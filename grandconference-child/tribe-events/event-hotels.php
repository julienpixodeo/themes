<?php
if (!defined('ABSPATH')) {
    die('-1');
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = Tribe__Events__Main::postIdHelper(get_the_ID());

// Allow filtering of the event ID
$event_id = apply_filters('tec_events_single_event_id', $event_id);

// Allow filtering of the single event template title classes
$title_classes = apply_filters('tribe_events_single_event_title_classes', ['tribe-events-single-event-title'], $event_id);
$title_classes = implode(' ', tribe_get_classes($title_classes));

// Allow filtering of the single event template title before HTML
$before = apply_filters('tribe_events_single_event_title_html_before', '<h1 class="' . $title_classes . '">');

// Allow filtering of the single event template title after HTML
$after = apply_filters('tribe_events_single_event_title_html_after', '</h1>');

// Allow filtering of the single event template title HTML
$title = apply_filters('tribe_events_single_event_title_html', the_title($before, $after, false), $event_id);
$lan = get_field('language', $event_id);
$cost = tribe_get_formatted_cost($event_id);
$location = get_post_meta($event_id, 'location', true);
$title_location = ($lan === 'french') ? get_field('locations_evhotel_fr', 'option') : get_field('locations_evhotel', 'option');
$get_maps_direction = ($lan === 'french') ? get_field('get_maps_direction_fr', 'option') : get_field('get_maps_direction', 'option');
$partnering_hotels = ($lan === 'french') ? get_field('partnering_hotels_fr', 'option') : get_field('partnering_hotels', 'option');
$sub_partnering_hotels = ($lan === 'french') ? get_field('sub_partnering_hotels_fr', 'option') : get_field('sub_partnering_hotels', 'option');
// $hotels = get_post_meta($event_id, 'hotels', true);
$list_event = get_post_meta($event_id, 'hotel_type-of-rooms', true);
$hotels = array();
$data_hotel = get_post_meta($event_id, 'data_hotel_event', true);

if ($list_event) {
    foreach ($list_event as $event) {
        $hotels[] = $event['hotelId'];
    }
}

if ($data_hotel) {
    foreach ($data_hotel as $data) {
        $hotels_data[] = $data['hotel_id'];

    }
}

$from = ($lan === 'french') ? 'Prix' : 'Price';
?>
<div class="container-hotel-list-wrap">
    <div class="top-heading">
        <h2 class="sub-title">
            <?php echo $partnering_hotels; ?>
        </h2>
        <div class="description-sub">
            <?php echo $sub_partnering_hotels; ?>
        </div>
    </div>
    <div class="filter-hotel-wrap">
        <?php 
            set_query_var('event_id', $event_id);
            get_template_part('filter-hotel/form-filter'); 
        ?>
        <div class="show-hide-map">
            <label class="switch">
                <input type="checkbox" checked>
                <span class="slider round"></span>
            </label>
        </div>
    </div>
    <div class="count-filter-wrap">
        <a href="<?php echo home_url() ?>">Accueil</a>
        <span>></span>
        <span class="count-hotel"><?php echo count($data_hotel); ?> hotels</span>
    </div>
    <div class="wrap-list-hotel">
        <div class="list-hotels-event">
            <?php
            $locations = array();

            if ($data_hotel) {
                // Step 1: Collect all the hotel data with the minimum price
                $hotels = array();

                foreach ($data_hotel as $data) {
                    $hotel_id = $data['hotel_id'];
                    $featured_img_url = get_the_post_thumbnail_url($hotel_id, 'full');
                    $address = get_field('address', $hotel_id);
                    $price = get_field('price', $hotel_id);
                    $hotel_stars = (!empty(get_field('hotel_stars', $hotel_id))) ? get_field('hotel_stars', $hotel_id) : 5;
                    $url_de_hotel = get_field('url_de_hotel', $hotel_id);

                    if ($url_de_hotel) {
                        $url = $url_de_hotel;
                        $attr = 'target="_blank"';
                    } else {
                        $url = get_permalink($hotel_id) . $event_id;
                        $attr = '';
                    }

                    $gallery = get_field('gallery', $hotel_id);

                    if (!$featured_img_url) {
                        if ($gallery) {
                            $featured_img_url = wp_get_attachment_image_url($gallery[0], 'full');
                        } else {
                            $featured_img_url = home_url('/wp-content/uploads/woocommerce-placeholder.png');
                        }
                    }

                    $rooms_hotel = get_field('rooms', $hotel_id);
                    $list_event = $data['variations_data'];
                    $price_array = array();

                    if ($list_event) {
                        foreach ($list_event as $event) {
                            if (isset($event['price'])) {
                                $price_array[] = $event['price'];
                            }
                        }
                    }

                    $gallery_images_urls = array();

                    if ($featured_img_url) {
                        $gallery_images_urls[] = $featured_img_url; 
                    }

                    if ($gallery) {
                        foreach ($gallery as $image_id) {
                            $gallery_images_urls[] = wp_get_attachment_image_url($image_id, 'full');
                        }
                    } 

                    if (!$featured_img_url && empty($gallery)) {
                        $gallery_images_urls[] = home_url('/wp-content/uploads/woocommerce-placeholder.png');
                    }

                    $minPrice = !empty($price_array) ? min($price_array) : 0;

                    $hotels[] = array(
                        'hotel_id' => $hotel_id,
                        'featured_img_url' => $featured_img_url,
                        'address' => $address,
                        'hotel_stars' => $hotel_stars,
                        'url' => $url,
                        'attr' => $attr,
                        'minPrice' => $minPrice,
                    );

                    if(!empty($address)){
                        $locations[] = [
                            'lat' => $address['lat'],
                            'lng' => $address['lng'],
                            'gallery_images' => $gallery_images_urls,
                            'title' => get_the_title($hotel_id),
                            'address' => $address['address'],
                            'minPrice' => $from . " " . $minPrice . get_woocommerce_currency_symbol(get_option('woocommerce_currency')),
                            'price' => $minPrice . " €",
                            'url' => $url,
                            'hotel_stars' => $hotel_stars
                        ];
                    }
                }

                // Step 2: Sort the collected data by the minimum price
                usort($hotels, function ($a, $b) {
                    return $a['minPrice'] - $b['minPrice'];
                });

                // Step 3: Display the sorted data
                foreach ($hotels as $hotel) {
                    ?>
                    <div class="item-hotels">
                        <a href="<?= $hotel['url'] ?>" <?= $hotel['attr'] ?>>
                            <img src="<?= $hotel['featured_img_url']; ?>" alt="" class="thumbnail">
                        </a>
                        <div class="wrap-title-rating">
                            <a href="<?= $hotel['url'] ?>" <?= $hotel['attr'] ?>
                                class="title"><?= get_the_title($hotel['hotel_id']); ?></a>
                            <div class="review-hotel">
                                <!-- <span class="rate"><?php echo number_format($hotel['hotel_stars'], 1); ?></span> -->
                                <div class="list-star">
                                    <?php echo generateStars($hotel['hotel_stars']); ?>
                                </div>
                            </div>
                        </div>
                        <div class="infor">
                            <?php
                            if (!empty($hotel['address']['address']) && !empty($hotel['address'])) {
                                ?>
                                <span><?= $hotel['address']['address']; ?></span>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                        if ($hotel['minPrice'] > 0) {
                            ?>
                            <h3 class="price">
                                <?php echo $from . " " . $hotel['minPrice'] . get_woocommerce_currency_symbol(get_option('woocommerce_currency')); ?>
                            </h3>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="list-hotel-map-wrap">
            <div id="list-hotel-map"></div>
        </div>
    </div>
    
</div>
<?php
if(!empty($locations)){
    ?>
    <script>
        jQuery(document).ready(function ($) {
            async function initMap() {
                // Request needed libraries.
                const { Map } = await google.maps.importLibrary("maps");
                const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

                var locations = <?php echo json_encode($locations); ?>;

                // Calculate the center of the map
                var latSum = 0, lngSum = 0;
                locations.forEach(function(location) {
                    latSum += location.lat;
                    lngSum += location.lng;
                });
                var centerLat = latSum / locations.length;
                var centerLng = lngSum / locations.length;

                const map = new Map(document.getElementById("list-hotel-map"), {
                    zoom: 4,
                    center: { lat: centerLat, lng: centerLng },
                    mapId: "4504f8b37365c3d0",
                });

                var bounds = new google.maps.LatLngBounds();

                // Loop through each location and add a marker
                locations.forEach((location) => {
                    const priceTag = document.createElement("div");
                    priceTag.className = "price-tag";
                    priceTag.textContent = location.price;

                    // Create and add the marker to the map
                    const marker = new AdvancedMarkerElement({
                        map,
                        position: { lat: location.lat, lng: location.lng },
                        content: priceTag,
                    });

                    var star = '';
                    for (var i = 0; i < location.hotel_stars; i++) {
                        star += '<i class="fas fa-star"></i>';
                    }

                    // Generate gallery HTML
                    var galleryHtml = '';
                    if (location.gallery_images && location.gallery_images.length) {
                        galleryHtml = '<div class="slick-slider">';
                        location.gallery_images.forEach((imageUrl) => {
                            galleryHtml += `<a href="${location.url}"><img src="${imageUrl}" alt="Hotel image" class="gallery-img"></a>`;
                        });
                        galleryHtml += '</div>';
                    }

                    var infowindow = new google.maps.InfoWindow({
                        content: `<div class="item-hotels-map">
                            <div>
                                ${galleryHtml}
                            </div>
                            <div class="wrap-title-rating">
                                <a href="${location.url}" class="title">${location.title}</a>
                                <div class="review-hotel">
                                    <div class="list-star">
                                        ${star}
                                    </div>
                                </div>
                            </div>
                            <div class="infor">
                                <span>${location.address}</span>
                            </div>
                            <h3 class="price">
                                ${location.minPrice}
                            </h3>
                        </div>`
                    });

                    marker.addListener('click', function() {
                        infowindow.open(map, marker);
                        currentInfoWindow = infowindow;
                        setTimeout(function() {
                            $('.slick-slider').slick({
                                dots: true,
                                infinite: true,
                                speed: 300,
                                slidesToShow: 1,
                                slidesToScroll: 1
                            });
                        }, 100);
                    });

                    bounds.extend(marker.position);

                    // Close InfoWindow on click outside
                    $(document).on('click', function (e) {
                        if (!$('#list-hotel-map').has(e.target).length && currentInfoWindow) {
                            currentInfoWindow.close();
                            currentInfoWindow = null;
                        }
                    });

                    // Prevent click inside InfoWindow from closing it
                    google.maps.event.addListener(map, 'click', function (e) {
                        if (currentInfoWindow) {
                            currentInfoWindow.close();
                            currentInfoWindow = null;
                        }
                    });
                });
                // Adjust map to fit all markers
                map.fitBounds(bounds);
            }

            initMap();
        });
    </script>
    <?php
}
?>

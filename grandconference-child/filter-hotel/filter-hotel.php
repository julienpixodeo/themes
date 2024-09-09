<?php
function haversine_distance($lat1, $lng1, $lat2, $lng2) {
    $earth_radius = 6371; // Earth radius in kilometers

    $dLat = deg2rad($lat2 - $lat1);
    $dLng = deg2rad($lng2 - $lng1);

    $a = sin($dLat / 2) * sin($dLat / 2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($dLng / 2) * sin($dLng / 2);

    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $distance = $earth_radius * $c;

    return $distance;
}

function get_posts_within_distance($lat, $lng, $distance) {
    global $wpdb;

    $posts = $wpdb->get_results("
        SELECT p.ID, p.post_title, pm1.meta_value AS lat, pm2.meta_value AS lng
        FROM {$wpdb->posts} p
        JOIN {$wpdb->postmeta} pm1 ON p.ID = pm1.post_id AND pm1.meta_key = '_latitude'
        JOIN {$wpdb->postmeta} pm2 ON p.ID = pm2.post_id AND pm2.meta_key = '_longitude'
        WHERE p.post_status = 'publish'
    ");

    $filtered_posts = [];

    foreach ($posts as $post) {
        $post_distance = haversine_distance($lat, $lng, $post->lat, $post->lng);
        if ($post_distance <= $distance) {
            $filtered_posts[] = $post;
        }
    }

    return $filtered_posts;
}

function filter_hotel(){
    ob_start();
    $min_price = (int) $_POST['min_price'];
    $max_price = (int) $_POST['max_price'];
    $min_distance = (int) $_POST['min_distance'];
    $max_distance = (int) $_POST['max_distance'];
    $event_id = (int) $_POST['event_id'];
    $star = isset($_POST['star']) ? $_POST['star'] : '';
    $star_ratings = !empty($star) ? $star : ["1","2","3","4","5"];

    $data_hotel = get_post_meta($event_id, 'data_hotel_event', true);
    $lan = get_field('language', $event_id);
    $from = ($lan === 'french') ? 'Prix' : 'Price';
    $location = get_post_meta($event_id, 'location', true);
    
    if (!empty($location)) {
        $lat = $location['lat'];
        $lng = $location['lng'];
    }

    if ($data_hotel) {
        // Collect hotel data
        $hotels = array();

        foreach ($data_hotel as $data) {
            $hotel_id = $data['hotel_id'];
            $featured_img_url = get_the_post_thumbnail_url($hotel_id, 'full') ?: wp_get_attachment_image_url(get_field('gallery', $hotel_id)[0], 'full') ?: home_url('/wp-content/uploads/woocommerce-placeholder.png');
            $address = get_field('address', $hotel_id);
            $hotel_stars = get_field('hotel_stars', $hotel_id) ?: 5;
            $url_de_hotel = get_field('url_de_hotel', $hotel_id);
            $url = $url_de_hotel ?: get_permalink($hotel_id) . $event_id;
            $attr = $url_de_hotel ? 'target="_blank"' : '';

            if (!empty($address)) {
                $lat_post = $address['lat'];
                $lng_post = $address['lng'];
            }

            $post_distance = haversine_distance($lat, $lng, $lat_post, $lng_post);

            // Get minimum price from variations
            $price_array = array_column($data['variations_data'], 'price');
            $minPrice = !empty($price_array) ? min($price_array) : 0;
            // Filter hotels by min_price and max_price
            if ($minPrice >= $min_price && $minPrice <= $max_price && in_array($hotel_stars, $star_ratings) && $post_distance <= $max_distance) {
                $hotels[] = array(
                    'hotel_id' => $hotel_id,
                    'featured_img_url' => $featured_img_url,
                    'address' => $address,
                    'hotel_stars' => $hotel_stars,
                    'url' => $url,
                    'attr' => $attr,
                    'minPrice' => $minPrice,
                );
            }
        }

        // Sort hotels by minimum price
        usort($hotels, function ($a, $b) {
            return $a['minPrice'] - $b['minPrice'];
        });

        // Display sorted hotel data
        foreach ($hotels as $hotel) {
            ?>
            <div class="item-hotels">
                <a href="<?= esc_url($hotel['url']) ?>" <?= esc_attr($hotel['attr']) ?>>
                    <img src="<?= esc_url($hotel['featured_img_url']); ?>" alt="" class="thumbnail">
                </a>
                <div class="wrap-title-rating">
                    <a href="<?= esc_url($hotel['url']) ?>" <?= esc_attr($hotel['attr']) ?> class="title"><?= esc_html(get_the_title($hotel['hotel_id'])); ?></a>
                    <div class="review-hotel">
                        <div class="list-star">
                            <?= generateStars($hotel['hotel_stars']); ?>
                        </div>
                    </div>
                </div>
                <div class="infor">
                    <?php if (!empty($hotel['address']['address'])) { ?>
                        <span><?= esc_html($hotel['address']['address']); ?></span>
                    <?php } ?>
                </div>
                <?php if ($hotel['minPrice'] > 0) { ?>
                    <h3 class="price">
                        <?= esc_html($from) . " " . esc_html($hotel['minPrice']) . get_woocommerce_currency_symbol(get_option('woocommerce_currency')); ?>
                    </h3>
                <?php } ?>
            </div>
            <?php
        }
    }
    $html = ob_get_contents();
    ob_end_clean();
    $return = array(
        'html' => $html
    );

    wp_send_json($return);
}
add_action('wp_ajax_filter_hotel', 'filter_hotel');
add_action('wp_ajax_nopriv_filter_hotel', 'filter_hotel');
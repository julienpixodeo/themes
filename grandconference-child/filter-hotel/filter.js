jQuery(document).ready(function ($) {
    var currency = $('.woocommerce_currency').val();
    // Initialize price range slider
    $("#price-range").slider({
        range: true,
        min: 0,
        max: 1000,
        values: [0, 1000],
        slide: function(event, ui) {
            $("#price-amount").text(ui.values[0] + currency + " - " + ui.values[1] + currency);
            $("#price-amount-btn").text(ui.values[0] + currency + " - " + ui.values[1] + currency);
            $(".min-price").val(ui.values[0]);
            $(".max-price").val(ui.values[1]);
        }
    });
    $("#price-amount").text($("#price-range").slider("values", 0) + currency + " - " + $("#price-range").slider("values", 1) + currency);
    // $("#price-amount-btn").text($("#price-range").slider("values", 0) + currency + " - " + $("#price-range").slider("values", 1) + currency);
    $(".min-price").val($("#price-range").slider("values", 0));
    $(".max-price").val($("#price-range").slider("values", 1));

    // Initialize address range slider
    $("#address-range").slider({
        range: true,
        min: 0,
        max: 1000,
        values: [0, 1000],
        slide: function(event, ui) {
            $("#address-amount").text(ui.values[0] + "Km - " + ui.values[1] + "Km");
            $("#address-amount-btn").text(ui.values[0] + "Km - " + ui.values[1] + "Km");
            $(".min-distance").val(ui.values[0]);
            $(".max-distance").val(ui.values[1]);
        }
    });
    $("#address-amount").text($("#address-range").slider("values", 0) + "Km - " + $("#address-range").slider("values", 1)+ "Km");
    // $("#address-amount-btn").text($("#address-range").slider("values", 0) + "Km - " + $("#address-range").slider("values", 1)+ "Km");
    $(".min-distance").val($("#address-range").slider("values", 0));
    $(".max-distance").val($("#address-range").slider("values", 1));

    // change select stars
    $('.filter-hotel').on('change','#stars-select',function(e){  
        e.preventDefault();
        $("#btn-stars").text($(this).val()+" Stars");
    }); 

    // show filter each
    $('body').on('click', '.show-filter', function(event) {
        event.preventDefault();
        $('.drop-filter').not($(this).closest('.wrap-item-filter').find('.drop-filter')).slideUp(100);
        $(this).closest('.wrap-item-filter').find('.drop-filter').slideToggle(100);
        event.stopPropagation(); // Prevents the click from triggering the document event
    });

    // Hide all filters when clicking outside
    $(document).on('click', function(event) {
        if (!$(event.target).closest('.wrap-item-filter').length) {
            $('.drop-filter').slideUp(100); // Hide all .drop-filter elements
        }
    });
    
    // apply filter each
    $('body').on('click','.apply-filter-each', function(event) {
        event.preventDefault();
        $('.drop-filter').slideUp(100);
        applyHotelFilters();
    });

    // toggle show map
    $('body').on('click','.show-hide-map input', function(event) {
        if ($(this).is(':checked')) {
            $('.wrap-list-hotel').removeClass('active');
        } else {
            $('.wrap-list-hotel').addClass('active');
        }
    });

    // sticky sidebar map
    var $sticky = $('.list-hotel-map-wrap');
    var $stickyrStopper = $('.footer-content');
    if (!!$sticky.offset()) { // make sure ".sticky" element exists
  
        var generalSidebarHeight = $sticky.innerHeight();
        var stickyTop = $sticky.offset().top;
        if($('.admin-bar').length){
            var stickOffset = 110;
        }else{
            var stickOffset = 78;
        }
        var stickyStopperPosition = $stickyrStopper.offset().top;
        var stopPoint = stickyStopperPosition - generalSidebarHeight - stickOffset;
        var diff = stopPoint + stickOffset;
    
        $(window).scroll(function(){ // scroll event
            var windowTop = $(window).scrollTop(); // returns number
    
            if (stopPoint < windowTop) {
                $sticky.css({ position: 'absolute', top: diff });
            } else if (stickyTop < windowTop+stickOffset) {
                $sticky.css({ position: 'fixed', top: stickOffset });
            } else {
                $sticky.css({position: 'absolute', top: 'initial'});
            }
        });
    }

    var stickyTop_filter = $('.filter-hotel-wrap').offset().top;
    $(window).scroll(function(){
        if ($(window).scrollTop() >= stickyTop_filter) {
            $('.filter-hotel-wrap').addClass('fixed-header');
        }
        else {
            $('.filter-hotel-wrap').removeClass('fixed-header');
        }
    });

    // apply Hotel Filters
    function applyHotelFilters() {
        // Fetch values from the context
        var event_id = $('.filter-hotel .event-id').val(),
        min_price =  $('.filter-hotel .min-price').val(),
        max_price =  $('.filter-hotel .max-price').val(),
        min_distance = $('.filter-hotel .min-distance').val(),
        max_distance =  $('.filter-hotel .max-distance').val();
        star =  $('.filter-hotel #stars-select').val();
        
        $.ajax({
            url: jaxsr.url,
            type: 'POST',
            data: {
                action: 'filter_hotel',
                min_price: min_price,
                max_price: max_price,
                min_distance: min_distance,
                max_distance: max_distance,
                event_id: event_id,
                star: star,
            },
            success: function(response) {
                $('.list-hotels-event').html(response.html);
                $('.count-hotel').text(response.count +  " hotels");
                initMap(response.locations);
            },
            error: function(err) {
                console.log(err);
            }
        });
    }

    // Function to initialize the map
    async function initMap(locations) {
        // Request needed libraries.
        const { Map } = await google.maps.importLibrary("maps");
        const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

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

    // ajax js filter hotel
    $('.filter-hotel').on('click','#apply-filters',function(e){  
        e.preventDefault();
        var event_id = $('.filter-hotel .event-id').val(),
        min_price = $('.filter-hotel .min-price').val(),
        max_price = $('.filter-hotel .max-price').val(),
        min_distance = $('.filter-hotel .min-distance').val(),
        max_distance = $('.filter-hotel .max-distance').val();
        var star = [];

        $('input.star-review[type="checkbox"]:checked').each(function() {
            star.push($(this).val());
        });
        
        console.log(star);
        $.ajax({
            url: jaxsr.url,
            type :'POST',
            data : {
                action : 'filter_hotel',
                min_price: min_price,
                max_price: max_price,
                min_distance: min_distance,
                max_distance: max_distance,
                event_id: event_id,
                star: star,
            },
            success: function (response) {
                $('.list-hotels-event').html(response.html);
            },
            error: function(err){
                console.log(err);
            }
        });
    });
});
<form action="" class="filter-hotel">
    <input type="hidden" class="event-id" value="<?php echo $event_id; ?>">
    <input type="hidden" class="woocommerce_currency" value="<?php echo get_woocommerce_currency_symbol(get_option('woocommerce_currency')); ?>">
    <div class="wrap-item-filter">
        <button class="show-filter"><span id="price-amount-btn">Prix</span><i class="fal fa-angle-down"></i></button>
        <div class="drop-filter">
            <div class="filter-section">
                <div class="wrap-header">
                    <div class="filter-title">Prix</div>
                    <div class="filter-range">
                        <span id="price-amount"></span>
                    </div>
                </div>
                <div id="price-range"></div>
                <input type="hidden" class="min-price">
                <input type="hidden" class="max-price">
                <button class="apply-filter-each">Appliquer</button>
            </div>
        </div>
    </div>

    <div class="wrap-item-filter">
        <button class="show-filter"><span id="btn-stars">Stars</span><i class="fal fa-angle-down"></i></button>
        <div class="drop-filter">
            <div class="filter-section">
                <div class="wrap-header">
                    <div class="filter-title">Stars</div>
                </div>
                <select name="stars" id="stars-select">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <button class="apply-filter-each">Appliquer</button>
            </div>
        </div>
    </div>

    <div class="wrap-item-filter">
        <button class="show-filter"><span id="address-amount-btn">Distance</span> <i class="fal fa-angle-down"></i></button>
        <div class="drop-filter">
            <div class="filter-section">
                <div class="wrap-header">
                    <div class="filter-title">Distance</div>
                    <div class="filter-range">
                        <span id="address-amount"></span>
                    </div>
                </div>
                <div id="address-range"></div>
                <input type="hidden" class="min-distance">
                <input type="hidden" class="max-distance">
                <button class="apply-filter-each">Appliquer</button>
            </div>
        </div>
    </div>
    <!-- <button id="apply-filters">Apply Filters</button> -->
</form>
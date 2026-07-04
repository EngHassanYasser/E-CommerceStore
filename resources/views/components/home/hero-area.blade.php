  <!-- Start Hero Area -->
 <div></div>
   @if(session()->has('message'))
        <div class="alert alert-danger text-center">{{ session('message') }}</div>
    @endif
    <section class="hero-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12 custom-padding-right">
                    <div class="slider-head">
                        <!-- Start Hero Slider -->
                        <div class="hero-slider">
                            <!-- Start Single Slider -->
                            <div class="single-slider"
                                style="background-image: url();">
                                <div class="content">
                                    <h2><span>{{ __('hero-area.No_restocking_fee_($35_savings)') }}</span>
                                        {{ __('hero-area.M75_Sport_Watch') }}
                                    </h2>
                                    <p>{{ __('hero-area.The_M75_Sport_Watch_combines_modern_design_with_reliable_performance._It_features_a_high-resolution_display,_a_comfortable_strap,_and_long_battery_life,_making_it_ideal_for_daily_wear_and_sports_activities._It_delivers_a_dependable_user_expe_rience_with_a_stylish_look_suitable_for_any_occasion.') }}</p>
                                    <h3><span>{{ __('hero-area.Now_Only') }}</span> {{ __('hero-area.$320.99') }}</h3>
                                    <div class="button">
                                        <a href="product-grids.html" class="btn">{{ __('hero-area.Shop_Now') }}</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Slider -->
                            <!-- Start Single Slider -->
                            <div class="single-slider"
                                style="background-image: url();">
                                <div class="content">
                                    <h2><span>{{ __('hero-area.Big_Sale_Offer') }}</span>
                                        {{ __('hero-area.Get_the_Best_Deal_on_CCTV_Camera') }}
                                    </h2>
                                    <p>{{ __('hero-area.Discover_the_latest_CCTV_cameras_with_high-definition_video_quality,_clear_night_vision,_and_smart_connectivity_to_monitor_your_home_or_business_anytime,_from_anywhere._Enjoy_enhanced_security_with_reliable_performance_and_easy_installation.') }}</p>
                                    <h3><span>{{ __('hero-area.Combo_Only') }}:</span> {{ __('hero-area.$590.00') }}</h3>
                                    <div class="button">
                                        <a href="product-grids.html" class="btn">{{ __('hero-area.Shop_Now') }}</a>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Slider -->
                        </div>
                        <!-- End Hero Slider -->
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-12 md-custom-padding">
                            <!-- Start Small Banner -->
                            <div class="hero-small-banner"
                                style="background-image: url('');">
                                <div class="content">
                                    <h2>
                                        <span>{{ __('hero-area.New_line_required') }}</span>
                                        {{ __('hero-area.iPhone_12_Pro_Max') }}
                                    </h2>
                                    <h3>{{ __('hero-area.$259.99') }}</h3>
                                </div>
                            </div>
                            <!-- End Small Banner -->
                        </div>
                        <div class="col-lg-12 col-md-6 col-12">
                            <!-- Start Small Banner -->
                            <div class="hero-small-banner style2">
                                <div class="content">
                                    <h2>{{ __('hero-area.Weekly_Sale!') }}</h2>
                                    <p>{{ __('hero-area.Saving_up_to_50%_off_all_online_store_items_this_week') }}</p>
                                    <div class="button">
                                        <a class="btn" href="product-grids.html">{{ __('hero-area.Shop_Now') }}</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Start Small Banner -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Area -->
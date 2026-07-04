  <!-- Start Trending Product Area -->
    <section class="trending-product section">
        <div class="container">
            <div class="row">
                @foreach ($products as $product)
                 <div class="col-lg-3 col-md-6 col-12">
                    <x-product-cart :product="$product"/>
                </div>
                @endforeach
               
            </div>
        </div>
    </section>
    <!-- End Trending Product Area -->
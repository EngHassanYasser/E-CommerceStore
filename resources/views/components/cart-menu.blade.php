  <div class="cart-items">
      <a href="javascript:void(0)" class="main-btn">
          <i class="lni lni-cart"></i>
          <span class="total-items">{{ $items->count }}</span>
      </a>
      <!-- Shopping Item -->
      <div class="shopping-item">
          <div class="dropdown-cart-header">
              <span>{{ $items->count }} Items</span>
              <a href="{{ route('cart.index') }}">View Cart</a>
          </div>
          <ul class="shopping-list">
              @foreach ($cart->items as $item)
                  <li data-id="{{ $item->id }}" class="cart-item">
                      <a data-id="{{ $item->id }}" href="javascript:void(0)" class="remove remove-menu-cart-item"
                          title="Remove this item"><i class="lni lni-close"></i></a>
                      <div class="cart-img-head">
                          <a class="cart-img" href="{{ route('product.show', $item->product->slug) }}">
                            <img src="{{asset('storage/products/' . $item->product->image)}}" alt="#"></a>
                      </div>
                      <div class="content">
                          <h4><a href="product-details.html">{{ $item->product->name }}</a></h4>
                          <p class="quantity"{{ $item->quantity }}1x - <span class="amount">
                              {{ Currency::format($item->price) }}</span></p>
                      </div>
                  </li>
              @endforeach

          </ul>
          <div class="bottom">
              <div class="total">
                  <span>Total</span>
                  <span class="total-amount">{{ Currency::format($cart->total) }}</span>
              </div>
              <div class="button">
                  <a href="{{ route('checkout') }}" class="btn animate">Checkout</a>
              </div>
          </div>
      </div>
      <!--/ End Shopping Item -->
  </div>

  @push('scripts')
      <script>
          const csrf_token = "{{ csrf_token() }}";
      </script>
      @vite('resources/js/cart.js')

     <!-- Start Topbar -->
     <div class="topbar">
         <div class="container">
             <div class="row align-items-center">
                 <div class="col-lg-4 col-md-4 col-12">
                     <div class="top-left">
                         <ul class="menu-top-link">
                             <li>
                                 <div class="select-position">
                                     <form action="{{ route('currency.store') }}" method="post">
                                         @csrf
                                         <select name="currency_code" onchange="this.form.submit()">
                                             <option value="USD"
                                                 {{ session('currency_code') == 'USD' ? 'selected' : '' }}>$ USD
                                             </option>
                                             <option value="EUR"
                                                 {{ session('currency_code') == 'EUR' ? 'selected' : '' }}>€ EURO
                                             </option>
                                             <option value="EGP"
                                                 {{ session('currency_code') == 'EGP' ? 'selected' : '' }}>£ EGP
                                             </option>
                                         </select>
                                     </form>
                                 </div>
                             </li>
                             <li>
                                 <div class="select-position">
                                     <select name="locale" onchange="window.location.href=this.value">
                                         @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                             <option value="{{ $localeCode }}"
                                                 {{ App::currentLocale() == $localeCode ? 'selected' : '' }}>
                                                 {{ $properties['native'] }}
                                             </option>
                                         @endforeach
                                     </select>
                                 </div>
                             </li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-lg-4 col-md-4 col-12">
                     <div class="top-middle">
                         <ul class="useful-links">
                             <li><a href="/">{{ trans('app.home') }}</a></li>
                             <li><a href="{{ route('about-us') }}">{{ __('app.about_us') }}</a></li>
                             <li><a href="{{ route('contact') }}">{{ __('app.contact_us') }}</a></li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-lg-4 col-md-4 col-12">
                     <div class="top-end">
                         @auth
                             <div class="user">
                                 <i class="lni lni-user"></i>
                                 {{ Auth::guard('web')->user()->name }}
                             </div>
                             <ul class="user-login">
                                 <li>
                                     <a href=""
                                         onclick="event.preventDefault();document.getElementById('logout').submit()">Sign
                                         out</a>
                                 </li>
                                 <form style="display: none;" method="post" action="{{ route('logout') }}" id="logout">
                                     @csrf
                                 </form>
                             </ul>
                         @else
                             <div class="user">
                                 <i class="lni lni-user"></i>
                                 {{ __('hello') }}
                             </div>
                             <ul class="user-login">
                                 <li>
                                     <a href="{{ route('login') }}">{{ Lang::get('signin') }}</a>
                                 </li>
                                 <li>
                                     <a href="{{ route('register') }}"> @lang('register')</a>
                                 </li>
                             </ul>

                         @endauth

                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- End Topbar -->

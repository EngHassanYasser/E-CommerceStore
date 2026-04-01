<x-front-layout title="login">
 <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" method="post" action="{{ route('two-factor.enable') }}">
                        @if($errors->any) 
                           @foreach ($errors->all() as $error)
                               <div>{{ $error }}</div>
                           @endforeach
                        @endif
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>Two Factor Authentication</h3>
                                <p>enable/disable 2FA.</p>
                                </div>

                            @if(session('status') == 'two-factor-authentication-enabled')
                            <div class="mb-2 font-medium text-sm"> please finish configuring two factor authentication bleow</div>

                            @endif
                            <div class="button">
                                @if(!$user->two_factor_secret)
                                      <button class="btn" type="submit">Enable</button>
                                @else
                                @method('delete')
                                        {!!  $user->twoFactorQrCodeSvg() !!}
                                      <button class="btn" type="submit">Disable</button>
                                @endif
                            </div>
                          
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->

    <!-- Start Footer Area -->
    <footer class="footer">
        <!-- Start Footer Top -->
        <div class="footer-top">
            <div class="container">
                <div class="inner-content">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="footer-logo">
                                <a href="index.html">
                                    <img src="assets/images/logo/white-logo.svg" alt="#">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 col-12">
                            <div class="footer-newsletter">
                                <h4 class="title">
                                    Subscribe to our Newsletter
                                    <span>Get all the latest information, Sales and Offers.</span>
                                </h4>
                                <div class="newsletter-form-head">
                                    <form action="#" method="get" target="_blank" class="newsletter-form">
                                        <input name="EMAIL" placeholder="Email address here..." type="email">
                                        <div class="button">
                                            <button class="btn">Subscribe<span class="dir-part"></span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-front-layout>
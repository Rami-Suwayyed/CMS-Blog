<!-- Footer Area -->
<footer id="wn__footer" class="footer__area bg__cat--8 brown--color">
    <div class="footer-static-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__widget footer__menu">
                        <div class="ft__logo">
                            <a href="index.html">
                                <img src="{{ asset('frontend/images/logo/logo.png') }}" alt="logo">
                            </a>
                            <p></p>
                        </div>
                        <div class="footer__content">
                            <ul class="social__net social__net--2 d-flex justify-content-center">
                                <li><a href="https://www.facebook.com/avocadosoft/"><i class="bi bi-facebook"></i></a></li>
                                <li><a href="https://www.instagram.com/avocado.software"><i class="bi bi-google"></i></a></li>
                                <li><a href="https://twitter.com/Rami_Suwayyed/"><i class="bi bi-twitter"></i></a></li>
                                <li><a href="https://www.linkedin.com/company/avocadosoft/"><i class="bi bi-linkedin"></i></a></li>
{{--                                <li><a href="#"><i class="bi bi-youtube"></i></a></li>--}}
                            </ul>
                            <ul class="mainmenu d-flex justify-content-center">
                                <li><a href="{{route('frontend.home.index')}}">{{ __('Frontend/general.home_page') }}</a></li>
                                <li><a href="{{ route('frontend.pages.show',  'about-us') }}">{{ __('Frontend/general.about_us') }}</a></li>
                                <li><a href="{{ route('frontend.pages.show',  'our-vision') }}">{{ __('Frontend/general.our_vision') }}</a></li>
                                <li><a href="{{ route('frontend.posts.index') }}">{{ __('Frontend/general.blog') }}</a></li>
                                <li><a href="{{ route('frontend.pages.show',  'privacy-policy') }}">{{ __('Frontend/general.privacy-policy') }}</a></li>
                                <li><a href="{{ route('frontend.pages.show',  'terms-of-service') }}">{{ __('Frontend/general.terms-of-service') }}</a></li>
                                <li><a href="{{ route('frontend.contact') }}">{{ __('Frontend/general.contact') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright__wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="copyright">
                        <div class="copy__right__inner text-left">
                            <p>{!! __('Frontend/general.copyright') !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="payment text-right">
                        <div class="text-sm-end d-none d-sm-block">
                            {{ __('Frontend/general.crafted_with_love') }} <i class="mdi mdi-heart text-danger"></i> {{__('Frontend/general.by')}} <a class="text-reset" href="https://rami-suwayyed.netlify.app/" target="_blank"  style="color: #1b4b72" >{{__('Frontend/general.rami_suwayyed')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- //Footer Area -->

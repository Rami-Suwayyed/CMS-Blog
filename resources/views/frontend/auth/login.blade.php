@extends('layouts.app-auth')

@section('content')
    <section class="my_account_area pt--80 pb--55 bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-md-3">
                    <div class="my__account__wrapper">
                        <h3 class="account__title">{{ __('Frontend/auth.login') }}</h3>
                        <div class="account__form">
                            <form action="{{ route('frontend.login') }}" method="post">
                                @csrf
                                    <div class="input__box">
                                        <label for="username">{{ __('Frontend/auth.username_or_email') }}</label>
                                        <input type="text" name="login" value="{{ old('login') }}">
                                        @error('login')<span class="text-danger">{{ $message }}</span>@enderror
                                        @error('email'||'username')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <div class="input__box">
                                        <label for="password">{{ __('Frontend/auth.password') }}</label>
                                        <input type="password" name="password">
                                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                    <label class="label-for-checkbox">
                                        <input class="input-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span>{{ __('Frontend/auth.remember_me') }}</span>
                                    </label>
                                    <div class="form__btn">
                                        <button type="submit">{{ __('Frontend/auth.login') }}</button>
                                    </div>
                                    <a class="forget_pass" href="{{ route('password.request') }}">{{ __('Frontend/auth.forgot_password') }}</a>
                            </form>
                            <div class="form__btn" style=" text-align: end">
                               {{__('Frontend/auth.have`t_an_account')}}   <a  href="{{route('frontend.show_register_form')}}"  class="btn btn-outline-primary">{{__('Frontend/auth.register_here')}}</a>
                            </div>
                        </div>

                        <div >
                            <p style="text-align: center; margin-bottom: 2px">{{ __('Frontend/auth.or') }}</p>
                            <hr>
                            <div class="form__btn mt-3 mb-3" style=" text-align: center">
                                <h5 class="text-center">{{ __('Frontend/auth.login_with_social') }}</h5>
                            </div>
                                <div class="form__btn" >
                                <a href="{{ route('frontend.social_login', 'facebook') }}" class="btn btn-block" style="background-color: #1877F2; color: #ffffff;">{{ __('Frontend/auth.login_facebook') }}</a>
                                {{--                                    <a href="{{ route('frontend.social_login', 'twitter') }}" class="btn btn-block" style="background-color: #1DA1F2; color: #ffffff;">{{ __('Frontend/auth.login_twitter') }}</a>--}}
                                <a href="{{ route('frontend.social_login', 'google') }}" class="btn btn-block" style="background-color: #ce453a; color: #ffffff;">{{ __('Frontend/auth.login_google') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.app-auth')

@section('content')
    <section class="my_account_area pt--80 pb--55 bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-md-3">
                    <div class="my__account__wrapper">
                        <h3 class="account__title">{{ __('Frontend/auth.login') }}</h3>
                        <form action="{{ route('frontend.login') }}" method="post">
                            @csrf
                            <div class="account__form">
                                <div class="input__box">
                                    <label for="username">{{ __('Frontend/auth.username') }}</label>
                                    <input type="text" name="username" value="{{ old('username') }}">
                                    @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="input__box">
                                    <label for="password">{{ __('Frontend/auth.password') }}</label>
                                    <input type="password" name="password">
                                    @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form__btn">
                                    <button type="submit">{{ __('Frontend/auth.login') }}</button>
                                    <label class="label-for-checkbox">
                                        <input class="input-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span>{{ __('Frontend/auth.remember_me') }}</span>
                                    </label>
                                </div>
                                <a class="forget_pass" href="{{ route('password.request') }}">{{ __('Frontend/auth.lost_password') }}</a>

                                <div class="form__btn">
                                    <a href="{{ route('frontend.social_login', 'facebook') }}" class="btn btn-block" style="background-color: #1877F2; color: #ffffff;">{{ __('Frontend/auth.login_facebook') }}</a>
                                    <a href="{{ route('frontend.social_login', 'twitter') }}" class="btn btn-block" style="background-color: #1DA1F2; color: #ffffff;">{{ __('Frontend/auth.login_twitter') }}</a>
                                    <a href="{{ route('frontend.social_login', 'google') }}" class="btn btn-block" style="background-color: #ce453a; color: #ffffff;">{{ __('Frontend/auth.login_google') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

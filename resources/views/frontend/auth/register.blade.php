@extends('layouts.app-auth')


@section('content')
    <section class="my_account_area pt--80 pb--55 bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-md-3">
                    <div class="my__account__wrapper">
                        <h3 class="account__title">{{ __('Frontend/auth.register') }}</h3>
                        <form action="{{ route('frontend.register') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="account__form">
                                <div class="input__box">
                                    <label for="name">{{ __('Frontend/auth.name') }}</label>
                                    <input type="text" name="name" value="{{ old('name') }}">
                                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="input__box">
                                    <label for="username">{{ __('Frontend/auth.username') }}</label>
                                    <input type="text" name="username" value="{{ old('username') }}">
                                    @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="input__box">
                                    <label for="email">{{ __('Frontend/auth.email') }}</label>
                                    <input type="text" name="email" value="{{ old('email') }}">
                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="input__box">
                                    <label for="phone_number">{{ __('Frontend/auth.phone_number') }}</label>
                                    <input type="text" name="phone_number" value="{{ old('phone_number') }}">
                                    @error('phone_number')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="input__box">
                                    <label for="password">{{ __('Frontend/auth.password') }}</label>
                                    <input type="password" name="password">
                                    @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="input__box">
                                    <label for="password_confirmation">{{ __('Frontend/auth.password_confirmation') }}</label>
                                    <input type="password" name="password_confirmation">
                                    @error('password_confirmation')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>

                                <div class="input__box">
                                    <label for="user_image">{{ __('Frontend/auth.user_image') }}</label>
                                    <input type="file" name="user_image" class="custom-file">
                                    @error('user_image')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form__btn ">
                                    <button type="submit" class="btn-block">{{ __('Frontend/auth.create_account') }}</button>
                                </div>
                                <div class="form__btn">
                                    <br>
                                    {{ __('Frontend/auth.have_an_account') }}  <span> <a class="forget_pass_loge" href="{{ route('frontend.show_login_form') }}">{{ __('Frontend/auth.login_here') }}</a></span>
                                </div>
                            </div>
                        </form>


                        <div  style="justify-items: center;text-align: center;padding: 10px;">
                            <strong><hr></strong>
                           <span class="mt-3" >{{ __('Frontend/auth.or') }}</span>
                            <div class="form__btn mt-3" >
                                <a href="{{ route('frontend.social_login', 'facebook') }}" class="btn btn-block" style="background-color: #1877F2; color: #ffffff;"> <span class="fa fa-facebook"></span> {{ __('Frontend/auth.login_facebook') }}</a>
                                <a href="{{ route('frontend.social_login', 'twitter') }}" class="btn btn-block" style="background-color: #1DA1F2; color: #ffffff;">   <span class="fa fa-twitter"></span> {{ __('Frontend/auth.login_twitter') }}</a>
                                <a href="{{ route('frontend.social_login', 'google') }}" class="btn btn-block" style="background-color: #ce453a; color: #ffffff;"> <span class="fa fa-google"></span> {{ __('Frontend/auth.login_google') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

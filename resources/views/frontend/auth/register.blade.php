@extends('layouts.app-auth')


@section('content')
    <section class="my_account_area pt--80 pb--55 bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-md-3">
                    <div class="my__account__wrapper">
                        <h3 class="account__title">Register</h3>
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
                                    <label for="mobile">{{ __('Frontend/auth.mobile') }}</label>
                                    <input type="text" name="mobile" value="{{ old('mobile') }}">
                                    @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
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

                                <div class="form__btn">
                                    <button type="submit">{{ __('Frontend/auth.create_account') }}</button>
                                </div>
                                <a class="forget_pass" href="{{ route('frontend.show_login_form') }}">{{ __('Frontend/auth.login_2') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

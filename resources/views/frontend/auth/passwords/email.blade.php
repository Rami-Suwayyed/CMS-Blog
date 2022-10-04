@extends('layouts.app-auth')

@section('content')
    <section class="my_account_area pt--80 pb--55 bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-md-3">
                    <div class="my__account__wrapper">
                        <h3 class="account__title">{{ __('Frontend/auth.password_reset') }}</h3>
                        <form action="{{ route('password.email') }}" method="post">
                            @csrf
                            <div class="account__form">
                                <div class="input__box">
                                    <label for="email">{{ __('Frontend/auth.email_address') }}</label>
                                    <input type="email" name="email" value="{{ old('email') }}">
                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form__btn">
                                    <button type="submit">
                                        {{ __('Frontend/auth.send_password_reset') }}
                                    </button>
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

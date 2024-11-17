@extends('layouts.app-auth')

@section('content')
    <section class="my_account_area pt--80 pb--55 bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-md-3">
                    <div class="my__account__wrapper">
                        <h3 class="account__title">{{ __('Frontend/auth.reset_password') }}</h3>
                        <form action="{{ route('password.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="account__form">
                                <div class="input__box">
                                    <label for="email">{{ __('Frontend/auth.email_address') }}</label>
                                    <input type="email" name="email" value="{{ $email ?? old('email') }}" readonly>
                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
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

                                <div class="form__btn">
                                    <button type="submit">{{ __('Frontend/auth.reset_password') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

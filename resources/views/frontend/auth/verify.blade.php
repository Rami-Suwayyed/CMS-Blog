@extends('layouts.app-auth')

@section('content')
    <section class="my_account_area pt--80 pb--55 bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-md-3">
                    <div class="my__account__wrapper">
                        <h3 class="account__title">{{ __('Frontend/auth.verify_email') }}</h3>


                        {{ __('Frontend/auth.please_check_email') }}
                        {{ __('Frontend/auth.if_did_not_receive_email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Frontend/auth.request_another') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

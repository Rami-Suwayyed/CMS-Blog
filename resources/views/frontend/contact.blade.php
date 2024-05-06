@extends('layouts.app')
@section('content')

    <div class="col-lg-8 col-12">
        <div class="contact-form-wrap">
            <h2 class="contact__title">{{ __('Frontend/general.get_in_touch') }}</h2>
            <form action="{{ route('frontend.do_contact') }}" method="post" id="contact-form">
                @csrf
                <div class="single-contact-form">
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('Frontend/general.your_name_here') }}">
                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="single-contact-form space-between">
                    <input type="text" name="email" value="{{ old('email') }}" placeholder="{{ __('Frontend/general.your_email_here') }}">
                    <input type="text" name="phone_number" value="{{ old('phone_number') }}" placeholder="{{ __('Frontend/general.your_phone_number_here') }}">
                </div>
                <div class="single-contact-form space-between">
                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                    @error('phone_number')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="single-contact-form">
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="{{ __('Frontend/general.your_title_here') }}">
                    @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="single-contact-form message">
                    <textarea name="message" placeholder="{{ __('Frontend/general.your_message_here') }}">{{ old('message') }}</textarea>
                    @error('message')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
                <div class="contact-btn">
                    <button type="submit">
                        {{ __('Frontend/general.send_message') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-4 col-12 md-mt-40 sm-mt-40">
        <div class="wn__address">
            <h2 class="contact__title">{{ __('Frontend/general.get_office_info') }}</h2>
            <p>{{ __('Frontend/general.contact_us_info') }}</p>
            <div class="wn__addres__wreapper">

                <div class="single__address">
                    <i class="icon-location-pin icons"></i>
                    <div class="content">
                        <span>{{ __('Frontend/general.address') }}:</span>
                        <p>{!! getSettingsOf('address') !!}</p>
                    </div>
                </div>

                <div class="single__address">
                    <i class="icon-phone icons"></i>
                    <div class="content">
                        <span>{{ __('Frontend/general.phone_number') }}:</span>
                        <p>{!! getSettingsOf('phone_number') !!}</p>
                    </div>
                </div>

                <div class="single__address">
                    <i class="icon-envelope icons"></i>
                    <div class="content">
                        <span>{{ __('Frontend/general.email_address') }}:</span>
                        <p>{!! getSettingsOf('site_email') !!}</p>
                    </div>
                </div>

                <div class="single__address">
                    <i class="icon-globe icons"></i>
                    <div class="content">
                        <span>{{ __('Frontend/general.site_title') }}:</span>
                        <p>{!! getSettingsOf('site_title') !!}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

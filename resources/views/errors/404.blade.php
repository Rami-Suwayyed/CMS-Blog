@extends('layouts.app')
@section('content')
    <div class="col-lg-9 col-12" >
        <article class="blog__post d-flex flex-wrap">
            <div class="thumb">
                <a href="#">
                    <img src="{{ asset('assets/others/404CHID.gif') }}" alt="blog images">
                </a>
            </div>
            <div class="content text-center">
                <h4><a href="#">{{ __('Frontend/general.page_not_found') }}</a></h4>
                <p>{{ __('Frontend/general.page_not_found_message') }}</p>
                <br>
                <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('frontend.index') }}">{{ __('Frontend/general.back_to_home') }}</a>
            </div>
        </article>
    </div>

    <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
        @include('partial.frontend.sidebar')
    </div>

@endsection

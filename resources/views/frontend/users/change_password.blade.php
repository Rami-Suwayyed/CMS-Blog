@extends('layouts.app')
@section('content')

    <div class="col-lg-9 col-12">
        <h3>{{ __('Frontend/general.update_password') }}</h3>
        <form action="{{ route('users.update_password') }}" name="user_password" id="user_password" method="post">
            @csrf
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="current_password">{{ __('Frontend/general.current_password') }}</label>
                        <input type="password" name="current_password" class="form-control">
                        @error('current_password')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="password">{{ __('Frontend/general.password') }}</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="password_confirmation">{{ __('Frontend/general.password_confirmation') }}</label>
                        <input type="password" name="password_confirmation" class="form-control">
                        @error('password_confirmation')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="update_password">
                            {{ __('Frontend/general.update_password') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>

    <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
        @include('partial.frontend.users.sidebar')
    </div>

@endsection

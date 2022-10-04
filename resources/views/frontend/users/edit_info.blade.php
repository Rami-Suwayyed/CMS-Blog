@extends('layouts.app')
@section('content')

    <div class="col-lg-9 col-12">
        <h3>{{ __('Frontend/general.update_information') }}</h3>
        <form action="{{ route('users.update_info') }}" name="user_info" id="user_info" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="name">{{ __('Frontend/general.name') }}</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="form-control">
                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="email">{{ __('Frontend/general.email') }}</label>
                        <input type="text" name="email" value="{{ old('email', auth()->user()->email) }}" class="form-control">
                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="mobile">{{ __('Frontend/general.mobile') }}</label>
                        <input type="text" name="mobile" value="{{ old('mobile', auth()->user()->mobile) }}" class="form-control">
                        @error('mobile')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="receive_email">{{ __('Frontend/general.receive_email') }}</label>
                        <select name="receive_email" class="form-control">
                            <option value="1" {{ old('receive_email', auth()->user()->receive_email) == '1' ? 'selected' : '' }}>{{ __('Frontend/general.yes') }}</option>
                            <option value="0" {{ old('receive_email', auth()->user()->receive_email) == '0' ? 'selected' : '' }}>{{ __('Frontend/general.no') }}</option>
                        </select>
                        @error('receive_email')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="bio">{{ __('Frontend/general.bio') }}</label>
                        <textarea name="bio" class="form-control">{{ old('bio', auth()->user()->bio) }}</textarea>
                        @error('bio')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                @if (auth()->user()->user_image != '')
                    <div class="col-12">
                        <img src="{{ asset('assets/users/' . auth()->user()->user_image) }}" class="img-fluid" width="150" alt="{{ auth()->user()->name }}">
                    </div>
                @endif
                <div class="col-12">
                    <div class="form-group">
                        <label for="user_image">{{ __('Frontend/general.user_image') }}</label>
                        <input type="file" name="user_image" class="custom-file">
                        @error('user_image')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="update_information">
                            {{ __('Frontend/general.update_information') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <hr>

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

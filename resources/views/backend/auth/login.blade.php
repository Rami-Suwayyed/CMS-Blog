@extends('layouts.admin-auth')

@section('content')
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{ __('Backend/auth.welcome_back') }}</h1>
                                </div>

                                {!! Form::open(['route' => 'admin.show_login_form', 'method' => 'post']) !!}
                                <div class="form-group">
                                    {!! Form::text('login', old('login'), ['class' => 'form-control form-control-user', 'placeholder' => 'Enter your Email or username']) !!}
                                    @error('email'||'username') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    {!! Form::password('password', ['class' => 'form-control form-control-user', 'placeholder' => 'Enter your password']) !!}
                                    @error('password') <span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="remember">{{ __('Backend/auth.remember_me') }}</label>
                                    </div>
                                </div>
                                {!! Form::button(__('Backend/auth.login'), ['type' => 'submit', 'class' => 'btn btn-primary btn-user btn-block']) !!}
                                {!! Form::close() !!}

                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('password.request') }}">{{ __('Backend/auth.forgot_password') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

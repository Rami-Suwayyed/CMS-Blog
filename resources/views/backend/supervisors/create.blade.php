@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('backend/vendor/select2/css/select2.min.css') }}">
@endsection
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Backend/supervisors.add_new_supervisor') }}</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.supervisors.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{ __('Backend/supervisors.supervisors') }}</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.supervisors.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">{{ __('Backend/supervisors.name') }}</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="username">{{ __('Backend/supervisors.username') }}</label>
                            <input type="text" name="username" value="{{ old('username') }}" class="form-control">
                            @error('username')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="email">{{ __('Backend/supervisors.email') }}</label>
                            <input type="text" name="email" value="{{ old('email') }}" class="form-control">
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="phone_number">{{ __('Backend/supervisors.phone_number') }}</label>
                            <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control">
                            @error('phone_number')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="password">{{ __('Backend/supervisors.password') }}</label>
                            <input type="password" name="password" class="form-control">
                            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="status">{{ __('Backend/supervisors.status') }}</label>
                        <select name="status" class="form-control">
                            <option
                                value="1" {{ old('status') == '1' ? 'selected' : '' }}>{{ __('Backend/supervisors.active') }}</option>
                            <option
                                value="0" {{ old('status') == '0' ? 'selected' : '' }}>{{ __('Backend/supervisors.inactive') }}</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-6">
                        <label for="receive_email">{{ __('Backend/supervisors.receive_email') }}</label>
                        <select name="receive_email" class="form-control">
                            <option
                                value="1" {{ old('receive_email') == '1' ? 'selected' : '' }}>{{ __('Backend/supervisors.yes') }}</option>
                            <option
                                value="0" {{ old('receive_email') == '0' ? 'selected' : '' }}>{{ __('Backend/supervisors.no') }}</option>
                        </select>
                        @error('receive_email')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="bio">{{ __('Backend/supervisors.bio') }}</label>
                            <textarea name="bio" class="form-control">{{ old('bio') }}</textarea>
                            @error('bio')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="roles">{{ __('Backend/supervisors.roles') }}</label>
                            <select name="roles[]" class="form-control select-multiple-tags" multiple="multiple">
                                @foreach($roles as $role)
                                    <option
                                        value="{{ $role->id }}" {{ in_array($role->id, old('roles[]', [])) ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('roles')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-12">
                        <label for="user_image">{{ __('Backend/supervisors.image') }}</label>
                        <br>
                        <div class="file-loading">
                            <input type="file" name="user_image" id="user-image" class="file-input-overview">
                            <span class="form-text text-muted">{{ __('Backend/supervisors.image_hint') }}</span>
                            @error('user_image')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" class="btn btn-primary">{{ __('Backend/supervisors.submit') }}</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('backend/vendor/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            $('.select-multiple-tags').select2({
                minimumResultsForSearch: Infinity,
                tags: true,
                closeOnSelect: false
            });

            $('#user-image').fileinput({
                theme: "fas",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
            });
        });
    </script>
@endsection

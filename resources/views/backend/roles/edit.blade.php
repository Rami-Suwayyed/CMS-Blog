@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{ asset('backend/vendor/select2/css/select2.min.css') }}">
@endsection
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Backend/roles.edit_role') }}
                ({{ $role->display_name() }})</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.roles.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{ __('Backend/roles.roles') }}</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.roles.update', $role->id) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="name">{{ __('Backend/roles.name') }}</label>
                            <input type="text" name="name" value="{{ old('name', $role->name) }}" class="form-control">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="display_name">{{ __('Backend/roles.display_name') }}</label>
                            <input type="text" name="display_name" value="{{ old('display_name', $role->display_name) }}" class="form-control">
                            @error('display_name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="display_name_en">{{ __('Backend/roles.display_name_en') }}</label>
                            <input type="text" name="display_name_en" value="{{ old('display_name_en', $role->display_name_en) }}" class="form-control">
                            @error('display_name_en')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="allowed_route">{{ __('Backend/roles.allowed_route') }}</label>
                        <select name="allowed_route" class="form-control">
                            <option value=""> --- </option>
                            <option value="admin" {{ old('allowed_route', $role->allowed_route) == 'admin' ? 'selected' : '' }}>admin</option>
                        </select>
                        @error('allowed_route')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="permissions">{{ __('Backend/roles.permissions') }}</label>
                            <select name="permissions[]" class="form-control select-multiple-tags" multiple="multiple">
                                @foreach($permissions as $permission)
                                    <option value="{{ $permission->id }}" {{ in_array($permission->id, old('permissions[]', $rolePerms)) ? 'selected' : '' }}>{{ $permission->display_name() }}</option>
                                @endforeach
                            </select>
                            @error('permissions')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" class="btn btn-primary">{{ __('Backend/roles.submit') }}</button>
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
        });
    </script>
@endsection


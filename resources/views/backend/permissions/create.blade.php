@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Backend/permissions.add_permission') }}</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.permissions.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{ __('Backend/permissions.permissions') }}</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.permissions.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-2">
                        <div class="form-group">
                            <label for="name">{{ __('Backend/permissions.name') }}</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="display_name">{{ __('Backend/permissions.display_name') }}</label>
                            <input type="text" name="display_name" value="{{ old('display_name') }}" class="form-control">
                            @error('display_name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="display_name_en">{{ __('Backend/permissions.display_name_en') }}</label>
                            <input type="text" name="display_name_en" value="{{ old('display_name_en') }}" class="form-control">
                            @error('display_name_en')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="description">{{ __('Backend/permissions.description') }}</label>
                            <input type="text" name="description" value="{{ old('description') }}" class="form-control">
                            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="description_en">{{ __('Backend/permissions.description_en') }}</label>
                            <input type="text" name="description_en" value="{{ old('description_en') }}" class="form-control">
                            @error('description_en')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="route">{{ __('Backend/permissions.route') }}</label>
                            <input type="text" name="route" value="{{ old('route') }}" class="form-control">
                            @error('route')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-3">
                        <div class="form-group">
                            <label for="module">{{ __('Backend/permissions.module') }}</label>
                            <input type="text" name="module" value="{{ old('module') }}" class="form-control">
                            @error('module')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="as">{{ __('Backend/permissions.as') }}</label>
                            <input type="text" name="as" value="{{ old('as') }}" class="form-control">
                            @error('as')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="icon">{{ __('Backend/permissions.icon') }}</label>
                            <input type="text" name="icon" value="{{ old('icon') }}" class="form-control">
                            @error('icon')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="sidebar_link">{{ __('Backend/permissions.sidebar_link') }}</label>
                        <select name="sidebar_link" class="form-control">
                            <option value="1" {{ old('sidebar_link') == '1' ? 'selected' : '' }}>{{ __('Backend/permissions.yes') }}</option>
                            <option value="0" {{ old('sidebar_link') == '0' ? 'selected' : '' }}>{{ __('Backend/permissions.no') }}</option>
                        </select>
                        @error('sidebar_link')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="parent">{{ __('Backend/permissions.parent') }}</label>
                            <select name="parent" class="form-control">
                                <option value="0"> --- </option>
                                @foreach($main_permissions as $main_perm)
                                    <option value="{{ $main_perm->id }}" {{ old('parent') == $main_perm->id ? 'selected' : '' }}>{{ $main_perm->display_name() }}</option>
                                @endforeach
                            </select>
                            @error('parent')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <label for="parent_show">{{ __('Backend/permissions.parent_show') }}</label>
                        <select name="parent_show" class="form-control">
                            <option value="0"> --- </option>
                            @foreach($main_permissions as $main_perm)
                                <option value="{{ $main_perm->id }}" {{ old('parent_show') == $main_perm->id ? 'selected' : '' }}>{{ $main_perm->display_name() }}</option>
                            @endforeach
                        </select>
                        @error('parent_show')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-3">
                        <label for="parent_original">{{ __('Backend/permissions.parent_original') }}</label>
                        <select name="parent_original" class="form-control">
                            <option value="0"> --- </option>
                            @foreach($main_permissions as $main_perm)
                                <option value="{{ $main_perm->id }}" {{ old('parent_original') == $main_perm->id ? 'selected' : '' }}>{{ $main_perm->display_name() }}</option>
                            @endforeach
                        </select>
                        @error('parent_original')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-3">
                        <label for="appear">{{ __('Backend/permissions.appear') }}</label>
                        <select name="appear" class="form-control">
                            <option value="0" {{ old('appear') == '0' ? 'selected' : '' }}>{{ __('Backend/permissions.no') }}</option>
                            <option value="1" {{ old('appear') == '1' ? 'selected' : '' }}>{{ __('Backend/permissions.yes') }}</option>
                        </select>
                        @error('appear')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="ordering">{{ __('Backend/permissions.ordering') }}</label>
                            <input type="text" name="ordering" value="{{ old('ordering') }}" class="form-control">
                            @error('ordering')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-9">

                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" class="btn btn-primary">{{ __('Backend/permissions.submit') }}</button>
                </div>
            </form>
        </div>
    </div>

@endsection

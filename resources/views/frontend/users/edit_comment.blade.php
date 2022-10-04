@extends('layouts.app')
@section('content')

    <div class="col-lg-9 col-12">
        <h3>{{ __('Frontend/general.edit_comment_on', ['title' => $comment->post->title()]) }}</h3>
        <form action="{{ route('users.comment.update', $comment->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="name">{{ __('Frontend/general.name') }}</label>
                        <input type="text" name="name" value="{{ old('name', $comment->name) }}" class="form-control">
                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="email">{{ __('Frontend/general.email') }}</label>
                        <input type="text" name="email" value="{{ old('email', $comment->email) }}" class="form-control">
                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="url">{{ __('Frontend/general.url') }}</label>
                        <input type="text" name="url" value="{{ old('url', $comment->url) }}" class="form-control">
                        @error('url')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-3">
                    <label for="status">{{ __('Frontend/general.status') }}</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>{{ __('Frontend/general.active') }}</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>{{ __('Frontend/general.inactive') }}</option>
                    </select>
                    @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <label for="comment">{{ __('Frontend/general.comment') }}</label>
                    <textarea name="comment" class="form-control">{{ old('comment', $comment->comment) }}</textarea>
                    @error('comment')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-group pt-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Frontend/general.submit') }}
                </button>
            </div>
        </form>
    </div>
    <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
        @include('partial.frontend.users.sidebar')
    </div>

@endsection

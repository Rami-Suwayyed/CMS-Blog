@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Backend/pages.edit_page') }} ({{ $page->title }})</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.pages.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{ __('Backend/pages.pages') }}</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.pages.update', $page->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="title">{{ __('Backend/pages.title') }}</label>
                            <input type="text" name="title" value="{{ old('title', $page->title) }}" class="form-control">
                            @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="title_en">{{ __('Backend/pages.title_en') }}</label>
                            <input type="text" name="title_en" value="{{ old('title_en', $page->title_en) }}" class="form-control">
                            @error('title_en')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="description">{{ __('Backend/pages.description') }}</label>
                            <textarea name="description" class="form-control summernote">{!! old('description', $page->description) !!}</textarea>
                            @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="description_en">{{ __('Backend/pages.description_en') }}</label>
                            <textarea name="description_en" class="form-control summernote">{!! old('description_en', $page->description_en) !!}</textarea>
                            @error('description_en')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label for="category_id">{{ __('Backend/pages.category') }}</label>
                        <select name="category_id" class="form-control">
                            <option value=""> ---</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $page->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name() }}</option>
                            @endforeach
                        </select>
                        @error('category_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-6">
                        <label for="status">{{ __('Backend/pages.status') }}</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $page->status) == '1' ? 'selected' : '' }}>{{ __('Backend/pages.active') }}</option>
                            <option value="0" {{ old('status', $page->status) == '0' ? 'selected' : '' }}>{{ __('Backend/pages.inactive') }}</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-12">
                        <label for="images">{{ __('Backend/pages.sliders') }}</label>
                        <br>
                        <div class="file-loading">
                            <input type="file" name="images[]" id="page-images" class="file-input-overview" multiple="multiple">
                            <span class="form-text text-muted">{{ __('Backend/pages.image_hint') }}</span>
                            @error('images')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Backend/pages.submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(function () {
            $('.summernote').summernote({
                tabSize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            $('#page-images').fileinput({
                theme: "fas",
                maxFileCount: {{ 5 - $page->media->count() }},
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview: [
                    @if($page->media->count() > 0)
                        @foreach($page->media as $media)
                        "{{ asset('assets/posts/' . $media->file_name) }}",
                    @endforeach
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                        @if($page->media->count() > 0)
                        @foreach($page->media as $media)
                    {
                        caption: "{{ $media->file_name }}",
                        size: {{ $media->file_size }},
                        width: "120px",
                        url: "{{ route('admin.pages.media.destroy', [$media->id, '_token' => csrf_token()]) }}",
                        key: "{{ $media->id }}"
                    },
                    @endforeach
                    @endif
                ],
            });
        });
    </script>
@endsection

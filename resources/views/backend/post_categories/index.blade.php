@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Backend/post_categories.posts_categories') }}</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.post_categories.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">{{ __('Backend/post_categories.add_new_category') }}</span>
                </a>
            </div>
        </div>

        @include('backend.post_categories.filter.filter')

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>{{ __('Backend/post_categories.name') }}</th>
                    <th>{{ __('Backend/post_categories.posts_count') }}</th>
                    <th>{{ __('Backend/post_categories.status') }}</th>
                    <th>{{ __('Backend/post_categories.created_at') }}</th>
                    <th class="text-center" style="width: 30px;">{{ __('Backend/post_categories.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->name() }}</td>
                        <td><a href="{{ route('admin.posts.index', ['category_id' => $category->id]) }}">{{ $category->posts_count }}</a></td>
                        <td>{{ $category->status() }}</td>
                        <td>{{ $category->created_at->format('d-m-Y h:i a') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.post_categories.edit', $category->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" onclick="if (confirm('Are you sure to delete this category?') ) { document.getElementById('category-delete-{{ $category->id }}').submit(); } else { return false; }" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                <form action="{{ route('admin.post_categories.destroy', $category->id) }}" method="post" id="category-delete-{{ $category->id }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">{{ __('Backend/post_categories.no_categories_found') }}</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="5">
                        <div class="float-right">
                            {!! $categories->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>


@endsection

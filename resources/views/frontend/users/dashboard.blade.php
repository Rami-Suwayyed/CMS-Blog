@extends('layouts.app')
@section('content')

    <div class="col-lg-9 col-12">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>{{ __('Frontend/general.title') }}</th>
                    <th>{{ __('Frontend/general.comments') }}</th>
                    <th>{{ __('Frontend/general.status') }}</th>
                    <th>{{ __('Frontend/general.action') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>{{ $post->title() }}</td>
                        <td><a href="{{ route('users.comments', ['post' => $post->id]) }}">{{ $post->comments_count }}</a></td>
                        <td>{{ $post->status() }}</td>
                        <td>
                            <a href="{{ route('users.post.edit', $post->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0);" onclick="if (confirm('{{ __('Frontend/general.sure_to_delete') }}') ) { document.getElementById('post-delete-{{ $post->id }}').submit(); } else { return false; }" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                            <form action="{{ route('users.post.destroy', $post->id) }}" method="post" id="post-delete-{{ $post->id }}" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">{{ __('Frontend/general.no_posts_found') }}</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4">{!! $posts->links() !!}</td>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>

    <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
        @include('partial.frontend.users.sidebar')
    </div>

@endsection

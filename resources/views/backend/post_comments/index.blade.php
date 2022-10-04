@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Backend/post_comments.comments') }}</h6>
        </div>

        @include('backend.post_comments.filter.filter')

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>{{ __('Backend/post_comments.image') }}</th>
                    <th>{{ __('Backend/post_comments.author') }}</th>
                    <th width="40%">{{ __('Backend/post_comments.comment') }}</th>
                    <th>{{ __('Backend/post_comments.status') }}</th>
                    <th>{{ __('Backend/post_comments.created_at') }}</th>
                    <th class="text-center" style="width: 30px;">{{ __('Backend/post_comments.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($comments as $comment)
                    <tr>
                        <td><img src="{{ get_gravatar($comment->email, 50) }}" class="img-circle"></td>
                        <td><a href="{!! $comment->url != '' ? $comment->url : 'javascript:void(0);' !!}" target="_blank">{{ $comment->name }}</a> {{ $comment->user_id != '' ? '(Member)' : '' }}</td>
                        <td>
                            {!! $comment->comment !!}
                            <div class="text-muted">
                                <a href="{{ route('admin.posts.show', $comment->post_id) }}">{{ $comment->post->title }}</a>
                            </div>
                        </td>
                        <td>{{ $comment->status() }}</td>
                        <td>{{ $comment->created_at->format('d-m-Y h:i a') }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.post_comments.edit', $comment->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0)" onclick="if (confirm('Are you sure to delete this comment?') ) { document.getElementById('comment-delete-{{ $comment->id }}').submit(); } else { return false; }" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                <form action="{{ route('admin.post_comments.destroy', $comment->id) }}" method="post" id="comment-delete-{{ $comment->id }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">{{ __('Backend/post_comments.no_comments_found') }}</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="6">
                        <div class="float-right">
                            {!! $comments->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection

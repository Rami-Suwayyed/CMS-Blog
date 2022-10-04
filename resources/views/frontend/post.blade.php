@extends('layouts.app')
@section('content')

    <div class="col-lg-9 col-12">
        <div class="blog-details content">
            <article class="blog-post-details">
                @if ($post->media->count() > 0)
                    <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($post->media as $media)
                                <li data-target="#carouselIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->index == 0 ? 'active' : '' }}"></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            @foreach($post->media as $media)
                                <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                                    <img class="d-block w-100" src="{{ asset('assets/posts/' . $media->file_name) }}" alt="{{ $post->title }}">
                                </div>
                            @endforeach
                        </div>
                        @if ($post->media->count() > 1)
                            <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">{{ __('Frontend/general.previous') }}</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">{{ __('Frontend/general.next') }}</span>
                            </a>
                        @endif
                    </div>
                @endif

                <div class="post_wrapper">
                    <div class="post_header">
                        <h2>{{ $post->title() }}</h2>
                        <div class="blog-date-categori">
                            <ul>
                                <li>{{ $post->created_at->format('M d, Y') }}</li>
                                <li><a href="{{ route('frontend.author.posts', $post->user->username) }}" title="Posts by {{ $post->user->name }}" rel="author">{{ $post->user->name }}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="post_content">
                        <p>{!! $post->description() !!}</p>

                        @if ($post->tags->count() > 0)
                            <div class="post__meta">
                                <span>{{ __('Frontend/general.tags') }}: </span>
                                @foreach($post->tags as $tag)
                                    <a href="{{ route('frontend.tag.posts', $tag->url_slug()) }}" class="bg-info p-1"><span class="text-white">{{ $tag->name() }}</span></a>
                                @endforeach
                            </div>
                        @endif

                    </div>
                    <ul class="blog_meta">
                        <li><a href="#">{{ $post->approved_comments->count() }} {{ __('Frontend/general.comment_s') }}</a></li>
                        <li> / </li>
                        <li>{{ __('Frontend/general.category_id') }}:<span>{{ $post->category->name() }}</span></li>
                    </ul>
                </div>
            </article>

            <div class="comments_area">
                <h3 class="comment__title">{{ $post->approved_comments->count() }} {{ __('Frontend/general.comment_s') }}</h3>
                <ul class="comment__list">
                    @forelse ($post->approved_comments as $comment)
                        <li>
                            <div class="wn__comment">
                                <div class="thumb">
                                    <img src="{{ get_gravatar($comment->email, 46) }}" alt="comment images">
                                </div>
                                <div class="content">
                                    <div class="comnt__author d-block d-sm-flex">
                                        <span><a href="{{ $comment->url != '' ? $comment->url : '#' }}">{{ $comment->name }}</a></span>
                                        <span>{{ $comment->created_at->format('M d Y h:i a') }}</span>
                                    </div>
                                    <p>{{ $comment->comment }}</p>
                                </div>
                            </div>
                        </li>
                    @empty
                        <p>{{ __('Frontend/general.no_comments_found') }}</p>
                    @endforelse
                </ul>
            </div>

            <div class="comment_respond">
                <h3 class="reply_title">{{ __('Frontend/general.leave_reply') }} <small></small></h3>
                <form action="{{ route('frontend.posts.add_comment', $post->url_slug()) }}" method="post" class="comment__form">
                    @csrf
                    <p>{{ __('Frontend/general.email_not_published') }}</p>
                    <div class="input__box">
                        <textarea name="comment" placeholder="{{ __('Frontend/general.your_comment_here') }}">{{ old('comment') }}</textarea>
                        @error('comment')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="input__wrapper clearfix">
                        <div class="input__box name one--third">
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('Frontend/general.your_name_here') }}">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="input__box email one--third">
                            <input type="text" name="email" value="{{ old('email') }}" placeholder="{{ __('Frontend/general.your_email_here') }}">
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="input__box website one--third">
                            <input type="text" name="url" value="{{ old('url') }}" placeholder="{{ __('Frontend/general.your_url_here') }}">
                            @error('url')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="submite__btn">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Frontend/general.submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
        @include('partial.frontend.sidebar')
    </div>

@endsection

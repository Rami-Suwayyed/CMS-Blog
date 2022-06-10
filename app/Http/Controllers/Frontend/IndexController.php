<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{

    public function index()
    {
        $posts = Post::with(['media', 'user'])
        ->whereHas('category', function ($query) {
            $query->whereStatus(1);
        })
        ->whereHas('user', function ($query) {
            $query->whereStatus(1);
        })
        ->post()->active()->orderBy('id', 'desc')->paginate(5);

        return view('Frontend.index', compact('posts'));
    }


    public function post_show($slug)
    {
        $post = Post::with(['category', 'media', 'user',
            'approved_comments' => function($query) {
                $query->orderBy('id', 'desc');
            }
        ]);
        $post = $post->whereHas('category', function ($query) {
                $query->whereStatus(1);
            })
            ->whereHas('user', function ($query) {
                $query->whereStatus(1);
            });

        $post = $post->whereSlug($slug);
        $post = $post->active()->first();

        if($post) {

            $blade = $post->post_type == 'post' ? 'post' : 'page';

            return view('frontend.' . $blade, compact('post'));
        } else {
            return redirect()->route('frontend.index');
        }

    }



    public function store_comment(Request $request, $slug)
    {
        $validation = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email',
            'url'       => 'nullable|url',
            'comment'   => 'required|min:10',
        ]);
        if ($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $post = Post::whereSlug($slug)->wherePostType('post')->whereStatus(1)->first();
        if ($post) {

            $userId = auth()->check() ? auth()->id() : null;
            $data['name']           = $request->name;
            $data['email']          = $request->email;
            $data['url']            = $request->url;
            $data['ip_address']     = $request->ip();
            $data['comment']        = $request->comment;
            $data['post_id']        = $post->id;
            $data['user_id']        = $userId;

            $comment = $post->comments()->create($data);

            if (auth()->guest() || auth()->id() != $post->user_id) {
                // $post->user->notify(new NewCommentForPostOwnerNotify($comment));
            }

            // User::whereHas('roles', function ($query) {
            //     $query->whereIn('name', ['admin', 'editor']);
            // })->each(function ($admin, $key) use ($comment) {
            //     // $admin->notify(new NewCommentForAdminNotify($comment));
            // });

            return redirect()->back()->with([
                'message' => 'Comment added successfully',
                'alert-type' => 'success'
            ]);
        }

        return redirect()->back()->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger'
        ]);

    }

}

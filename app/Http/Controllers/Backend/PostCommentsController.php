<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;

class PostCommentsController extends Controller
{
    public function __construct()
    {
        if (\auth()->check()){
            $this->middleware('auth');
        } else {
            return view('backend.auth.login');
        }
    }

    public function index()
    {
        $comments = Comment::query()
            ->when(request('keyword') != '', function($query) {
                $query->search(request('keyword'));
            })
            ->when(request('post_id') != '', function($query) {
                $query->wherePostId(request('post_id'));
            })
            ->when(request('status') != '', function($query) {
                $query->whereStatus(request('status'));
            })
            ->orderBy(request('sort_by') ?? 'id', request('order_by') ?? 'desc')
            ->paginate(request('limit_by') ?? 10)
            ->withQueryString();

        $posts = Post::wherePostType('post')->select('id', 'title', 'title_en')->get();
        return view('backend.post_comments.index', compact('comments', 'posts'));

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $comment = Comment::whereId($id)->first();
        return view('backend.post_comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'email'         => 'required|email',
            'url'           => 'nullable|url',
            'status'        => 'required',
            'comment'       => 'required',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $comment = Comment::whereId($id)->first();

        if ($comment) {
            $data['name']           = $request->name;
            $data['email']          = $request->email;
            $data['url']            = $request->url;
            $data['status']         = $request->status;
            $data['comment']        = Purify::clean($request->comment);

            $comment->update($data);

            Cache::forget('recent_comments');

            return redirect()->route('admin.post_comments.index')->with([
                'message' => 'Comment updated successfully',
                'alert-type' => 'success',
            ]);

        }
        return redirect()->route('admin.post_comments.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }

    public function destroy($id)
    {

        $comment = Comment::whereId($id)->first();
        $comment->delete();

        return redirect()->route('admin.post_comments.index')->with([
            'message' => 'Comment deleted successfully',
            'alert-type' => 'success',
        ]);
    }

}

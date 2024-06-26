<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use App\Notifications\NewCommentForAdminNotify;
use App\Notifications\NewCommentForPostOwnerNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class IndexController extends Controller
{

    public function index()
    {
        $posts = Post::with(['media', 'user', 'tags'])
            ->whereHas('category', function ($query) {
                $query->whereStatus(1);
            })
            ->whereHas('user', function ($query) {
                $query->whereStatus(1);
            })
            ->post()
            ->active()
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('frontend.index', compact('posts'));
    }

    public function search()
    {
        $posts = Post::with(['media', 'user', 'tags'])
            ->whereHas('category', function ($query) {
                $query->whereStatus(1);
            })
            ->whereHas('user', function ($query) {
                $query->whereStatus(1);
            })
            ->when(request('keyword') != '', function ($query) {
                $query->search(request('keyword'), null, true);
            })
            ->post()
            ->active()
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();
        return view('frontend.index', compact('posts'));
    }

    public function category($slug)
    {
        $category = Category::whereSlug($slug)->orWhere('id', $slug)->whereStatus(1)->first()->id;

        if ($category) {
            $posts = Post::with(['media', 'user', 'tags'])
                ->whereCategoryId($category)
                ->post()
                ->active()
                ->orderBy('id', 'desc')
                ->paginate(10)
                ->withQueryString();
            return view('frontend.index', compact('posts'));
        }

        return redirect()->route('frontend.index');
    }

    public function tag($slug)
    {
        $tag = Tag::whereSlug($slug)->orWhere('id', $slug)->first()->id;

        if ($tag) {
            $posts = Post::with(['media', 'user', 'tags'])
                ->whereHas('tags', function ($query) use ($slug) {
                    $query->where('slug', $slug);
                })
                ->post()
                ->active()
                ->orderBy('id', 'desc')
                ->paginate(10)
                ->withQueryString();
            return view('frontend.index', compact('posts'));
        }

        return redirect()->route('frontend.index');
    }

    public function archive($date)
    {
        $exploded_date = explode('-', $date);
        $month = $exploded_date[0];
        $year = $exploded_date[1];

        $posts = Post::with(['media', 'user', 'tags'])
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->post()
            ->active()
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();
        return view('frontend.index', compact('posts'));
    }

    public function author($username)
    {
        $user = User::whereUsername($username)->whereStatus(1)->first()->id;
        if ($user) {
            $posts = Post::with(['media', 'user', 'tags'])
                ->whereUserId($user)
                ->post()
                ->active()
                ->orderBy('id', 'desc')
                ->paginate(10)
                ->withQueryString();
            return view('frontend.index', compact('posts'));
        }
        return redirect()->route('frontend.index');
    }

    public function post_show($slug)
    {
        $post = Post::query()
            ->with(['category', 'media', 'user', 'tags',
                'approved_comments' => function($query) {
                $query->orderBy('id', 'desc');
            }
            ])
            ->whereHas('category', function ($query) {
                $query->whereStatus(1);
            })
            ->whereHas('user', function ($query) {
                $query->whereStatus(1);
            })
            ->whereSlug($slug)
            ->active()
            ->first();

        if($post) {
            $blade = $post->post_type == 'post' ? 'post' : 'page';
            return view('frontend.' . $blade, compact('post'));
        } else {
            return redirect()->route('frontend.index');
        }

    }


    public function showPage($post)
    {
        $post = Post::query()
            ->with(['media'])
            ->whereSlug($post)
            ->active()
            ->first();
        if($post->post_type == 'page')
            return view('frontend.page', compact('post'));
            abort(404);
    }


    public function store_comment(Request $request, $slug)
    {
        $validation = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email',
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
            $data['ip_address']     = $request->ip();
            $data['comment']        = Purify::clean($request->comment);
            $data['post_id']        = $post->id;
            $data['user_id']        = $userId;

            $comment = $post->comments()->create($data);

            if (auth()->guest() || auth()->id() != $post->user_id) {
                $post->user->notify(new NewCommentForPostOwnerNotify($comment));
            }

            User::whereHas('roles', function ($query) {
                $query->whereIn('name', ['admin', 'editor']);
            })->each(function ($admin, $key) use ($comment) {
                $admin->notify(new NewCommentForAdminNotify($comment));
            });

            return redirect()->back()->with([
                'message' => __('Frontend/general.added_successfully'),
                'alert-type' => 'success'
            ]);
        }

        return redirect()->back()->with([
            'message' => __('Frontend/general.something_was_wrong'),
            'alert-type' => 'danger'
        ]);

    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function do_contact(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|email',
            'phone_number'    => 'nullable|numeric',
            'title'     => 'required|min:5',
            'message'   => 'required|min:10',
        ]);
        if ($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $data['name']       = $request->name;
        $data['email']      = $request->email;
        $data['phone_number']     = $request->phone_number;
        $data['title']      = $request->title;
        $data['message']    = $request->message;

        Contact::create($data);

        return redirect()->back()->with([
            'message' => __('Frontend/general.sent_successfully'),
            'alert-type' => 'success'
        ]);

    }

}

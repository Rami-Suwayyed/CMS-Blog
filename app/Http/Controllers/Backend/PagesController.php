<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\PostMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Stevebauman\Purify\Facades\Purify;

class PagesController extends Controller
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
        $pages = Page::wherePostType('page')
            ->when(request('keyword') != '', function($query) {
                $query->search(request('keyword'));
            })
            ->when(request('category_id') != '', function($query) {
                $query->whereCategoryId(request('category_id'));
            })
            ->when(request('status') != '', function($query) {
                $query->whereStatus(request('status'));
            })
            ->orderBy(request('sort_by') ?? 'id', request('order_by') ?? 'desc')
            ->paginate(request('limit_by') ?? 10)
            ->withQueryString();

        $categories = Category::orderBy('id', 'desc')->select('id', 'name', 'name_en')->get();
        return view('backend.pages.index', compact('categories', 'pages'));

    }

    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->select('id', 'name', 'name_en')->get();
        return view('backend.pages.create', compact('categories'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'title_en'      => 'required',
            'description'   => 'required|min:50',
            'description_en'=> 'required|min:50',
            'status'        => 'required',
            'category_id'   => 'required',
            'images.*'      => 'nullable|mimes:jpg,jpeg,png,gif|max:20000',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['title']              = $request->title;
        $data['title_en']           = $request->title_en;
        $data['description']        = Purify::clean($request->description);
        $data['description_en']     = Purify::clean($request->description_en);
        $data['status']             = $request->status;
        $data['post_type']          = 'page';
        $data['comment_able']       = 0;
        $data['category_id']        = $request->category_id;

        $page = auth()->user()->posts()->create($data);

        if ($request->images && count($request->images) > 0) {
            $i = 1;
            foreach ($request->images as $file) {
                $filename = $page->slug.'-'.time().'-'.$i.'.'.$file->getClientOriginalExtension();
                $file_size = $file->getSize();
                $file_type = $file->getMimeType();
                $path = public_path('assets/posts/' . $filename);
                Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);

                $page->media()->create([
                    'file_name' => $filename,
                    'file_size' => $file_size,
                    'file_type' => $file_type,
                ]);
                $i++;
            }
        }

        return redirect()->route('admin.pages.index')->with([
            'message' => 'Page created successfully',
            'alert-type' => 'success',
        ]);
    }

    public function show($id)
    {
        $page = Page::with(['media'])->whereId($id)->wherePostType('page')->first();
        return view('backend.pages.show', compact('page'));
    }

    public function edit($id)
    {

        $categories = Category::orderBy('id', 'desc')->select('id', 'name', 'name_en')->get();
        $page = Page::with(['media'])->whereId($id)->wherePostType('page')->first();

        return view('backend.pages.edit', compact('categories', 'page'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'title_en'      => 'required',
            'description'   => 'required|min:50',
            'description_en'=> 'required|min:50',
            'status'        => 'required',
            'category_id'   => 'required',
            'images.*'      => 'nullable|mimes:jpg,jpeg,png,gif|max:20000',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $page = Page::whereId($id)->wherePostType('page')->first();

        if ($page) {
            $data['title']              = $request->title;
            $data['slug']               = null;
            $data['description']        = Purify::clean($request->description);
            $data['title_en']           = $request->title_en;
            $data['description_en']     = Purify::clean($request->description_en);
            $data['status']             = $request->status;
            $data['category_id']        = $request->category_id;

            $page->update($data);

            if ($request->images && count($request->images) > 0) {
                $i = 1;
                foreach ($request->images as $file) {
                    $filename = $page->slug.'-'.time().'-'.$i.'.'.$file->getClientOriginalExtension();
                    $file_size = $file->getSize();
                    $file_type = $file->getMimeType();
                    $path = public_path('assets/posts/' . $filename);
                    Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path, 100);

                    $page->media()->create([
                        'file_name' => $filename,
                        'file_size' => $file_size,
                        'file_type' => $file_type,
                    ]);
                    $i++;
                }
            }

            return redirect()->route('admin.pages.index')->with([
                'message' => 'Page updated successfully',
                'alert-type' => 'success',
            ]);

        }
        return redirect()->route('admin.pages.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }

    public function destroy($id)
    {
        $page = Page::whereId($id)->wherePostType('page')->first();

        if ($page) {
            if ($page->media->count() > 0) {
                foreach ($page->media as $media) {
                    if (File::exists('assets/posts/' . $media->file_name)) {
                        unlink('assets/posts/' . $media->file_name);
                    }
                }
            }
            $page->delete();

            return redirect()->route('admin.pages.index')->with([
                'message' => 'Page deleted successfully',
                'alert-type' => 'success',
            ]);
        }

        return redirect()->route('admin.pages.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }

    public function removeImage(Request $request)
    {

        $media = PostMedia::whereId($request->media_id)->first();
        if ($media) {
            if (File::exists('assets/posts/' . $media->file_name)) {
                unlink('assets/posts/' . $media->file_name);
            }
            $media->delete();
            return true;
        }
        return false;
    }
}

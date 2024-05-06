<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class PostTagsController extends Controller
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
        $tags = Tag::withCount('posts')
            ->when(request('keyword') != '', function($query) {
                $query->search(request('keyword'));
            })
            ->orderBy(request('sort_by') ?? 'id', request('order_by') ?? 'desc')
            ->paginate(request('limit_by') ?? 10)
            ->withQueryString();

        return view('backend.post_tags.index', compact('tags'));

    }

    public function create()
    {

        return view('backend.post_tags.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'name_en'       => 'required',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']              = $request->name;
        $data['name_en']           = $request->name_en;

        Tag::create($data);

        Cache::forget('global_tags');

        return redirect()->route('admin.post_tags.index')->with([
            'message' => 'Tag created successfully',
            'alert-type' => 'success',
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

        $tag = Tag::whereId($id)->first();
        return view('backend.post_tags.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'name_en'       => 'required',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tag = Tag::whereId($id)->first();

        if ($tag) {
            $data['name']               = $request->name;
            $data['slug']               = null;
            $data['name_en']            = $request->name_en;

            $tag->update($data);

            Cache::forget('global_tags');

            return redirect()->route('admin.post_tags.index')->with([
                'message' => 'Tag updated successfully',
                'alert-type' => 'success',
            ]);

        }
        return redirect()->route('admin.post_tags.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }

    public function destroy($id)
    {

        $tag = Tag::whereId($id)->first();
        $tag->delete();

        return redirect()->route('admin.post_tags.index')->with([
            'message' => 'Tag deleted successfully',
            'alert-type' => 'success',
        ]);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionsController extends Controller
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

        $permissions = Permission::query()
            ->when(request('keyword') != '', function($query) {
                $query->search(request('keyword'));
            })
            ->orderBy(request('sort_by') ?? 'id', request('order_by') ?? 'desc')
            ->paginate(request('limit_by') ?? 10)
            ->withQueryString();

        return view('backend.permissions.index', compact('permissions'));

    }

    public function create()
    {
        $main_permissions = Permission::whereParent(0)->select('id', 'display_name', 'display_name_en')->get();
        return view('backend.permissions.create', compact('main_permissions'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'              => 'required|unique:permissions,name',
            'display_name'      => 'required',
            'display_name_en'   => 'required',
            'description'       => 'nullable',
            'description_en'    => 'nullable',
            'route'             => 'required',
            'module'            => 'required',
            'as'                => 'required',
            'icon'              => 'required',
            'parent'            => 'required',
            'parent_show'       => 'required',
            'parent_original'   => 'required',
            'sidebar_link'      => 'required',
            'appear'            => 'required',
            'ordering'          => 'required',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']               = $request->name;
        $data['display_name']       = $request->display_name;
        $data['display_name_en']    = $request->display_name_en;
        $data['description']        = $request->description;
        $data['description_en']     = $request->description_en;
        $data['route']              = $request->route;
        $data['module']             = $request->module;
        $data['as']                 = $request->as;
        $data['icon']               = $request->icon;
        $data['parent']             = $request->parent;
        $data['parent_show']        = $request->parent_show;
        $data['parent_original']    = $request->parent_original;
        $data['sidebar_link']       = $request->sidebar_link;
        $data['appear']             = $request->appear;
        $data['ordering']           = $request->ordering;

        Permission::create($data);

        return redirect()->route('admin.permissions.index')->with([
            'message' => 'Permission created successfully',
            'alert-type' => 'success',
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $permission = Permission::whereId($id)->first();
        $main_permissions = Permission::whereParent(0)->select('id', 'display_name', 'display_name_en')->get();
        return view('backend.permissions.edit', compact('permission', 'main_permissions'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name'              => 'required|unique:permissions,name,'.$id,
            'display_name'      => 'required',
            'display_name_en'   => 'required',
            'description'       => 'nullable',
            'description_en'    => 'nullable',
            'route'             => 'required',
            'module'            => 'required',
            'as'                => 'required',
            'icon'              => 'required',
            'parent'            => 'required',
            'parent_show'       => 'required',
            'parent_original'   => 'required',
            'sidebar_link'      => 'required',
            'appear'            => 'required',
            'ordering'          => 'required',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']               = $request->name;
        $data['display_name']       = $request->display_name;
        $data['display_name_en']    = $request->display_name_en;
        $data['description']        = $request->description;
        $data['description_en']     = $request->description_en;
        $data['route']              = $request->route;
        $data['module']             = $request->module;
        $data['as']                 = $request->as;
        $data['icon']               = $request->icon;
        $data['parent']             = $request->parent;
        $data['parent_show']        = $request->parent_show;
        $data['parent_original']    = $request->parent_original;
        $data['sidebar_link']       = $request->sidebar_link;
        $data['appear']             = $request->appear;
        $data['ordering']           = $request->ordering;

        Permission::whereId($id)->update($data);

        return redirect()->route('admin.permissions.index')->with([
            'message' => 'Permission updated successfully',
            'alert-type' => 'success',
        ]);
    }

    public function destroy($id)
    {

        Permission::whereId($id)->delete();

        return redirect()->route('admin.permissions.index')->with([
            'message' => 'Permission deleted successfully',
            'alert-type' => 'success',
        ]);
    }

}

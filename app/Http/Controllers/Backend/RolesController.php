<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolesController extends Controller
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
        $roles = Role::query()
            ->when(request('keyword') != '', function($query) {
                $query->search(request('keyword'));
            })
            ->orderBy(request('sort_by') ?? 'id', request('order_by') ?? 'desc')
            ->paginate(request('limit_by') ?? 10)
            ->withQueryString();

        return view('backend.roles.index', compact('roles'));

    }

    public function create()
    {
        $permissions = Permission::select('id', 'display_name', 'display_name_en')->get();
        return view('backend.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'              => 'required|unique:roles,name',
            'display_name'      => 'required',
            'display_name_en'   => 'required',
            'description'       => 'nullable',
            'description_en'    => 'nullable',
            'allowed_route'     => 'nullable',
            'permissions'       => 'nullable',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']               = $request->name;
        $data['display_name']       = $request->display_name;
        $data['display_name_en']    = $request->display_name_en;
        $data['description']        = $request->description;
        $data['description_en']     = $request->description_en;
        $data['allowed_route']      = $request->allowed_route;

        $role = Role::create($data);
        if (count($request->permissions) > 0) {
            $role->attachPermissions($request->permissions);
        }

        return redirect()->route('admin.roles.index')->with([
            'message' => 'Role created successfully',
            'alert-type' => 'success',
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $role = Role::whereId($id)->first();
        $permissions = Permission::select('id', 'display_name', 'display_name_en')->get();
        $rolePerms = $role->perms()->pluck('id')->toArray();
        return view('backend.roles.edit', compact('role', 'permissions', 'rolePerms'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required|unique:roles,name,'.$id,
            'display_name'      => 'required',
            'display_name_en'   => 'required',
            'description'       => 'nullable',
            'description_en'    => 'nullable',
            'allowed_route'     => 'nullable',
            'permissions'       => 'nullable',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']               = $request->name;
        $data['display_name']       = $request->display_name;
        $data['display_name_en']    = $request->display_name_en;
        $data['description']        = $request->description;
        $data['description_en']     = $request->description_en;
        $data['allowed_route']      = $request->allowed_route;

        $role = Role::whereId($id)->first();
        $role->update($data);

        if (count($request->permissions) > 0) {
            $role->perms()->sync($request->permissions);
        }

        return redirect()->route('admin.roles.index')->with([
            'message' => 'Role updated successfully',
            'alert-type' => 'success',
        ]);
    }

    public function destroy($id)
    {
        Role::whereId($id)->delete();

        return redirect()->route('admin.roles.index')->with([
            'message' => 'Role deleted successfully',
            'alert-type' => 'success',
        ]);
    }
}

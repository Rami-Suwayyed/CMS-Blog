<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPermission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SupervisorsController extends Controller
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

        $users = User::query()
            ->whereUserRole('admin')
            ->when(request('keyword') != '', function($query) {
                $query->search(request('keyword'));
            })
            ->when(request('status') != '', function($query) {
                $query->whereStatus(request('status'));
            })
            ->orderBy(request('sort_by') ?? 'id', request('order_by') ?? 'desc')
            ->paginate(request('limit_by') ?? 10)
            ->withQueryString();

        return view('backend.supervisors.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::having('name->en', '!=', 'user')->get();
        return view('backend.supervisors.create', compact('roles'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'username'      => 'required|max:20|unique:users',
            'email'         => 'required|email|max:255|unique:users',
            'phone_number'        => 'required|numeric|unique:users',
            'status'        => 'required',
            'password'      => 'required|min:8',
            'permissions.*' => 'required'
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']           = $request->name;
        $data['username']       = $request->username;
        $data['email']          = $request->email;
        $data['email_verified_at'] = Carbon::now();
        $data['phone_number']         = $request->phone_number;
        $data['password']       = bcrypt($request->password);
        $data['status']         = $request->status;
        $data['bio']            = $request->bio;
        $data['receive_email']  = $request->receive_email;

        if ($user_image = $request->file('user_image')) {
            $filename = Str::slug($request->username).'.'.$user_image->getClientOriginalExtension();
            $path = public_path('assets/users/' . $filename);
            Image::make($user_image->getRealPath())->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $data['user_image']  = $filename;
        }

        $user = User::create($data);
        $user->attachRole(Role::whereName('editor')->first()->id);

        if (isset($request->permissions) && count($request->permissions) > 0 ){
            $user->permissions()->sync($request->permissions);
        }


        return redirect()->route('admin.supervisors.index')->with([
            'message' => 'Users created successfully',
            'alert-type' => 'success',
        ]);
    }

    public function show($id)
    {
        $user = User::whereId($id)->first();
        if ($user) {
            return view('backend.supervisors.show', compact('user'));
        }
        return redirect()->route('admin.supervisors.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);

    }

    public function edit($id)
    {
        $user = User::whereId($id)->first();
        if ($user) {
            $permissions = Permission::select('id', 'display_name', 'display_name_en')->get();
            $userPermissions = UserPermission::whereUserId($id)->pluck('permission_id')->toArray();
            return view('backend.supervisors.edit', compact('user', 'permissions', 'userPermissions'));
        }
        return redirect()->route('admin.supervisors.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'username'      => 'required|max:20|unique:users,username,'.$id,
            'email'         => 'required|email|max:255|unique:users,email,'.$id,
            'phone_number'        => 'required|numeric|unique:users,phone_number,'.$id,
            'status'        => 'required',
            'password'      => 'nullable|min:8',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::whereId($id)->first();

        if ($user) {
            $data['name']           = $request->name;
            $data['username']       = $request->username;
            $data['email']          = $request->email;
            $data['phone_number']         = $request->phone_number;
            if (trim($request->password) != '') {
                $data['password'] = bcrypt($request->password);
            }
            $data['status']         = $request->status;
            $data['bio']            = $request->bio;
            $data['receive_email']  = $request->receive_email;

            if ($user_image = $request->file('user_image')) {
                if ($user->user_image != '') {
                    if (File::exists('assets/users/' . $user->user_image)) {
                        unlink('assets/users/' . $user->user_image);
                    }
                }
                $filename = Str::slug($request->username).'.'.$user_image->getClientOriginalExtension();
                $path = public_path('assets/users/' . $filename);
                Image::make($user_image->getRealPath())->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);
                $data['user_image']  = $filename;
            }

            $user->update($data);

            if (isset($request->permissions) && count($request->permissions) > 0 ){
                $user->permissions()->sync($request->permissions);
            }

            return redirect()->route('admin.supervisors.index')->with([
                'message' => 'User updated successfully',
                'alert-type' => 'success',
            ]);

        }
        return redirect()->route('admin.supervisors.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }

    public function destroy($id)
    {

        $user = User::whereId($id)->first();

        if ($user) {
            if ($user->user_image != '') {
                if (File::exists('assets/users/' . $user->user_image)) {
                    unlink('assets/users/' . $user->user_image);
                }
            }
            $user->delete();

            return redirect()->route('admin.supervisors.index')->with([
                'message' => 'Supervisor deleted successfully',
                'alert-type' => 'success',
            ]);
        }

        return redirect()->route('admin.supervisors.index')->with([
            'message' => 'Something was wrong',
            'alert-type' => 'danger',
        ]);
    }

    public function removeImage(Request $request)
    {

        $user = User::whereId($request->user_id)->first();
        if ($user) {
            if (File::exists('assets/users/' . $user->user_image)) {
                unlink('assets/users/' . $user->user_image);
            }
            $user->user_image = null;
            $user->save();
            return 'true';
        }
        return 'false';
    }
}

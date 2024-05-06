<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{

    public function __construct()
    {
        if (!Auth::check()) {
            return redirect()->route('admin.show_login_form');
        }
    }

    public function index()
    {
        return view('backend.profile.index');
    }

    public function edit()
    {
        return view('backend.profile.edit');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'email'         => 'required|email',
            'phone_number'        => 'required|numeric',
            'bio'           => 'nullable|min:10',
            'receive_email' => 'required',
            'user_image'    => 'nullable|image|max:20000,mimes:jpeg,jpg,png'
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['name']           = $request->name;
        $data['email']          = $request->email;
        $data['phone_number']         = $request->phone_number;
        $data['bio']            = $request->bio;
        $data['receive_email']  = $request->receive_email;

        if ($image = $request->file('user_image')) {
            if (auth()->user()->user_image != ''){
                if (File::exists('/assets/users/' . auth()->user()->user_image)){
                    unlink('/assets/users/' . auth()->user()->user_image);
                }
            }
            $filename = Str::slug(auth()->user()->username).'.'.$image->getClientOriginalExtension();
            $path = public_path('assets/users/' . $filename);
            Image::make($image->getRealPath())->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);

            $data['user_image'] = $filename;
        }

        $update = auth()->user()->update($data);

        if ($update) {
            return redirect()->back()->with([
                'message' => __('backend/general.updated_successfully'),
                'alert-type' => 'success',
            ]);
        } else {
            return redirect()->back()->with([
                'message' => __('backend/general.something_was_wrong'),
                'alert-type' => 'danger',
            ]);
        }
    }



    public function change_password()
    {
        return view('backend.profile.change_password');
    }

    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password'  => 'required',
            'password'          => 'required|min:6|max:25|confirmed',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = auth()->user();
        if (Hash::check($request->current_password, $user->password)) {
            $update = $user->update([
                'password' =>  Hash::make($request->password),
            ]);

            if ($update) {
                return redirect()->route('admin.profile.index')->with([
                    'message' => __('backend/general.updated_successfully'),
                    'alert-type' => 'success',
                ]);
            } else {
                return redirect()->back()->with([
                    'message' => __('backend/general.something_was_wrong'),
                    'alert-type' => 'danger',
                ]);
            }

        } else {
            return redirect()->back()->with([
                'message' => __('backend/general.something_was_wrong'),
                'alert-type' => 'danger',
            ]);
        }
    }


}

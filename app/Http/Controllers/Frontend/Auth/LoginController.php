<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';
    protected $loginField = "email";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    public function username()
    {
        $loginFieldValue = request()->input("login");
        if($loginFieldValue){
            $this->loginField = filter_var($loginFieldValue, FILTER_VALIDATE_EMAIL) ? "email" : "username";
            request()->merge([$this->loginField => $loginFieldValue]);
        }
        return $this->loginField;
    }


    protected function authenticated(Request $request, $user)
    {

        if ($user->status == 1) {
            return redirect()->route('users.dashboard')->with([
                'message' => 'Logged in successfully.',
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('frontend.index')->with([
            'message' => 'Please contact Bloggi Admin.',
            'alert-type' => 'warning'
        ]);


    }

    public function redirectToProvider($provider)
    {
      return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();
        $token = $socialUser->token;
        $id = $socialUser->getId();
        $nickName = $socialUser->getNickname();
        $name = $socialUser->getName();
        $email = $socialUser->getEmail() == '' ? trim(Str::lower(Str::replaceArray(' ', ['_'], $name))).'@'.$provider.'.com' : $socialUser->getEmail();
        $avatar = $socialUser->getAvatar();
        $nameTrim =trim(Str::lower(Str::replaceArray(' ', ['_'], $name)));
        $Username = User::whereUsername($nameTrim)->first();
        if ($Username) {
            $nameTrim = $nameTrim.'_'.$id;
        }
        $user = User::firstOrCreate([
            'email' => $email
        ], [
            'name' => $name,
            'user_role'=> 'user',
            'username' => $nickName != '' ? $nickName : trim(Str::lower(Str::replaceArray(' ', ['_'], $nameTrim))),
            'email' => $email,
            'email_verified_at' => Carbon::now(),
            'phone_number' => '00000000000',
            'status' => 1,
            'receive_email' => 1,
            'remember_token' => $token,
            'password' => Hash::make($email),
        ]);

        if ($user->user_image == '') {
            $filename = '' . $user->username .'.jpg';
            $path = public_path('/assets/users/' . $filename);
            Image::make($avatar)->save($path, 100);
            $user->update(['user_image' => $filename]);
        }
//        $user->attachRole(Role::whereName('user')->first()->id);

        Auth::login($user, true);

        return redirect()->route('users.dashboard')->with([
            'message' => 'Logged in successfully',
            'alert-type' => 'success'
        ]);


    }


}

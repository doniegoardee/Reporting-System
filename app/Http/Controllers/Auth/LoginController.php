<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Spatie\Activitylog\Models\Activity;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $input['email'], 'password' => $input['password']])) {
            $user = auth()->user();


            if ($user instanceof User) {
                activity()
                    ->causedBy($user)
                    ->performedOn($user)
                    ->log('logged in');
            }

            if ($user->role == 'user') {
                return redirect()->route('user.incident');
            } elseif ($user->role == 'admin') {
                return redirect()->route('admin.index');
            } elseif ($user->role == 'agency') {
                return redirect()->route('agency.home');
            }
        } else {
            return redirect()->route('login')->with("error", 'Login Error incorrect email or password');
        }
    }
}

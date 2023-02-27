<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Session;
use App\Admin;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Controllers\Controller;


class LoginController extends Controller
{

    use ThrottlesLogins;

    protected $maxAttempts = 3; // Default is 5
    protected $decayMinutes = 1; // Default is 1


    public function __construct()
    {
      $this->middleware('guest:admin', ['except' => ['logout']]);
    }


    public function index()
    {
      return view('admin.auth.login');
    }

    public function username(){
        return 'email';
    }

    public function login(AdminLoginRequest $request)
    {
      //check if the user has too many login attempts.
      if ($this->hasTooManyLoginAttempts($request)){
          //Fire the lockout event.
          $this->fireLockoutEvent($request);

          //redirect the user back after lockout.
          return $this->sendLockoutResponse($request);
      }
      // Attempt to log the admin in
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('admin.dashboard'));
      } 

        //keep track of login attempts from the user.
        $this->incrementLoginAttempts($request);
      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->route('admin.login')->withInput($request->only('email', 'remember'))->with('danger','Credentials Does not Match!');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        Session::flush();
        return redirect()->route('admin.login');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\ShopService;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo()
    {
        return '/my-account';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'r-email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'min:9','max:10'],
            'city' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'r-password' => ['required', 'string', 'min:8', 'confirmed'],
            'captcha' => ['required', 'captcha'],
            'is_vendor' => ['required','in:1,0'],
            'shop_name' => ['required_if:is_vendor,1', 'max:255','unique:shops'],
            'shop_number' => ['required_if:is_vendor,1', 'max:10'],
            'national_copy' => ['required_if:is_vendor,1'],
            'national_id' => ['required_if:is_vendor,1'],
            'comercial_reg_number' => ['required_if:is_vendor,1'],
            'comercial_reg_copy' => ['required_if:is_vendor,1'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['r-email'],
            'phone' => $data['vendor_number_code'].$data['phone'],
            'city' => $data['city'],
            'address' => $data['address'],
            'password' => Hash::make($data['r-password']),
            'status' => 1,
        ]);
        if ($data['is_vendor'] == 1) {
            $user = ShopService::create($user,$data);
        }
        $user->image()->create(['url'=>'assets/images/users/no-image.jpg']);
        return $user;
    }
}
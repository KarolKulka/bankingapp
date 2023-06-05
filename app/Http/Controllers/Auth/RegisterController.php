<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'lastname' => ['required', 'string', 'min:3'],
            'phone' => ['required', 'string', 'min:9'],
            'street' => ['required', 'string' , 'min:3'],
            'number' => ['required', 'string'],
            'apartment' => ['string'],
            'city' => ['required', 'string', 'min:3'],
            'postcode' => ['required', 'string', 'min:5', 'max:6', 'regex:/\A(\d{5}|\d{2}-\d{3}|\d{2}\s\d{3})\z/'],
            'birthdate' => ['required', 'date_format:Y-m-d', 'before:'.date('Y-m-d',strtotime('18 years ago'))],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'street' => $data['street'],
            'number' => $data['number'],
            'apartment' => $data['apartment'],
            'city' => $data['city'],
            'postcode' => $data['postcode'],
            'birthdate' => $data['birthdate'],
        ]);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Mail\ConfirmationEmail;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/index';

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
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'father_name' => $data['father_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

         Mail::to($user->email)->send(new ConfirmationEmail($user));

         return back()->with('status', 'Siz uğurla qeydiyyatdan keçdiniz. Zəhmət olmasa email ünvanınıza göndərdiyimiz aktivləşdirmə linkinə klikləyərək hesabınızı aktivləşdirin.');
    }
    public function confirmEmail($token){
        User::where('token',$token)->firstOrFail()->hasVerified();
        return redirect('login')->with('status','Sizin hesabınız uğurla aktivləşdirildi.Hesabınıza daxil olmaq üçün email ünvanınızı və şifrənizi daxil edin.');
    }
}

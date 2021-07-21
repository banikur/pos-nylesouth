<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;

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
    protected $redirectTo = '/home';

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
            'alamat' => ['required', 'string', 'max:255'],
            'no_telp' => ['required', 'string', 'max:13'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        $event = new \stdClass();
        $datenow = date('Y-m-d');

        $event->senderEmail = $data['email'];
        $event->email = $data['email']; 
        $event->senderName = 'no-reply';
        $event->subject = 'REGISTRASI APLIKASI POS-NYLESOUTH';
        $event->message = '';  
        $event->name = $data['name'];
        $event->password = $data['password'];
        $event->tanggal = $datenow;       
        Mail::send((new RegisterMail($event))->delay(30));

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'tipe_user' => null,
            'active' => 1,
            'password' => Hash::make($data['password']),
            'no_hp' => $data['no_telp'],
            'alamat' => $data['alamat'],
        ]);
    }

}

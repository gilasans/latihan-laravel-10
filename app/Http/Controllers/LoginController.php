<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    //
    public function index(){
        return view('auth.login');
    }

    public function forgot_password(){
        return view('auth.forgot_password');
    }
    public function forgot_password_act(Request $request)
    {   
        $customMessage = [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.exists' => 'Email tidak terdaftar di database',
        ];
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], $customMessage);

        $token = Str::random(60);
        // jngn pake create doang tapi harus pake updateOrCreate supaya nantinya 
        // klo ngeklik 2x reset password nya gak double
        PasswordResetToken::updateOrCreate(
            [
                'email' => $request->email,    
            ],
            [
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
            ]
    );
            // proses kirim email
            // php artisan make:mail ResetPasswordMail
            Mail::to($request->email)->send(new ResetPasswordMail($token));

        return redirect()->route('forgot-password')->with('success','Kami telah mengirim Link ke email');
    }

    public function validasi_forgot_password(Request $request, $token)
    {
    $getToken = PasswordResetToken::where('token', $token)->first();
    if(!$getToken){
        return redirect()->route('login')->with('failed', 'Token tidak valid');
    }


        return view('auth.validasi-token', compact( 'token'));
    }

    public function validasi_forgot_password_act(Request $request)
    {
        $customMessage = 
        [
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 6 karakter',
            // 'password.confirmed' => 'Password tidak sama dengen konfirmasi password'
        ];

        $request->validate([
            'password' => 'required|min:6'
        ], $customMessage);

        // dd($request->all());

        $token = PasswordResetToken::where('token', $request->token)->first();

        if(!$token){
            return redirect()->route('login')->with('failed', 'Token tidak valid');
        }
    
        $user = User::where('email', $request->email)->first();

        if(!$user){
            return redirect()->route('login')->with('failed', 'Email tidak terdaftar di database');
        }

        $user->update([
            'password' =>Hash::make($request->password)
        ]);

        $token->delete(); 
    
        return redirect()->route('login')->with('success', 'Password berhasil di reset');
    }

    public function login_proses(Request $request){
        
        // var_dump nya laravel
        // dd($request->all());

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // untuk pengecekan login
        if(Auth::attempt($data)){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('login')->with('Failed','Email atau password salah');
        }
    }
    public function logout(){
        // untuk ngecek
        // dd('oke');

        return redirect()->route('login')->with('success','Kamu Berhasil Logout');
    }

    public function register(){
        return view('auth.register');
    }
    public function register_proses(Request $request){
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

            $data['name'] = $request->nama;
            $data['email'] = $request->email;
            $data['password'] = Hash::make($request->password) ;  

        User::create($data);


        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // untuk pengecekan login
        if(Auth::attempt($login)){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('login')->with('Failed','Email atau password salah');
        }
        }

}

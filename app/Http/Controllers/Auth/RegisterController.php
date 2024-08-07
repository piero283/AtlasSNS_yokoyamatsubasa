<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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


    public function register(Request $request){
        if($request->isMethod('post')){

            //ユーザー登録のバリテーション登録
            $request->validate(
                [
                'username' =>'required|between:2,12',
                'mail' => 'required|between:5,40|email:filter,dns',
                'password' => 'required|between:8,20|alpha-num|confirmed:password',
            ]);

            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');

            $user = User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);

            //セッションにユーザー情報を保存
            session(['registered_user' => $user]);

            return redirect('added');
        }
        return view('auth.register');
    }
    public function added()
    {
        $user = session('registered_user');
        session()->forget('registered_user'); //セッションをクリア
        return view('auth.added', ['user' => $user]);
    }
}

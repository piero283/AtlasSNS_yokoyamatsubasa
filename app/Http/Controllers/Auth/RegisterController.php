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

    //登録フォーム表示
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    //ユーザー登録のバリテーション登録
    public function validator(array $data){
        return Validator::make($data, [
            'username' =>'required|between:2,12',
            'mail' => 'required|between:5,40|email:filter,dns|unique:users,email',
            'password' => 'required|between:8,20|alpha-num|confirmed:password',
        ]);
    }

    //取得したデータの登録
    public function create(array $data){
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => Hash::make($data['password']),
        ]);
    }

    //登録したユーザーネーム反映
    public function added(Request $request){
        $username = $request->input('username');
        return view('auth.added',['username'=>$username]);
    }

    /*    public function register(Request $request){
        if($request->isMethod('post')){

        //ユーザー登録のバリテーション登録
          $request->validate([
            'username' =>'required|between:2,12',
            'mail' => 'required|between:5,40|email:filter,dns|unique:users,email',
            'password' => 'required|between:8,20|alpha-num|confirmed:password',
          ]);

            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');

            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);

            return redirect('added');
        }
        return view('auth.register');
    }*/
}

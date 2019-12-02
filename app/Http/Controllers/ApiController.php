<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function register(Request $request){
        $this->validator($request->all())->validate();
        $token = Str::random(80);
        $data = array_merge($request->all(),compact('token'));
        $this->create($data);
//        return compact('token');
        return response()->json(['message'=>'注册成功','token'=>$token],201);
    }

    public function login(){
        $user = User::where($this->username(), request($this->username()))->first();
        if(!$user || !Hash::check(request('password'),$user->password)){
            return response()->json(['errer'=> '抱歉账号或者密码错误'],403);
        }
        $token = Str::random(80);
        $user->update(['api_token' => $token]);
//        $user->api_token = $token;
//        $user->save();
        return response()->json(['message'=> '登录成功','token'=> $token],200);

    }

    public function logout(){
        Auth::user();
//        return $user;
        auth()->user()->update(['api_token' => null]);

        return ['message'=> '登出成功！'];
    }

    public function refresh(){
        $user = Auth::user();
        dd($user);
//        $token = Str::random(80);
//        Auth::user()->update(['api_token', $token]);
//        auth()->user()->update(['api_token'=> $token]);
        return compact('token');
    }




    public  function validator(array $data){
        //原始写法
//        return Validator::make($data, [
//            'name' => ['required', 'string', 'max:255', 'unique:users'],
//            'password' => ['required', 'string', 'min:8', 'confirmed'],
//           'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//
//        ]);
        $rules = [
            'name'     => 'required|alpha_num|min:5|max:30|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
        $message = [
            'name.required'     => '必须输入用户名',
            'name.alpha_num'    => '用户名只能为字母或数字',
            'name.min'          => '用户名长度不能少于 5 字符',
            'name.max'          => '用户名长度不能超过 30 字符',
            'name.unique'       => '用户名已经存在，请更换注册用户名',
//            'user_Email.required'    => '必须输入电子邮箱地址',
//            'user_Email.email'       => '电子邮箱地址非法',
//            'user_Email.max'         => '电子邮箱地址长度不能超过 100 字符',
//            'user_Email.unique'      => '电子邮箱地址已经存在，请更换邮箱地址',
            'password.required' => '必须输入密码',
            'password.min'      => '密码长度最少 6 字符',
            'confirmed'              => '密码和确认密码必须相同',
//            'I_agree.required'       => '必须同意服务条款',
        ];
        return validator::make($data, $rules, $message);

    }
    public function create(array $data){
        return User::create([
            'name' => $data['name'],
//            'email' => $data['email'],
            'password' => Hash::make($data['password']),  //哈希加密
//            'api_token' => hash('sha256', $data['token']), //哈希加密
            'api_token' => $data['token'],
        ]);
    }
    public function username()
    {
        return 'name';
    }
}

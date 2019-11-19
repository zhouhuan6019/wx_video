<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client as Guzzle;

class RegisterController extends Controller
{
    //
    private $http;

    /**
     * RegisterController constructor.
     * @param $http
     */
    public function __construct(Guzzle $http)
    {
        $this->http = $http;
    }


    public function register(RegisterUserRequest $request){
        $Login = User::create([
           'name'     => $request->name,
           'password'   => bcrypt($request->password),
           'email'      => $request->email
        ]);

        $response = $this->http->post('http://la.cn/oauth/token', [
            'form_params' => [
                'grant_type'    => 'password',
                'client_id'     => '2',  // your client id
                'client_secret' => 'g1gLROqrY9qFZe4Dmu1x9qlb2TnXsSJa0hffVWny',   // your client secret
                'username'      => $Login->email,
                'password'      => $request->password,
                'scope'         => '*',
                'code'          => $request->code,
            ],
        ]);

        $token = json_decode((string) $response->getBody(), true);

        return response()->json([
           'token' => $token
        ],201);
    }
}

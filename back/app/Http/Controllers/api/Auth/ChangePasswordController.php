<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Tymon\JWTAuth\JWTAuth;

class ChangePasswordController extends Controller
{

    protected $auth;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'new_password' => 'required|string|min:8',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    public function update(Request $request, $id)
    {
        
        $user = User::find($id);
        if (!password_verify($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'errors' => [
                    'password' => [
                        "パスワードが合致しません"
                    ],
                ]
            ],422);
        }
        $this->validator($request->all())->validate();
        $user->password = bcrypt($request->new_password);
        $user->save();
}

}

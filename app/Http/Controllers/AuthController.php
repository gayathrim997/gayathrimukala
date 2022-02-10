<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('user_name', $request->user_name)->first();

        if (!$user | !Hash::check($request->password, $user->password)) {
            return [
                'message' => 'Invalid Credentials '
            ];
        }

        return [
            'user_type' => $user->user_type,
            'token' => $user->createToken('auth')->accessToken
        ];
    }
    //

    public function logout(Request $request)
    {

        // if($request->user()->user_type == "admin"){
        //     return "true";
        // }
        $request->user()->tokens()->delete();
        return redirect('/');
    }
}

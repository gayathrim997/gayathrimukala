<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserUpdateRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\CreateUserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return [
            "users" =>CreateUserResource::collection($users)
        ];
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UserRequest $request)
    {
        $user = User::create([
            'user_type'=>$request->user_type,
            'user_name' => $request->user_name,
            'password'=>Hash::make($request->password),    
            'status'=>$request->status
        ]);

        return [
            'message' => 'User Created..',
            'user'  => new CreateUserResource($user) 
        ];
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user  = User::whereId($id)->first();

        return [
            'User' => new CreateUserResource($user)
        ];
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUserUpdateRequest $request, $id)
    {
        User::whereId($id)->update($request->all());
        $user = User::whereId($id)->first();
        return [
            "message" => 'user Updated ',
            'user' => new CreateUserResource($user)
        ];
        
        
    }


    public function forgetPassword(Request $request ,$id){

        $request->validate([
            'new_password' => 'required|min:8|max:16',
            'cof_password' => 'required|min:8|max:16'
        ]);

        if($request->new_password === $request->cof_password){

            User::whereId($id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            return [
                'message' => 'Password Reset Successfully '
            ];
        }

        return [
            'message' => 'Password Didnt Match !! '
             
        ];


    }


    public function changePassword(Request $request , $id){
        $request->validate([
            'new_password' => 'required|min:8|max:16',
            'cof_password' => 'required|min:8|max:16'
        ]);

        if($request->new_password === $request->cof_password){

            User::whereId($id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            return [
                'message' => 'Password Changed Successfully '
            ];
        }

        return [
            'message' => 'Password Didnt Match !! '
             
        ];
    }
}

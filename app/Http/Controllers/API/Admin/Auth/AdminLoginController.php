<?php

namespace App\Http\Controllers\API\Admin\Auth;

use App\Http\Controllers\Controller;

use App\Http\Requests\API\Admin\AdminLoginRequest ;
use App\Http\Resources\API\Admin\Auth\AdminLoginResource;
use App\Models\Admin;
use App\Traits\ResponceTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    use ResponceTrait;
    public function login(AdminLoginRequest $request)
    {
       $data = $request->validated();

        $admin = Admin::where('email',$data['email'])->first();

        if(!$admin || !Hash::check($data['password'] ,$admin->password )){
            return $this->sendError('Invalid credentials');
        }

       $admin->access_token = $admin->createToken('admin_token',['admin'])->plainTextToken;

        return $this->sendResponce(new AdminLoginResource($admin),'User Logged in successfully');

    }
      public function logout()
    {
        $user=auth('admin')->user();
            //        return $user->tokens()->get();

        // delete all tokens
//        $user->tokens()->delete() ;

        // remove received token
        $user->currentAccessToken()->delete();

        return $this->sendResponce(null ,'user logout successfully');

    }
}

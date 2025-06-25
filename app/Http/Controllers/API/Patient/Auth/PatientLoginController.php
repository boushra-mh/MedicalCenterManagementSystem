<?php

namespace App\Http\Controllers\API\Patient\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Patient\PatientLoginRequest;
use App\Http\Resources\API\Patient\Auth\PatientLoginResource;
use App\Models\User;
use App\Traits\ResponceTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientLoginController extends Controller
{
    use ResponceTrait;
    public function login(PatientLoginRequest $request)
    {
        
       $data = $request->validated();

        $user = User::where('email',$data['email'])->first();

        if(!$user || !Hash::check($data['password'] ,$user->password )){
            return $this->sendError('Invalid credentials');
        }

       $user->access_token = $user->createToken('user_token',['user'])->plainTextToken;

        return $this->sendResponce(new PatientLoginResource($user),'User Logged in successfully');

    }
      public function logout()
    {
        $user=auth('user')->user();
            //        return $user->tokens()->get();

        // delete all tokens
//        $user->tokens()->delete() ;

        // remove received token
        $user->currentAccessToken()->delete();

        return $this->sendResponce(null ,'user logout successfully');

    }
}

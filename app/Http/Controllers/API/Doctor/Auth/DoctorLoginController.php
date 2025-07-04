<?php

namespace App\Http\Controllers\API\Doctor\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Doctor\DoctorLoginRequest;
use App\Http\Resources\API\Doctor\Auth\DoctorLoginResource;
use App\Models\Doctor;
use App\Traits\ResponceTrait;
use Illuminate\Support\Facades\Hash;

class DoctorLoginController extends Controller
{
     use ResponceTrait;
    public function login(DoctorLoginRequest $request)
    {
       $data = $request->validated();

        $doctor = Doctor::where('email',$data['email'])->first();

        if(!$doctor || !Hash::check($data['password'] ,$doctor->password )){
            return $this->sendError('Invalid credentials');
        }

       $doctor->access_token = $doctor->createToken('doctor_token',['doctor'])->plainTextToken;

        return $this->sendResponce(new DoctorLoginResource($doctor),'User Logged in successfully');

    }
      public function logout()
    {
        $user=auth('doctor')->user();
            //        return $user->tokens()->get();

        // delete all tokens
//        $user->tokens()->delete() ;

        // remove received token
        $user->currentAccessToken()->delete();

        return $this->sendResponce(null ,'user logout successfully');

    }
}

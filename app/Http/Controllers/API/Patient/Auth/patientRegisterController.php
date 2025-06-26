<?php

namespace App\Http\Controllers\API\Patient\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Patient\Auth\patientRegisterRequest;
use App\Models\User;
use App\Traits\ResponceTrait;
use Illuminate\Http\Request;

class patientRegisterController extends Controller
{
   use ResponceTrait;
    public function register(patientRegisterRequest $request)
    {
        $user=User::create($request->validated());


         $token=$user->createToken('user_token')->plainTextToken;
         return $this->sendResponce(['access-token'=>$token],'you are register successfully');



    }
}

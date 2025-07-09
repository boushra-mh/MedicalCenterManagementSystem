<?php



namespace App\Http\Controllers\WEB\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Patient\Auth\patientRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('user.auth.register');
    }

    public function register(patientRegisterRequest $request)
    {
       $data=$request->validated();

        $user = User::create($data);

        $user->assignRole('user');

        Auth::login($user);

        return redirect()->route('user.dashboard');
    }
}



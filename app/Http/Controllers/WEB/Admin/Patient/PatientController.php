<?php
namespace App\Http\Controllers\WEB\Admin\Patient;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = User::latest()->get();
        return view('admin.patients.index', compact('patients'));
    }
}

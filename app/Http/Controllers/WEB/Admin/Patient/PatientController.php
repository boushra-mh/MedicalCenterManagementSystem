<?php
namespace App\Http\Controllers\WEB\Admin\Patient;

use App\Http\Controllers\Controller;
use App\Models\User;

class PatientController extends Controller
{
   /**
     * 📋 عرض قائمة المرضى
     */
    public function index()
    {
        $patients = User::paginate(10);
        return view('admin.patients.index', compact('patients'));
    }
}

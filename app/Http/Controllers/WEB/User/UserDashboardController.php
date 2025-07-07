<?php
namespace App\Http\Controllers\WEB\User;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Specialty;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $appointmentsToday = Appointment::byUser($userId)
            ->appointmentsForToday()
            ->with('doctor')
            ->get();

        $stats = [
            'total'     => Appointment::byUser($userId)->count(),
            'confirmed' => Appointment::byUser($userId)->confirmed()->count(),
            'canceled'  => Appointment::byUser($userId)->canceled()->count(),
            'pending'   => Appointment::byUser($userId)->pending()->count(),
        ];

        $specialties = Specialty::all();

        return view('user.dashboard', compact('appointmentsToday', 'stats', 'specialties'));
    }

    public function showDoctors($id)
    {
        $specialty = Specialty::with('doctors')->findOrFail($id);
        return view('user.doctors.doctors_by_specialty', compact('specialty'));
    }
}

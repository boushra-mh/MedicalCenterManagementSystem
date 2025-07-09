<?php
namespace App\Http\Controllers\WEB\Admin\Appointments;

use App\Http\Controllers\Controller;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    /**
     * 📋 عرض قائمة المواعيد
     */
    public function index()
    {
        $appointments = Appointment::with(['doctor', 'user'])->paginate(10);
        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * 📋 عرض قائمة المواعيد المحذوفة مؤقتاً
     */
    public function trashed()
    {
        $appointments = Appointment::onlyTrashed()->with(['doctor', 'user'])->latest()->get();
        return view('admin.appointments.trashed', compact('appointments'));
    }

    /**
     * 🗑️ حذف المواعيد بشكل نهائي
     */
    public function forceDelete($id)
    {
        $appointment = Appointment::onlyTrashed()->findOrFail($id);
        $appointment->forceDelete();

        return redirect()->route('admin.appointments.trashed')->with('success', 'تم حذف الموعد نهائياً');
    }
}

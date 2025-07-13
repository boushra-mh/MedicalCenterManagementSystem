<?php
namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Enums\StatusEnum;
use App\Events\AppointmentStatusUpdated;
use App\Services\AdminSevice;
use App\Services\DoctorService;
use Illuminate\Http\RedirectResponse;

class AdminPanelController extends Controller
{
   protected $adminService;

    public function __construct(AdminSevice $adminService)
    {
        $this->adminService = $adminService;
    }

       public function index()
    {
        // جلب البيانات الإحصائية
        $stats = $this->adminService->statistics();

        // البيانات بالصيغة العادية (array)
        $statsArray = [
            'total_doctors' => $stats['total_doctors'],
            'total_patients' => $stats['total_patients'],
            'total_appointments' => $stats['total_appointments'],
            'total_appointmentsWithTrashed' => $stats['total_appointmentsWithTrashed'],
        ];

        return view('admin.dashboard', compact('statsArray'));
    }

    public function toggleStatusForDoctor($id)
{
    $doctor = $this->adminService->toggleDoctorStatus($id);

    return response()->json([
        'message' => 'تم تحديث حالة الطبيب بنجاح',
        'status' => $doctor->status === StatusEnum::Active ? 'active' : 'inactive',

    ]);
}
}

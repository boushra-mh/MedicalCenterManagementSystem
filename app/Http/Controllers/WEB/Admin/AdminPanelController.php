<?php
namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Enums\StatusEnum;
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

    public function toggleStatusForDoctor($id): RedirectResponse
    {
        $doctor = $this->adminService->toggleDoctorStatus($id);

        return redirect()->back()->with('success', 'تم تحديث حالة الطبيب بنجاح');
    }
}

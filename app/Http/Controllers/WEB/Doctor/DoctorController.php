<?php

namespace App\Http\Controllers\WEB\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Doctor\DoctorRequest;
use App\Models\Specialty;
use App\Services\DoctorService;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    protected $doctorService;

    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    /**
     * 📋 عرض قائمة الأطباء
     */
    public function index()
    {
        $doctors = $this->doctorService->getAllDoctors();
        return view('admin.doctors.index', compact('doctors'));
    }
    

    /**
     * ➕ عرض نموذج إنشاء طبيب
     */
    public function create()
    {
        $specialties = Specialty::all();
        return view('admin.doctors.create', compact('specialties'));
    }

    /**
     * 💾 حفظ طبيب جديد
     */
    public function store(DoctorRequest $request)
    {
        $this->doctorService->create($request->validated());
        return redirect()->route('admin.doctors.index')->with('success', 'Doctor created successfully.');
    }

    /**
     * ✏️ عرض نموذج تعديل الطبيب
     */
    public function edit($id)
    {
        $doctor = $this->doctorService->find($id);
        $specialties = Specialty::all();
        return view('admin.doctors.edit', compact('doctor', 'specialties'));
    }

    /**
     * 🔄 تحديث بيانات الطبيب
     */
    public function update(Request $request, $id)
    {
         $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
             'specialties.*' => ['exists:specialties,id']
        ]);
        $this->doctorService->update($data, $id);
        return redirect()->route('admin.doctors.index')->with('success', 'Doctor updated successfully.');
    }

    /**
     * 🗑️ حذف طبيب
     */
    public function destroy($id)
    {
        $this->doctorService->delete($id);
        return redirect()->route('admin.doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}

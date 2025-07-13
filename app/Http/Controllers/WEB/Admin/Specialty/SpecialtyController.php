<?php
namespace App\Http\Controllers\WEB\Admin\Specialty;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\Specialty\SpecialtyStoreRequest;
use App\Models\Specialty;
use App\Services\SpecialtyService;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    protected $specialtyService;

    public function __construct(SpecialtyService $specialtyService)
    {
        $this->specialtyService = $specialtyService;
    }

    /**
     * 📋 عرض قائمة التخصصات
     */
    public function index()
    {
        $specialties = $this->specialtyService->getAllSpecialties();
        return view('specialty.index', compact('specialties'));
    }

    /**
     * ➕ عرض نموذج إنشاء تخصص
     */
    public function create()
    {
        return view('specialty.create');
    }

    /**
     * 💾 حفظ تخصص جديد
     */
    public function store(SpecialtyStoreRequest $request)
    {
        $data = $request->validated();

        $this->specialtyService->create($data);
        return redirect()->route('admin.specialties.index')->with('success', 'Specialty created successfully.');
    }

    /**
     * ✏️ عرض نموذج تعديل التخصص
     */
    public function edit($id)
    {
        $specialty = $this->specialtyService->getById($id);
        return view('specialty.edit', compact('specialty'));
    }
     public function trashed()
    {
        $specialties = Specialty::onlyTrashed()->get();
        return view('specialty.trashed', compact('specialties'));
    }

    /**
     * 🔄 تحديث بيانات التخصص
     */
    public function update(SpecialtyStoreRequest $request, $id)
    {
        $data = $request->validated();
        $this->specialtyService->update($data, $id);
        return redirect()->route('admin.specialties.index')->with('success', 'Specialty updated successfully.');
    }

    /**
     * 🗑️ حذف تخصص
     */
    public function destroy($id)
    {
        $this->specialtyService->delete($id);
        return redirect()->route('admin.specialties.index')->with('success', 'Specialty deleted successfully.');
    }
     /**
     * إعادة تخزين تخصص
     */

    public function restore($id)
{
    $specialty = Specialty::onlyTrashed()->findOrFail($id);
     $specialty ->restore();
     

    return redirect()->route('admin.specialties.index')->with('success', 'Specialty restored successfully.');
}
    /**
     * 🗑️ حذف المواعيد بشكل نهائي
     */
    public function forceDelete($id)
    {
        $specialty = specialty::onlyTrashed()->findOrFail($id);
        $specialty->forceDelete();

        return redirect()->route('admin.specialties.trashed')->with('success', 'تم حذف الموعد نهائياً');
    }
}

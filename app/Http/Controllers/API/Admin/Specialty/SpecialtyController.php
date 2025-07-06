<?php

namespace App\Http\Controllers\API\Admin\Specialty;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\Specialty\SpecialtyStoreRequest;
use App\Http\Resources\API\Admin\Specialty\SpecialtyResource;
use App\Http\Resources\API\Doctor\DoctorResource;
use App\Models\Specialty;
use App\Services\SpecialtyService;
use App\Traits\ResponceTrait;

class SpecialtyController extends Controller
{
    use ResponceTrait;

    protected $specialtyService;

    public function __construct(SpecialtyService $specialtyService)
    {
        $this->specialtyService = $specialtyService;
    }

    /**
     * 📋 جلب جميع التخصصات
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $specialties = $this->specialtyService->getAllSpecialties();

        return $this->sendResponce(
            SpecialtyResource::collection($specialties),
            __("Speciality_retrieved_successfully"),
            200,
            true
        );
    }

    /**
     * ➕ إنشاء تخصص جديد
     *
     * @param SpecialtyStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SpecialtyStoreRequest $request)
    {
        $specialty = $this->specialtyService->create($request->validated());

        return $this->sendResponce(
            SpecialtyResource::make($specialty),
            __("Speciality_Stored_Succesfully")
        );
    }

    /**
     * 👁️ عرض تفاصيل تخصص حسب المعرف
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $specialty = $this->specialtyService->find($id);

        return $this->sendResponce(
            SpecialtyResource::make($specialty),
            __("Speciality_retrieved_Succesfully")
        );
    }

    /**
     * ✏️ تعديل تخصص موجود
     *
     * @param SpecialtyStoreRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SpecialtyStoreRequest $request, $id)
    {
        $specialty = $this->specialtyService->update($request->validated(), $id);

        return $this->sendResponce(
            SpecialtyResource::make($specialty),
            __("Speciality_updated_Succesfully")
        );
    }

    /**
     * 🗑️ حذف تخصص حسب المعرف
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->specialtyService->delete($id);

        return $this->sendResponce(
            null,
            __("Speciality_deleted_Succesfully")
        );
    }

    /**
     * 👨‍⚕️ جلب جميع الأطباء المرتبطين بتخصص معين
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function doctors($id)
    {
        $specialty = Specialty::with('doctors')->findOrFail($id);

        return $this->sendResponce(
            DoctorResource::collection($specialty->doctors),
            __('Doctors_in_this_specialty')
        );
    }
}

<?php

namespace App\Services;

use App\Models\Specialty;

class SpecialtyService
{
    /**
     * 🔍 جلب تخصص واحد حسب المعرف
     *
     * @param int $id
     * @return Specialty
     */
    public function getById($id)
    {
        return Specialty::findOrFail($id);
    }

    /**
     * 📋 جلب قائمة بجميع التخصصات (مع تقسيم الصفحات)
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllSpecialties()
    {
        return Specialty::paginate(10);
    }

    /**
     * ➕ إنشاء تخصص جديد مع ترجمة الاسم
     *
     * @param array $data
     * @return Specialty
     */
    public function create(array $data)
    {
        $specialty = new Specialty();

        $specialty->setTranslations('name', [
            'en' => $data['name_en'],
            'ar' => $data['name_ar'],
        ]);

        $specialty->save();

        return $specialty;
    }

    /**
     * 🔍 البحث عن تخصص حسب المعرف (استخدام داخلي)
     *
     * @param int $id
     * @return Specialty
     */
    public function find($id)
    {
        return $this->getById($id);
    }

    /**
     * ✏️ تحديث بيانات تخصص موجود
     *
     * @param array $data
     * @param int $id
     * @return Specialty
     */
    public function update($data, $id)
    {
        $specialty = $this->getById($id);

        $specialty->setTranslations('name', [
            'en' => $data['name_en'],
            'ar' => $data['name_ar'],
        ]);

        $specialty->save();

        return $specialty;
    }

    /**
     * 🗑️ حذف تخصص حسب المعرف
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        $this->getById($id)->delete();
    }
}

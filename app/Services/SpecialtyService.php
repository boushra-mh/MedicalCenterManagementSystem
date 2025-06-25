<?php

namespace App\Services;

use App\Models\Specialty;

class SpecialtyService
{
    public function getById($id)
    {
        $specialty= Specialty::findOrFail($id);
        return $specialty;
    }
    public function getAllSpecialties()
    {
        $specialties= Specialty::paginate(10);
        return $specialties;


    }
    public function create(array $data)
    {
        $specialty= new Specialty();
       
        $specialty->setTranslations('name', [
            'en' => $data['name_en'],
            'ar' => $data['name_ar']
        ]);
        $specialty->save();

        return $specialty ;



    }
    public function find($id)
    {
        return $this->getById($id);
    }
   
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
    public function delete($id)
    {
        $this->getById($id)->delete();


    }

}

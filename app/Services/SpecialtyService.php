<?php

namespace App\Services;

use App\Models\Specialty;
use Illuminate\Queue\Middleware\ThrottlesExceptions;

class SpecialtyService
{
    public function getById($id)
    {
       return Specialty::findOrFail($id);
       
    }
    public function getAllSpecialties()
    {
          return Specialty::paginate(10);
       


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

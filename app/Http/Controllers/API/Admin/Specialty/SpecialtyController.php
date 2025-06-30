<?php

namespace App\Http\Controllers\API\Admin\Specialty;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\Specialty\SpecialtyStoreRequest;
use App\Http\Resources\API\Admin\Specialty\SpecialtyResource;

use App\Http\Resources\API\Doctor\DoctorResource;
use App\Models\Specialty;
use App\Services\SpecialtyService;
use App\Traits\ResponceTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    use ResponceTrait;
    protected $specialtyService;
    public function __construct(SpecialtyService $specialtyService)
    {
        $this->specialtyService = $specialtyService;
    }
    public function index()

    {
        $specialties = $this->specialtyService->getAllSpecialties();
        return $this->sendResponce(SpecialtyResource::collection($specialties) ,
        "Speciality_retrieved_successfully",
        200,
        true);

    }
    public function store(SpecialtyStoreRequest $request)
    {
        $specialty = $this->specialtyService->create($request->validated());
        return $this->sendResponce(SpecialtyResource::make($specialty) ,"Speciality_Stored_Succesfully");

    }
    public function show($id)
    {
         $specialty= $this->specialtyService->find($id);
         return $this->sendResponce(SpecialtyResource::make($specialty) ,"Speciality_retrieved_Succesfully");
    }

    public function update(SpecialtyStoreRequest $request, $id)

    {
        $specialty = $this->specialtyService->update($request->validated(),$id);
        return $this->sendResponce(SpecialtyResource::make($specialty)
         ,"Speciality_updated_Succesfully");
    }
    public function destroy($id)
    {
         $this->specialtyService->delete($id);
        return $this->sendResponce(null,
        "Speciality_deleted_Succesfully");
}
public function doctors($id)
{
      
    $specialty = Specialty::with('doctors')->findOrFail($id);

    return $this->sendResponce(DoctorResource::collection($specialty->doctors) ,'Doctors_in_this_specialty');
}

}

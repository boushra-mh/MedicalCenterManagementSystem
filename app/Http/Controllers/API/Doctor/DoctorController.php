<?php

namespace App\Http\Controllers\API\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Doctor\DoctorRequest;
use App\Http\Resources\API\Doctor\DoctorResource;
use App\Services\DoctorService;
use App\Traits\ResponceTrait;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    use ResponceTrait;
    protected $doctorService;

    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }
    /**
     * Display a listing of the resource.
     */


     public function index()
    {
        $doctors = $this->doctorService->getAllDoctors();
        return $this->sendResponce(DoctorResource::collection($doctors),'Doctors_retrieved_successfully');
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorRequest $request)
    {
        $doctor= $this->doctorService->create($request->validated());
        return $this->sendResponce(new DoctorResource($doctor),'Doctor_stored_successfully');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $doctor= $this->doctorService->find($id);
         return $this->sendResponce(new DoctorResource($doctor),'Doctor_retrived_successfully');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DoctorRequest $request, string $id)
    {
        $doctor= $this->doctorService->update($request->validated(),$id);
        return $this->sendResponce(new DoctorResource($doctor),'Doctor_updated_successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor= $this->doctorService->delete($id);
        return $this->sendResponce(null,'Doctor_deleted_successfully');
    }
}

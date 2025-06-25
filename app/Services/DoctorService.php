<?php

namespace App\Services;

use App\Models\Doctor;

class DoctorService
{
    public function getById($id)
    {
        return Doctor::where("id", $id)->first();
    }
    public function getAllDoctors()
    {
        $doctors = Doctor::all();
        return $doctors;
    }
    public function create(array $data)
    {
     $doctor = Doctor::create([
    'name' => $data['name'],
    'email' => $data['email'],
    'password' => bcrypt($data['password']),
]);

    if (!empty($data['specialties'])) {
            $doctor->specialties()->sync($data['specialties']);
        }
        return $doctor;
        
    }
    public function find($id)
    {
        return $this->getById($id);
    }
    public function update(array $data, $id)
    {
        $doctor = $this->getById($id);
        $doctor->update($data);
         if (isset($data['specialties'])) {
            $doctor->specialties()->sync($data['specialties']);
        }
        return $doctor;
    }
    public function delete($id)
    {
        $this->getById($id)->delete();

        return true;
    }
}


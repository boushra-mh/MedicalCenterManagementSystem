<?php
namespace App\Http\Controllers\WEB\Admin\Specialty;

use App\Http\Controllers\Controller;
use App\Services\SpecialtyService;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    protected $specialtyService;

    public function __construct(SpecialtyService $specialtyService)
    {
        $this->specialtyService = $specialtyService;
    }

    public function index()
    {
        $specialties = $this->specialtyService->getAllSpecialties();
        return view('specialty.index', compact('specialties'));
    }

    public function create()
    {
        return view('specialty.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
        ]);

        $this->specialtyService->create($data);
        return redirect()->route('admin.specialties.index')->with('success', 'Specialty created successfully.');
    }

    public function edit($id)
    {
        $specialty = $this->specialtyService->getById($id);
        return view('specialty.edit', compact('specialty'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
        ]);

        $this->specialtyService->update($data, $id);
        return redirect()->route('admin.specialties.index')->with('success', 'Specialty updated successfully.');
    }

    public function destroy($id)
    {
        $this->specialtyService->delete($id);
        return redirect()->route('admin.specialties.index')->with('success', 'Specialty deleted successfully.');
    }
}

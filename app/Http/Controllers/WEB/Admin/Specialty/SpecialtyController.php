<?php

namespace App\Http\Controllers\WEB\Admin\Specialty;

use App\Http\Controllers\Controller;
use App\Services\SpecialtyService;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public $apecialtyService;
    public function __construct(SpecialtyService $apecialtyService)
    {
        $this->apecialtyService = $apecialtyService;
    }
    public function index()
    {
        $specialties = $this->apecialtyService->getAllSpecialties();
        return view("specialty.index", compact("specialties"));

    }
}

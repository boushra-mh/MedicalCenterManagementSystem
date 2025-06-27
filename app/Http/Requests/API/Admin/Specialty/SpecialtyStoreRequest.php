<?php

namespace App\Http\Requests\API\Admin\Specialty;

use Illuminate\Foundation\Http\FormRequest;

class SpecialtyStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
public function rules(): array
{
    return [
<<<<<<< HEAD
        'name_en' => ['required', 'string','unique:specialties,name->en'],
        'name_ar' => ['required', 'string','unique:specialties,name->ar'],
=======
        'name_en' => ['required', 'string'],
        'name_ar' => ['required', 'string'],
>>>>>>> 3aa0de5 (SpecialtiesPanel)
    ];
}

}

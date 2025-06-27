<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Specialty extends Model
{
    use HasTranslations;
    protected $fillable=['name'];
     public  $translatable = ['name'];

     public function doctors()
     {
<<<<<<< HEAD

        return $this->belongsToMany(Doctor::class);

=======
        return $this->belongsToMany(Doctor::class);
>>>>>>> 3aa0de5 (SpecialtiesPanel)
     }
}

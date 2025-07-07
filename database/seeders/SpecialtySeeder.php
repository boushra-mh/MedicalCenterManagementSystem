<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    public function run(): void
    {
        $specialties = [
            ['en' => 'Cardiology', 'ar' => 'أمراض القلب'],
            ['en' => 'Dermatology', 'ar' => 'الأمراض الجلدية'],
            ['en' => 'Neurology', 'ar' => 'طب الأعصاب'],
            ['en' => 'Pediatrics', 'ar' => 'طب الأطفال'],
            ['en' => 'Orthopedics', 'ar' => 'جراحة العظام'],
            ['en' => 'Ophthalmology', 'ar' => 'طب العيون'],
            ['en' => 'Psychiatry', 'ar' => 'الطب النفسي'],
            ['en' => 'Gynecology', 'ar' => 'أمراض النساء'],
            ['en' => 'Oncology', 'ar' => 'طب الأورام'],
            ['en' => 'Dentistry', 'ar' => 'طب الأسنان'],
            ['en' => 'ENT', 'ar' => 'أنف أذن حنجرة'],
            ['en' => 'Internal Medicine', 'ar' => 'الأمراض الباطنية'],
        ];

        foreach ($specialties as $specialty) {
            Specialty::create([
                'name' => [
                    'en' => $specialty['en'],
                    'ar' => $specialty['ar'],
                ]
            ]);
        }
    }
}

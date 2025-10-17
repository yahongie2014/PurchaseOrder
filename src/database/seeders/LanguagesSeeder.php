<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesSeeder extends Seeder
{
    public function run()
    {
        $languages = [
            ['code' => 'en', 'name' => 'English', 'direction' => 'ltr', 'is_active' => true],
            ['code' => 'ar', 'name' => 'Arabic', 'direction' => 'rtl', 'is_active' => true],
            ['code' => 'fr', 'name' => 'French', 'direction' => 'ltr', 'is_active' => true],
            ['code' => 'es', 'name' => 'Spanish', 'direction' => 'ltr', 'is_active' => true],
            ['code' => 'he', 'name' => 'Hebrew', 'direction' => 'rtl', 'is_active' => true],
        ];

        foreach ($languages as $language) {
            DB::table('languages')->updateOrInsert(
                ['code' => $language['code']],
                $language
            );
        }
    }
}

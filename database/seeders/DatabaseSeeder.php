<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\family;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        family::create([
            'nik' => '1234567890123456',
            'mother_name' => 'Ibu Pertama',
            'date_of_birth_mom' => '1990-01-01',
            'place_of_birth_mom' => 'Tempat Lahir Ibu',
            'blood_type_mom' => 'A',
            'father_name' => 'Ayah Pertama',
            'date_of_birth_father' => '1980-01-01',
            'place_of_birth_father' => 'Tempat Lahir Ayah',
            'blood_type_father' => 'B',
            'many_kids' => 2,
            'address' => 'Alamat Keluarga',
            'city' => 'Kota',
            'subdistrict' => 'Kecamatan',
            'ward' => 'Kelurahan',
            'postal_code' => '12345',
            'phone_number' => '1234567890',
        ]);

        User::create([
            'username' => 'admin123',
            'password' => bcrypt('123123'),
            'family_id' => 1
        ]);
    }
}

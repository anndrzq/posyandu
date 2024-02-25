<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Child;
use App\Models\family;
use App\Models\Midwife;
use App\Models\Officer;
use App\Models\Vaccine;
use App\Models\Vitamin;
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

        Child::create([
            'nik' => '1234567890123457',
            'name' => 'Pertama',
            'place_of_birth_child' => 'Tempat Lahir Anak',
            'date_of_birth_child' => '2020-01-01',
            'gender' => 'L',
            'blood_type_child' => 'O',
            'family_id' => 1, // Sesuaikan dengan id keluarga yang telah dibuat
        ]);

        Child::create([
            'nik' => '1234567890123458',
            'name' => 'Kedua',
            'place_of_birth_child' => 'Tempat Lahir Anak',
            'date_of_birth_child' => '2022-01-01',
            'gender' => 'P',
            'blood_type_child' => 'A',
            'family_id' => 1, // Sesuaikan dengan id keluarga yang telah dibuat
        ]);

        User::create([
            'username' => 'parent123',
            'password' => bcrypt('123123'),
            'family_id' => 1,
            'role' => 'parents'
        ]);

        User::create([
            'username' => 'admin123',
            'password' => bcrypt('123123'),
            'role' => 'admin'
        ]);


        Officer::create([
            'nik' => '1234567890123459',
            'nip' => '12345',
            'name' => 'Ketua Pertama',
            'place_of_birth' => 'Tempat Lahir Ketua',
            'date_of_birth' => '1985-01-01',
            'gender' => 'Laki-laki',
            'address' => 'Alamat Ketua',
            'position' => 'Ketua',
            'last_educations' => 'S1 Teknik Informatika',
            'phone_number' => '1234567891',
        ]);

        User::create([
            'username' => 'officer123',
            'password' => bcrypt('123123'),
            'officer_id' => 1,
            'role' => 'employee'
        ]);

        Midwife::create([
            'nik' => '1234567890123463',
            'nip' => '98765',
            'name' => 'Bidan Kedua',
            'place_of_birth' => 'Tempat Lahir Bidan',
            'date_of_birth' => '1987-06-25',
            'gender' => 'Perempuan',
            'address' => 'Alamat Bidan',
            'last_educations' => 'D3 Kebidanan',
            'phone_number' => '1234567895',
        ]);


        User::create([
            'username' => 'midwife123',
            'password' => bcrypt('123123'),
            'midwife_id' => 1,
            'role' => 'midwife'
        ]);

        Vaccine::create([
            'vaccine_name' => 'Vaksin B',
            'stock' => '80',
            'for_age_value' => 1,
            'for_age_operator' => '=',
            'for_age_unit' => 'tahun',
        ]);

        Vaccine::create([
            'vaccine_name' => 'Vaksin C',
            'stock' => '120',
            'for_age_value' => 2,
            'for_age_operator' => '<',
            'for_age_unit' => 'tahun',
        ]);

        Vitamin::create([
            'vitamins_name' => 'Merah',
            'stock' => '30',
        ]);

        Vitamin::create([
            'vitamins_name' => 'Biru',
            'stock' => '40',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LeadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('leads')->insert([
            [
                'name' => 'John',
                'phone_number' => '0126304471',
                'address' => 'Bandar Mahkota Cheras',
                'title' => 'Business lead',
                'email' => 'john@gmail.com',
                'faxNo' => '9876543213',
                'inv_address' => 'Jalan presint 7, Putrajaya',
                'company' => 'Sample Company 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Viki',
                'phone_number' => '0189204471',
                'address' => 'Bandar Sungai Cheras',
                'title' => 'Business lead',
                'email' => 'viki@gmail.com',
                'faxNo' => '9838643213',
                'inv_address' => 'Jalan presint 7, Putrajaya',
                'company' => 'Tech Solution',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Norman',
                'phone_number' => '0186712371',
                'address' => 'Mont Kiara',
                'title' => 'CTO',
                'email' => 'norman@gmail.com',
                'faxNo' => '9838643475',
                'inv_address' => 'Bandar Sunway',
                'company' => 'DoctorOnCall',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maran',
                'phone_number' => '0186759241',
                'address' => 'Petaling Jaya',
                'title' => 'CEO',
                'email' => 'maran@gmail.com',
                'faxNo' => '9838647875',
                'inv_address' => 'Bandar Sunway',
                'company' => 'TechOnCall',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Add more rows as needed
        ]);
    }
}

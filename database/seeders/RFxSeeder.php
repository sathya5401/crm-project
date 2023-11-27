<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RFxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rfqs')->insert([
            [
                'Company' => 'ABC Corporation',
                'Custom_Name' => 'Alice Smith',
                'Custom_Email' => 'alice@gmail.com',
                'Custom_Number' => '1234567890',
                'RFQ_number' => 'RFQ123',
                'RFQ_title' => 'Sample RFQ',
                'Due_date' => '2023-12-01',
                'Quota_mount' => 5000.00,
                'Status' => 'new',
                'user_id' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Company' => 'XYZ Ltd',
                'Custom_Name' => 'Bob Johnson',
                'Custom_Email' => 'bob@gmail.com',
                'Custom_Number' => '9876543210',
                'RFQ_number' => 'RFQ456',
                'RFQ_title' => 'Another RFQ',
                'Due_date' => '2023-12-15',
                'Quota_mount' => 8000.00,
                'Status' => 'new',
                'user_id' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Company' => 'DoctorOnCall',
                'Custom_Name' => 'Norman',
                'Custom_Email' => 'norman@gmail.com',
                'Custom_Number' => '9873453210',
                'RFQ_number' => 'RFQ442443',
                'RFQ_title' => 'Proposal for server maintenance',
                'Due_date' => '2023-12-15',
                'Quota_mount' => 8000.00,
                'Status' => 'new',
                'user_id' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Company' => 'TechOnCall',
                'Custom_Name' => 'Maran',
                'Custom_Email' => 'maran@gmail.com',
                'Custom_Number' => '98734534763',
                'RFQ_number' => 'RFQ53942443',
                'RFQ_title' => 'Proposal for server maintenance',
                'Due_date' => '2023-12-15',
                'Quota_mount' => 6000.00,
                'Status' => 'new',
                'user_id' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Company' => 'Zeta Integration',
                'Custom_Name' => 'Fitri Ramli',
                'Custom_Email' => 'fitri@gmail.com',
                'Custom_Number' => '012334763',
                'RFQ_number' => 'RFQ5530443',
                'RFQ_title' => 'Proposal for cloud infra',
                'Due_date' => '2023-12-10',
                'Quota_mount' => 7000.00,
                'Status' => 'new',
                'user_id' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Company' => 'Meta',
                'Custom_Name' => 'Zack',
                'Custom_Email' => 'zack@gmail.com',
                'Custom_Number' => '0123340573',
                'RFQ_number' => 'RFQ5510443',
                'RFQ_title' => 'Build an mobile app',
                'Due_date' => '2023-12-10',
                'Quota_mount' => 10000.00,
                'Status' => 'new',
                'user_id' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Company' => 'X',
                'Custom_Name' => 'Elon',
                'Custom_Email' => 'elon@gmail.com',
                'Custom_Number' => '01893340573',
                'RFQ_number' => 'RFQ9382443',
                'RFQ_title' => 'Proposal for Cybersecurity system',
                'Due_date' => '2023-12-2',
                'Quota_mount' => 9000.00,
                'Status' => 'new',
                'user_id' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Add more rows as needed
        ]);
    }
}

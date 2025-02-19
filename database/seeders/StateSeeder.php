<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            ['name' => 'Andhra Pradesh', 'code' => '37'],
            ['name' => 'Arunachal Pradesh', 'code' => '12'],
            ['name' => 'Assam', 'code' => '18'],
            ['name' => 'Bihar', 'code' => '10'],
            ['name' => 'Chhattisgarh', 'code' => '22'],
            ['name' => 'Goa', 'code' => '30'],
            ['name' => 'Gujarat', 'code' => '24'],
            ['name' => 'Haryana', 'code' => '06'],
            ['name' => 'Himachal Pradesh', 'code' => '02'],
            ['name' => 'Jharkhand', 'code' => '20'],
            ['name' => 'Karnataka', 'code' => '29'],
            ['name' => 'Kerala', 'code' => '32'],
            ['name' => 'Madhya Pradesh', 'code' => '23'],
            ['name' => 'Maharashtra', 'code' => '27'],
            ['name' => 'Manipur', 'code' => '14'],
            ['name' => 'Meghalaya', 'code' => '17'],
            ['name' => 'Mizoram', 'code' => '15'],
            ['name' => 'Nagaland', 'code' => '13'],
            ['name' => 'Odisha', 'code' => '21'],
            ['name' => 'Punjab', 'code' => '03'],
            ['name' => 'Rajasthan', 'code' => '08'],
            ['name' => 'Sikkim', 'code' => '11'],
            ['name' => 'Tamil Nadu', 'code' => '33'],
            ['name' => 'Telangana', 'code' => '36'],
            ['name' => 'Tripura', 'code' => '16'],
            ['name' => 'Uttar Pradesh', 'code' => '09'],
            ['name' => 'Uttarakhand', 'code' => '05'],
            ['name' => 'West Bengal', 'code' => '19'],
            ['name' => 'Andaman and Nicobar Islands', 'code' => '92'],
            ['name' => 'Chandigarh', 'code' => '04'],
            ['name' => 'Dadra and Nagar Haveli and Daman and Diu', 'code' => '26'],
            ['name' => 'Delhi', 'code' => '07'],
            ['name' => 'Jammu and Kashmir', 'code' => '33'],
            ['name' => 'Ladakh', 'code' => '34'],
            ['name' => 'Lakshadweep', 'code' => '31'],
            ['name' => 'Puducherry', 'code' => '34'],
        ];

        DB::table('states')->insert($states);
    }
}

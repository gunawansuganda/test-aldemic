<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponsTableSeeder extends Seeder
{
    public function run()
    {
        Coupon::create([
            'code' => 'FA111',
            'type' => 'percent',
            'percent_off' => 10,
        ]);

        Coupon::create([
            'code' => 'FA222',
            'type' => 'fixed',
            'value' => 50000,
        ]);
		
        Coupon::create([
            'code' => 'FA333',
            'type' => 'percent',
            'percent_off' => 6,
        ]);
		
        Coupon::create([
            'code' => 'FA444',
            'type' => 'percent',
            'percent_off' => 5,
        ]);		
		
    }
	
}

<?php

namespace Database\Seeders;

use App\Models\Offer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Offer::create([
            'price_befor_discount' => '10000',
            'discount_value' => '10',
            'price_after_discount' => '9000',
            'course_id' => '1',
            'created_by' => '1',
        ]);
    }
}

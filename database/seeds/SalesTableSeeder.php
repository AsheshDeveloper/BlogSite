<?php

use Illuminate\Database\Seeder;
use App\Sale;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create a seed for sales entities
        Sale::create([
            'customer_name' => 'Shyam Bahadur',
            'product_name' => 'Second Sales',
            'product_quantity' => 100
        ]);
    }
}

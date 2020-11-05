<?php

use Illuminate\Database\Seeder;
use App\Purchase;

class PurchasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create a seed for purchase entities
        Purchase::create([
            'supplier_name' => 'Hari Bahadur',
            'purchase_price' => 50000,
            'purchase_quantity' => 50,
            'product_name' => 'Second Purchase'
        ]);
    }
}

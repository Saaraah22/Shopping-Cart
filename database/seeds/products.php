<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class products extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = array("Yakult", "Energy Drink", "Softdrinks", "Water", "Milk", "Juice");

        for ($i=0; $i < 6; $i++){
        	DB::table('products')->insert([
        		'name'=> $products[$i],
                'path'=> "../img/yakult.jpg",
        		'description'=> "Prebiotic Drink",
        		'category_id'=> "1",
        		'price'=> rand(1,50).".00",
        		'stocks'=> rand(5, 10),
        		'barcode'=> "Drinks".str_random(5),
        		'created_at'=>Carbon::now()
        	]);
        	echo $i+1;
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
require_once 'vendor/autoload.php';
use Illuminate\Support\Str;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$int= mt_rand(1262055681,1262055681);
    	$date = date("Y-m-d H:i:s",$int);
		// $faker = Faker\Factory::create();
    	for ($i = 0; $i < 100; $i++) {
	        DB::table('products')->insert([
	            'name' => Str::random(10),
	            'detail' => Str::random(40),
	            'created_at' => $date,
	            'updated_at' => $date,
	        ]);
		}
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
require_once 'vendor/autoload.php';
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// $int= mt_rand(1262055681,1262055681);
    	// $date = date("Y-m-d H:i:s",$int);

		$faker = Faker::create();
		$gender = $faker->randomElement(['male', 'female']);

    	for ($i = 0; $i < 100; $i++) {
	        DB::table('products')->insert([
	            'name' => $faker->name($gender),
	            'detail' => $faker->text,
	            'created_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
	            'updated_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
	        ]);
		}
    }
}

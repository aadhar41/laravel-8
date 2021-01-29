<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lead;
use Illuminate\Support\Facades\DB;
require_once 'vendor/autoload.php';
use Illuminate\Support\Str;

class LeadSeeder extends Seeder
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
	        DB::table('leads')->insert([
	            'name' => Str::random(10),
	            'description' => Str::random(40),
	            'created_at' => $date,
	            'updated_at' => $date,
	        ]);
		}
    }
}

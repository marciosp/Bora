<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\CompanyHasPlan;

class CompanyHasPlanTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		CompanyHasPlan::create([
			'id_companies' => 1, 
			'id_plans' => 1]);
	}

}

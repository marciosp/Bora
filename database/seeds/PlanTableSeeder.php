<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Plan;

class PlanTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		Plan::create([
			'name' => 'Gratuito', 
			'quantity_oportunities' => 1, 
			'price' => 0.0]);
		Plan::create([
			'name' => 'Básico', 
			'quantity_oportunities' => 10, 
			'price' => 99.0]);
		Plan::create([
			'name' => 'Premium', 
			'quantity_oportunities' => 50, 
			'price' => 149.0]);
	}

}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Oportunity;

class OportunityTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		Oportunity::create([
			'id_users' => 1, 
			'id_companies' => 1, 
			'title' => 'Web Developer', 
			'salary' => 5000.00, 
			'period_salary' => 'mês', 
			'description' => 'Desenvolver tudo que precisar e for pedido', 
			'begins' => '2015-05-11', 
			'ends' => '2015-05-29']);
	}

}

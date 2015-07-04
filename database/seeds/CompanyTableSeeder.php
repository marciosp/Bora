<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class CompanyTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		Company::create([
			'name' => 'Video Jobs', 
			'id_company_types' => 5, 
			'cnpj' => '01123456000145', 
			'id_line_business' => 1, 
			'number_employees' => 3, 
			'approved_contract' => 1, 
			'permalink' => 'video-jobs']);
	}

}

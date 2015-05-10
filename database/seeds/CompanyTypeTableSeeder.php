<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\CompanyType;

class CompanyTypeTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		CompanyType::create(['type' => 'Industria']);
		CompanyType::create(['type' => 'Distribuidor']);
		CompanyType::create(['type' => 'Comércio']);
		CompanyType::create(['type' => 'Varejo']);
		CompanyType::create(['type' => 'Outros']);
	}

}

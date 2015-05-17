<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UserTableSeeder');
		$this->call('CompanyTypeTableSeeder');
		$this->call('LineBusinessTableSeeder');
		$this->call('PlanTableSeeder');
		$this->call('CompanyTableSeeder');
		$this->call('CompanyHasPlanTableSeeder');
		$this->call('OportunityTableSeeder');
		$this->call('QuestionTableSeeder');
		$this->call('PermissionTableSeeder');
		$this->call('AclTableSeeder');
	}

}

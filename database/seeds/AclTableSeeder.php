<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Acl;

class AclTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		Acl::create(['id_companies' => 1, 'id_users' => 1, 'id_permissions' => 1]);
		Acl::create(['id_companies' => 1, 'id_users' => 2, 'id_permissions' => 2]);
		Acl::create(['id_companies' => 1, 'id_users' => 3, 'id_permissions' => 3]);
	}

}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class PermissionTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		Permission::create(['role' => 'Root']);
		Permission::create(['role' => 'Administrador']);
		Permission::create(['role' => 'Usuário']);
	}

}

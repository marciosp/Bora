<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('acl', function(Blueprint $table)
		{
			$table->increments('id_acl')->unsigned();
            $table->integer('id_companies')->unsigned();
            $table->integer('id_users')->unsigned();
            $table->integer('id_permissions')->unsigned();
			$table->foreign('id_companies')->references('id_companies')->on('companies');
			$table->foreign('id_users')->references('id_users')->on('users');
			$table->foreign('id_permissions')->references('id_permissions')->on('permissions');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('acl');
	}

}

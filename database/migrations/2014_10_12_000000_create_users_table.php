<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id_users');
			$table->string('email')->unique();
			$table->text('password')->nullable()->default(NULL);
			$table->string('name');
			$table->string('gender', 1)->nullable()->default('');
            $table->string('cpf', 11)->nullable()->default('');
            $table->date('birthday')->nullable()->default(NULL);
            $table->string('permalink')->unique();
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}

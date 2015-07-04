<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('images', function(Blueprint $table)
		{
			$table->increments('id_images');
			$table->string('image');
			$table->integer('id_users')->unsigned()->nullable()->default(NULL);
			$table->integer('id_companies')->unsigned()->nullable()->default(NULL);
			$table->string('main',1)->default(0);
            $table->timestamps();
            $table->softDeletes();
			$table->foreign('id_users')->references('id_users')->on('users');
			$table->foreign('id_companies')->references('id_companies')->on('companies');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('images');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesHasPlansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies_has_plans', function(Blueprint $table)
		{
			$table->increments('id_companies_has_plans');
            $table->integer('id_companies')->unsigned();
            $table->integer('id_plans')->unsigned();
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('id_companies')->references('id_companies')->on('companies');
			$table->foreign('id_plans')->references('id_plans')->on('plans');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('companies_has_plans');
	}

}

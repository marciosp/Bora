<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function(Blueprint $table)
		{
			$table->increments('id_companies');
			$table->string('name');
            $table->integer('id_company_types')->unsigned();
            $table->string('cnpj', 14)->nullable()->default('');
            $table->integer('id_line_business')->unsigned();
            $table->integer('number_employees')->unsigned();
            $table->enum('approved_contract', [0, 1]);
            $table->string('permalink')->unique();
			$table->timestamps();
			$table->softDeletes();
			$table->foreign('id_company_types')->references('id_company_types')->on('company_types');
			$table->foreign('id_line_business')->references('id_line_business')->on('line_business');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('companies');
	}

}

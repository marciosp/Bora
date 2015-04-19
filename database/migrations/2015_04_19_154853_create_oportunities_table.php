<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOportunitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('oportunities', function(Blueprint $table)
		{
			$table->increments('id_oportunities');
            $table->integer('id_users')->unsigned();
            $table->integer('id_companies')->unsigned();
			$table->string('title');
			$table->decimal('salary', 9, 2);
			$table->enum('period_salary', ['hora', 'dia', 'semana', 'mês', 'ano']);
			$table->text('description');
			$table->timestamps();
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
		Schema::drop('oportunities');
	}

}

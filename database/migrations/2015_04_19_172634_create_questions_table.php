<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions', function(Blueprint $table)
		{
			$table->increments('id_questions');
    		$table->integer('id_oportunities')->unsigned();
    		$table->string('question');
    		$table->time('think');
    		$table->time('answer');
    		$table->integer('quantity_answers')->default(0);
            $table->timestamps();
    		$table->softDeletes();
			$table->foreign('id_oportunities')->references('id_oportunities')->on('oportunities');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('questions');
	}

}

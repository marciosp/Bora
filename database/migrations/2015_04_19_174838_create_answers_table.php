<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('answers', function(Blueprint $table)
		{
			$table->increments('id_answers');
    		$table->integer('id_questions')->unsigned();
    		$table->integer('id_users')->unsigned();
    		$table->string('answer');
			$table->decimal('grade',9,2);
            $table->timestamps();
    		$table->softDeletes();
			$table->foreign('id_questions')->references('id_questions')->on('questions');
			$table->foreign('id_users')->references('id_users')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('answers');
	}

}

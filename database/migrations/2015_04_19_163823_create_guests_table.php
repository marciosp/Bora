<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('guests', function(Blueprint $table)
		{
			$table->increments('id_guests');
            $table->integer('id_oportunities')->unsigned();
            $table->integer('id_users')->unsigned();
            $table->decimal('grade');
            $table->enum('accepted', [0, 1]);
      		$table->datetime('answered_invite');
            $table->enum('status_oportunity', ['pendente', 'aprovado', 'reprovado']);
            $table->datetime('cancel_invite');
			$table->timestamps();
			$table->foreign('id_oportunities')->references('id_oportunities')->on('oportunities');
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
		Schema::drop('guests');
	}

}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		User::create([
			'name' => 'Daniel Satiro', 
			'email' => 'danielsatiro2003@yahoo.com.br', 
			'gender' => 'M', 
			'cpf' =>'12345678901', 
			'birthday' => '1987-02-12', 
			'password' => '$2y$10$rhnCD6Pc./qhHqnGdLr.qeCVttT6ALSNTN.4wL8sL7rUtboy6Farq']);
		User::create([
			'name' => 'Alexandre Gomes', 
			'email' => 'alexandre@videojobs.com.br', 
			'gender' => 'M', 
			'cpf' =>'01234567890', 
			'birthday' => '1980-03-26', 
			'password' => '$2y$10$rhnCD6Pc./qhHqnGdLr.qeCVttT6ALSNTN.4wL8sL7rUtboy6Farq']);
		User::create([
			'name' => 'Clayton da Costa', 
			'email' => 'claytoncm@gmail.com', 
			'gender' => 'M', 
			'cpf' =>'90123456789', 
			'birthday' => '1985-02-08', 
			'password' => '$2y$10$rhnCD6Pc./qhHqnGdLr.qeCVttT6ALSNTN.4wL8sL7rUtboy6Farq']);
	}

}

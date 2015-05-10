<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\LineBusiness;

class LineBusinessTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		LineBusiness::create(['name' => 'Tecnologia']);
		LineBusiness::create(['name' => 'Recrutamento e seleção']);
		LineBusiness::create(['name' => 'Telecomunicação']);
		LineBusiness::create(['name' => 'Cosméticos']);
		LineBusiness::create(['name' => 'Energia']);
		LineBusiness::create(['name' => 'Educação']);
		LineBusiness::create(['name' => 'Farmacêutica']);
		LineBusiness::create(['name' => 'Veterinária']);
		LineBusiness::create(['name' => 'Governo']);
		LineBusiness::create(['name' => 'Outros']);
	}

}

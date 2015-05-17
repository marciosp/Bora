<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class QuestionTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		Question::create([
			'id_oportunities' => 1,
			'question' => 'Fale um pouco sobre suas expêriencias profissionais.',
			'think' => '00:00:30',
			'answer' => '00:01:00',
			'quantity_answers' => 0]);
		Question::create([
			'id_oportunities' => 1,
			'question' => 'Quais são seus objetivos a curto prazo? E a longo prazo?',
			'think' => '00:00:30',
			'answer' => '00:01:00',
			'quantity_answers' => 0]);
		Question::create([
			'id_oportunities' => 1,
			'question' => 'O que procura num emprego?',
			'think' => '00:00:30',
			'answer' => '00:01:00',
			'quantity_answers' => 0]);
		Question::create([
			'id_oportunities' => 1,
			'question' => 'Dê-nos um motivo para o escolhermos em vez dos outros candidatos.',
			'think' => '00:00:45',
			'answer' => '00:01:30',
			'quantity_answers' => 0]);
		Question::create([
			'id_oportunities' => 1,
			'question' => 'Que avaliação faz da sua última (ou atual) experiência profissional?',
			'think' => '00:00:30',
			'answer' => '00:01:00',
			'quantity_answers' => 0]);
	}

}

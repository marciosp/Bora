<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {

	protected $table = 'questions';
	protected $primaryKey = 'id_questions';
	protected $fillable = ['id_oportunities', 'question', 'think', 'answer', 'quantity_answers'];
	protected $hidden = ['deleted_at', 'updated_at', 'created_at'];
	protected $softDelete = true;
	public $timestamps = true;
}

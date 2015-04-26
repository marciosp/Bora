<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model {

	protected $table = 'answers';
	protected $primaryKey = 'id_answers';
	protected $fillable = ['id_questions', 'id_users', 'think', 'answer'];
	protected $hidden = ['deleted_at', 'updated_at', 'created_at'];
	protected $softDelete = true;
	public $timestamps = true;
}

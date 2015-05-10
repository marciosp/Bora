<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model {

	protected $table = 'answers';
	protected $primaryKey = 'id_answers';
	protected $fillable = ['id_questions', 'id_users', 'think', 'answer'];
	protected $hidden = ['deleted_at', 'updated_at', 'created_at'];
	protected $softDelete = true;
	public $timestamps = true;

	public function question(){
		return $this->belongsTo('App\Models\Question', 'id_questions', 'id_questions');
	}

	public function user(){
		return $this->hasOne('App\Models\User', 'id_users', 'id_users');
	}
}

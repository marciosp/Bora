<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Oportunity extends Model {

	protected $table = 'oportunities';
	protected $primaryKey = 'id_oportunities';
	protected $fillable = ['id_users', 'id_companies', 'title', 'salary', 'period_salary', 'description', 'begins', 'ends'];
	protected $hidden = ['deleted_at', 'updated_at', 'created_at'];
	protected $softDelete = true;
	public $timestamps = true;
}

<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oportunity extends Model {

	protected $table = 'oportunities';
	protected $primaryKey = 'id_oportunities';
	protected $fillable = ['id_users', 'id_companies', 'salary', 'period_salary', 'description', 'begins', 'ends'];
	protected $hidden = ['deleted_at', 'updated_at', 'created_at'];
	protected $softDelete = true;
	public $timestamps = true;

	public function user(){
		return $this->hasOne('App\Models\User', 'id_users', 'id_users');
	}

	public function company(){
		return $this->hasOne('App\Models\Company', 'id_companies', 'id_companies');
	}

	public function guests(){
		return $this->hasMany('App\Models\Guest', 'id_oportunities', 'id_oportunities');
	}
}

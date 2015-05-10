<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyHasPlan extends Model {

	protected $table = 'companies_has_plans';
	protected $primaryKey = 'id_companies_has_plans';
	protected $fillable = ['id_companies', 'id_plans'];
	protected $hidden = ['deleted_at', 'updated_at', 'created_at'];
	protected $softDelete = true;
	public $timestamps = true;

	public function company(){
		return $this->belongsTo('App\Models\Company', 'id_companies', 'id_companies');
	}

	public function plan(){
		return $this->belongsTo('App\Models\Plan', 'id_plans', 'id_plans');
	}

}

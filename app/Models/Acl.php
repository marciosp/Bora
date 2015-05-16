<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acl extends Model {

	protected $table = 'acl';
	protected $primaryKey = 'id_acl';
	protected $fillable = ['id_companies', 'id_users', 'id_permissions'];
	protected $softDelete = false;
	public $timestamps = false;

	public function company(){
		return $this->hasOne('App\Models\Company', 'id_companies', 'id_companies');
	}

	public function user(){
		return $this->hasOne('App\Models\User', 'id_users', 'id_users');
	}

	public function permission(){
		return $this->hasOne('App\Models\Permission', 'id_permissions', 'id_permissions');
	}

}

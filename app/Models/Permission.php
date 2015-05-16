<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {

	protected $table = 'permissions';
	protected $primaryKey = 'id_permissions';
	protected $fillable = ['role'];
	protected $hidden = ['deleted_at', 'updated_at', 'created_at'];
	protected $softDelete = true;
	public $timestamps = true;

	public function acl(){
		return $this->hasMany('App\Models\Acl', 'id_permissions', 'id_permissions');
	}

}

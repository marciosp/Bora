<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acl extends Model {

	protected $table = 'acl';
	protected $primaryKey = 'id_acl';
	protected $fillable = ['id_companies', 'id_users', 'id_permissions'];
	protected $softDelete = false;
	public $timestamps = false;

}

<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model {

	protected $table = 'plans';
	protected $primaryKey = 'id_plans';
	protected $fillable = ['name', 'quantity_oportunities', 'price'];
	protected $hidden = ['deleted_at', 'updated_at', 'created_at'];
	protected $softDelete = true;
	public $timestamps = true;
}

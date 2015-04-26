<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model {

	protected $table = 'guests';
	protected $primaryKey = 'id_guests';
	protected $fillable = ['id_oportunities', 'id_users', 'grade', 'title', 'accepted', 'answered_invite', 'status_oportunity', 'cancel_invite'];
	protected $hidden = ['deleted_at', 'updated_at', 'created_at'];
	protected $softDelete = true;
	public $timestamps = true;
}

<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model {

	protected $table = 'guests';
	protected $primaryKey = 'id_guests';
	protected $fillable = ['id_oportunities', 'id_users', 'grade', 'title', 'accepted', 'answered_invite', 'status_oportunity', 'cancel_invite'];
	protected $hidden = ['deleted_at', 'updated_at', 'created_at'];
	protected $softDelete = true;
	public $timestamps = true;

	public function oportunity(){
		return $this->belongsTo('App\Models\Company', 'id_companies', 'id_companies');
	}

	public function user(){
		return $this->belongsTo('App\Models\User', 'id_users', 'id_users');
	}

	public function answers(){
		return $this->hasMany('App\Models\Answer', 'id_users', 'id_users');
	}

	public static function validateGuest($data, $type = 'C'){
		$rules = array(
		    'email' => 'required|email',
		    'name' => 'required|regex:/^([a-zà-úÀ-Ú\x20])+$/i'
		);

		if ($type == 'U') {
			$rules['id_users'] = 'required|integer|exists:guests,id_users';
			$rules['id_guests'] = 'required|integer|exists:guests,id_guests';
		}

		return \Validator::make($data, $rules);
	}
}

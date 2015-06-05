<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model {

	protected $table = 'guests';
	protected $primaryKey = 'id_guests';
	protected $fillable = ['id_oportunities', 'id_users', 'grade', 'accepted', 'answered_invite', 'status_oportunity', 'cancel_invite'];
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
		    'name' => 'required|regex:/^([a-zà-úÀ-Ú\x20])+$/i',
		    'id_oportunities' => 'required|integer|exists:oportunities,id_oportunities'
		);

		if ($type == 'U') {
			$rules['id_users'] = 'required|integer|exists:guests,id_users';
			$rules['id_guests'] = 'required|integer|exists:guests,id_guests';
		}

		return \Validator::make($data, $rules);
	}

	public static function newGuest($data){
		$validate = self::validateGuest($data, 'C');
 		
		//TODO validar Acl

	    if ($validate->fails()){
			$response['messages'] = $validate->messages()->toArray();
			$response['return_code'] = 406;
			return $response;
	    }

	    $verifyUser = Models\User::getUserByEmail($data['email']);
	    if($verifyUser){
	    	$data['id_users'] = $verifyUser->id_users;
	    }else{
	    	$newUser = Models\User::newUser($data);

	    	if(!isset($newUser['user'])){
	    		 return $newUser;
	    	}

	    	$data['id_users'] = $newUser['user']->id_users;
	    }

	    if(self::getGuestByOportunity($data['id_users'], $data['id_oportunities'])){
	    	$response['messages'] = 'Candidato já convidado para esta oportunidade';
			$response['return_code'] = 406;
			return $response;
	    }

	    $guest = new self;
	    $guest->fill($data);
	    $guest->save();

	    //TODO envio de email informativo do convite
	 
	    return ['guest' => $guest, 'return_code' => 201];
	}

	public static function getGuestByOportunity($idUser, $idOportunity){
		$invite = self::where('id_oportunities', $idOportunity)
			->where('id_users', $idUser)
			->first();
		return $invite;
	}
}

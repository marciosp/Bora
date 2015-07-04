<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oportunity extends Model {

	protected $table = 'oportunities';
	protected $primaryKey = 'id_oportunities';
	protected $fillable = ['id_users', 'id_companies', 'title', 'salary', 'period_salary', 'description', 'begins', 'ends'];
	protected $hidden = ['deleted_at', 'updated_at', 'created_at'];
	protected $softDelete = true;
	public $timestamps = true;

	public function user(){
		return $this->hasOne('App\Models\User', 'id_users', 'id_users');
	}

	public function company(){
		return $this->belongsTo('App\Models\Company', 'id_companies', 'id_companies');
	}

	public function guests(){
		return $this->hasMany('App\Models\Guest', 'id_oportunities', 'id_oportunities');
	}

	/*
	* Validate oportunity data
	*
	* @param array $data Data of oportunity
	* @param String $type Type of validation Create or Update
	*
	* @return Illuminate\Validation\Validator
	*/
	public static function validateOportunity($data, $type = 'C'){
		$rules = array(
		    'id_users' => 'required|integer|exists:users,id_users',
		    'id_companies' => 'required|integer|exists:companies,id_companies',
		    'title' => 'required|regex:/^([a-zà-úÀ-Ú\x20])+$/i',
		    'salary' => 'numeric',
		    'period_salary' => 'in:hora,dia,semana,mês,ano',
		    'description' => 'required',
		    'begins' => 'required|date_format:Y-d-m H:i:s',
		    'ends' => 'required|date_format:Y-d-m H:i:s'
		);

		if ($type == 'U') :
			$rules['id_oportunities'] = 'required|integer|exists:oportunities,id_oportunities';
		endif;

		return \Validator::make($data, $rules);
	}

	public static function newOportunity($data){
		$validate = self::validateOportunity($data, 'C');
 		
		//TODO validar Acl

	    if ($validate->fails()){
			$response['messages'] = $validate->messages()->toArray();
			$response['return_code'] = 406;
			return $response;
	    }

		$oportunity = new self;
	 	
	 	$oportunity->fill($data);
	    $oportunity->save();
	 
	    return ['oportunity' => $oportunity, 'return_code' => 201];
	}

	public static function updateOportunity($data){
		$validate = self::validateOportunity($data, 'U');
 		
		//TODO validar Acl
 
	    if ($validate->fails()){
			$response['messages'] = $validate->messages()->toArray();
			$response['return_code'] = 406;
			return $response;
	    }

	    $oportunity = self::find($data['id_oportunities']);
	    $oportunity->fill($data);
	    $oportunity->save();

	    return ['oportunity' => $oportunity, 'return_code' => 200];
	}

	public static function getOportunity($idOportunity){
		return self::find($idOportunity);
	}

	/*
	* Delete a Oportunity
	*
	* @param int $idOportunity ID of oportunity
	*
	* @return boolean
	*/
	public static function deleteCompany($idOportunity){
		$oportunity = self::find($idOportunity);
		return $oportunity->delete();
	}
}

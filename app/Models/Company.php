<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {

	protected $table = 'companies';
	protected $primaryKey = 'id_companies';
	protected $fillable = ['name', 'id_company_types', 'cnpj', 'id_line_business', 'number_employees', 'approved_contract', 'permalink', 'logo'];
	protected $hidden = ['deleted_at', 'updated_at', 'created_at'];
	protected $softDelete = true;
	public $timestamps = true;

	public function plan(){
		return $this->belongsToMany('App\Models\Plan', 'companies_has_plans', 'id_companies', 'id_plans');
	}

	public function acl(){
		return $this->hasMany('App\Models\Acl', 'id_companies', 'id_companies');
	}

	public function companyType(){
		return $this->hasOne('App\Models\CompanyType', 'id_company_types', 'id_company_types');
	}

	public function lineBusuness(){
		return $this->hasOne('App\Models\LineBusiness', 'id_line_business', 'id_line_business');
	}

	/*
	* Validate company data
	*
	* @param array $data Data of company
	* @param String $type Type of validation Create or Update
	*
	* @return Illuminate\Validation\Validator
	*/
	public static function validateCompany($data, $type = 'C'){
		$maxDate = date('Y-m-d');
		$minDate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y') - 100));

		$rules = array(
		    'name' => 'regex:/^([a-zà-úÀ-Ú\x20])+$/i',
		    'id_company_types' => 'required|integer|exists:company_types,id_company_types',
		    'cnpj' => 'cnpj|unique:companies',
		    'id_line_business' => 'required|integer|exists:line_business,id_line_business',
		    'approved_contract' => 'in:0,1',
		    'permalink' => 'required'
		);

		if ($type == 'U') :
			$rules['id_companies'] = 'required|integer|exists:companies,id_companies';
			$rules['cnpj'] = 'cnpj|unique:companies,cnpj,' . $data['id_companies'] . ',id_companies';
		endif;

		return \Validator::make($data, $rules);
	}

	/*
	* Create new company
	*
	* @param array $data Data of company
	*
	* @return company
	*/
	public static function newCompany($data){
		$validate = self::validateCompany($data, 'C');
 
	    if ($validate->fails()):
			$response['messages'] = $validate->messages()->toArray();
			$response['return_code'] = '406';
			return $response;
	    endif;

		$company = new self;
	 	
	 	$company->fill($data);
	    $company->save();
	 
	    return $company;
	}


	/*
	* Update a Company
	*
	* @param array $data Data of Company
	*
	* @return Company
	*/
	public static function updateCompany($data){
		$validate = self::validateCompany($data, 'U');
 
	    if ($validate->fails()):
			$response['messages'] = $validate->messages()->toArray();
			$response['return_code'] = '406';
			return $response;
	    endif;

	    $company = self::find($data['id_companies']);
	    $company->fill($data);
	    $company->save();

	    return $company;
	}


	/*
	* Get company
	*
	* @param int $idCompany ID of company
	*
	* @return Company
	*/
	public static function getCompany($idCompany){
		return self::find($idCompany);
	}


	/*
	* Delete a Company
	*
	* @param int $idCompany ID of company
	*
	* @return boolean
	*/
	public static function deleteCompany($idCompany){
		$company = self::find($idCompany);
		return $company->delete();
	}
}

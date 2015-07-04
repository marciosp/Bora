<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Image extends Model {

	protected $table = 'images';
	protected $primaryKey = 'id_images';
	protected $fillable = ['image', 'id_users', 'id_companies', 'main'];
	protected $hidden = ['deleted_at', 'updated_at', 'created_at'];
	protected $softDelete = true;
	public $timestamps = true;

	public function user(){
		return $this->belongsTo('App\Models\User', 'id_users', 'id_users');
	}

	public function company(){
		return $this->belongsTo('App\Models\Company', 'id_companies', 'id_companies');
	}

	/*
	* Validate image data
	*
	* @param array $data Data of image
	* @param String $type Type of validation Create or Update
	*
	* @return Illuminate\Validation\Validator
	*/
	public static function validateImage($data, $type = 'C'){

		$rules = array(
		    'id_users' => 'required|integer|exists:users,id_users',
		    'id_companies' => 'integer|exists:companies,id_companies'
		);

		if ($type == 'U') :
			$rules['id_images'] = 'required|integer|exists:images,id_images';
		endif;

		return \Validator::make($data, $rules);
	}

	public static function newImage($data){
    	$validate = self::validateImage($data, 'C');
 
	    if ($validate->fails()){
			$response['messages'] = $validate->messages()->toArray();
			$response['return_code'] = 406;
			return $response;
	    }

		if(empty($data['id_companies'])){
			DB::table('images')->where('id_users', $data['id_users'])->update(array('main' => 0));
		} else {
			//TODO validar Acl
			if ($data['main'] == 1) {
			  self::where('id_companies', $data['id_companies'])->where('main', 1)->delete();
			}
			unset($data['id_users']);
		}

		$image = new self;
		$image->fill($data);
		$image->save();

		return return ['id_images' => $image->id_images, 'return_code' => 201];
    }

}

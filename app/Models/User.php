<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	protected $primaryKey = 'id_users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'gender', 'password', 'salt'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'salt', 'remember_token'];

	/*
	* Validate user data
	*
	* @param array $data Data of user
	* @param String $type Type of validation Create or Update
	*
	* @return Illuminate\Validation\Validator
	*/
	public static function validateUser($data, $type = 'C'){
		$maxDate = date('Y-m-d');
		$minDate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y') - 100));

		$rules = array(
		    'email' => 'email|unique:users',
		    'password' => 'min:8|confirmed',
		    'name' => 'regex:/^([a-zà-úÀ-Ú\x20])+$/i',
		    'gender' => 'in:M,F',
		    'cpf' => 'size:11',
		    'birthday' => 'after:' . $minDate . '|before:' . $maxDate,
		    'landline' => 'min:10',
		    'cellphone' => 'min:10',
		);

		if ($type == 'U') :
			$rules['id_users'] = 'required|integer|exists:users,id_users';
			$rules['email'] = 'email|unique:users,email,' . $data['id_users'] . ',id_users';
		endif;

		return Validator::make($data, $rules);
	}

	public static function newUser($data){
		$validate = self::validateUser($data, 'C');
 
	    if ($validate->fails()):
			$response['messages'] = $validate->messages()->toArray();
			$response['return_code'] = '406';
			return $response;
	    endif;

		$user = new self;
	 
	    if (!empty($data['password'])):
	      $data['password'] = bcrypt($data['password']);
	    endif;
	 	
	 	$user->fill($data);
	    $user->save();
	 
	    return $user;
	}

}

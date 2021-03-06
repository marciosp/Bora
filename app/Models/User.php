<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Library\Permalink;

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
	protected $fillable = ['name', 'email', 'gender', 'cpf', 'birthday', 'permalink', 'password', 'salt'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['id_users', 'password', 'salt', 'remember_token'];

	public function acl(){
		return $this->hasMany('App\Models\Acl', 'id_users', 'id_users');
	}

	public function guest(){
		return $this->hasMany('App\Models\Guest', 'id_users', 'id_users');
	}

	public function image(){
		return $this->hasMany('App\Models\Image', 'id_users', 'id_users');
	}

	/*
	* Validate user data
	*
	* @param array $data Data of user
	* @param String $type Type of validation Create, Update or Invite
	*
	* @return Illuminate\Validation\Validator
	*/
	public static function validateUser($data, $type = 'C'){
		$maxDate = date('Y-m-d');
		$minDate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y') - 100));

		$rules = array(
		    'email' => 'required|email|unique:users',
		    'password' => 'required|min:8|confirmed',
		    'name' => 'required|regex:/^([a-zà-úÀ-Ú\x20])+$/i',
		    'gender' => 'in:M,F',
		    'cpf' => 'size:11',
		    'birthday' => 'after:' . $minDate . '|before:' . $maxDate,
		    'landline' => 'min:10',
		    'cellphone' => 'min:10',
		);

		if ($type == 'U') {
			$rules['id_users'] = 'required|integer|exists:users,id_users';
			$rules['email'] = 'email|unique:users,email,' . $data['id_users'] . ',id_users';
			$rules['password'] = 'min:8|confirmed';
		} elseif ($type == 'I') {
			unset($rules['password']);
		}

		return \Validator::make($data, $rules);
	}

	/*
	* Create new user
	*
	* @param array $data Data of user
	* @param string $type Type of validation
	*
	* @return User
	*/
	public static function newUser($data, $type = 'C'){
		$validate = self::validateUser($data, $type);
 
	    if ($validate->fails()){
			$response['messages'] = $validate->messages()->toArray();
			$response['return_code'] = 406;
			return $response;
	    }

	    $data['permalink'] = Permalink::make($data['name']);

		$user = new self;
	 
	    if (!empty($data['password'])):
	      $data['password'] = bcrypt($data['password']);
	    endif;
	 	
	 	$user->fill($data);
	    $user->save();
	    $user->token = \Crypt::encrypt(['id_users' => $user->id_users]);
	 	
	 	$response = ['user' => $user, 'return_code' => 201];
	    return $response;
	}


	/*
	* Update a user
	*
	* @param array $data Data of user
	*
	* @return User
	*/
	public static function updateUser($data){
		$validate = self::validateUser($data, 'U');
 
	    if ($validate->fails()){
			$response['messages'] = $validate->messages()->toArray();
			$response['return_code'] = 406;
			return $response;
	    }

	    $user = self::find($data['id_users']);
	    $user->fill($data);
	    $user->save();

	    $response = ['user' => $user, 'return_code' => 200];
	    return $response;
	}

	/*
	* Get user
	*
	* @param int $idUser ID of user
	*
	* @return User
	*/
	public static function getUser($idUser){
		return self::with(['image' => function($query){
			$query->where('main', 1);
		}])->find($idUser);
	}

	public static function getUserByEmail($email){
		return self::where('email', $email)
			->with(['image' => function($query){
			$query->where('main', 1);
		}])->first();
	}

	public static function getUserByPermalink($permalink){
		return self::where('permalink', $permalink)
			->with(['image' => function($query){
			$query->where('main', 1);
		}])->first();
	}

	/*
	* Delete a user
	*
	* @param int $idUser ID of user
	*
	* @return boolean
	*/
	public static function deleteUser($idUser){
		$user = self::find($idUser);
		return $user->delete();
	}

}

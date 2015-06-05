<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {

	protected $table = 'questions';
	protected $primaryKey = 'id_questions';
	protected $fillable = ['id_oportunities', 'question', 'think', 'answer', 'quantity_answers'];
	protected $hidden = ['deleted_at', 'updated_at', 'created_at'];
	protected $softDelete = true;
	public $timestamps = true;

	public function oportunity(){
		return $this->belongsTo('App\Models\Oportunity', 'id_oportunities', 'id_oportunities');
	}

	public function answers(){
		return $this->hasMany('App\Models\Answer', 'id_questions', 'id_questions');
	}

	/*
	* Validate question data
	*
	* @param array $data Data of question
	* @param String $type Type of validation Create or Update
	*
	* @return Illuminate\Validation\Validator
	*/
	public static function validateQuestion($data, $type = 'C'){

		$rules = array(
		    'id_oportunities' => 'required|integer|exists:oportunities,id_oportunities',
		    'question' => 'required',
		    'think' => 'required|date_format:H:i:s',
		    'answer' => 'required|date_format:H:i:s'
		);

		if ($type == 'U') :
			$rules['id_questions'] = 'required|integer|exists:questions,id_questions';
		endif;

		return \Validator::make($data, $rules);
	}

	/*
	* Create new question
	*
	* @param array $data Data of question
	*
	* @return question
	*/
	public static function newQuestion($data){
		$validate = self::validateQuestion($data, 'C');
 
	    if ($validate->fails()){
			$response['messages'] = $validate->messages()->toArray();
			$response['return_code'] = 406;
			return $response;
	    }

		$question = new self;
	 	
	 	$question->fill($data);
	    $question->save();
	 
	    return ['question' => $question, 'return_code' => 201];
	}


	/*
	* Update a Question
	*
	* @param array $data Data of Question
	*
	* @return Question
	*/
	public static function updateQuestion($data){
		$validate = self::validateQuestion($data, 'U');
 
	    if ($validate->fails()){
			$response['messages'] = $validate->messages()->toArray();
			$response['return_code'] = 406;
			return $response;
	    }

	    $question = self::find($data['id_companies']);
	    $question->fill($data);
	    $question->save();

	    return ['question' => $question, 'return_code' => 200];
	}


	/*
	* Get question
	*
	* @param int $idQuestion ID of question
	*
	* @return Question
	*/
	public static function getQuestion($idQuestion){
		return self::find($idQuestion);
	}


	/*
	* Delete a Question
	*
	* @param int $idQuestion ID of question
	*
	* @return boolean
	*/
	public static function deleteQuestion($idQuestion){
		$question = self::find($idQuestion);
		return $question->delete();
	}
}

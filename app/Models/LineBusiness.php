<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineBusiness extends Model {

	protected $table = 'line_business';
	protected $primaryKey = 'id_line_business';
	protected $fillable = ['name'];
	protected $softDelete = true;
	public $timestamps = true;

	public function company(){
		return $this->hasMany('App\Models\Company', 'id_line_business', 'id_line_business');
	}

}

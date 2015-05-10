<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class LineBusiness extends Model {

	protected $table = 'line_business';
	protected $primaryKey = 'id_linebusiness';
	protected $fillable = ['name'];
	protected $softDelete = true;
	public $timestamps = true;

}

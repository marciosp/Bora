<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {

	protected $table = 'companies';
	protected $primaryKey = 'id_companies';
	protected $fillable = ['name', 'id_company_types', 'cnpj', 'id_line_business', 'number_employees', 'approved_contract', 'permalink', 'logo'];
	protected $hidden = ['deleted_at', 'updated_at', 'created_at'];
	protected $softDelete = true;
	public $timestamps = true;
}

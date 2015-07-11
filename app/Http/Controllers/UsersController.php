<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models;
//use LucaDegasperi\OAuth2Server\Facades\AuthorizerFacade;
use Authorizer;

class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return \Response::json('Forbiden Access',403);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return \Response::json('Forbiden Access',403);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = \Input::all();
		$newUser = Models\User::newUser($data);
		return \Response::json($newUser, $newUser['return_code']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $permalink
	 * @return Response
	 */
	public function show($permalink)
	{
		$user = Models\User::getUserByPermalink($permalink);
		return \Response::json($user);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $permalink
	 * @return Response
	 */
	public function getUserData()
	{	
		$idUser = Authorizer::getResourceOwnerId();
		$user = Models\User::getUser($idUser);
		return \Response::json($user);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return \Response::json('Forbiden Access',403);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//verificar se o usuario alterante e o mesmo a ser alterado (token)
		if(Authorizer::getResourceOwnerId() != $id){
			return \Response::json(['messages' => 'Acesso Negado'], 401);
		}

		$data = \Input::all();
		$data['id_users'] = $id;
		$updateUser = Models\User::updateUser($data);
		return \Response::json($updateUser, $updateUser['return_code']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Authorizer::getResourceOwnerId() != $id){
			return \Response::json(['messages' => 'Acesso Negado'], 401);
		}

		return Response::json(Models\User::getuser($id));
	}

}

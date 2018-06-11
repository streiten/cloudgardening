<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('pages.register')
		->with('body_class','register')
		->with('title','Create account');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$input = Input::all();

		$rules = [
			'user' => 'required|email|unique:users',
			'password' => 'required|alpha_num|between:6,12|confirmed',
			'password_confirmation' => 'required|alpha_num|between:6,12'
		];

		$niceNames = array(
		    'user' => 'e-mail',
			'password' => 'password',
			'password_confirmation' => 'confirm password',
		);



		$validator = Validator::make($input,$rules);
		$validator->setAttributeNames($niceNames); 

		if(!$validator->fails()){

			$user = new User;
			$user->user = Input::get('user');
		    $user->password = Hash::make(Input::get('password'));
		    $user->save();

			foreach ($input as $key => $value) {
				$message .= $key . ':'. $value . "\n\n";
			}
			// mail($to,$subject,$message,$headers);

			return Redirect::to('login')
			->with('message', 'Thanks for registering!');
		}

		return Redirect::route('userCreate')
			->withErrors($validator->messages())
			->withInput();
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}

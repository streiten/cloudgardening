<?php

class PageController extends \BaseController {

	public function home()
	{

		$typer = Typer::orderByRaw("RAND()")
            ->where('featured','=',true)
            ->first();
		return Redirect::to($typer->slug);

	}

	public function login()
	{
		return View::make('pages.login')
		->with('body_class','login')
		->with('title','Login');
	}

	public function notfound()
	{
		return View::make('pages.notfound')
		->with('body_class','four-O-four')
		->with('title','Not Found!');
	}

}




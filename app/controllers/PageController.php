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
		->with('body_class','page login')
		->with('title','Login');
	}


    public function legal()
    {
        return View::make('pages.legal')
            ->with('body_class','page legal')
            ->with('title','Legal & Privacy');
    }


    public function notfound()
	{
		return View::make('pages.notfound')
		->with('body_class','page four-O-four')
		->with('title','Not Found!');
	}

}




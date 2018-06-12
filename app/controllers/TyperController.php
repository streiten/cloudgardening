<?php

require_once base_path('vendor/ShortURL/ShortURL.php');

class TyperController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$typers = Typer::orderBy('created_at','desc')->get();
		
		return View::make('pages.latest')
		->with(['typers'=> $typers])
		->with('title','Latest Typers')
		->with('body_class','page list_typers');
	}

	public function manage()
	{	

		// not logged in / no anonymous user cookie
		if (!Cookie::get('auhash') || !Auth::check() ) {
			$typerCollection['importTypers'] = null ;
			$typerCollection['typers']= null ;
		}

		// cookie user
		if (Cookie::get('auhash')) {

			$username = Cookie::get('auhash');
			$user = User::where('email','=',$username)->first();
			$uid = $user->id;
			$cookieTypers = Typer::where('uid','=',$uid)->orderBy('created_at','desc')->get();

			$typerCollection['typers'] = $cookieTypers ;
			$typerCollection['importTypers'] = null ;

		} 

		// logged in user
		if(Auth::check()) {
			
			$uid = Auth::user()->id;
			$typers = Typer::where('uid','=',$uid)->orderBy('created_at','desc')->get();

			if(Cookie::get('auhash')) {
				// move the cookie ones into their place
				$typerCollection['importTypers'] = $typerCollection['typers'];
			}

			$typerCollection['typers'] = $typers ;

		}

		return View::make('pages.manage')
			->with($typerCollection)
		// ->with('messages', $messages )
			->with('title','Manage Typers')
			->with('body_class','page typer-manage');
	}

	public function importCookieTypers () {

		if (Cookie::get('auhash')) {

			$username = Cookie::get('auhash');
			$user = User::where('email','=',$username)->first();
			
			// cookie uid
			$cuid = $user->id;

			// account uid
			$uid = Auth::user()->id;
						
			$cookieTypers = Typer::where('uid','=',$cuid)->orderBy('created_at','desc')->get();
			
			// update each of them to account uid
			foreach ($cookieTypers as $key => $value) {
				$value->uid = $uid;
				$value->save();
			}
		} 

		return Redirect::route('manage');
		//->with('messages', ['Done! Have fun!'] );
	}



    public function supermanage()
	{
		$uid = Auth::user()->id;
		
		if($uid == 1 ) {
			
			$typers = Typer::orderBy('created_at','desc')->get();
			
			return View::make('pages.supermanage')
			->with(['typers'=> $typers])
			->with('title','Manage Typers')
			->with('body_class','page typer-manage typer-supermanage');
		
		} else {
			
			return Redirect::route('login');

		}	 
	}

    /**
     *
     * Sets a typer as featured for display on homepage
     *
     * @param $id
     * @return Response
     */
    public function setFeatured($id)
    {
        $typer = Typer::find($id);
        $typer->featured = true;
        $typer->save();

        return Redirect::route('supermanage');

    }

    /**
     *
     * Unset a typer as featured for hiding on homepage
     *
     * @param $id
     * @return Response
     */
    public function unsetFeatured($id)
    {
        $typer = Typer::find($id);
        $typer->featured = false;
        $typer->save();

        return Redirect::route('supermanage');

    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$PageController = new PageController();
		
		return View::make('pages.typer')
		->with('body_class','page typer-create')
		->with('title','Typer')
		->with('typer',new Typer);
	}

	/**
	 * Store a newly created resource in storage.
	 *
     * TODO: preserve newlines
     *
	 * @return Response
	 */

	public function store()
	{
		$input = Input::all();

		$rules = [
			'typer' => 'required',
			'my_name'   => 'honeypot',
    	    'my_time'   => 'required|honeytime:2'
		];

    $messages = array(
        'required' => 'Yes. Silence is golden. But in this case not working...',
    );

		$validator = Validator::make($input,$rules,$messages);

		if(!$validator->fails()){

			// If registered and logged in user go for this one
			if(Auth::check()) {

				$input['uid'] = Auth::user()->id;

			// if anonymous user that already has a coookie (posted before)
			} else if (Cookie::get('auhash')) {
				
				$username = Cookie::get('auhash');
				$user = User::where('email','=',$username)->first();
				$input['uid'] = $user->id;

			} else {
				// lets get him a user and cookie
				$hash = Hash::make($input['typer']);
				
				$user = new User;
				$user->email = $hash;
				$user->save();

				$cookie = Cookie::queue('auhash', $hash , 2628000);
				$input['uid'] = $user->id;

			}

			$typer = Typer::Create($input);
			$slug = $typer->generateShortCode();
			$typer->save();

			return Redirect::to($slug);

		} else {

            return View::make('pages.typer')
                ->with('body_class','typer-create')
                ->with('title','Typer')
                ->with('typer',new Typer)
                ->withErrors($validator->messages());

        }

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  char  $slug
	 * @return Response
	 */
	public function show($slug)
	{
		$typer = new Typer;
		$typer = $typer->getTyperByURL($slug);

		if(sizeof($typer)>0) {
		
			$typer = $typer->typer;
			return View::make('pages.home')
			->with(['typer'=> $typer])
			->with('body_class','home');	
		
		} else {
		
			return Redirect::route('404');
		
		}

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return 'edit';	
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
		Typer::find($id)->delete();
		return Redirect::route('manage');	
	}


    /* TODO: Implemend Message/Worker Que, generate Versions for OG:Graph Tags and download on create - replace by paper.js for SVG export ? */
	public function shot($slug)
	{
		$browsershot = new Spatie\Browsershot\Browsershot();
	   	$result = $browsershot
	        ->setURL('http://localhost/typer/laravel/public/'. $slug )
	        ->setWidth('1920')
	        ->setHeight('1080')
	        ->save( $slug .'.png');

	       return Redirect::to('http://localhost/typer/laravel/public/'.$slug .'.png');
	}


}

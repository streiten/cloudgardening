<?php

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return View::make('password.remind')
            ->with('body_class','page password-reset');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
        $response = Password::remind(Input::only('email'));

		switch ($response)
		{
			case Password::INVALID_USER:
				return Redirect::back()
                    ->with('error', Lang::get($response))
                    ->with('body_class','password-reset');

			case Password::REMINDER_SENT:
				return Redirect::back()
                    ->with('success', Lang::get($response))
                    ->with('body_class','page password-reset');
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		// if token not valid redirect with message to reminder form
        $reminder = Reminder::where('token','=',$token)->first();

        if(is_null($reminder)) {

            return Redirect::to('password/reset')
                ->with('error', 'Token not valid. Please try again.')
                ->with('body_class','page password-reset');

        } else {

            return View::make('password.reset')
                ->with('token', $token)
                ->with('body_class','page password-reset');

        }

	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{


	    $credentials = Input::only('password', 'password_confirmation', 'token');

        // get the email for token
        $reminder = Reminder::where('token','=',Input::get('token'))->first();
        $credentials['email'] = $reminder->email;

        $response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);
			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::PASSWORD_RESET:
				return Redirect::to('login')
                    ->with('message','Password updated!');
		}
	}

}

<?php

class LoginController extends \BaseController
{

    public function showLogin()
    {
        return View::make('login');
    }

    public function doLogin()
    {
        if ((Input::has('benutzername') && Input::has('passwort'))) {
            if (
                Auth::attempt(
                    array(
                        'benutzername' => Input::get('benutzername'),
                        'password' => Input::get('passwort')
                    ),
                    true
                )
            ) {
                return Redirect::intended();
            } else {

            }
        }

        //Session::flash('messages', 'value');

        return Redirect::to('login');

    }

    public function doLogout()
    {
        Auth::logout(); // log the user out of our application
        return Redirect::to('/'); // redirect the user to the login screen
    }
}

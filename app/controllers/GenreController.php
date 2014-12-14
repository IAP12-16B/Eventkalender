<?php

use kije\Genre;

class GenreController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('admin.genre.index', array('genres' => Genre::all()));
	}



	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (Input::has('name')) {
            $genre = new Genre();
            $genre->name = Input::get('name');
            $genre->save();
        }

        return Redirect::route('admin.genre.index');
	}



	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$genre = Genre::find($id);

        if (!empty($genre)) {
            $genre->name = Input::get('name');
            $genre->save();
        }

        return Redirect::route('admin.genre.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $genre = Genre::find($id);

        if (!empty($genre)) {
            $genre->delete();
        }

        return Redirect::route('admin.genre.index');
	}


}

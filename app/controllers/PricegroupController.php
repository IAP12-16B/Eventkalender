<?php

use kije\Pricegroup;

class PricegroupController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('admin.pricegroup.index', array('pricegroups' => Pricegroup::all()));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        if (Input::has('name') && Input::has('preis')) {
            $pg = new Pricegroup();
            $pg->name = Input::get('name');
            $pg->preis = Input::get('preis');
            $pg->save();
        }

        return Redirect::route('admin.pricegroup.index');
	}




	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $pg = Pricegroup::find($id);

        if (!empty($pg) && Input::has('name') && Input::has('preis')) {
            $pg->name = Input::get('name');
            $pg->preis = Input::get('preis');
            $pg->save();
        }

        return Redirect::route('admin.pricegroup.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $pg = Pricegroup::find($id);

        if (!empty($pg)) {
            $pg->delete();
        }

        return Redirect::route('admin.pricegroup.index');
	}


}

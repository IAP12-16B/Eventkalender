<?php

use kije\Genre;
use kije\Show;

class ShowController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $shows = Show::isArchive(false)->chronologically();
        if (Input::has('genre')) {
            /** @var kije\Genre $genre */
            $genre = Genre::find(Input::get('genre'));
            $event_ids = array_keys($genre->events->lists('name', 'ID'));
            if (!empty($event_ids)) {
                $shows->whereIn('fk_Veranstaltung_ID', $event_ids);
            } else {
                $shows->where('ID',0); // do not show
            }
        }
        return View::make('index', array('shows' => $shows->paginate(10)));
    }

    public function archive()
    {

        $shows = Show::isArchive(true)->chronologically();
        if (Input::has('genre')) {
            /** @var kije\Genre $genre */
            $genre = Genre::find(Input::get('genre'));
            $event_ids = array_keys($genre->events->lists('name', 'ID'));
            if (!empty($event_ids)) {
                $shows->whereIn('fk_Veranstaltung_ID', $event_ids);
            } else {
                $shows->where('ID',0); // do not show
            }
        }
        return View::make('index', array('shows' => $shows->paginate(10)));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return View::make('detail', array('show' => Show::find($id))); // todo check if available
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


}

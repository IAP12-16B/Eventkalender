<?php


use Carbon\Carbon;
use kije\Event;
use kije\Link;
use kije\Pricegroup;
use kije\Show;

class EventController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

    }

    /**
     *
     * @return Response
     */
    public function archive()
    {
    }


    /**
     * kije\Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make(
            'admin.event.edit',
            array(
                'pricegroups' => Pricegroup::all(),
            )
        );
        /*$ev = new Event();
        $ev->name = '';
        $ev->beschreibung = '50';
        $ev->dauer = Carbon::create(null, null, null, 2);
        var_dump($ev);
        $genre =  Genre::create(array('name' => 'Test'));
        $ev = $genre->events()->save($ev);
        var_dump($ev);
        $genre->save();*/
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
        //
    }


    /**
     * kije\Show the form for editing the specified resource.
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

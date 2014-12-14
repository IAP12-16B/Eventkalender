<?php


use kije\Event;
use kije\Genre;
use kije\Link;
use kije\Pricegroup;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

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
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make(
            Input::all(),
            array(
                'name' => 'required',
                'beschreibung' => 'required',
                'dauer' => 'required',
                'fk_Genre_ID' => 'required|exists:' . Genre::getTableName() . ',ID'
            )
        );

        if ($validator->fails()) {

            dd($validator->messages()); // todo error message
            Notification::message($validator->messages());

            return Redirect::back()->withInput(Input::all());
        }


        $new_event = new Event(Input::only('name', 'beschreibung', 'dauer'));
        $new_event->dauer = Input::get('dauer');

        $new_event->genre()->associate(Genre::find(Input::get('fk_Genre_ID')));

        foreach (array('besetzung', 'bildbeschreibung') as $optional_field) {
            if (Input::has($optional_field)) {
                $new_event->$optional_field = Input::get($optional_field);
            }
        }

        if (Input::hasFile('bild') && Input::file('bild')->isValid()) {
            $file = Input::file('bild');
            $extension = strtolower($file->getClientOriginalExtension());

            if (!in_array($extension, array('png', 'jpg', 'jpeg', 'gif'))) {
                // todo error message
            } else {
                $upload_path = public_path() .
                               DIRECTORY_SEPARATOR .
                               'img' .
                               DIRECTORY_SEPARATOR .
                               'uploads' .
                               DIRECTORY_SEPARATOR;
                $new_file_name =
                    str_random(12) .
                    '.' .
                    $extension;

                try {
                    $file = $file->move($upload_path, $new_file_name);
                    $new_event->bild =
                        str_replace(public_path(), '', realpath($file->getPath() . '/' . $file->getBasename()));
                } catch (FileException $e) {
                    // todo error message
                }
            }
        }

        try {
            $new_event->save();
        } catch (Exception $e) {
            // todo error
        }

        /*if (Input::has('pricegroups')) {
            foreach(Input::get('pricegroups') as $pricegroup_id) {
                $pricegroup = Pricegroup::find($pricegroup_id);
                if (!empty($pricegroup) && !$pricegroup->isEmpty()) {
                    $new_event->pricegroups()->save($pricegroup);
                }
            }
        }*/

        if (Input::has('pricegroups')) {
            $new_event->pricegroups()->sync(Input::get('pricegroups'));
        } else {
            $new_event->pricegroups()->detach();
        }

        /*if (Input::has('links')) {
            $new_event->links()->delete();

            foreach(Input::get('links') as $link_data) {
                if (!empty($link_data) && !empty($link_data['link'])) {
                    $link = new Link($link_data);
                    $new_event->links()->save($link);
                }
            }
        }

        if (Input::has('shows')) {
            $new_event->links()->delete();

            foreach(Input::get('links') as $link_data) {
                if (!empty($link_data) && !empty($link_data['link'])) {
                    $link = new Link($link_data);
                    $new_event->links()->save($link);
                }
            }
        }*/

        // update relations to links and presentations
        $new_event->links()->delete();
        $new_event->links()->createMany(Input::get('links'));

        $new_event->shows()->delete();
        $new_event->shows()->createMany(Input::get('shows'));

        try {
            $new_event->save();
        } catch(Exception $e) {
            // todo error
        }

        // todo success notification
        return Redirect::back();
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

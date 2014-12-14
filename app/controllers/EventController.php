<?php


use kije\Event;
use kije\Genre;
use kije\Link;
use kije\Pricegroup;
use kije\Show;
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
        $events = Event::all();
        return View::make('admin.event.index', array('events' => $events)); // todo genrefilter
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
        return $this->editOrCreate();
    }

    protected function editOrCreate($event_id = null) {
        return DB::transaction(function () use ($event_id) {
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

            $data = Input::only('name', 'beschreibung', 'dauer');
            if (empty($event_id)) {
                $event = new Event($data);
            } else {
                $event = Event::findOrNew($event_id);
                $event->fill($data);
            }

            $event->genre()->associate(Genre::find(Input::get('fk_Genre_ID')));

            foreach (array('besetzung', 'bildbeschreibung') as $optional_field) {
                if (Input::has($optional_field)) {
                    $event->$optional_field = Input::get($optional_field);
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
                        $event->bild =
                            str_replace(public_path(), '', realpath($file->getPath() . '/' . $file->getBasename()));
                    } catch (FileException $e) {
                        // todo error message
                    }
                }
            }

            try {
                $event->save();
            } catch (Exception $e) {
                // todo error
            }


            if (Input::has('pricegroups')) {
                $event->pricegroups()->sync(Input::get('pricegroups'));
            } else {
                $event->pricegroups()->detach();
            }

            // update relations to links and shows

            if (Input::has('links')) {
                $event->links()->delete();
                foreach(Input::get('links') as $link_data) {
                    if (!empty($link_data['link'])) {
                        $link = new Link($link_data);
                        $event->links()->save($link);
                    }
                }
            }

            if (Input::has('shows')) {
                $event->shows()->delete();
                $shows = Input::get('shows');

                foreach($shows as $show_data) {
                    if (!empty($show_data['datum']) && !empty($show_data['zeit'])) {
                        $show = new Show($show_data);
                        if (!$show->hasCollision()) {
                            $event->shows()->save($show);
                        }
                    }
                }
            }


            try {
                $event->save();
            } catch (Exception $e) {
                // todo error
            }

            // todo success notification
            return Redirect::route('admin.event.edit', $event->ID);
        });



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
        $event = Event::find($id);

        return View::make(
            'admin.event.edit',
            array(
                'event' => $event,
                'pricegroups' => Pricegroup::all(),
                'links' => $event->links,
                'shows' => $event->shows
            )
        );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        return $this->editOrCreate($id);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        Event::find($id)->delete();

        // todo success notification
        return Redirect::back();
    }


}

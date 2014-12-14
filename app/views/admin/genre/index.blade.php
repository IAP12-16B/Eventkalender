@extends('layouts.admin')

@section('page.actions')
    {{ Form::open(array('method' => 'POST', 'class' => 'forms-inline forms', 'action' => 'admin.genre.store')) }}
        {{ Form::text('name', Input::old('name'), array('placeholder' => 'Name')) }}
        {{ Form::button('Save', array('type' => 'submit', 'class' => 'btn')) }}
    {{ Form::close() }}
@endsection

@section('page.content')
    @if(!empty($genres))
        <table class="table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($genres as $genre)
                    <tr>
                        <td>
                            {{ Form::model($genre, array('method' => 'PUT', 'class' => 'forms-inline forms', 'action' => array('admin.genre.update', $genre->ID))) }}
                                {{ Form::text('name', $genre->name) }}
                                {{ Form::button('Save', array('type' => 'submit', 'class' => 'btn')) }}
                            {{ Form::close() }}
                        </td>

                        <td>
                            {{ Form::open(array('method' => 'DELETE', 'action' => array('admin.genre.destroy', $genre->ID))) }}
                                <button type="submit" class="btn btn-small"><i class="fa fa-trash fa-fw"></i></button>
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="message">
            There are currently no events!
        </p>
    @endif
@endsection
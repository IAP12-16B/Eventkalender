@extends('layouts.admin')

@section('page.content')
    @if(!empty($events))
        <table class="table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Dauer</th>
                    <th>Genre</th>
                    <th>Edit/Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>
                            <a href="{{ route('admin.event.edit', $event->ID) }}">{{ $event->name }}</a>
                        </td>
                        <td>
                            {{ $event->dauer }}
                        </td>
                        <td>
                            {{ $event->genre->name }}
                        </td>
                        <td>
                            {{ Form::open(array('method' => 'DELETE', 'action' => array('admin.event.destroy', $event->ID))) }}
                                <button type="submit" class="btn btn-small"><i class="fa fa-trash fa-fw"></i></button>
                                <a href="{{ route('admin.event.edit', $event->ID) }}" class="btn btn-small"><i class="fa fa-edit fa-fw"></i></a>
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
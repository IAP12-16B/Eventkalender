@extends('layouts.admin')

<?php $is_edit = isset($event); ?>
@if(!$is_edit)
    <?php $event = new kije\Event(); ?>
@endif

@section('page.content')
    @if($is_edit)
        {{ Form::model($event, array('route' => 'admin.event.update', 'method' => 'PATCH', 'class' => 'admin-form event-edit-form forms', 'files' => true)) }}
    @else
        {{ Form::open(array('route' => 'admin.event.store', 'class' => 'admin-form event-edit-form forms', 'files' => true)) }}
    @endif
        <h2>@if($is_edit) Edit @else Create @endif Event</h2>
        <ul class="form-list blocks-2 clearfix">
            <li class="edit-box">
                <fieldset>
                    <legend>General</legend>
                    {{ Form::label('name', 'Name*', array('class' => 'width-100')) }}
                    {{ Form::text('name', Input::old('name'), array('class' => 'width-100', 'required' => 'required')) }}

                    {{ Form::label('besetzung', 'Line-Up', array('class' => 'width-100')) }}
                    {{ Form::text('besetzung', Input::old('besetzung'), array('class' => 'width-100')) }}

                    {{ Form::label('beschreibung', 'Description*', array('class' => 'width-100')) }}
                    {{ Form::textarea('beschreibung', Input::old('beschreibung'), array('class' => 'width-100', 'required' => 'required')) }}

                    {{ Form::label('dauer', 'Duration*', array('class' => 'width-100')) }}
                    {{ Form::input('time', 'dauer', Input::old('dauer'), array('class' => 'width-100', 'required' => 'required')) }}
                </fieldset>
            </li>
            <li class="edit-box">
                <fieldset>
                    <legend>Image</legend>
                    {{ Form::label('bild', 'Image', array('class' => 'width-100')) }}
                    {{ Form::file('bild') }}

                    {{ Form::label('bildbeschreibung', 'Image description', array('class' => 'width-100')) }}
                    {{ Form::text('bildbeschreibung', Input::old('bildbeschreibung'), array('class' => 'width-100')) }}
                </fieldset>
            </li>
            <li class="edit-box">
                <fieldset>
                    <legend>Additional</legend>
                    {{ Form::label('fk_Genre_ID', 'Genre', array('class' => 'width-100')) }}
                    {{ Form::select('fk_Genre_ID', kije\Genre::lists('name', 'ID'), Input::old('fk_Genre_ID'), array('class' => 'width-100')) }}

                    @if(!empty($pricegroups))
                        <ul class="forms-list">
                            @foreach($pricegroups as $pricegroup)
                            <li>
                                <label>
                                    <input type="checkbox" name="pricegroups[]" id="pricegroup-{{$pricegroup->ID}}" value="{{$pricegroup->ID}}"  @if( $event->pricegroups->contains($pricegroup->ID) )checked="checked"@endif>
                                    {{ $pricegroup->name }} ({{ formatCurrency($pricegroup->preis) }} CHF)
                                </label>
                            </li>
                        @endforeach
                        </ul>
                    @endif
                </fieldset>
            </li>
            <li class="edit-box">
                <fieldset>
                    <legend>Links</legend>

                </fieldset>
            </li>
            <li class="edit-box">
                <fieldset>
                    <legend>Shows</legend>
                    {{-- Todo shows --}}
                </fieldset>
            </li>
        </ul>

        {{ Form::button('Save', array('type' => 'submit', 'class' => 'btn-red btn-outline')) }}
    {{ Form::close() }}
@endsection
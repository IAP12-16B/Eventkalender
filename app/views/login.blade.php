@extends('layouts.main')

@section('wrapper.content')
    <div class="login-container">
        {{ Form::open(array('route' => 'doLogin', 'class' => 'login-form')) }}
            {{ Form::label('benutzername', 'Username') }}
        	{{ Form::text('benutzername', Input::old('benutzername')) }}

        	{{ Form::label('passwort', 'Password') }}
            {{ Form::password('passwort') }}

            {{ Form::button('Login', array('type' => 'submit')) }}
        {{ Form::close() }}
    </div>
@endsection
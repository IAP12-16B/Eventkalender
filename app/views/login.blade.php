@extends('layouts.main')

@section('css.own.after')
    @parent
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" />
@endsection


@section('wrapper.inner.content')
    <div class="login-container unit-centered unit-40">
        {{ Form::open(array('route' => 'doLogin', 'class' => 'login-form forms')) }}
            <h2>Login</h2>
            {{ Form::label('benutzername', 'Username') }}
        	{{ Form::text('benutzername', Input::old('benutzername'), array('class' => 'width-100')) }}

        	{{ Form::label('passwort', 'Password') }}
            {{ Form::password('passwort', array('class' => 'width-100')) }}

            {{ Form::button('Login', array('type' => 'submit', 'class' => 'btn-red btn-outline width-100')) }}
        {{ Form::close() }}
    </div>
@endsection
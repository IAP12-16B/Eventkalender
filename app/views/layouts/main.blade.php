@extends('layouts.master')

@section('body.content')
    <div class="outer-wrapper">
        @yield('wrapper.before')
        <div class="inner-wrapper">
            @yield('wrapper.content')
        </div>
        @yield('wrapper.after')
    </div>
@endsection
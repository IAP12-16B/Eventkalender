@extends('layouts.master')

@section('head.after')
    @include('mixins.css')
@endsection

@section('body.after')
    @include('mixins.js')
@endsection

@section('body.content')
    <div class="outer-wrapper">
        @yield('wrapper.before')
        <div class="inner-wrapper">
            @yield('wrapper.content')
        </div>
        @yield('wrapper.after')
    </div>
@endsection
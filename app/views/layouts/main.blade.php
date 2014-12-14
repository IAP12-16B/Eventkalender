@extends('layouts.master')

@section('head.before')
    <meta name="viewport" content="width=device-width, initial-scale=1" />
@endsection

@section('head.after')
    @yield('body.css.before')
    @include('mixins.css')
    @yield('body.css.after')
@endsection

@section('body.after')
    @yield('body.js.before')
    @include('mixins.js')
    @yield('body.js.after')
@endsection

@section('body.content')
    <div class="outer-wrapper">
        @include('mixins.header')
        @yield('wrapper.outer.top')
        @section('wrapper.notificattions')
            {{ Notification::showAll() }}
        @endsection
        <div class="inner-wrapper units-row">
            @yield('wrapper.inner.top')
            @yield('wrapper.inner.content')
            @yield('wrapper.inner.bottom')
        </div>
        @yield('wrapper.outer.bottom')
    </div>
@endsection
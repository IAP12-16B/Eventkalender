@extends('layouts.main')


@section('wrapper.inner.content')
    @yield('page.before')
    <div class="page">
        @yield('page.top')
        @yield('page.content')
        @yield('page.bottom')
    </div>
    @yield('page.after')
@endsection
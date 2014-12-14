@extends('layouts.main')


@section('wrapper.inner.content')
    @yield('page.before')
    <div class="page units-row">
        @yield('page.top')
        @yield('page.content')
        @yield('page.bottom')
    </div>
    @yield('page.after')
@endsection
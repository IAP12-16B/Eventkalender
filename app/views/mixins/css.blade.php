@yield('css.before')
{{-- Base --}}
<link href="{{ asset('css/kube.min.css') }}" rel="stylesheet" />
<link href="{{ asset('css/normalize.css') }}" rel="stylesheet" />
<link href="{{ asset('css/cerabox.css') }}" rel="stylesheet" />
@yield('css.base.after')

{{-- Font-Awesome --}}
<link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />

{{-- Own Styles --}}
<link href="{{ asset('css/main.css') }}" rel="stylesheet" />
@yield('css.own.after')

{{-- Fonts --}}
<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700&subset=latin-ext,latin' rel='stylesheet' type='text/css'>

@yield('css.after')
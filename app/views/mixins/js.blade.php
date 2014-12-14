<!-- Scripts -->
@yield('js.before')
{{-- Base --}}
<script src="{{ asset('js/mootools-min.js') }}"></script>
<script src="{{ asset('js/cerabox.min.js') }}"></script>

{{-- Own --}}
<script src="{{ asset('js/main.js') }}"></script>

@yield('js.after')
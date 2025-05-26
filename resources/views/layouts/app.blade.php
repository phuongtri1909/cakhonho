@include('layouts.partials.header')

<body data-auth="{{ auth()->check() ? 'true' : 'false' }}">
    <div class="mt-88">
        @include('components.toast')
        @include('components.toast-main')
        
        @yield('content')
        @include('components.contact_widget')
        @include('components.top_button')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

@include('layouts.partials.footer')

<main>
    <div class="my-container">
        @yield('content')

        @if (session('status'))
            <div id="my-alert" class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
</main>
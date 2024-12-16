<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partial._head')

<body class="font-sans antialiased">
    @include('layouts.navigation')

    <div class="flex-1">
        <main>
            @yield('content')
        </main>
    </div>

    @include('partial._foot')

</body>
</html>

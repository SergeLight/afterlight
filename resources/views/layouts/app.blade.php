<!DOCTYPE html>
<html lang="en">

    @include('includes.head')

    <body data-csrf="{{ csrf_token() }}">
        <div id="app">

            <header style="padding: 20px">
                <span>
                    @auth
                        <a href="/logout">Logout</a>
                    @endauth

                </span>
            </header>

            @yield('content')

        </div>

    </body>

    @yield('plugins')
</html>

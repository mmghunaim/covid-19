<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="theme-light bg-page " >
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-header ">

        <div class="container mx-auto">
            <div class="flex justify-between items-center py-2">
                <h1>

                    <a class="navbar-brand"  href="{{ url('/') }}">
                        COVID-19
                    </a>
                </h1>

                <div class="flex items-center">
                    <!-- Right Side Of Navbar -->

                    <div class="navbar-nav ml-auto list-none text-default flex justify-between">
                        <!-- Authentication Links -->
                        @guest
                            <a class="nav-link no-underline text-default mr-3 text-accent" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link no-underline text-default text-accent" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif

                        @else
                            <div class="mr-6" style="line-height: 2rem">
                                <a href="home">Home</a>
                            </div>

                            <dropdown align="right" width="200px">
                                <template v-slot:trigger>
                                    <button class="flex items-center text-default no-underline text-sm focus:outline-none">
                                        <img
                                                src="{{ gravatar_url(Auth::user()->email) }}?s=60"
                                                alt="{{ Auth::user()->name }}'s avatar"
                                                class="rounded-full mr-3" width="35">
                                        {{  auth()->user()->name }}
                                    </button>
                                </template>

                                <a href="/users/{{ auth()->id() }}/edit" class="dropdown-menu-link w-full text-left">Update Profile</a>

                                <form id="logout-form" method="POST" action="/logout">
                                    @csrf
                                    <button type="submit" class="dropdown-menu-link w-full text-left">Logout</button>
                                </form>
                            </dropdown>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto py-4">
        @yield('content')
    </main>
</div>
</body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


<style>
.sidebar-text{
    color: #334D6E;
}

.sidebar-colour{
    background-color: #ffffff;
    height : 100vh;
    width : 30vh
}

.flex{
    display: flex;
    flex-direction: row;
    align-items: flex-start;
}

.crm-img{
    width: 100%;
    padding-bottom: 15%;
}

.nav-font {
    font-weight: bolder;
}
</style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    MY_CRM
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::currentRouteName() === 'register')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::currentRouteName() === 'login')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="flex">
            <div class="container sidebar-colour">
                <img src="{{ url('img/crm.jpg') }}"  alt="CRM image" class="crm-img"> 
                <!-- Add your sidebar code here -->
                <!-- bg-light add back to below nav -->
                <nav class="col-md-2 d-none d-md-block sidebar nav-font ">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                            <a class="nav-link sidebar-text" href="{{ url('/home') }}">Dashboard</a>
                            <ul class="collapse show ml-3" id="dashboardCollapse">
                                <li><a class="nav-link sidebar-text" href="{{ url('/leads') }}">Lead/Rfx</a></li>
                                <li><a class="nav-link sidebar-text" href="{{ url('/tasks') }}">Tasks</a></li>
                            </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sidebar-text" href="{{ url('/analysis') }}">Analysis/Report</a>
                            </li>
                            @if ( (Auth::user()->is_admin) === 0)
                            <li class="nav-item">
                                <a class="nav-link sidebar-text" data-bs-toggle="collapse" href="#usersCollapse" role="button" aria-expanded="false" aria-controls="usersCollapse">Users</a>
                                <ul class="collapse ml-3" id="usersCollapse">
                                    <li><a class="nav-link sidebar-text" href="{{ url('/user/register') }}">Registration</a></li>
                                    <li><a class="nav-link sidebar-text" href="{{ url('/user/listing') }}">Listing</a></li>
                                </ul>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link sidebar-text" data-bs-toggle="collapse" href="#customerCollapse" role="button" aria-expanded="false" aria-controls="customerCollapse">Customer</a>
                                <ul class="collapse ml-3" id="customerCollapse">
                                    <li><a class="nav-link sidebar-text" href="{{ url('/customer/register') }}">Registration</a></li>
                                    <li><a class="nav-link sidebar-text" href="{{ url('/customer/listing') }}">Listing</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sidebar-text" href="{{ url('/marketing/home') }}">Marketing</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="container" style="background-color: #e0e4f4; height: 100vh;">
                <main>
                    @yield('content')
                </main>
            </div>
        </div>
</body>
</html>

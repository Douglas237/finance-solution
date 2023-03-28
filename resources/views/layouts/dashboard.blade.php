<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href={{ asset('icons/css/all.css') }}>
    <link rel="stylesheet" href="{{ asset('css/finance.css') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Finance-solution</title>
</head>

<body>
    {{-- nav barre --}}
    <div class="nav-asside">
        <div class="navbare">
            <nav class="navbar navbar-expand-lg">
                <div class="menu_icon" id="menu_icon">
                    <img style="height: 3rem; width: 3rem" src="{{ asset('imgcon/menu.png') }}" alt="">
                </div>
                <div class="container-fluid content">
                    <div class="collapse navbar-collapse search" id="navbarSupportedContent">
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        </form>
                    </div>
                    <div class="icons">
                        <i class="fa-regular fa-flag" style="color: white; font-size: 1rem"></i>
                        <i class="fa-regular fa-bell" style="color: white; font-size: 1rem"></i>
                        <i class="fa fa-sliders" aria-hidden="true" style="color: white; font-size: 1rem"></i>
                    </div>
                    <div class="img">

                    </div>
                    <a href="#" class="dropdown"><i class="fa fa-caret-down toggle" aria-hidden="true"></i></a>
                    <ul class="elmts">
                        <li><a href="#"><i class="fa-solid fa-id-card-clip" style="margin-right: 1rem; font-size: 0.8em"></i>Profil</a></li>
                        <li><a href=""><i class="fa-solid fa-gear" style="margin-right: 1rem;"></i>parametre</a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="centre">
            @yield('content')
        </div>
        {{-- asside --}}
        <nav class="sidebar" id="sidebar">
            <div class="logo">
                <div style="background-color: #c8f5c3d3;height: 3.8rem;width: 3.8rem;border-radius: 50%" class="logoimg">
                    <img src="{{ asset('img-side/09.png') }}" alt="">
                </div>
                <div class="logotext">
                    <p style="color: rgba(255, 255, 255, 0.63)"><span>FINANCE-SOLUTION</span><br> <span>l'argent du peuple</span></p>
                </div>
            </div>
            <ul class="grandul">
                <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true" style="margin-right: 1.2rem; font-size: 0.8em;"></i>Dashboard</a></li>
                <li>
                    <a href="#" class="client-btn">
                        <i class="fa fa-user" aria-hidden="true" style="margin-right: 1.2rem;font-size: 0.8em;"></i> Clients <span><i
                                class="fa fa-caret-down toggle1" style="font-size: 0.8em;" aria-hidden="true"></i></span>
                    </a>
                    <ul class="souscli">
                        <li><a href="#"><i class="fa-regular fa-circle" style="margin-right: 0.8rem;font-size: 0.5em;"></i>Nouveau client</a></li>
                        <li><a href="{{ route('Client.index') }}"> <i class="fa-regular fa-circle" style="margin-right: 0.8rem;font-size: 0.5em;"></i>Liste de client</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="compte-btn"><i class="fa fa-user-plus" aria-hidden="true" style="margin-right: 1rem; font-size: 0.8em;"></i>Comptes <i class="fa fa-caret-down toggle2" style="font-size: 0.8em;" aria-hidden="true"></i></a>
                    <ul class="souscpt">
                        <li><a href="{{ route('Client.create')}}"><i class="fa-regular fa-circle" style="margin-right: 0.8rem; font-size: 0.5em"></i>Nouveau compte</a></li>
                        <li><a href="{{ route('compte.list') }}"><i class="fa-regular fa-circle" style="margin-right: 0.8rem; font-size: 0.5em"></i>Liste de compte</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('employer.list') }}"><i class="fa fa-users left" aria-hidden="true" style="margin-right: 0.7rem;font-size: 0.8em;"></i>
                        Employer</a></li>
                <li><a href="{{ route('entreprise.list') }}"><i class="fa fa-building" aria-hidden="true" style="margin-right: 1.3rem;font-size: 0.8em;"></i>
                        Entreprise</a></li>
                <li><a href="#"> <i class="fa fa-share" aria-hidden="true" style="margin-right: 0.8rem;font-size: 0.8em;"></i>
                        Transaction</a></li>
            </ul>
        </nav>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('icons/js/all.js') }}"></script>
    <script src="{{ asset('js/finance.js') }}"></script>
</body>

</html>

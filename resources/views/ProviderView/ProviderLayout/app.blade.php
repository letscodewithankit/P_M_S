<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<div>


<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" ><h5>Provider Dashboard</h5></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <h5><a href="{{route('provider_logout')}}" style="text-decoration: none;color: white">Logout</a></h5>
        </button>
{{--        <div class="collapse navbar-collapse" id="navbarNavDropdown">--}}
{{--            <ul class="navbar-nav">--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link active" aria-current="page" href="#">Home</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="#">Features</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="#">Pricing</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item dropdown">--}}
{{--                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                        Dropdown link--}}
{{--                    </a>--}}
{{--                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">--}}
{{--                        <li><a class="dropdown-item" href="#">Action</a></li>--}}
{{--                        <li><a class="dropdown-item" href="#">Another action</a></li>--}}
{{--                        <li><a class="dropdown-item" href="#">Something else here</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
    </div>
</nav>
@yield('content')
</div>

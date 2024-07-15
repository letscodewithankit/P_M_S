<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #fbfbfb;
        }
        @media (min-width: 991.98px) {
            main {
                padding-left: 240px;
            }
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 58px 0 0; /* Height of navbar */
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
            width: 150px;
            z-index: 600;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
            }
        }
        .sidebar .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
        }
    </style>
</head>
<!--Main Navigation-->
<body>
<header>
    <!-- Sidebar -->
    <nav id="sidebarMenu"  class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky" >
            <div class="list-group list-group-flush mx-3 mt-4">
                <!-- Collapse 1 -->

                <!-- Collapsed content -->
                <ul id="collapseExample1" class="collapse show list-group list-group-flush">
                    <li class="list-group-item py-1">
                        <a href="{{route('admin_dashboard')}}" class="text-reset" style="text-decoration: none">Home</a>
                    </li>
                    <li class="list-group-item py-1">
                        <a href="{{route('admin_dashboard_provider')}}" class="text-reset" style="text-decoration: none">Operator</a>
                    </li>
                    <li class="list-group-item py-1">
                        <a style="text-decoration: none" href="{{route('admin_dashboard_vehicle')}}" class="text-reset">Vehicle</a>
                    </li>
                    <li class="list-group-item py-1">
                        <a style="text-decoration: none" href="{{route('provider_report')}}" class="text-reset">Report</a>
                    </li>
                    <li class="list-group-item py-1">
                        <a style="text-decoration: none" href="{{route('form')}}" class="text-reset">Form</a>
                    </li>

                </ul>
                <!-- Collapse 1 -->

                <!-- Collapse 2 -->
{{--                <a class="list-group-item list-group-item-action py-2 ripple" aria-current="true"--}}
{{--                   data-mdb-collapse-init href="#collapseExample2" aria-expanded="true"--}}
{{--                   aria-controls="collapseExample2">--}}
{{--                    <i class="fas fa-chart-area fa-fw me-3"></i><span>Collapsed menu</span>--}}
{{--                </a>--}}
                <!-- Collapsed content -->
                <ul id="collapseExample2" class="collapse list-group list-group-flush">
                    <li class="list-group-item py-1">
                        <a href="" class="text-reset">Link</a>
                    </li>
                    <li class="list-group-item py-1">
                        <a href="" class="text-reset">Link</a>
                    </li>
                    <li class="list-group-item py-1">
                        <a href="" class="text-reset">Link</a>
                    </li>
                    <li class="list-group-item py-1">
                        <a href="" class="text-reset">Link</a>
                    </li>
                </ul>
                <!-- Collapse 2 -->
            </div>
        </div>
    </nav>
    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button data-mdb-button-init class="navbar-toggler" type="button" data-mdb-collapse-init data-mdb-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand" href="#">
                <h4 style="color: white">Admin Panel</h4>
            </a>
            <!-- Search form -->
{{--            <form class="d-none d-md-flex input-group w-auto my-auto">--}}
{{--                <input autocomplete="off" type="search" class="form-control rounded"--}}
{{--                       placeholder='Search (ctrl + "/" to focus)' style="min-width: 225px;" />--}}
{{--                <span class="input-group-text border-0"><i class="fas fa-search"></i></span>--}}
{{--            </form>--}}

            <!-- Right links -->
            <ul class="navbar-nav ms-auto d-flex flex-row">
                <button class="btn btn-dark"><a style="text-decoration: none;color: white" href="{{route('admin_logout')}}">Logout</a></button>
            </ul>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</header>
<!--Main Navigation-->
<div class="container mt-5">
    @yield('content')
</div>

</body>


<!--Main layout-->
<main style="margin-top: 58px;">
    <div class="container pt-4"></div>
</main>
<!--Main layout-->

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SPK BLT</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <!-- CSS -->
    <style>
        .navbar .navbar-toggler {
            top: .25rem;
            right: 1rem;
        }

        .navbar-brand {
            color: white;
            font-size: 16px;
            font-weight: bold;
            padding-top: .75rem;
            padding-bottom: .75rem;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .sidebar {
            position: fixed;
            top: 0;
            /* rtl:raw:
  right: 0;
  */
            bottom: 0;
            /* rtl:remove */
            left: 0;
            z-index: 100;
            /* Behind the navbar */
            padding: 48px 0 0;
            /* Height of navbar */
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }

        @media (max-width: 767.98px) {
            .sidebar {
                top: 5rem;
            }
        }

        .sidebar-sticky {
            height: calc(100vh - 48px);
            overflow-x: hidden;
            overflow-y: auto;
            /* Scrollable contents if viewport is shorter than content. */
        }

        .sidebar hr {
            color: white;
            opacity: 3;
        }
    </style>

</head>

<body>
    <!-- svg -->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="person" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
            <path fill-rule="evenodd"
                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
        </symbol>
        <symbol id="beranda" viewBox="0 0 16 16">
            <path
                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
            <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
        </symbol>
        <symbol id="kriteria" viewBox="0 0 16 16">
            <path
                d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z" />
        </symbol>
        <symbol id="subkriteria" viewBox="0 0 16 16">
            <path
                d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4z" />
            <path
                d="M4.268 1A2 2 0 0 1 6 0h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L13 13.768V2a1 1 0 0 0-1-1H4.268z" />
        </symbol>
        <symbol id="perhitungan" viewBox="0 0 16 16">
            <path
                d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2 .5v2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0-.5.5zm0 4v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zM4.5 9a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM4 12.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zM7.5 6a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM7 9.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm.5 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM10 6.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm.5 2.5a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-.5-.5h-1z" />
        </symbol>
        <symbol id="form-masyarakat" viewBox="0 0 16 16">
            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>          
        </symbol>
    </svg>

    {{-- NAVBAR --}}
    <header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 fs-6" href="{{ route('berandaadmin') }}">
            <img class="img-fluid ms-3 me-2" src="{{ asset('asset') }}/image/logo.png" alt="logo" width="30" />
            BLT-DD SMARTER
        </a>

        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="w-100 rounded-0 border-0"></div>

        <div class="navbar-nav">
            <div class="nav-item text-nowrap ms-3 me-3 mb-2 mt-1">
                <a class="btnlogout nav-link px-3 btn btn-outline-primary" role="button"
                    href="{{ route('logout') }}">LOGOUT</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            {{-- SIDEBAR --}}
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <a href="/berandaadmin"
                        class="d-flex align-items-center mt-2 mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <svg class="bi pe-none me-2 ms-2" width="40" height="32">
                            <use xlink:href="#person" />
                        </svg>
                        <span class="fs-4">{{ Auth::user()->name }}</span>
                    </a>
                    <hr>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="{{ route('berandaadmin') }}" class="nav-link text-white" aria-current="page">
                                <svg class="bi pe-none me-2" width="16" height="16">
                                    <use xlink:href="#beranda" />
                                </svg>
                                Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kriterias.index') }}" class="nav-link text-white">
                                <svg class="bi pe-none me-2" width="16" height="16">
                                    <use xlink:href="#kriteria" />
                                </svg>
                                Kriteria
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('subkriterias.index') }}" class="nav-link text-white">
                                <svg class="bi pe-none me-2" width="16" height="16">
                                    <use xlink:href="#subkriteria" />
                                </svg>
                                Sub Kriteria
                            </a>
                        </li>

                        <hr>
                        
                        <li class="nav-item">
                            <a href="{{ route('perhitungan.index') }}" class="nav-link text-white">
                                <svg class="bi pe-none me-2" width="16" height="16">
                                    <use xlink:href="#perhitungan" />
                                </svg>
                                Perhitungan
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('forms.index') }}" class="nav-link text-white">
                                <svg class="bi pe-none me-2" width="16" height="16">
                                    <use xlink:href="#form-masyarakat" />
                                </svg>
                                Form Masyarakat
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            {{-- Main Content --}}
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/sidebars.js') }}"></script>
</body>

</html>

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
        <symbol id="masyarakat" viewBox="0 0 16 16">
            <path
                d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
        </symbol>
        <symbol id="penilaian" viewBox="0 0 16 16">
            <path
                d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0z" />
        </symbol>
        <symbol id="kriteria" viewBox="0 0 16 16">
            <path
                d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3z" />
        </symbol>
        <symbol id="penerima" viewBox="0 0 16 16">
            <path
                d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm1.354 4.354-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
        </symbol>
        <symbol id="laporan" viewBox="0 0 16 16">
            <path
                d="M5.523 12.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.572a.266.266 0 0 1-.035.012.282.282 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548zm2.455-1.647c-.119.025-.237.05-.356.078a21.148 21.148 0 0 0 .5-1.05 12.045 12.045 0 0 0 .51.858c-.217.032-.436.07-.654.114zm2.525.939a3.881 3.881 0 0 1-.435-.41c.228.005.434.022.612.054.317.057.466.147.518.209a.095.095 0 0 1 .026.064.436.436 0 0 1-.06.2.307.307 0 0 1-.094.124.107.107 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256zM8.278 6.97c-.04.244-.108.524-.2.829a4.86 4.86 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.517.517 0 0 1 .145-.04c.013.03.028.092.032.198.005.122-.007.277-.038.465z" />
            <path fill-rule="evenodd"
                d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.651 11.651 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.856.856 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.844.844 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.76 5.76 0 0 0-1.335-.05 10.954 10.954 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.238 1.238 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a19.697 19.697 0 0 1-1.062 2.227 7.662 7.662 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103z" />
        </symbol>
    </svg>

    {{-- NAVBAR --}}
    <header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 fs-6" href="{{ asset('img/logo.png') }}">
            <img class="img-fluid ms-3 me-2" src="img/logo.png" alt="logo" width="30" />
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
                <a class="btnlogout nav-link px-3 btn btn-outline-primary" role="button" href="{{ route('logout') }}">LOGOUT</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            {{-- SIDEBAR --}}
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <a href="/"
                        class="d-flex align-items-center mt-2 mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <svg class="bi pe-none me-2 ms-2" width="40" height="32">
                            <use xlink:href="#person" />
                        </svg>
                        <span class="fs-4">{{ Auth::user()->name }}</span>
                    </a>
                    <hr>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="{{ route('beranda') }}" class="nav-link text-white" aria-current="page">
                                <svg class="bi pe-none me-2" width="16" height="16">
                                    <use xlink:href="#beranda" />
                                </svg>
                                Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('masyarakats.index') }}" class="nav-link text-white">
                                <svg class="bi pe-none me-2" width="16" height="16">
                                    <use xlink:href="#masyarakat" />
                                </svg>
                                Masyarakat
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('penilaian.index') }}" class="nav-link text-white">
                                <svg class="bi pe-none me-2" width="16" height="16">
                                    <use xlink:href="#penilaian" />
                                </svg>
                                Penilaian
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
                                    <use xlink:href="#kriteria" />
                                </svg>
                                Sub Kriteria
                            </a>
                        </li>

                        <hr>

                        <li class="nav-item">
                            <a href="#" class="nav-link text-white">
                                <svg class="bi pe-none me-2" width="16" height="16">
                                    <use xlink:href="#penerima" />
                                </svg>
                                Penerima BLT
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-white">
                                <svg class="bi pe-none me-2" width="16" height="16">
                                    <use xlink:href="#laporan" />
                                </svg>
                                Laporan
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

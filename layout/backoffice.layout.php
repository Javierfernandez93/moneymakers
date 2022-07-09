<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../../src/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../src/img/favicon.png">
    <title>
        %title%
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link rel="stylesheet" href="../../src/css/nucleo-icons.css" />
    <link rel="stylesheet" href="../../src/css/nucleo-svg.css" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../../src/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../src/css/general.css" />
    <link rel="stylesheet" href="../../src/css/nucleo-svg.css" />
    <!-- CSS Files -->

    <link id="pagestyle" href="../../src/css/soft-ui-dashboard.css?v=1.0.6" rel="stylesheet" />
    <link rel="stylesheet" href="../../src/css/colors-light.css" />
    %css_scripts%
</head>
<body class="row justify-content-center">
    <div class="col-12 col-xl-10">
        <header class="navbar navbar-expand-md navbar-light bd-navbar">
            <nav class="container-xxl flex-wrap flex-md-nowrap" aria-label="Main navigation">
                <a class="navbar-brand p-0 me-2 fs-3 fw-semibold" href="/" aria-label="Bootstrap">
                    MoneyMakers
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" class="bi" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"></path>
                    </svg>
                </button>

                <div class="collapse navbar-collapse" id="bdNavbar">
                    <ul class="navbar-nav flex-row flex-wrap bd-navbar-nav pt-2 py-md-0">
                        <li class="nav-item col-6 col-md-auto">
                            <a class="nav-link p-2" href="/">Dashboard</a>
                        </li>
                        <li class="nav-item col-6 col-md-auto">
                            <a class="nav-link p-2" href="/docs/5.0/getting-started/introduction/">Learn</a>
                        </li>
                        <li class="nav-item col-6 col-md-auto">
                            <a class="nav-link p-2 active" aria-current="true" href="/docs/5.0/examples/">Referrals</a>
                        </li>
                    </ul>

                    <hr class="d-md-none text-white-50">

                    <ul class="navbar-nav flex-row flex-wrap ms-md-auto">
                        <li class="nav-item col-6 col-md-auto">
                            <a class="nav-link p-2" href="https://opencollective.com/bootstrap" target="_blank" rel="noopener">
                                Javier fernandez
                            </a>
                        </li>
                    </ul>

                    <a class="btn btn-bd-download d-lg-inline-block my-2 my-md-0 ms-md-3" href="/docs/5.0/getting-started/download/">Log out</a>
                </div>
            </nav>
        </header>
    
        %content%

        <footer class="container footer pt-3 fixesd-bottom">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            © <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            made with <i class="fa fa-heart"></i> by
                            <a href="https://moneymarkers.academy/" class="font-weight-bold" target="_blank">Money Markers</a>
                            for a better web.
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="" class="nav-link text-muted" target="_blank">Money Markers</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="../../src/js/core/bootstrap.bundle.min.js" type="text/javascript"></script>
    <!--   Core JS Files   -->
    <script src="../../src/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../../src/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../../src/js/plugins/chartjs.min.js"></script>
    <script src="../../src/js/42d5adcbca.js" type="text/javascript"></script>
    <script src="../../src/js/jquery-3.1.1.js" type="text/javascript"></script>
    <script src="../../src/js/alertCtrl.js?t=1" type="text/javascript"></script>
    <script src="../../src/js/general.js?t=2" type="text/javascript"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="../../src/js/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <!-- <script src="../../src/js/soft-ui-dashboard.min.js?v=1.0.6"></script> -->

    <script src="../../src/js/vue.js"></script>

    %js_scripts%

</body>

</html>
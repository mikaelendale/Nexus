<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--  Title -->
    <title>Nexus | Lalo Dev</title>
    <!--  Favicon -->
    <link rel="shortcut icon" type="image/Nexus.png" href="favicon.ico">
    <!--  Aos -->
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/style.min.css">
</head>

<body>
    <div class="page-wrapper p-0 overflow-hidden">
        <header class="header">
            <nav class="navbar navbar-expand-lg py-0">
                <div class="container">
                    <a class="navbar-brand me-0 align-items-center justify-center py-0" href="/">
                        <img src="images/Nexus.png" width="60" alt="img-fluid">
                    </a>
                    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav align-items-center mb-2 mb-lg-0 ms-auto">
                            @if (Route::has('login'))
                                @auth
                                    <li class="nav-item ms-2">
                                        <a class="btn btn-primary fs-3 rounded btn-hover-shadow px-3 py-2"
                                            href="{{ url('/dashboard') }}">Dashboard</a>
                                    </li>
                                @else
                                    <li class="nav-item ms-2">
                                        <a class="btn btn-primary fs-3 rounded btn-hover-shadow px-3 py-2"
                                            href="{{ route('login') }}">Login</a>
                                    </li>

                                @endauth
                            @endif

                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="body-wrapper overflow-hidden">
            <section class="pt-8 pt-md-5 pb-5 pb-lg-10 pb-xl-12">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="card c2a-box">
                                <div class="card-body text-center p-4 pt-8">
                                    <h3 class="fs-7 fw-semibold pt-6">Haven't found an answer to your question?</h3>
                                    <p class="mb-8 pb-2 text-dark">Connect with us either on Whatsapp or Telegram </p>
                                    <div class="d-sm-flex align-items-center justify-content-center gap-3 mb-4">
                                        <a href="https://wa.me/+251955133507" target="_blank"
                                            class="btn btn-primary d-block mb-3 mb-sm-0 btn-hover-shadow"
                                            type="button">Ask on Whatsapp</a>
                                        <a href="https://t.me/lalo_dev" target="_blank"
                                            class="btn btn-outline-secondary d-block" type="button">Ask on
                                            Telegram</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="bg-primary pt-5 pt-xl-9 pb-8">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-lg-7 col-xl-5 pt-lg-5 mb-5 mb-lg-0">
                            <h2 class="fs-12 text-white text-center text-lg-start fw-bolder mb-8">Jump to your Nexus
                                admin </h2>
                            @if (Route::has('login'))
                                @auth
                                    <div
                                        class="d-sm-flex align-items-center justify-content-center justify-content-lg-start gap-3">
                                        <a href="{{ url('/dashboard') }}"
                                            class="btn bg-white text-info fw-semibold d-block mb-3 mb-sm-0 btn-hover-shadow">Dashboard</a>
                                    </div>
                                    
                                @else
                                    <div
                                        class="d-sm-flex align-items-center justify-content-center justify-content-lg-start gap-3">
                                        <a href="{{route('login')}}"
                                            class="btn bg-white text-primary fw-semibold d-block mb-3 mb-sm-0 btn-hover-shadow">Login</a>
                                    </div>
                                    @endauth
                                @endif
                            </div>
                            <div class="col-lg-5 col-xl-5">
                                <div class="text-center text-lg-end">
                                    <img src="images/business-woman-checking-her-mail.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
            <footer class="footer-part pt-8 pb-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4">
                            <div class="text-center">
                                <a href="/">
                                    <img src="https://lalodev.com/images/icon.png" width="40" class="img-fluid pb-3">
                                </a>
                                <p class="mb-0 text-dark">All rights reserved by Nexus Volunteerism. Designed &amp; Developed by <a
                                        class="text-dark text-hover-primary border-bottom border-primary"
                                        href="https://lalodev.com/">Lalo Dev.</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer> 
        </div>
        <script src="js/jquery.min.js"></script>
        <script src="js/aos.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/custom.js"></script>
        <script>
            // change URL Js
            $(function() {
                let currentURL =
                    window.location != window.parent.location ?
                    document.referrer :
                    document.location.href;
                if (currentURL == "https://themeforest.net/") {
                    $("a.download-link").attr(
                        "href",
                        "#"
                    );
                } else {
                    $("a.download-link").attr(
                        "href",
                        "https://adminmart.com/product/modernize-react-mui-dashboard-template/"
                    );
                }
            });
        </script>


    </body>

    </html>

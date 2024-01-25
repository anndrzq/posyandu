<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; Posyandu</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="d-flex align-items-stretch flex-wrap">
                <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                    <div class="m-3 p-4">
                        <img src="{{ asset('img/logo.png') }}" alt="logo" width="90"
                            class="shadow-light rounded-circle mb-5 mt-2">
                        <h4 class="text-dark font-weight-normal">Selamat Datang Di <span
                                class="font-weight-bold">Pelayanan Posyandu</span>
                        </h4>
                        <p class="text-muted">Sebelum melakukan aktifitas anda harus login terlebih dahulu.</p>
                        <form method="POST" action="#" class="needs-validation" novalidate="">
                            <div class="form-group">
                                <label for="email">Username</label>
                                <input id="email" type="email" class="form-control" name="email" tabindex="1"
                                    required autofocus>
                                <div class="invalid-feedback">
                                    Silakan Masuk kan Username
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control" name="password"
                                    tabindex="2" required>
                                <div class="invalid-feedback">
                                    Silakan Masukkan Password
                                </div>
                            </div>

                            {{-- <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                        id="remember-me">
                                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                                </div>
                            </div> --}}

                            <div class="form-group text-right">
                                {{-- <a href="auth-forgot-password.html" class="float-left mt-3">
                                    Forgot Password?
                                </a> --}}
                                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right"
                                    tabindex="4">
                                    Login
                                </button>
                            </div>
                        </form>

                        <div class="text-small mt-5 text-center">
                            Copyright &copy; Ananda. Made with 💙 by Stisla
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12 order-lg-2 min-vh-100 background-walk-y position-relative overlay-gradient-bottom order-1"
                    data-background="{{ asset('img/unsplash/mom-baby.jpg') }}">
                    <div class="absolute-bottom-left index-2">
                        <div class="text-light p-5 pb-2">
                            <div class="mb-5 pb-3">
                                <h1 id="greeting" class="display-4 font-weight-bold mb-2">Selamat Pagi</h1>
                            </div>
                            Photo by <a class="text-light bb" target="_blank"
                                href="https://unsplash.com/@jonathanborba">Jonathan Borba</a> on <a
                                class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var greetingElement = document.getElementById('greeting');
            var currentTime = new Date();

            // Set zona waktu ke Asia/Jakarta
            currentTime.toLocaleString('en-US', {
                timeZone: 'Asia/Jakarta'
            });

            if (currentTime.getHours() >= 5 && currentTime.getHours() < 10) {
                greetingElement.innerText = 'Selamat Pagi';
            } else if (currentTime.getHours() > 10 && currentTime.getHours() < 15) {
                greetingElement.innerText = 'Selamat Siang';
            } else if (currentTime.getHours() > 15 && currentTime.getHours() < 18) {
                greetingElement.innerText = 'Selamat Sore';
            } else {
                greetingElement.innerText = 'Selamat Malam';
            }
        });
    </script>
</body>

</html>

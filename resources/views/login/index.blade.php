<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/js/app.js')
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('asset_login') }}/css/materialdesignicons.css"> --}}
    <link rel="stylesheet" href="{{ asset('asset_login') }}/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('asset_login') }}/css/login.css">
</head>

<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-6 ">
                        <img src="{{ asset('asset_login') }}/images/login.png" alt="login"
                            class="login-card-img border">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="brand-wrapper">
                                <img src="{{ asset('asset_login') }}/images/logo.png" alt="logo" class="logo">
                            </div>
                            <p class="login-card-description">Sign into your account</p>
                            <form action="{{ url('/') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="username" class="sr-only">Email</label>
                                    <input type="text" name="username" id="username" class="form-control"
                                        placeholder="Enter Username">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Enter password">
                                </div>
                                <input name="login" id="login" class="btn btn-block btn-dark mb-4" type="submit"
                                    value="Login">
                            </form>
                            <nav class="login-card-footer-nav">
                                <a href="#!">Terms of use.</a>
                                <a href="#!">Privacy policy</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <script src="{{ asset('asset_login') }}/js/jquery-3.4.1.js"></script>
    {{-- <script src="{{ asset('asset_login') }}/js/popper.js"></script>
    <script src="{{ asset('asset_login') }}/js/bootstrap.js"></script> --}}
</body>

</html>

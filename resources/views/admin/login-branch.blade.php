<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{!! $title !!}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="https://templates.iqonic.design/calendify/html/assets/images/favicon.ico" />
    <link rel="stylesheet" href="{!! URL::asset('admin-assets/css/backend.minf700.css?v=1.0.1') !!}">
    <link rel="stylesheet" href="{!! URL::asset('admin-assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('admin-assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! URL::asset('admin-assets/vendor/remixicon/fonts/remixicon.css') !!}">  </head>
<body class=" ">
<!-- loader Start -->
<div id="loading">
    <div id="loading-center">
    </div>
</div>
<!-- loader END -->

<div class="wrapper">
    <section class="login-content">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center height-self-center">
                <div class="col-md-5 col-sm-12 col-12 align-self-center">
                    <div class="card">
                        <div class="card-body text-center">
                            <h2>Sign In</h2>
                            <p>Login to stay connected.</p>
                            <form method="post" action="{!! url('branch/user-login') !!}">
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="floating-input form-group">
                                            <input class="form-control" type="text" name="email" id="email" required />
                                            <label class="form-label" for="email">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="floating-input form-group">
                                            <input class="form-control" type="password" name="password" id="password" required />
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">

                                    </div>
                                    <div class="col-lg-6">
                                        <a href="#" class="text-primary float-right">Forgot Password?</a>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<script src="{!! URL::asset('admin-assets/js/backend-bundle.min.js') !!}"></script>

<script src="{!! URL::asset('admin-assets/js/customizer.js') !!}"></script>

<script src="{!! URL::asset('admin-assets/js/app.js') !!}"></script>
</body>
</html>

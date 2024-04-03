<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual MCQ Test System</title>
    <meta name="description" content="A modern CRM Dashboard Template with reusable and flexible components for your SaaS web applications by hencework. Based on Bootstrap."/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/') }}assets/img/favicon.ico">
    <link rel="icon" href="{{ asset('/') }}assets/img/favicon.ico" type="image/x-icon">

    <!-- CSS -->
    <link href="{{ asset('/') }}assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('/') }}assets/jquery-toast-plugin/jquery.toast.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<!-- Wrapper -->
<div class="hk-wrapper hk-pg-auth" data-footer="simple">
    <!-- Top Navbar -->
    <nav class="hk-navbar navbar navbar-expand-xl navbar-light fixed-top">
        <div class="container-xxl">
            <!-- Start Nav -->
            <div class="nav-start-wrap">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="brand-img d-inline-block" src="{{ asset('/') }}assets/img/logo-light.png" alt="brand" />
                </a>
            </div>
            <!-- /Start Nav -->

            <!-- End Nav -->
            <div class="nav-end-wrap">
                @if (Route::has('login'))
                    @auth
                        <ul class="nav nav-light">
                            @role('admin')
                            <li class="nav-item">
                                <a href="{{ route('admin.index') }}" class="nav-link">
                                    <span class="nav-link-text">Dashboard</span>
                                </a>
                            </li>
                            @endrole
                            @role('creator')
                            <li class="nav-item">
                                <a href="{{ route('creator.index') }}" class="nav-link">
                                    <span class="nav-link-text">Teacher Panel</span>
                                </a>
                            </li>
                            @endrole
                            @role('subscriber')
                            <li class="nav-item">
                                <a href="{{ route('subscriber.index') }}" class="nav-link">
                                    <span class="nav-link-text">Student Student</span>
                                </a>
                            </li>
                            @endrole
                        </ul>
                    @else
                        <ul class="nav nav-light nav-pills">
                            <li class="nav-item">
                                <a class="sign-in nav-link" data-bs-toggle="pill" href="#login">
                                    <span class="nav-link-text">Login</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="sign-up nav-link" data-bs-toggle="pill" href="#register">
                                    <span class="nav-link-text">Register</span>
                                </a>
                            </li>
                        </ul>
                    @endauth
                @endif
            </div>
            <!-- /End Nav -->
        </div>

    </nav>
    <!-- /Top Navbar -->

    <!-- Main Content -->
    <div class="hk-pg-wrapper">
        <!-- Page Body -->
        <div class="hk-pg-body">
            <!-- Container -->
            <div class="container-xxl">
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-7 col-lg-6 d-lg-block d-none v-separator">
                        <div class="auth-content py-md-0  py-8">
                            <div class="row">
                                <div class="col-xxl-9 col-xl-8 col-lg-11 mx-auto">
                                    <div class="text-center">
                                        <h3 class="mb-2">Virtual MCQ Test System Project.</h3>
                                    </div>
                                    <ul class="list-icon mt-4">
                                        <li class="mb-1"><p><i class="ri-check-fill text-success"></i><span>There are many variations of passages of Lorem Ipsum available, in some form, by injected humour</span></p></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-5 col-lg-6 col-md-7 col-sm-10 position-relative mx-auto">
                        @auth
                            <h5 class="pt-10 text-center">You are already logged in!</h5>
                        @else
                        <div class="tab-content">
                            <div class="tab-pane fade" id="login">
                                <div class="auth-content">
                                    <form class="w-100" method="POST" action="{{ route('login') }}">
                                        <div class="row">
                                            <div class="col-lg-10 mx-auto">
                                                <h4 class="mb-4">Sign in to your account</h4>
                                                @csrf
                                                <div class="row gx-3">
                                                    <div class="form-group col-lg-12">
                                                        <div class="form-label-group">
                                                            <label for="email">Email</label>
                                                        </div>
                                                        <input id="email" class="form-control" name="email" placeholder="email ID" type="text">
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <div class="form-label-group">
                                                            <label for="password">Password</label>
                                                        </div>
                                                        <div class="input-group password-check">
                                                            <span class="input-affix-wrapper">
                                                                <input id="password" class="form-control" name="password" placeholder="Enter your password" type="password">
                                                                <a href="#" class="input-suffix text-muted">
                                                                    <span class="feather-icon"><i class="form-icon" data-feather="eye"></i></span>
                                                                    <span class="feather-icon d-none"><i class="form-icon" data-feather="eye-off"></i></span>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-uppercase btn-block">Sign In</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="register">
                                <div class="auth-content">
                                    <form class="w-100" method="POST" action="{{ route('register') }}">
                                        <div class="row">
                                            <div class="col-lg-10 mx-auto">
                                                <h4 class="text-center mb-4">Sign Up</h4>
                                                @csrf
                                                <div class="row gx-3">
                                                    <div class="form-group col-lg-12">
                                                        <label class="form-label">Authentication Type</label>
                                                        <select class="form-select" name="role">
                                                            <option value="subscriber" selected>Student</option>
                                                            <option value="creator">Teacher</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label class="form-label">Choose Course</label>
                                                        <select class="form-select" name="course_id">
                                                            @foreach($courses as $course)
                                                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label class="form-label">Full Name</label>
                                                        <input class="form-control" placeholder="Enter your full name" name="name" type="text">
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label class="form-label">Mobile</label>
                                                        <input class="form-control" placeholder="01XXXXXXXXX" name="mobile" type="number">
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label class="form-label">Email</label>
                                                        <input class="form-control" placeholder="Enter your email id" name="email" type="text">
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label class="form-label">Password</label>
                                                        <div class="input-group password-check">
                                                            <span class="input-affix-wrapper affix-wth-text">
                                                                <input class="form-control" placeholder="8+ characters" name="password" type="password">
                                                                <a href="#" class="input-suffix text-primary text-uppercase fs-8 fw-medium">
                                                                    <span>Show</span>
                                                                    <span class="d-none">Hide</span>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-12">
                                                        <label class="form-label">Confirm Password</label>
                                                        <div class="input-group password-check">
                                                            <span class="input-affix-wrapper affix-wth-text">
                                                                <input class="form-control" placeholder="Enter password again" name="password_confirmation" type="password">
                                                                <a href="#" class="input-suffix text-primary text-uppercase fs-8 fw-medium">
                                                                    <span>Show</span>
                                                                    <span class="d-none">Hide</span>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-rounded btn-uppercase btn-block">Create account</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endauth
                    </div>
                </div>
                <!-- /Row -->
            </div>
            <!-- /Container -->
        </div>
        <!-- /Page Body -->

        <!-- Page Footer -->
        <div class="hk-footer">
            <footer class="container-xxl footer">
                <div class="row">
                    <div class="col-xl-8">
                        <p class="footer-text"><span class="copy-text">Jahid © 2022 All rights reserved.</span></p>
                    </div>
                </div>
            </footer>
        </div>
        <!-- / Page Footer -->

    </div>
    <!-- /Main Content -->
</div>
<!-- /Wrapper -->

<!-- jQuery -->
<script src="{{ asset('/') }}assets/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="{{ asset('/') }}assets/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- FeatherIcons JS -->
<script src="{{ asset('/') }}assets/js/feather.min.js"></script>

<!-- Fancy Dropdown JS -->
<script src="{{ asset('/') }}assets/js/dropdown-bootstrap-extended.js"></script>

<!-- Simplebar JS -->
<script src="{{ asset('/') }}assets/simplebar/simplebar.min.js"></script>

<!-- Init JS -->
<script src="{{ asset('/') }}assets/js/init.js"></script>
<!-- Toastr -->
<script src="{{ asset('/') }}assets/jquery-toast-plugin/jquery.toast.min.js"></script>
<script type="text/javascript">
    $('.nav-link').on('click', function () {
        sessionStorage.setItem('lastTab', $(this).attr('href'));
    });
    if(sessionStorage.getItem('lastTab') === '#login') {
        $('.sign-in').addClass('active');
        $('#login').addClass('show active');
    }else if(sessionStorage.getItem('lastTab') === '#register') {
        $('.sign-up').addClass('active');
        $('#register').addClass('show active');
    }else {
        $('.sign-in').addClass('active');
        $('#login').addClass('show active');
    }
    @if($errors->any())
    $.toast({
        heading: 'Oh snap!',
        text: '<ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
        position: 'top-right',
        loaderBg:'#00acf0',
        class: 'jq-toast-inv jq-toast-inv-danger',
        hideAfter: 6000,
        stack: 6,
        loader:false,
        showHideTransition: 'fade'
    });
    @endif
</script>
</body>
</html>

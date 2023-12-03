<nav class="{{ $user->hasRole('admin') ? '' : 'd-none d-lg-block' }} hk-navbar navbar navbar-expand-xl navbar-light fixed-top">
    <div class="container-fluid">
        <!-- Start Nav -->
        <div class="nav-start-wrap">
            <button class="d-xl-none btn-icon btn-rounded btn-flush-dark flush-soft-hover navbar-toggle"><span class="icon"><span class="feather-icon"><i data-feather="align-left"></i></span></span></button>
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('admin.index') }}">Virtual MCQ Test System</a>
            <!-- /Logo -->
        </div>
        <!-- /Start Nav -->
        <!-- End Nav -->
        <div class="nav-end-wrap">
            <ul class="navbar-nav flex-row">
                <!--<li class="nav-item">
                    <div class="dropdown dropdown-notifications">
                        <a href="#" class="btn btn-icon btn-rounded btn-flush-dark flush-soft-hover dropdown-toggle no-caret" data-bs-toggle="dropdown" data-dropdown-animation role="button" aria-haspopup="true" aria-expanded="false"><span class="icon"><span class="position-relative"><span class="feather-icon"><i data-feather="bell"></i></span><span class="badge badge-success badge-indicator position-top-end-overflow-1"></span></span></span></a>
                        <div class="dropdown-menu dropdown-menu-end p-0">
                            <h6 class="dropdown-header px-4 fs-6">Notifications<a href="#" class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover"><span class="icon"><span class="feather-icon"><i data-feather="settings"></i></span></span></a>
                            </h6>
                            <div data-simplebar class="dropdown-body  p-2">
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <div class="media">
                                        <div class="media-head">
                                            <div class="avatar avatar-rounded avatar-sm">
                                                <img src="{{--{{ asset('/') }}--}}assets/img/avatar2.jpg" alt="user" class="avatar-img">
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div>
                                                <div class="notifications-text">Morgan Freeman accepted your invitation to join the team</div>
                                                <div class="notifications-info">
                                                    <span class="badge badge-soft-success">Collaboration</span>
                                                    <div class="notifications-time">Today, 10:14 PM</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-footer"><a href="#"><u>View all notifications</u></a></div>
                        </div>
                    </div>
                </li>-->
                <li class="nav-item">
                    <div class="dropdown ps-2">
                        <a class=" dropdown-toggle no-caret" href="#" role="button" data-bs-display="static" data-bs-toggle="dropdown" data-dropdown-animation data-bs-auto-close="outside" aria-expanded="false">
                            <div class="avatar avatar-rounded avatar-xs">
                                <img src="{{ asset('/') }}assets/img/avatar1.jpg" alt="user" class="avatar-img">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="p-2">
                                <div class="media">
                                    <div class="media-body">
                                        <h5>{{ $user->getRoleNames()->first() }}</h5>
                                        <div class="fs-7">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <h6 class="dropdown-header">Manage Account</h6>
                            <a class="dropdown-item" href="{{ route('user.profile') }}"><span class="dropdown-icon feather-icon"><i data-feather="check-square"></i></span><span>Profile</span></a>
                            <a class="dropdown-item" href="{{ route('admin.setting') }}"><span class="dropdown-icon feather-icon"><i data-feather="settings"></i></span><span>Settings</span></a>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"><span class="dropdown-icon feather-icon"><i data-feather="credit-card"></i></span><span>Logout</span></a>
                            <form action="{{ route('auth.logout') }}" method="post" id="logoutForm">@csrf</form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <!-- /End Nav -->
    </div>
</nav>

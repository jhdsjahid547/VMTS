<div class="hk-menu">
    <!-- Brand -->
    <div class="menu-header">
				<span>
					<a class="navbar-brand" href="{{ route('admin.index') }}">
						<img class="brand-img img-fluid" src="{{ asset('/') }}assets/img/main-logo.png" alt="brand" />
						<img class="brand-img img-fluid" src="{{ asset('/') }}assets/img/logo-light.png" alt="brand" />
					</a>
					<button class="btn btn-icon btn-rounded btn-flush-dark flush-soft-hover navbar-toggle">
						<span class="icon">
							<span class="svg-icon fs-5">
								<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-bar-to-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
									<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
									<line x1="10" y1="12" x2="20" y2="12"></line>
									<line x1="10" y1="12" x2="14" y2="16"></line>
									<line x1="10" y1="12" x2="14" y2="8"></line>
									<line x1="4" y1="4" x2="4" y2="20"></line>
								</svg>
							</span>
						</span>
					</button>
				</span>
    </div>
    <!-- /Brand -->
    <!-- Main Menu -->
    <div data-simplebar class="nicescroll-bar">
        <div class="menu-content-wrap">
            <div class="menu-group">
                <div class="nav-header">
                </div>
                <ul class="navbar-nav flex-column">
                    @role('admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.index') }}">
                            <i class="fa fa-meteor fs-5 px-2"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.course.index') }}">
                            <i class="fa fa-book fs-5 px-2"></i>
                            <span class="nav-link-text">Course Module</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.student.list') }}">
                            <i class="fa fa-users fs-5 px-2"></i>
                            <span class="nav-link-text">Student Module</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.teacher.list') }}">
                            <i class="fa fa-users-cog fs-5 px-2"></i>
                            <span class="nav-link-text">Teacher Module</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.setting') }}">
                            <i class="fa fa-cog fs-5 px-2"></i>
                            <span class="nav-link-text">Settings Module</span>
                        </a>
                    </li>
                    @endrole
                    @role('creator')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('creator.index') }}">
                            <i class="fa fa-newspaper fs-5 px-2"></i>
                            <span class="nav-link-text">Exam Module</span>
                        </a>
                    </li>
                    @endrole
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#dash_task">
                            <i class="fa fa-user-cog fs-5 px-2"></i>
                            <span class="nav-link-text">User Module</span>
                            <span class="badge badge-soft-success ms-2">2</span>
                        </a>
                        <ul id="dash_task" class="nav flex-column collapse  nav-children">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user.profile') }}"><span class="nav-link-text">Update Profile</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user.password.change') }}"><span class="nav-link-text">Change Password</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Main Menu -->
</div>
<div id="hk_menu_backdrop" class="hk-menu-backdrop"></div>

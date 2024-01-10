<section class="d-lg-none hk-fixed-footer">
    <div class="row">
        <div class="col-md-12">
            @role('creator')
            <!--student-->
            <div class="row display-1 text-center px-6 bg-light">
                <div class="col-3 border border-secondary rounded-4"><a class="fa fa-newspaper" href="{{ route('creator.index') }}"></a></div>
                <div class="col-3 border border-primary rounded-4"><a class="fa fa-chart-bar" href="{{ route('creator.exam.list') }}"></a></div>
                <div class="col-3 border border-secondary rounded-4"><a class="fa fa-bell" href="{{ route('creator.notice') }}"></a></div>
                <div class="col-3 border border-primary rounded-4">
                    <a class="fa fa-user-cog" data-bs-toggle="dropdown"></a>
                    <ul class="dropdown-menu">
                        <li class="border border-secondary rounded-4 mb-1"><a class="dropdown-item fa fa-user-edit" href="{{ route('user.profile') }}">&nbsp;Update Profile</a></li>
                        <li class="border border-secondary rounded-4 mb-1"><a class="dropdown-item fa fa-key" href="{{ route('user.password.change') }}">&nbsp;Change Password</a></li>
                        <li class="border border-secondary rounded-4"><a class="dropdown-item fa fa-sign-out-alt" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">&nbsp;Logout</a></li>
                    </ul>
                </div>
            </div>
            <!--/student <i class="fa-regular fa-users-medical"></i>-->
            @else
            <!--teacher-->
            <div class="row display-2 text-center px-6 bg-light rounded-4">
                <div class="col-3 border border-secondary rounded-4"><a class="fa fa-newspaper" href="{{ route('subscriber.index') }}"></a></div>
                <div class="col-3 border border-primary rounded-4"><a class="fa fa-chart-line" href="{{ route('subscriber.previous.result') }}"></a></div>
                <div class="col-3 border border-secondary rounded-4"><a class="fa fa-bell" href="{{ route('subscriber.notice') }}"></a></div>
                <div class="col-3 border border-primary rounded-4">
                    <a class="fa fa-user-cog" data-bs-toggle="dropdown"></a>
                    <ul class="dropdown-menu">
                        <li class="border border-secondary rounded-4 mb-1"><a class="dropdown-item fa fa-user-edit" href="{{ route('user.profile') }}">&nbsp;Update Profile</a></li>
                        <li class="border border-secondary rounded-4 mb-1"><a class="dropdown-item fa fa-key" href="{{ route('user.password.change') }}">&nbsp;Change Password</a></li>
                        <li class="border border-secondary rounded-4"><a class="dropdown-item fa fa-sign-out-alt" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">&nbsp;Logout</a></li>
                    </ul>
                </div>
            </div>
            <!--/teacher-->
            @endrole
        </div>
    </div>
    <form action="{{ route('auth.logout') }}" method="post" id="logoutForm">@csrf</form>
</section>

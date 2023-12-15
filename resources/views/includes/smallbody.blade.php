<section id="mbody">
    <div class="container-xxl">
        <!-- Page Header -->
        <div class="row">
            <div class="col-md-12 border border-secondary">
                <h2 class="text-center m-1">@yield('head')</h2>
            </div>
        </div>
        <!-- /Page Header -->
        <!-- Page Body -->
        @if($user->status == 1)
        @yield('body')
        @else
            <h3 class="text-danger text-center">You're under activation process please wait..</h3>
        @endif
        <!-- /Page Body -->
    </div>
</section>

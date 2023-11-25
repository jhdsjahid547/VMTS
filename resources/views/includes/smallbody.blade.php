<section class="d-none d-lg-block hk-pg-wrapper">
    <div class="container-xxl">
        <!-- Page Header -->
        <div class="row">
            <div class="col-md-12 border border-secondary">
                <h2 class="text-center m-1">@yield('head')</h2>
            </div>
        </div>
        <!-- /Page Header -->
        <!-- Page Body -->
        @yield('body')
        <!-- /Page Body -->
    </div>
</section>

<section class="d-lg-none">
    <div class="container-xxl">
        <!-- Page Header -->
        <div class="row">
            <div class="col-md-12 border border-secondary">
                <h2 class="text-center m-1">@yield('head')</h2>
            </div>
        </div>
        <!-- /Page Header -->
        <!-- Page Body -->
        @yield('body')
        <!-- /Page Body -->
    </div>
</section>

@include('includes.header')
@role('creator|subscriber')
    <!--Bottom Navbar-->
    @include('includes.bottomnav')
    <!--Bottom Navbar-->
@endrole
    <!-- Vertical Nav -->
    @include('includes.sidenav')
    <!-- /Vertical Nav -->
    <!-- Top Navbar -->
    @include('includes.topbar')
    <!-- /Top Navbar -->
@role('admin')
<!-- Main Content Normal-->
@include('includes.bigbody')
<!-- /Main Content Noraml -->
@else
<!-- Main Content Small Screen-->
@include('includes.smallbody')
<!-- Main Content Small Screen-->
@endrole
@include('includes.footer')

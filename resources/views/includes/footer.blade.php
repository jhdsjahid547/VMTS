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

<!-- Data Table JS -->
<script src="{{ asset('/') }}assets/datatables/datatables.min.js"></script>
{{--<script src="assets/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="assets/datatables.net-select/js/dataTables.select.min.js"></script>--}}
{{--<script src="assets/js/dataTables-data.js"></script>--}}

<!-- Init JS -->
<script src="{{ asset('/') }}assets/js/init.js"></script>
<script src="{{ asset('/') }}assets/js/chips-init.js"></script>
<!-- Toastr -->
<script src="{{ asset('/') }}assets/js/toastr.min.js"></script>
<!-- Custom Script -->
@role('creator|subscriber')
    <script type="text/javascript">
        if($(window).width() <= 991) {
            $("#mbody").attr("class", "d-lg-none");
            $("#footer-fix").attr("class", "mb-8");
        }
        else{
            $("#mbody").attr("class", "d-none d-lg-block hk-pg-wrapper");
        }
        $(window).on("resize", function() { //when project finished use only condition
            if($(window).width() <= 991) {
                $("#mbody").attr("class", "d-lg-none");
                $("#footer-fix").attr("class", "mb-8");
            }
            else{
                $("#mbody").attr("class", "d-none d-lg-block hk-pg-wrapper");
            }
        } );
    </script>
@endrole
@yield('script')
</body>
</html>

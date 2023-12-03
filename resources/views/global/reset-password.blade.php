@extends('master')
@section('title', 'password change')
@section('csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('head', 'Password Change')
@section('body')
    <section class="pt-2">
        <div class="container-fluid">
            <!-- Row -->
            <div class="row">
                <div class="col-md-6 position-relative mx-auto">
                    <div class="row">
                        <div class="card card-lg card-border">
                            <form id="passwordForm" action="javascript:void(0)" method="post">
                                <div class="card-body">
                                <div class="row gx-3">
                                    <div class="form-group col-lg-12">
                                        <div class="form-label-group">
                                            <label>Old Password</label>
                                        </div>
                                        <div class="input-group password-check">
                                            <span class="input-affix-wrapper">
                                                <input name="password" class="form-control" placeholder="Enter your old password" type="password">
                                                <a href="#" class="input-suffix text-muted">
                                                    <span class="feather-icon"><i class="form-icon" data-feather="eye"></i></span>
                                                    <span class="feather-icon d-none"><i class="form-icon" data-feather="eye-off"></i></span>
                                                </a>
                                                <span id="passwordError" class="text-danger"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <div class="form-label-group">
                                            <label>New Password</label>
                                        </div>
                                        <div class="input-group password-check">
                                            <span class="input-affix-wrapper">
                                                <input name="new_password" class="form-control" placeholder="Enter new password" type="password">
                                                <a href="#" class="input-suffix text-muted">
                                                    <span class="feather-icon"><i class="form-icon" data-feather="eye"></i></span>
                                                    <span class="feather-icon d-none"><i class="form-icon" data-feather="eye-off"></i></span>
                                                </a>
                                                <span id="new_passwordError" class="text-danger"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <div class="form-label-group">
                                            <label>Confirm Password</label>
                                        </div>
                                        <div class="input-group password-check">
                                            <span class="input-affix-wrapper">
                                                <input id="password-confirmation" name="password_confirmation" class="form-control" placeholder="Enter confirm password" type="password">
                                                <a href="#" class="input-suffix text-muted">
                                                    <span class="feather-icon"><i class="form-icon" data-feather="eye"></i></span>
                                                    <span class="feather-icon d-none"><i class="form-icon" data-feather="eye-off"></i></span>
                                                </a>
                                                <span id="password_confirmationError" class="text-danger"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                    <button id="saveBtn" type="submit" class="btn btn-primary btn-uppercase btn-block">Update Password</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Row -->
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#passwordForm").submit(function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ route('user.password.update') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: (data) => {
                    if($.isEmptyObject(data.invalid)) {
                        toastr.success(data.success, 'CONGRATULATION');
                    }else {
                        $.each(data.invalid, function (key, value) {
                            $('#'+key+'Error').html(value);
                        });
                    }
                },
                error: function () {
                    toastr.error('Something went wrong', 'System Alert!');
                }
            });
        });
    </script>
@endsection

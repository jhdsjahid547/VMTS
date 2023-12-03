@extends('master')
@section('title', 'Profile')
@section('csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('head', 'Profile Information')
@section('body')
    <section class="pt-2">
        <div class="container-fluid">
            <div class="col-lg-6 mx-auto">
                <div class="card mb-4">
                    <div class="card-body">
                        <a id="route" class="d-none" href="{{ route('user.profile.update',$user->id) }}"></a>
                        <form action="javascript:void(0)" id="profileForm" method="post">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p id="nameText" class="text-muted mb-0">{{ $user->name }}</p>
                                    <input id="nameInput"  type="text" name="name" class="d-none form-control" value="{{ $user->name }}">
                                    <span id="nameError" class="text-danger"></span>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p id="emailText" class="ext-muted mb-0">{{ $user->email }}</p>
                                    <input id="emailInput"  type="email" name="email" class="d-none form-control" value="{{ $user->email }}" disabled>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="button" id="editBtn" onclick="cng()" class="btn btn-success d-inline-block">Edit</button>
                                    <button type="submit" id="saveBtn" onclick="upd()" class="d-none btn btn-success d-inline-block">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
        function cng() {
            $("#nameText").addClass("d-none");
            $("#emailText").addClass("d-none");
            $("#editBtn").addClass("d-none");
            $("#nameInput").removeClass("d-none");
            $("#emailInput").removeClass("d-none");
            $("#saveBtn").removeClass("d-none");
        }
        $("#profileForm").submit(function (e) {
            e.preventDefault();
            const profileRoute = $("#route").attr("href");
            const formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: profileRoute,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: (data) => {
                    toastr.success(data.success, 'CONGRATULATION');
                    $("#nameText").html($("#nameInput").val());
                    $("#nameText").removeClass("d-none");
                    $("#emailText").removeClass("d-none");
                    $("#editBtn").removeClass("d-none");
                    $("#nameInput").addClass("d-none");
                    $("#emailInput").addClass("d-none");
                    $("#saveBtn").addClass("d-none");
                },
                error: function () {
                    toastr.error('Something went wrong', 'System Alert!');
                }
            });
        });
    </script>
@endsection

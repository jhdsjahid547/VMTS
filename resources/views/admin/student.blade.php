@extends('master')
@section('title', 'Students')
@section('csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('head', 'Manage Students')
@section('body')
    <section class="pt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 py-2">
                    <button class="btn btn-primary rounded-0" onclick="add()">Add Student</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table id="studentList" class="table nowrap w-100">
                        <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Course</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                    <!--Create Course Modal-->
                    <div class="modal fade" id="createStudent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createStudentLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-0">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createStudentLabel">Add New Student</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="javascript:void(0)" id="studentForm" method="post">
                                        <input type="hidden" id="id" name="id">
                                        <div class="row p-2">
                                            <div class="col-3">
                                                <span>Name</span>
                                            </div>
                                            <div class="col-9">
                                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter student name"/>
                                                <span id="nameError" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                <span>Email</span>
                                            </div>
                                            <div class="col-9">
                                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter student subject"/>
                                                <span id="emailError" class="text-danger"></span>
                                            </div>
                                        </div>
                                       <div class="row p-2">
                                            <div class="col-3">
                                                <span>Course</span>
                                            </div>
                                            <div class="col-9">
                                                <select id="course_id" name="course_id" class="form-select" aria-label="Course select"></select>
                                                <span id="course_idError" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                <span>Status</span>
                                            </div>
                                            <div class="col-9">
                                                <select id="status" name="status" class="form-select" aria-label="Status select">
                                                    <option id="default" value="" selected disabled>Select Status</option>
                                                    <option id="active" value="1">Active</option>
                                                    <option id="disable" value="0">Disable</option>
                                                </select>
                                                <span id="statusError" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                <span>Password</span>
                                            </div>
                                            <div class="col-9">
                                                <input type="text" id="password" name="password" class="form-control" value="password"/>
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3"></div>
                                            <div class="col-9">
                                                <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" id="btnSave" class="btn btn-primary rounded-0">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/Create Course Modal-->
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
        function showInvalid(msg) {
            $.each(msg, function (key, value) {
                $('#'+key+'Error').html(value);
            });
        }
        function resetValidation() {
            $('#nameError').html("");
            $('#emailError').html("");
            $('#course_idError').html("");
        }
        const table = $('#studentList').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.student.list') }}",
            columns: [
                { data: "DT_RowIndex" },
                { data: "name" },
                { data: "email" },
                { data: "status",
                    render: function(data){
                        badge = "";
                        if (data === "active") {
                            badge = `<span class="badge badge-success">${data}</span>`;
                        } else {
                            badge = `<span class="badge badge-warning">${data}</span>`;
                        }
                        return badge;
                    }
                },
                { data: "course",
                    render: function(data){
                    badge = "";
                        if (data === "not set yet") {
                            badge = `<span class="badge bg-danger badge-pill">${data}</span>`;
                        } else {
                            return data;
                        }
                        return badge;
                    }
                },
                { data: "action", orderable: false },
            ],
            order: [[0, "desc"]]
        });
        function add() {
            $("#password").prop("readonly", true);
            resetValidation();
            $.ajax({
                type : "POST",
                url: "{{ route('admin.show.info') }}",
                data: "",
                dataType: "json",
                success: function (data) {
                    let selectCourse = $("#course_id");
                    selectCourse.empty();
                    let option = "";
                    option += `<option value="" disabled selected> -- Select Course -- </option>`;
                    for (let course of data.course) {
                        option += `<option value="${course.id}">${course.name}</option>`;
                    }
                    selectCourse.append(option);
                }
            });
            $("#studentForm").trigger("reset");
            $("#createStudentLabel").html("Add New Student");
            $("#btnSave").html("Create");
            $("#createStudent").modal("show");
            $("#id").val("");
        }
        function editFunc(id){
            resetValidation();
            $("#password").removeAttr("readonly").val("");
            $.ajax({
                type:"POST",
                url: "{{ route('admin.show.info') }}",
                data: { id: id },
                dataType: "json",
                success: function(data){
                    let selectCourse = $("#course_id");
                    selectCourse.empty();
                    let option = "";
                    $("#createStudentLabel").html("Edit Student");
                    $("#btnSave").html("Update");
                    $('#createStudent').modal("show");
                    $("#id").val(data.student.id);
                    $("#name").val(data.student.name);
                    $("#email").val(data.student.email);
                    for (let course of data.course) {
                        if(data.student.subj === null) {
                            option += `<option value="${course.id}">${course.name}</option>`;
                        } else if(course.id === data.student.subj.course_id) {
                            option += `<option value="${course.id}" selected>${course.name}</option>`;
                        } else {
                            option += `<option value="${course.id}">${course.name}</option>`;
                        }
                    }
                    selectCourse.append(option);
                    if (data.student.status === 1) {
                        $("#active").prop('selected','true');
                    } else if (data.student.status === 0) {
                        $("#disable").prop('selected','true');
                    } else {
                        $("#default").prop('selected','true');
                    }
                }
            });
        }
        function deleteFunc(Id){
            if (confirm("Delete Record?") == true) {
                const id = Id;
                $.ajax({
                    type:"DELETE",
                    url: "{{ route('admin.student.remove') }}",
                    data: { id: id },
                    dataType: "json",
                    success: function(res){
                        table.draw();
                        toastr.warning(res.success, 'Alert');
                    },
                    error: function () {
                        toastr.error('Something went wrong', 'System Alert!');
                    }
                });
            }
        }
        function swapFunc(Id){
            const id = Id;
            $.ajax({
                type:"POST",
                url: "{{ route('admin.student.status') }}",
                data: { id: id },
                dataType: "json",
                success: function(res){
                    table.draw();
                    if (res.success === "active") {
                        toastr.success("Status change to "+res.success, 'Alert');
                    } else {
                        toastr.warning("Status change to "+res.success, 'Alert');
                    }
                },
                error: function () {
                    toastr.error('Something went wrong', 'System Alert!');
                }
            });
        }
        $("#studentForm").submit(function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ route('admin.student.submit') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: (data) => {
                    table.draw();
                    $("#btnSave"). attr("disabled", false);
                    if($.isEmptyObject(data.invalid)) {
                        resetValidation();
                        if($("#createStudentLabel").html() === "Edit Student")
                        {
                            $("#createStudent").modal("hide");
                        }
                        toastr.success(data.success, 'CONGRATULATION');
                    }else {
                        showInvalid(data.invalid);
                    }
                },
                error: function () {
                    toastr.error('Something went wrong', 'System Alert!');
                }
            });
        });
    </script>
@endsection

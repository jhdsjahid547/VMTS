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
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                <span>Password</span>
                                            </div>
                                            <div class="col-9">
                                                <input type="text" id="password" name="password" class="form-control" value="password" readonly/>
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
        const table = $('#studentList').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.student.list') }}",
            columns: [
                { data: "DT_RowIndex" },
                { data: "name" },
                { data: "email" },
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
            $.ajax({
                type : "POST",
                url: "{{ route('admin.show.info') }}",
                data: "",
                success: function (data) {
                    let selectCourse = $("#course_id");
                    selectCourse.empty();
                    let option = "";
                    option += `<option value=" " disabled selected> -- Select Course -- </option>`;
                    for (let course of data.course) {
                        option += `<option value="${course.id}">${course.name}</option>`;
                    }
                    selectCourse.append(option);
                }
            });
            /*resetValidation();*/
            $("#studentForm").trigger("reset");
            $("#createStudentLabel").html("Add New Student");
            $("#btnSave").html("Create");
            $("#createStudent").modal("show");
            $("#id").val("");
        }
        function editFunc(id){
            /*resetValidation();*/
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
                success: (data) => {
                    console.log(data)
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection

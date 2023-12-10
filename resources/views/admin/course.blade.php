@extends('master')
@section('title', 'Courses')
@section('csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('head', 'Manage Courses')
@section('body')
    <section class="pt-2">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12 py-2">
                    <button class="btn btn-primary rounded-0" onclick="add()">Create Course</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table id="courseList" class="table nowrap w-100">
                        <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                    <!--Create Course Modal-->
                    <div class="modal fade" id="createCourse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createCourseLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-0">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createCourseLabel">Create New Course</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="javascript:void(0)" id="courseForm" method="post">
                                        <input type="hidden" id="id" name="id">
                                        <div class="row p-2">
                                            <div class="col-3">
                                                <span>Name</span>
                                            </div>
                                            <div class="col-9">
                                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter subject name"/>
                                                <span id="nameError" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                <span>Code</span>
                                            </div>
                                            <div class="col-9">
                                                <input type="number" id="code" name="code" class="form-control" placeholder="Enter subject code"/>
                                                <span id="codeError" class="text-danger"></span>
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
            $("#"+key+"Error").html(value);
        });
    }
    function resetValidation() {
        $('#nameError').html("");
        $('#codeError').html("");
    }
    const table = $("#courseList").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.course.index') }}",
        columns: [
            { data: "DT_RowIndex"},
            { data: "name"},
            { data: "code"},
            { data: "action", orderable: false},
        ],
        order: [[0, "desc"]]
    });
    function add() {
        $.ajax({
            type: "POST"
        });
        resetValidation();
        $("#courseForm").trigger("reset");
        $("#createCourseLabel").html("Create New Course");
        $("#btnSave").html("Create");
        $("#createCourse").modal("show");
        $("#id").val("");
    }
    function editFunc(id){
        resetValidation();
        $.ajax({
            type:"GET",
            url: "{{ route('admin.course.create') }}",
            data: { id: id },
            dataType: "json",
            success: function(res){
                $("#createCourseLabel").html("Edit Course");
                $("#btnSave").html("Update");
                $('#createCourse').modal("show");
                $("#id").val(res.id);
                $("#name").val(res.name);
                $("#code").val(res.code);
            }
        });
    }
    function deleteFunc(Id){
        if (confirm("Delete Record?") == true) {
            const id = Id;
            $.ajax({
                type:"DELETE",
                url: "{{ route('admin.course.destroy', 0) }}",
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
    $("#courseForm").submit(function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "{{ route('admin.course.store') }}",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $("#btnSave"). attr("disabled", false);
                if($.isEmptyObject(data.invalid)) {
                    toastr.success(data.success, "CONGRATULATION");
                    $("#createCourse").modal("hide");
                    resetValidation()
                    table.draw();
                }else {
                    showInvalid(data.invalid);
                }
            },
            error: function () {
                toastr.error("Something went wrong", "System Alert!");
            }
        });
    });
</script>
@endsection

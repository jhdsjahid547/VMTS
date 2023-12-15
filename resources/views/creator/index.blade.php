@extends('master')
@section('title', 'Exam')
@section('csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('head', 'Ready Exam Question')
@section('body')
    <section class="pt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 py-2">
                    <button class="btn btn-primary rounded-0" onclick="add()">Create Question Panel</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table id="panelList" class="table nowrap w-100">
                        <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Exam Title</th>
                            <th>Course Name</th>
                            <th>Negative Mark</th>
                            <th>Time Limit</th>
                            <th>Passing Rate</th>
                            <th>Question Limit</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                    <!--<form action="javascript:void(0)" method="post" id="submitForm"></form>-->
                    <!--Create Course Modal-->
                    <div class="modal fade" id="createPanel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createPanelLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content rounded-0">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createPanelLabel">Create New Question Panel</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="javascript:void(0)" id="panelForm" method="post">
                                        <div class="row p-2">
                                            <div class="col-3">
                                                <label for="title">Exam Title</label>
                                            </div>
                                            <div class="col-9">
                                                <input type="text" name="title" id="title" class="form-control" placeholder="Enter exam title"/>
                                                <span id="titleError" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                <label for="course">Select Course</label>
                                            </div>
                                            <div class="col-9">
                                                <select name="course" id="course" class="form-select" aria-label="Course select">
                                                    <option selected disabled>Select Course</option>
                                                    @foreach($courses as $course)
                                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span id="courseError" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                <label for="time-limit">Time Limit</label>
                                            </div>
                                            <div class="col-9">
                                                <select name="time_limit" id="time-limit" class="form-select" aria-label="Time limit select">
                                                    <option selected disabled>Select Time</option>
                                                    @foreach($timeLimits as $timeLimit)
                                                        <option value="{{ $timeLimit->id }}">{{ $timeLimit->value }} Minute</option>
                                                    @endforeach
                                                </select>
                                                <span id="time_limitError" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                <label for="negative-mark">Negative Mark</label>
                                            </div>
                                            <div class="col-9">
                                                <select name="negative_mark" id="negative-mark" class="form-select" aria-label="negative mark select">
                                                    @foreach($negativeMarks as $negativeMark)
                                                        <option value="{{ $negativeMark->id }}" {{ $negativeMark->value == '0.00' ? 'selected' : '' }}>{{ $negativeMark->value }}</option>
                                                    @endforeach
                                                </select>
                                                <span id="negative_markError" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                <label for="passing-rate">Passing Rate</label>
                                            </div>
                                            <div class="col-9">
                                                <select name="passing_rate" id="passing-rate" class="form-select" aria-label="passing rate select">
                                                    <option selected disabled>Select Passing Rate</option>
                                                    @foreach($passRates as $rate)
                                                        <option value="{{ $rate->id }}">{{ $rate->value }}%</option>
                                                    @endforeach
                                                </select>
                                                <span id="passing_rateError" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                <label for="question-limit">Question Limit</label>
                                            </div>
                                            <div class="col-9">
                                                <input type="number" name="question_limit" id="question-limit" class="form-control" placeholder="Enter question limit"/>
                                                <span id="question_limitError" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3">
                                                <label for="description">Description</label>
                                            </div>
                                            <div class="col-9">
                                                <textarea name="description" id="description" class="form-control" cols="5" rows="2" placeholder="Enter exam description"></textarea>
                                                <span id="descriptionError" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="col-3"></div>
                                            <div class="col-9">
                                                <div class="float-end">
                                                    <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" id="btnSave" class="btn btn-primary rounded-0">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/Create Panel Modal-->
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        const panelForm = $("#panelForm")
        //Open create popup
        function add() {
            panelForm.trigger("reset");
            $("#createPanel").modal("show");
        }
        //Submit form
        $(panelForm).on("submit", function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                type: "POST",
                contentType: false,
                url: "{{ route('creator.exam.submit') }}",
                data: formData, //instead of JSON.stringify({}),
                dataType: "json",
                cache: false,
                processData:false,
                beforeSend: function (quick) {
                    return quick.setRequestHeader("X-CSRF-TOKEN", $("meta[name='csrf-token']").attr("content"));
                },
                success: function (response) {
                    $(panelForm).trigger("reset");
                    if($.isEmptyObject(response.invalid)) {
                        toastr.success(response.success, "CONGRATULATION");
                        table.draw();
                    }else {
                        $.each(response.invalid, function (key, value) {
                            $("#"+key+"Error").html(value);
                        });
                    }
                },
                error: function () {
                    toastr.error("Something went wrong", "System Alert!");
                }
            });
        });
        //Show exam list
        let table = $('#panelList').DataTable({
            serverSide: true,
            responsive: true,
            processing: true,
            ajax: "{{ route('creator.index') }}",
            columns: [
                { data: "DT_RowIndex" },
                { data: "title" },
                { data: "course_id" },
                { data: "negative_mark_id" },
                { data: "time_limit_id" },
                { data: "pass_mark_id" },
                { data: "question_limit" },
                { data: "action" },
            ],
            order: [[0, "desc"]]
        });

        function swap(id) {
            let url = "{{ route('creator.exam.activity', ':id') }}";
            url = url.replace(":id", id);
            $.ajax({
                type: "POST",
                contentType: "application/json",
                url: url,
                dataType: "json",
                cache: false,
                processData:false,
                beforeSend: function (quick) {
                    return quick.setRequestHeader("X-CSRF-TOKEN", $("meta[name='csrf-token']").attr("content"));
                },
                success: function(response){
                    if (response.success === "active") {
                        toastr.success("Status change to "+response.success, 'Alert');
                    } else {
                        toastr.warning("Status change to "+response.success, 'Alert');
                    }
                    table.draw();
                },
                error: function () {
                    toastr.error('Something went wrong', 'System Alert!');
                }
            });
        }
        function distroy(id){
            let url = "{{ route('creator.exam.distroy', ':id') }}";
            url = url.replace(":id", id);
            if (confirm("Delete Record?") === true) {
                $.ajax({
                    type:"DELETE",
                    contentType: "application/json",
                    url: url,
                    dataType: "json",
                    cache: false,
                    processData:false,
                    beforeSend: function (quick) {
                        return quick.setRequestHeader("X-CSRF-TOKEN", $("meta[name='csrf-token']").attr("content"));
                    },
                    success: function(response){
                        toastr.warning(response.success, 'Alert');
                        table.draw();
                    },
                    error: function () {
                        toastr.error('Something went wrong', 'System Alert!');
                    }
                });
            }
        }
    </script>
@endsection

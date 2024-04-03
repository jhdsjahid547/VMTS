@extends('master')
@section('title', 'Manage Exam')
@section('csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('head', 'Update or Create Question')
@section('body')
    <section class="pt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card rounded-0">
                        <div class="card-header py-3">
                            <h5 class="text-primary text-uppercase"><i class="fa fa-exclamation-circle"></i>&nbsp;Exam Information</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('creator.exam.update', $exam->id) }}" id="panelForm" method="post">
                                <div class="row p-2">
                                    <div class="col-3">
                                        <label for="global">For All</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="checkbox" name="global" id="global" value="1" class="form-check" {{ $exam->global == 1 ? 'checked' : '' }}/>
                                        <span id="titleError" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <div class="col-12">
                                        <label for="title">Exam Title</label>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" name="title" id="title" class="form-control" value="{{ $exam->title }}" placeholder="Enter exam title"/>
                                        <span id="titleError" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <div class="col-12">
                                        <label for="course">Select Course</label>
                                    </div>
                                    <div class="col-12">
                                        <select name="course" id="course" class="form-select" aria-label="Course select">
                                            <option selected disabled>Select Course</option>
                                            @foreach($courses as $course)
                                                <option value="{{ $course->id }}" {{ $course->id == $exam->course_id ? 'selected' : '' }}>{{ $course->name }}</option>
                                            @endforeach
                                        </select>
                                        <span id="courseError" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <div class="col-12">
                                        <label for="time-limit">Time Limit</label>
                                    </div>
                                    <div class="col-12">
                                        <select name="time_limit" id="time-limit" class="form-select" aria-label="Time limit select">
                                            <option selected disabled>Select Time(in minute)</option>
                                            @foreach($timeLimits as $timeLimit)
                                                <option value="{{ $timeLimit->id }}" {{ $timeLimit->id == $exam->time_limit_id ? 'selected' : '' }}>{{ $timeLimit->value }}</option>
                                            @endforeach
                                        </select>
                                        <span id="time_limitError" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <div class="col-12">
                                        <label for="negative-mark">Negative Mark</label>
                                    </div>
                                    <div class="col-12">
                                        <select name="negative_mark" id="negative-mark" class="form-select" aria-label="negative mark select">
                                            @foreach($negativeMarks as $negativeMark)
                                                <option value="{{ $negativeMark->id }}" {{ $negativeMark->id == $exam->negative_mark_id ? 'selected' : '' }}>{{ $negativeMark->value }}</option>
                                            @endforeach
                                        </select>
                                        <span id="negative_markError" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <div class="col-12">
                                        <label for="passing-rate">Passing Rate</label>
                                    </div>
                                    <div class="col-12">
                                        <select name="passing_rate" id="passing-rate" class="form-select" aria-label="passing rate select">
                                            @foreach($passRates as $rate)
                                                <option value="{{ $rate->id }}" {{ $rate->id == $exam->pass_mark_id ? 'selected' : '' }}>{{ $rate->value }}%</option>
                                            @endforeach
                                        </select>
                                        <span id="passing_rateError" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <div class="col-12">
                                        <label for="question-limit">Question Limit</label>
                                    </div>
                                    <div class="col-12">
                                        <input type="number" name="question_limit" id="question-limit" class="form-control" value="{{ $exam->question_limit }}" placeholder="Enter question limit"/>
                                        <span id="question_limitError" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <div class="col-12">
                                        <label for="description">Description</label>
                                    </div>
                                    <div class="col-12">
                                        <textarea name="description" id="description" class="form-control" cols="5" rows="2" placeholder="Enter exam description">{{ $exam->description }}</textarea>
                                        <span id="descriptionError" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="row p-2 float-end">
                                    <div class="col-12">
                                        <button type="reset" class="btn btn-gradient-dark rounded-0">Reset</button>
                                        <button type="submit" id="btnSave" class="btn btn-gradient-primary rounded-0">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <div class="col-10">
                                <h5 class="text-primary text-uppercase"><span id="question-count" class="badge badge-primary badge-pill">{{ $count }}</span>&nbsp;Exam Question's</h5>
                            </div>
                            <div class="col-2">
                                <button type="submit" id="addQuestion" class="btn btn-gradient-primary float-end fa fa-plus btn-sm">&nbsp;Add</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="questionList" class="table table-responsive table-borderless table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                            <!--Create Course Modal-->
                            <div class="modal fade" id="questionAction" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createQuestionLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content rounded-0">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="createQuestionLabel">Create New Question</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="javascript:void(0)" id="questionForm" method="post">
                                               <div class="row">
                                                   <div class="col-md-12">
                                                       <input type="hidden" name="exam_id" id="examId" value="{{ $exam->id }}">
                                                       <input type="hidden" name="question_id" id="question-id">
                                                       <div class="row p-2">
                                                           <div class="col-12">
                                                               <span id="idError" class="text-danger"></span>
                                                           </div>
                                                           <div class="col-12">
                                                               <label for="question-name">Question Name</label>
                                                           </div>
                                                           <div class="col-12">
                                                               <input type="text" name="question" id="question-name" class="form-control" aria-label="question name" placeholder="Enter question name">
                                                               <span id="questionError" class="text-danger"></span>
                                                           </div>
                                                       </div>
                                                       <div class="row">
                                                           <div class="col-12">
                                                               <h6 class="text-warning ps-2">Select left side dot(<i class="fa fa-circle text-primary"></i>) button for correct answer.</h6>
                                                               <span id="correct_answerError" class="text-danger ps-2"></span>
                                                           </div>
                                                       </div>
                                                       <div class="row p-2">
                                                           <div class="col-12">
                                                               <label for="choice-one">First Choice</label>
                                                           </div>
                                                           <div class="col-12">
                                                               <div class="input-group">
                                                                   <div class="input-group-text">
                                                                       <input type="radio" name="correct_answer" id="option-one" class="form-check-input mt-0"  aria-label="choice one radio">
                                                                   </div>
                                                                   <input type="text" name="choice_one" id="choice-one" class="form-control" aria-label="first choice" placeholder="Enter first choice ">
                                                               </div>
                                                               <span id="choice_oneError" class="text-danger"></span>
                                                           </div>
                                                       </div>
                                                       <div class="row p-2">
                                                           <div class="col-12">
                                                               <label for="choice-two">Second Choice</label>
                                                           </div>
                                                           <div class="col-12">
                                                               <div class="input-group">
                                                                   <div class="input-group-text">
                                                                       <input type="radio" name="correct_answer" id="option-two" class="form-check-input mt-0"  aria-label="choice two radio">
                                                                   </div>
                                                                   <input type="text" name="choice_two" id="choice-two" class="form-control" aria-label="second choice" placeholder="Enter second choice ">
                                                               </div>
                                                               <span id="choice_twoError" class="text-danger"></span>
                                                           </div>
                                                       </div>
                                                       <div class="row p-2">
                                                           <div class="col-12">
                                                               <label for="choice-three">Third Choice</label>
                                                           </div>
                                                           <div class="col-12">
                                                               <div class="input-group">
                                                                   <div class="input-group-text">
                                                                       <input type="radio" name="correct_answer" id="option-three" class="form-check-input mt-0"  aria-label="choice three radio">
                                                                   </div>
                                                                   <input type="text" name="choice_three" id="choice-three" class="form-control" aria-label="third choice" placeholder="Enter third choice ">
                                                               </div>
                                                               <span id="choice_threeError" class="text-danger"></span>
                                                           </div>
                                                       </div>
                                                       <div class="row p-2">
                                                           <div class="col-12">
                                                               <label for="choice-four">Fourth Choice</label>
                                                           </div>
                                                           <div class="col-12">
                                                               <div class="input-group">
                                                                   <div class="input-group-text">
                                                                       <input type="radio" name="correct_answer" id="option-four" class="form-check-input mt-0"  aria-label="choice four radio">
                                                                   </div>
                                                                   <input type="text" name="choice_four" id="choice-four" class="form-control" aria-label="fourth choice" placeholder="Enter fourth choice ">
                                                               </div>
                                                               <span id="choice_fourError" class="text-danger"></span>
                                                           </div>
                                                       </div>
                                                       <div class="row p-2">
                                                           <div class="col-12">
                                                               <div class="float-end">
                                                                   <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Close</button>
                                                                   <button type="submit" id="btnSave" class="btn btn-primary rounded-0">Save</button>
                                                               </div>
                                                           </div>
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
            </div>
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="{{ route('creator.index') }}" class="btn btn-dark rounded-0 float-end fa fa-angle-double-left">&nbsp;Back</a>
                </div>
            </div>
            <div id="footer-fix"></div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        let url = "{{ route('creator.question.set', ':id') }}";
        url = url.replace(":id", $("#examId").val());
        let count = $("#question-count");
        const table = new $('#questionList').DataTable({
            "dom": 'frtip',
            info: false,
            ordering: false,
            searching: false,
            /*paging: false,*/
            responsive: true,
            scrollCollapse: true,
            scrollY: '450px', //490
            serverSide: true,
            processing: true,
            ajax: url,
            columns: [
                { data: "questions",
                    render: function(data, type, row){
                        let question = `<b>${row['DT_RowIndex']}.&nbsp;${data.question}</b><br>`;
                        $.each(data.choice, function (key, value) {
                            question += `<span class="pl-4 ${value === data.correct ? "text-success" : ""}">${key}&nbsp;-&nbsp;${value}</span><br>`;
                        });
                        return question;
                    }
                },
                { data: "action" },
            ],
        });
        $("#panelForm").on("submit", function (e){
            e.preventDefault();
            let formData = new FormData(this);
            formData.append('_method', 'PATCH');
            $.ajax({
                type: "POST",
                contentType: false,
                url: $(this).attr('action'),
                data: formData,
                dataType: "json",
                cache: false,
                processData: false,
                beforeSend: function (quick) {
                    return quick.setRequestHeader("X-CSRF-TOKEN", $("meta[name='csrf-token']").attr("content"));
                },
                success: function(response){
                    if($.isEmptyObject(response.invalid)) {
                        toastr.success(response.success, "CONGRATULATION");
                    }else {
                        $.each(response.invalid, function (key, value) {
                            $("#"+key+"Error").text(value);
                        });
                    }
                },
                error: function () {
                    toastr.error("Something went wrong", "System Alert!");
                }
            });
        });
        function removeError() {
            $('#idError').text("");
            $('#questionError').text("");
            $('#correct_answerError').text("");
            $('#choice_oneError').text("");
            $('#choice_twoError').text("");
            $('#choice_threeError').text("");
            $('#choice_fourError').text("");
        }
        $("#addQuestion").on("click", function () {
            removeError();
            $("#question-id").removeAttr("value");
            $("#questionForm").trigger("reset");
            $("#questionAction").modal("show");
        });
        function updateQuestion(id) {
            removeError();
            let url = "{{ route('creator.question.show', ':id') }}";
            url = url.replace(":id", id);
            $.ajax({
                type:"GET",
                contentType: "application/json",
                url: url,
                dataType: "json",
                cache: false,
                processData:false,
                beforeSend: function (quick) {
                    return quick.setRequestHeader("X-CSRF-TOKEN", $("meta[name='csrf-token']").attr("content"));
                },
                success: function(response){
                    let one = $("#option-one"), two = $("#option-two"), three = $("#option-three") , four = $("#option-four");
                    $("#questionAction").modal("show");
                    $("#questionForm").trigger("reset");
                    $("#question-name").val(response.question);
                    $("#question-id").val(response.id);
                    $("#choice-one").val(response.choice_one);
                    $("#choice-two").val(response.choice_two);
                    $("#choice-three").val(response.choice_three);
                    $("#choice-four").val(response.choice_four);
                    one.val(response.choice_one);
                    two.val(response.choice_two);
                    three.val(response.choice_three);
                    four.val(response.choice_four);
                    if (one.val() ===  response.correct_answer){
                        one.prop("checked", true);
                    } else if (two.val() === response.correct_answer) {
                        two.prop("checked", true);
                    } else if (three.val() === response.correct_answer) {
                        three.prop("checked", true);
                    } else if (four.val() === response.correct_answer) {
                        four.prop("checked", true);
                    }
                },
                error: function () {
                    toastr.error('Something went wrong', 'System Alert!');
                }
            });
        }
        function deleteQuestion(id) {
            let url = "{{ route('creator.question.distroy', ':id') }}";
            url = url.replace(":id", id);
            if (confirm("Delete Question?") === true) {
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
                        table.draw();
                        toastr.warning(response.success, 'Alert');
                        count.text(parseInt(count.text())-1);
                    },
                    error: function () {
                        toastr.error('Something went wrong', 'System Alert!');
                    }
                });
            }
        }
        $("#choice-one, #choice-two, #choice-three, #choice-four").on("keydown, keyup", function () {
            let a = $('#choice-one').val();
            let b = $('#choice-two').val();
            let c = $('#choice-three').val();
            let d = $('#choice-four').val();
            $('#option-one').val(a);
            $('#option-two').val(b);
            $('#option-three').val(c);
            $('#option-four').val(d);
        });
        $("#questionForm").on("submit", function (e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                contentType: false,
                url: "{{ route('creator.question.submit') }}",
                data: new FormData(this),
                dataType: "json",
                cache: false,
                processData: false,
                beforeSend: function (quick) {
                    return quick.setRequestHeader("X-CSRF-TOKEN", $("meta[name='csrf-token']").attr("content"));
                },
                success: function(response){
                    removeError();
                    if($.isEmptyObject(response.invalid)) {
                        table.draw();
                        toastr.success(response.success, "CONGRATULATION");
                        if (Object.hasOwn(response, "cr")) {
                            count.text(parseInt(count.text())+1);
                        } else {
                            $("#questionAction").modal("hide");
                        }
                    }else {
                        $.each(response.invalid, function (key, value) {
                            $("#"+key+"Error").text(value);
                        });
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            });
        });
    </script>
@endsection

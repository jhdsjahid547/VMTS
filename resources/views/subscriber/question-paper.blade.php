@extends('master')
@section('title', 'Exam Running...')
@section('csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('head')
    {{ $exam->title }}
@endsection
@section('body')
@if (empty($exam->singleAttempt->exam_id))
    <section class="pt-2">
        <div class="container-fluid">
            <div class="row sticky-top border border-danger">
                <div class="col-6">
                    <form name="cd">
                        <input type="hidden" name="" id="timeExamLimit" value="{{ $exam->timeLimit->value }}">
                        <label for="txt" class="fs-3">Remaining Time : </label>
                        <input name="disp" type="text" class="clock border-0 bg-transparent text-danger fw-bold fs-2" id="txt" size="5" readonly/>
                    </form>
                </div>
                <div class="col-6">
                    <h4 class="float-end pt-3">Mark: <span class="text-success">{{ $exam->question_limit }}</span></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 m-4">
                    <form action="{{ route('subscriber.exam.submit', $exam->id) }}" method="post" id="answerForm">
                        <input type="hidden" name="exam_id" id="exam_id" value="{{ $exam->id }}"/>
                        <input type="hidden" name="examAction" id="examAction"/>
                        @forelse($questions as $question)
                            <div class="mcq row pb-4">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md ps-0">
                                        <h4><span>{{ $loop->iteration }}.&nbsp;{{ $question->question }}</span></h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-check">
                                        <label class="form-check-label option" for="choice-{{ ++$i }}">
                                            <input type="radio" id="choice-{{ $i }}" class="form-check-input option-input" name="answer[{{ $question->id }}][correct]" value="{{ $question->choice_one }}">
                                            <span class="set-value fw-bold">ক</span>
                                            {{ $question->choice_one }}
                                        </label>
                                    </div>
                                    <div class="col-md-6 form-check">
                                        <label class="form-check-label option" for="choice-{{ ++$i }}">
                                            <input type="radio" id="choice-{{ $i }}" class="form-check-input option-input" name="answer[{{ $question->id }}][correct]" value="{{ $question->choice_two }}">
                                            <span class="set-value fw-bold">খ</span>
                                            {{ $question->choice_two }}
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-check">
                                        <label class="form-check-label option" for="choice-{{ ++$i }}">
                                            <input type="radio" id="choice-{{ $i }}" class="form-check-input option-input" name="answer[{{ $question->id }}][correct]" value="{{ $question->choice_three }}">
                                            <span class="set-value fw-bold">গ</span>
                                            {{ $question->choice_three }}
                                        </label>
                                    </div>
                                    <div class="col-md-6 form-check">
                                        <label class="form-check-label option" for="choice-{{ ++$i }}">
                                            <input type="radio" id="choice-{{ $i }}" class="form-check-input option-input" name="answer[{{ $question->id }}][correct]" value="{{ $question->choice_four }}">
                                            <span class="set-value fw-bold">ঘ</span>
                                            {{ $question->choice_four }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                            <div class="error">
                                <h3 class="text-danger">Question not found</h3>
                            </div>
                        @endforelse
                        <div class="row">
                            <div class="col-md text-center">
                                <input name="submit" type="submit" value="Submit" class="btn btn-success btn-lg p-3 mt-5 float-right" id="submitAnswerFrmBtn">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="footer-fix"></div>
        </div>
    </section>
@else
    <section class="pt-2">
        <div class="container-fluid">
            <h3 class="text-danger text-center">You already attempt this exam!</h3><br>
            <div class="row">
                <div class="col-6">
                    <a class="float-start btn btn-success" href="{{ $exam->id }}">SEE RESULT</a>
                </div>
                <div class="col-6">
                    <a class="float-end btn btn-info" href="{{ route('subscriber.index') }}">GO BACK</a>
                </div>
            </div>
        </div>
    </section>
@endif
@endsection
@section('script')
    <script type="text/javascript">
        $("#answerForm :input[type=radio]").on("click", function() {
            $(this).closest(".mcq").attr("id", $(this).attr("id"));
            $('div[id^="choice-"] :radio:not(:checked)').attr("disabled", !0);
        });

        var timer2 = $("#timeExamLimit").val()+":01";
        var interval = setInterval(function() {
            var timer = timer2.split(":");
            //by parsing integer, I avoid all extra string processing
            var minutes = parseInt(timer[0], 10);
            var seconds = parseInt(timer[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            if (minutes < 0) clearInterval(interval);
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? "0" + seconds : seconds;
            //minutes = (minutes < 10) ?  minutes : minutes;
            $("#txt").val(minutes + ":" + seconds);
            timer2 = minutes + ":" + seconds;
            if (minutes == 0 && seconds == 1) {
                $("#answerForm").submit();
                window.location.replace("/v/available-exams");
            }
        }, 1000);

        $("#answerForm").on("submit", function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                type: "POST",
                contentType: false,
                url: $(this).attr('action'),
                data: formData, //instead of JSON.stringify({}),
                dataType: "json",
                cache: false,
                processData:false,
                beforeSend: function (quick) {
                    return quick.setRequestHeader("X-CSRF-TOKEN", $("meta[name='csrf-token']").attr("content"));
                },
                success: function (response) {
                    console.log(response);
                },
                error: function (response) {
                    console.log(response);
                }
            });
        });
    </script>
@endsection

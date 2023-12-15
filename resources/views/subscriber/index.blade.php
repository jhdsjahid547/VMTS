@extends('master')
@section('title', 'Available Exams')
@section('head', 'Available Exams')
@section('body')
    <section class="pt-2">
        <div class="container-fluid">
            <div class="row">
                @forelse($exams as $exam)
                <div class="col-6 col-lg-4 p-2">
                    <a href="{{ empty($exam->singleAttempt->exam_id) ? route('subscriber.exam.take', $exam->id)  : route('subscriber.result.show', $exam->id) }}"> <!-- Change route based on condition-->
                        <div class="card h-100 border-4 {{ empty($exam->singleAttempt->exam_id) ? 'border-primary' : 'border-success' }}">
                            <div class="card-header">
                                <h5>{{ Str()->of($exam->title)->limit(25) }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6"><h6 class="fa fa-hourglass-end text-blue">&nbsp;Time: {{ $exam->timeLimit->value }} Minute</h6></div>
                                    <div class="col-6"><h6 class="fa fa-times-circle text-danger">&nbsp;Negative: {{ $exam->negativeMark->value }}</h6></div>
                                </div>
                                <p class="text-muted">{{ Str()->of($exam->description)->limit(30) }}</p>
                            </div>
                            @if(empty($exam->singleAttempt->exam_id))
                                <button class="btn btn-primary rounded-0 btn-uppercase btn-block result" >Start Exam</button>
                            @else
                                <button class="btn btn-success rounded-0 btn-uppercase btn-block result" >See Result</button>
                            @endif
                        </div>
                    </a>
                </div>
                @empty
                    <h4 class="text-secondary">No exam found right now.</h4>
                @endforelse
            </div>
            <div id="footer-fix"></div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
/*        $(".result").on("click", function () {
            alert($(this).val());
        });*/
    </script>
@endsection

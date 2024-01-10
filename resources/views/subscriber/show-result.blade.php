@extends('master')
@section('title', 'Result & Solve')
@section('head', 'Result & Solution')
@section('body')
    <section class="pt-2">
        <div class="container-fluid">
            <input id="routeUrl" type="hidden" value="{{ $result->exam_id }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-gradient-bunting text-white">
                                <div class="card-body">
                                    <h5 class="mb-4">Total Mark</h5>
                                    <i class="fa fa-file-invoice fa-2x mb-2">&nbsp;{{ $exam->question_limit }}</i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-gradient-info text-white">
                                <div class="card-body">
                                    <h5 class="mb-4">You Answered</h5>
                                    <i class="fa fa-file-signature fa-2x mb-2">&nbsp;{{ $result->total_answered }}</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-gradient-success text-white">
                                <div class="card-body">
                                    <h5 class="mb-4">Correct Answered</h5>
                                    <i class="fa fa-check fa-2x mb-2">&nbsp;{{ $result->correct_answer }}</i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-gradient-danger text-white">
                                <div class="card-body">
                                    <h5 class="mb-4">Wrong Answered</h5>
                                    <i class="fa fa-times fa-2x mb-2">&nbsp;{{ $result->wrong_answer }}</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-gradient-warning text-white">
                                <div class="card-body">
                                    <h5 class="mb-4">Obtain Mark</h5>
                                    <i class="fa fa-file-archive fa-2x mb-2">&nbsp;{{ $result->result }}</i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-gradient-sunset text-white">
                                <div class="card-body">
                                    <h5 class="mb-4">In Percentage</h5>
                                    <i class="fa fa-calculator fa-2x mb-2">&nbsp;{{ $final = number_format($result->result/$exam->question_limit*100, 2) }}%</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card {{ $final < $exam->passingRate->value ? 'bg-danger' : 'bg-success' }} text-white">
                                <div class="card-body">
                                    <h5 class="mb-4">Result</h5>
                                    {{--<i class="fa fa-heart-broken fa-2x mb-2"></i>--}}
                                    <i class="fa {{ $final < $exam->passingRate->value ? 'fa-heart-broken' : 'fa-smile-beam' }} fa-2x mb-2">&nbsp;{{ $final < $exam->passingRate->value ? 'Failed!' : 'Passed' }}</i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-gradient-ashes text-white">
                                <div class="card-body pb-2">
                                    <p class="fs-5">Answer Description</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <p><i class="fa fa-stop text-success"></i>&nbsp;Correct answer</p>
                                        </div>
                                        <div class="col-12">
                                            <p><i class="fa fa-stop text-danger"></i>&nbsp;You answered wrong.</p>
                                        </div>
                                        <div class="col-12">
                                            <p><i class="fa fa-stop text-blue"></i>&nbsp;You answered correct.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <table id="user-answer" class="table table-borderless table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Your Answer's</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($questions as $question)
                                <tr>
                                    <td>
                                        <b>{{ $loop->iteration }}. {{ $question->question }}</b><br>
                                        @if($question->choice_one == $question->solution->answer && $question->choice_one == $question->correct_answer)
                                            <span class="pl-4 text-blue">A - {{ $question->choice_one }}</span><br>
                                        @elseif($question->choice_one == $question->correct_answer)
                                            <span class="pl-4 text-success">A - {{ $question->choice_one }}</span><br>
                                        @elseif($question->choice_one == $question->solution->answer)
                                            <span class="pl-4 text-danger">A - {{ $question->choice_one }}</span><br>
                                        @else
                                            <span class="pl-4">A - {{ $question->choice_one }}</span><br>
                                        @endif
                                        @if($question->choice_two == $question->solution->answer && $question->choice_two == $question->correct_answer)
                                            <span class="pl-4 text-blue">B - {{ $question->choice_two }}</span><br>
                                        @elseif($question->choice_two == $question->correct_answer)
                                            <span class="pl-4 text-success">B - {{ $question->choice_two }}</span><br>
                                        @elseif($question->choice_two == $question->solution->answer)
                                            <span class="pl-4 text-danger">B - {{ $question->choice_two }}</span><br>
                                        @else
                                            <span class="pl-4">B - {{ $question->choice_two }}</span><br>
                                        @endif
                                        @if($question->choice_three == $question->solution->answer && $question->choice_three == $question->correct_answer)
                                            <span class="pl-4 text-blue">C - {{ $question->choice_three }}</span><br>
                                        @elseif($question->choice_three == $question->correct_answer)
                                            <span class="pl-4 text-success">C - {{ $question->choice_three }}</span><br>
                                        @elseif($question->choice_three == $question->solution->answer)
                                            <span class="pl-4 text-danger">C - {{ $question->choice_three }}</span><br>
                                        @else
                                            <span class="pl-4">C - {{ $question->choice_three }}</span><br>
                                        @endif
                                        @if($question->choice_four == $question->solution->answer && $question->choice_four == $question->correct_answer)
                                            <span class="pl-4 text-blue">D - {{ $question->choice_one }}</span><br>
                                        @elseif($question->choice_four == $question->correct_answer)
                                            <span class="pl-4 text-success">D - {{ $question->choice_four }}</span><br>
                                        @elseif($question->choice_four == $question->solution->answer)
                                            <span class="pl-4 text-danger">D - {{ $question->choice_four }}</span><br>
                                        @else
                                            <span class="pl-4">D - {{ $question->choice_four }}</span><br>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td>No answer found.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
                <!--all solution -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-body">
                        <table id="answer-sheet" class="table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th>All Question and Answer</th>
                        </tr>
                        </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div id="footer-fix"></div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        let url = "{{ route('subscriber.question.set', ':id') }}";
        url = url.replace(":id", $("#routeUrl").val());
        $('#user-answer').DataTable({
            "dom": 'frtip',
            info: false,
            ordering: false,
            searching: false,
            /*paging: false,*/
            responsive: true,
            scrollCollapse: true,
            scrollY: '430px'
        });
        $('#answer-sheet').DataTable( {
            dom: 'Bfrtip',
            searching: false,
            "info": false,
            serverSide: true,
            processing: true,
            ajax: url,
            columns: [
                { data: "questions",
                    render: function(data, type, row){
                        let question = `<b>${row['DT_RowIndex']}.&nbsp;${data.question}</b><br>`;
                        $.each(data.choice, function (key, value) {
                            question += `<span class="pl-4 ${value === data.correct ? "text-success" : ""}">${key}&nbsp;-&nbsp;${value}&nbsp;${value === data.correct ? "~correct" : ""}</span><br>`;
                        });
                        return question;
                    }
                },
            ],
        });
    </script>
@endsection

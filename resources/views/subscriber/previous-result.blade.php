@extends('master')
@section('title', 'Previous Results')
@section('head', 'Previous Exam Results')
@section('body')
    <section class="pt-2">
        <div class="container-fluid">
            <div class="row">
                @forelse($oldResults as $result)
                <div class="col-6 col-lg-4 p-2">
                    <a href="{{ route('subscriber.result.show', $result->exam_id) }}"> <!-- Change route based on condition-->
                        <div class="card h-100 border-4 border-smoke bg-blue-light-4">
                            <div class="card-header">
                                <h5>{{ $result->exam->title }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6"><h6 class="fa fa-hourglass-end text-purple">&nbsp;Time:{{ $result->exam->timeLimit->value }} Minute</h6></div>
                                    <div class="col-6"><h6 class="fa fa-times-circle text-danger">&nbsp;Negative: {{ $result->exam->negativeMark->value }}</h6></div>
                                </div>
                                <p class="text-muted"></p>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                    <h4 class="text-secondary">No result found right now.</h4>
                @endforelse
            </div>
            <div id="footer-fix"></div>
        </div>
    </section>
@endsection

@extends('master')
@section('title', 'Dashboard')
@section('head', 'Dashboard')
@section('body')
    <section class="pt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-gradient-bunting text-white">
                        <div class="card-body">
                            <h5 class="mb-4">Total Course</h5>
                            <i class="fa fa-file-invoice fa-2x mb-2">&nbsp;{{ $course }}</i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-gradient-info text-white">
                        <div class="card-body">
                            <h5 class="mb-4">Total Teacher</h5>
                            <i class="fa fa-users fa-2x mb-2">&nbsp;{{ $teacher }}</i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-gradient-metal text-white">
                        <div class="card-body">
                            <h5 class="mb-4">Total Student</h5>
                            <i class="fa fa-users fa-2x mb-2">&nbsp;{{ $student }}</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

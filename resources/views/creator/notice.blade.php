@extends('master')
@section('title', 'Notice')
@section('head', 'Manage Notice')
@section('body')
    <section class="pt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if (Session::has('success'))
                        <div class="alert alert-border-success alert-dismissible fade show" role="alert">{{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('creator.send.notice') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="notice" class="form-label">Notice Title</label>
                            <input id="notice" name="message" type="text" class="form-control" value="1st year 1st semester 2024 'C programming' class lecture sheet 1 [{{ Carbon\Carbon::now()->format('d-m-Y') }}]"  placeholder="Enter About notification">
                            <span class="text-danger">{{ $errors->has('message') ? $errors->first('message') : '' }}</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Attachment<span class="text-muted">(*lower than 2.5mb)</span></label>
                            <input name="attach" type="file" class="form-control">
                            <span class="text-danger">{{ $errors->has('attach') ? $errors->first('attach') : '' }}</span>
                        </div>
                        <div class="form-group float-end">
                            <button type="submit" class="btn btn-gradient-primary">Send</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <table id="datable_1" class="table table-responsive table-striped">
                        <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Message</th>
                            <th>Attach File</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($histories as $history)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $history->message }}</td>
                            <td>
                                @if(empty($history->file_path))
                                    File removed
                                @else
                                    <a href="{{ $history->url() }}">View</a>
                                    <a onclick="event.preventDefault(); document.getElementById('removeFile').submit();" href="#"><i class="fa fa-sm fa-trash"></i></a>
                                    <form action="{{ route('creator.remove.file', $history->id) }}" method="post" id="removeFile">@csrf @method('delete')</form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        $('#datable_1').DataTable( {
            autoWidth: false,
            language: { search: "",
                searchPlaceholder: "Search",
                sLengthMenu: "_MENU_items",
                paginate: {
                    next: '<i class="ri-arrow-right-s-line"></i>', // or '→'
                    previous: '<i class="ri-arrow-left-s-line"></i>' // or '←'
                }
            },
            "drawCallback": function () {
                $('.dataTables_paginate > .pagination').addClass('custom-pagination pagination-simple');
            }
        });
    </script>
@endsection

@extends('master')
@section('title', 'Settings')
@section('csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('head', 'Manage Setting')
@section('body')
    <section class="pt-2">
        <div class="container-fluid">
{{--            <div class="row">
                <div class="col-md-6 py-2">
                    <form id="settingForm" action="javascript:void(0)" method="post">
                        <div class="input-group">
                            <input type="text" id="title" name="title" class="form-control" placeholder="Enter Configuration Title" aria-label="Create Configuration" aria-describedby=create-configuration">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary rounded-0">Create Configuration</button>
                            </div>
                        </div>
                        <span id="titleError" class="text-danger"></span>
                    </form>
                </div>
            </div>--}}
            <div id="content" class="row">
                @forelse($setting as $value)
                    <div class="col-md-6">
                        <table id="table{{ $value->id }}" class="table table-bordered nowrap w-100">
                            <thead>
                            <tr>
                                <th colspan="2" class="text{{ $value->id }} w-50">{{ $value->title }}</th>
                                <th class="w-50">
                                    <button onclick="editBtn({{ $value->id }})" class="editBtn{{ $value->id }} btn btn-sm"><i class="fa fa-edit"></i></button>
                                    <button onclick="saveBtn({{ $value->id }})" class="saveBtn{{ $value->id }} d-none btn btn-sm"><i class="fa fa-arrow-right"></i></button>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2"><input type="text" name="value" class="form-control" placeholder="Value"></th>
                                <th><button onclick="addValue({{ $value->id }})" class="btn btn-sm"><i class="fa fa-plus"></i></button></th>
                            </tr>
                            </thead>
                            <tbody class="tdata{{ $value->id }}">
                            @forelse($value->property as $property)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $property->value }}</td>
                                <td>
                                    <button onclick="editValue({{ $property->id }})" class="btn btn-outline-warning btn-sm"><i class="fa fa-edit"></i></button>
                                    <button onclick="editConf({{ $property->id }})" class="d-none btn btn-outline-warning btn-sm"><i class="fa fa-marker"></i></button>
                                    <button onclick="deleteValue({{ $property->id }})" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="3">Not Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                @empty
                    <h3 class="text-danger">No Configuration Found!</h3>
                @endforelse
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
        function addValue(id) {
            event.preventDefault();
            $.ajax({
                type:'POST',
                url: "{{ route('admin.setting.value') }}",
                data: formData,
                contentType: false,
                processData: false,
            });
        }
        /*$(document).ready(function () {
        $.ajax({
            url: "{{--{{ route('admin.setting') }}--}}",
            success: function(data) {
                $.each(data.success, function (key, value) {
                    $("#content").append(`
                    <div class="col-md-6">
                        <table id="table${value.id}" class="table nowrap w-100">
                            <thead>
                            <tr>
                                <form action="javascript:void(0)" method="post">
                                    <th colspan="2" class="text${value.id} w-50">${value.title}</th>
                                </form>
                                <th class="w-50">
                                    <button onclick="editBtn(${value.id})" class="editBtn${value.id} btn btn-sm"><i class="fa fa-edit"></i></button>
                                    <button onclick="saveBtn(${value.id})" class="saveBtn${value.id} d-none btn btn-sm"><i class="fa fa-arrow-right"></i></button>
                                </th>
                            </tr>
                            <tr>
                                <th>Sl.</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    `);
                });
            }
        });
        });*/
       function editBtn(id) {
        $(".editBtn"+id).addClass("d-none");
        $(".saveBtn"+id).removeClass("d-none");
        $(".text"+id).attr("contenteditable", "true").addClass("border-danger");
       }
        function saveBtn(id) {
           event.preventDefault();
           let Id = id;
           let url = "{{ route('admin.setting.update', ':id') }}";
           url = url.replace(":id", Id);
           col = $(".text"+id).text();
           var formData = new FormData();
           formData.append("title", col);
            $(".text"+id).removeAttr('contenteditable');
            $.ajax({
                type:'POST',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success:function(data){
                    toastr.success(data.success, 'CONGRATULATION');
                    $(".editBtn"+id).removeClass("d-none");
                    $(".text"+id).removeClass("border-danger");
                    $(".saveBtn"+id).addClass("d-none");
                },
                error: function () {
                    toastr.error('Something went wrong', 'System Alert!');
                }
            });
        }

        $("#settingForm").submit(function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ route('admin.setting.create') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    if($.isEmptyObject(data.invalid)) {
                        $("#title").val("");
                        $("#titleError").html("");
                        console.log(data);
                        toastr.success(data.success, 'CONGRATULATION');
                       $("#content").append(`
                            <div class="col-md-6">
                                <table id="table${data.setting.id}" class="table nowrap w-100">
                                    <thead>
                                    <tr>
                                        <form action="javascript:void(0)" method="post">
                                            <th colspan="2" class="text${data.setting.id} w-50">${data.setting.title}</th>
                                        </form>
                                        <th class="w-50">
                                            <button onclick="editBtn(${data.setting.id})" class="editBtn${data.setting.id} btn btn-sm"><i class="fa fa-edit"></i></button>
                                            <button onclick="saveBtn(${data.setting.id})" class="saveBtn${data.setting.id} d-none btn btn-sm"><i class="fa fa-arrow-right"></i></button>
                                        </th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        `);
                    }else {
                        $("#titleError").html(data.invalid.title)
                    }
                },
                error: function () {
                    toastr.error('Something went wrong', 'System Alert!');
                }
            });
        });
/*       $(document).ready(function () {
        const table = $('#table1').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{--{{ route('admin.setting.list') }}--}}",
            columns: [
                { data: "DT_RowIndex" },
                { data: "title" },
                { data: "action", orderable: false },
            ],
            order: [[0, "desc"]]
        });
       });*/
    </script>
@endsection

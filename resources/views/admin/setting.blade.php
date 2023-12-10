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
                        <table id="table{{ $value->id }}" class="table table-bordered border-primary nowrap w-100">
                            <thead class="table-secondary">
                            <tr>
                                <th colspan="2" class="text{{ $value->id }} w-50">{{ $value->title }}</th>
                                <th class="w-50">
                                    <button onclick="editBtn({{ $value->id }})" class="editBtn{{ $value->id }} btn btn-sm"><i class="fa fa-edit"></i></button>
                                    <button onclick="saveBtn({{ $value->id }})" class="saveBtn{{ $value->id }} d-none btn btn-sm"><i class="fa fa-arrow-right"></i></button>
                                    <button onclick="resetBtn({{ $value->id }}, '{{ $value->title }}')" class="btn btn-sm"><i class="fa fa-redo btn-sm"></i></button>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2"><input id="value{{ $value->id }}" type="text" class="form-control" placeholder="Value"></th>
                                <th><button onclick="addValue(this.className, {{ $value->id }})" class="btn btn-sm"><i class="fa fa-plus"></i></button></th>
                            </tr>
                            </thead>
                            <tbody id="tdata{{ $value->id }}">
                            @foreach($value->property as $property)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="ctext{{ $property->id }}">{{ $property->value }}</td>
                                <td>
                                    <button onclick="editValue({{ $property->id }})" class="editValue{{ $property->id }} btn btn-outline-warning btn-sm fa fa-edit"></button>
                                    <button onclick="addValue(this.className, {{ $property->id }})" class="addValue{{ $property->id }} d-none btn btn-outline-warning btn-sm fa fa-marker"></button>
                                    <button onclick="resetTableBtn({{ $property->id }}, '{{ $property->value }}')" class="resetTableBtn{{ $property->id }} d-none btn btn-outline-info btn-sm fa fa-redo"></button>
                                    <button onclick="deleteValue(this, {{ $property->id }})" id="deleteValue{{ $property->id }}" class="btn btn-outline-danger btn-sm fa fa-trash"></button>
                                </td>
                            </tr>
                            @endforeach
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
        // Child  table remove state for edit and reset button
        function childStart(id) {
            let tdata = $(".ctext"+id);
            $(".editValue"+id).removeClass("d-none");
            $(".addValue"+id).addClass("d-none");
            $(".resetTableBtn"+id).addClass("d-none");
            tdata.attr("contenteditable", "true").removeClass("bg-warning bg-opacity-25")
        }
        // Main table for edit and reset button
        function attprop(id) {
            $(".editBtn"+id).addClass("d-none");
            $(".saveBtn"+id).removeClass("d-none");
            $(".text"+id).attr("contenteditable", "true").addClass("bg-secondary bg-opacity-25").focus();
        }
        // Main table for edit and reset button reverse state
        function defprop(id) {
            $(".editBtn"+id).removeClass("d-none");
            $(".text"+id).removeClass("bg-secondary bg-opacity-25");
            $(".saveBtn"+id).addClass("d-none");
        }
        // Main table reset button
        function resetBtn(id, title) {
            $(".text"+id).html(title);
            defprop(id);
        }
        // Child table reset button
        function resetTableBtn(id, value) {
            $(".ctext"+id).html(value);
            childStart(id);
        }
        // Child tbale edit button other setup
        function editValue(id) {
            let tdata = $(".ctext"+id);
            $(".editValue"+id).addClass("d-none");
            $(".addValue"+id).removeClass("d-none");
            $(".resetTableBtn"+id).removeClass("d-none");
            tdata.attr("contenteditable", "true").addClass("bg-warning bg-opacity-25").focus();
        }
        //Insert and update value in this  same function(child table)
        function addValue(className, id) {
            event.preventDefault();
            let hasClass = className.includes("fa-marker");
            let formData = new FormData;
            if(hasClass) {
                formData.append("id", id );
                formData.append("value", $(".ctext"+id).text());
                formData.append("setting", "update");
            } else {
                formData.append("setting_id", id );
                formData.append("value", $("#value"+id).val());
            }
            $.ajax({
                type:"POST",
                url: "{{ route('admin.setting.property.create') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if($.isEmptyObject(response.invalid)) {
                        toastr.success(response.message, 'CONGRATULATION.');
                        if(response.identity === "update") {
                            childStart(id);
                        } else {
                            $("#tdata"+response.success.settingId).append(`
                            <tr>
                                <td>${$("#table"+response.success.settingId+" "+"tr").length-1}</td>
                                <td class="ctext${response.success.id}">${response.success.value}</td>
                                <td>
                                    <button onclick="editValue(${response.success.id})" class="editValue${response.success.id} btn btn-outline-warning btn-sm fa fa-edit"></button>
                                    <button onclick="addValue(this.className, ${response.success.id})" class="addValue${response.success.id} d-none btn btn-outline-warning btn-sm fa fa-marker"></button>
                                    <button onclick="resetTableBtn(${response.success.id}, '${response.success.value}')" class="resetTableBtn${response.success.id} d-none btn btn-outline-info btn-sm fa fa-redo"></button>
                                    <button onclick="deleteValue(this, ${response.success.id})" id="deleteValue${response.success.id}" class="btn btn-outline-danger fa fa-trash btn-sm"></button>
                                </td>
                            </tr>
                        `);
                        }
                    }else {
                        toastr.error(response.invalid.value, 'VALIDATION ERROR!');
                    }
                },
                error: function () {
                    toastr.error("Something went wrong", "SYSTEM ALERT!");
                }
            });
        }
        //Delete operation for child table
        function deleteValue(btn, id)
        {
            let Id = id;
            let url = "{{ route('admin.setting.property.delete', ':id') }}";
            url = url.replace(":id", Id);
            $.ajax({
                type: "DELETE",
                url: url,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    $(btn).closest("tr").remove();
                    toastr.success(response.success, 'CONGRATULATION.');
                },
                error: function () {
                    toastr.error("Something went wrong", "SYSTEM ALERT!");
                }
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

        //Main table edit button
       function editBtn(id) {
           attprop(id);
       }
       //Main table update operation
        function saveBtn(id) {
           event.preventDefault();
           let Id = id;
           let mdata = $(".text"+id)
           let url = "{{ route('admin.setting.update', ':id') }}";
           url = url.replace(":id", Id);
           col = mdata.text();
           let formData = new FormData();
           formData.append("title", col);
           mdata.removeAttr('contenteditable');
            $.ajax({
                type:'POST',
                url: url,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success:function(data){
                    defprop(id);
                    if($.isEmptyObject(data.invalid)) {
                        toastr.success(data.success, 'CONGRATULATION.');
                    }else {
                        attprop(id);
                        toastr.error(data.invalid.title, 'VALIDATION ERROR!');
                    }
                },
                error: function () {
                    toastr.error("Something went wrong", "SYSTEM ALERT!");
                }
            });
        }

        /*$("#settingForm").submit(function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{--{{ route('admin.setting.create') }}--}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    if($.isEmptyObject(data.invalid)) {
                        $("#title").val("");
                        $("#titleError").html("");
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
        });*/
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

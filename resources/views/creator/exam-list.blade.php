@extends('master')
@section('title', 'Exam List')
@section('csrf')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('head', 'Publish Result')
@section('body')
    <section class="pt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <table id="examlist" class="table table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        let table = $('#examlist').DataTable({
            serverSide: true,
            responsive: true,
            processing: true,
            ajax: "{{ route('creator.exam.list') }}",
            columns: [
                { data: "DT_RowIndex" },
                { data: "title" },
                { data: "action" },
            ],
            order: [[0, "desc"]]
        });
        function publish(id){
            let url = "{{ route('creator.exam.publish', ':id') }}";
            url = url.replace(":id", id);
            $.ajax({
                type: "PATCH",
                contentType: "application/json",
                url: url,
                dataType: "json",
                cache: false,
                processData:false,
                beforeSend: function (quick) {
                    return quick.setRequestHeader("X-CSRF-TOKEN", $("meta[name='csrf-token']").attr("content"));
                },
                success: function(response){
                    if (response.success === "published") {
                        toastr.success("Result "+response.success, 'Alert');
                    } else {
                        toastr.warning("Result "+response.success, 'Alert');
                    }
                    table.draw();
                },
                error: function () {
                    toastr.error('Something went wrong', 'System Alert!');
                }
            });
        }
        function showAlert() {
            alert("Error");
        }
    </script>
@endsection

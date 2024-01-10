@extends('master')
@section('title', 'Rank')
@section('head', 'Result With Ranking')
@section('body')
    <section class="pt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <table id="datable_31" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Position</th>
                            <th>Name</th>
                            <th>Obtain Mark</th>
                            <th>Parentage</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($results as $result)
                        <tr>
                            {{--{{ $final >= 90 ? 'table-success' : ($final >= 75 ? 'table-warning' : '') }}--}}
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $result->user->name }}</td>
                            <td>{{ $result->result }}</td>
                            <td>{{ $final = number_format($result->result/$result->exam->question_limit*100, 2) }}%</td>
                            <td class="{{ $final < $result->exam->passingRate->value ? 'text-danger' : 'text-success' }}">{{ $final < $result->exam->passingRate->value ? 'Failed!' : 'Passed' }}</td>
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
        $('#datable_31').DataTable({
            scrollX:  true,
            autoWidth: false,
            dom: 'Bfrtip',
            "info":     false,
            language: { search: "",
                searchPlaceholder: "Search",
                sLengthMenu: "_MENU_items",
            },
        });
    </script>
@endsection

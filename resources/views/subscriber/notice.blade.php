@extends('master')
@section('title', 'Notice')
@section('head', 'Recent Notice')
@section('body')
    <section class="pt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mb-2">
                    <a class="btn btn-sm btn-danger" href="{{ route('subscriber.markallasread') }}">Mark All - As Read</a>
                    <input id="noticeUrl" type="hidden" value="{{ route('subscriber.notice') }}">
                </div>
                <div id="data-wrapper">
                    @include('subscriber.data')
                </div>
{{--                @foreach($notifications as $notification)
                <div class="col-md-12 mb-2">
                    <a href="{{ route('subscriber.markasread', $notification->id) }}">
                        <div class="card h-100 border-2 {{ empty($notification->read_at) ? 'border-danger bg-secondary-light-4' : 'border-lime' }}">
                            <div class="card-header">
                                <p class="text-secondary"><b>Lance Bogrol!</b> notify you.</p>
                            </div>
                            <div class="card-body py-2">
                                <p class="text-black">{{ $notification->data['data'] }}</p>
                                <p class="text-muted"><small>{{ $notification->created_at->diffForHumans() }}</small></p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach--}}
                <!-- Data Loader -->
                <div class="auto-load text-center" style="display: none;">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
            </div>
            <div id="footer-fix"></div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript">
        var ENDPOINT = $("#noticeUrl").val();
        var page = 1;
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
                page++;
                infinteLoadMore(page);
            }
        });
        function infinteLoadMore(page) {
            $.ajax({
                url: ENDPOINT + "?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    $('.auto-load').show();
                }
            })
                .done(function (response) {
                    if (response.html == '') {
                        $('.auto-load').html("Don't have more data to show on display.");
                        return;
                    }

                    $('.auto-load').hide();
                    $("#data-wrapper").append(response.html);
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }
    </script>
@endsection

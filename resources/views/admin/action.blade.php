
<div class="d-flex align-items-center">
    <div class="d-flex">
        {{--                            <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Archive" href="#"><span class="icon"><span class="feather-icon"><i data-feather="archive"></i></span></span></a>--}}
{{--        <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit" href="edit-contact.html"><span class="icon"><span class="feather-icon"><i data-feather="edit"></i></span></span></a>
        <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover del-button" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete" href="#"><span class="icon"><span class="feather-icon"><i data-feather="trash"></i></span></span></a>--}}
        @if(request()->getPathInfo() == '/o/student' || request()->getPathInfo() == '/o/teacher')
        <a class="btn" onclick="swapFunc({{ $id }})" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Swap" href="javascript:void(0)"><i class="fa fa-arrow-circle-up"></i></a>
        @endif
        <a class="btn" onclick="editFunc({{ $id }})" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit" href="javascript:void(0)"><i class="fa fa-edit"></i></a>
        <a class="btn del-button" onclick="deleteFunc({{ $id }})" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
    </div>
</div>


<div class="d-flex align-items-center">
    <div class="d-flex">
        {{--                            <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Archive" href="#"><span class="icon"><span class="feather-icon"><i data-feather="archive"></i></span></span></a>--}}
{{--        <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit" href="edit-contact.html"><span class="icon"><span class="feather-icon"><i data-feather="edit"></i></span></span></a>
        <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover del-button" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete" href="#"><span class="icon"><span class="feather-icon"><i data-feather="trash"></i></span></span></a>--}}
        @role('admin')
        @if(request()->getPathInfo() == '/o/student' || request()->getPathInfo() == '/o/teacher')
        <a class="btn" onclick="swapFunc({{ $id }})" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Swap" href="javascript:void(0)"><i class="fa fa-arrow-circle-up"></i></a>
        @endif
        <a class="btn" onclick="editFunc({{ $id }})" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Edit" href="javascript:void(0)"><i class="fa fa-edit"></i></a>
        <a class="btn del-button" onclick="deleteFunc({{ $id }})" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
        @endrole
        @if(request()->routeIs('creator.question.set'))
            <div class="text-center">
                <a class="btn btn-gradient-warning btn-sm px-2 fa fa-edit" onclick="updateQuestion({{ $id }})" href="javascript:void(0)">&nbsp;Update</a>
                <a class="btn btn-gradient-danger btn-sm px-2 fa fa-trash" onclick="deleteQuestion({{ $id }})" href="javascript:void(0)">&nbsp;Delete</a>
            </div>
        @else
            <a class="btn btn-outline-secondary fa fa-file-signature p-2 rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Or Edit Question" href="{{ route('creator.exam.manage', $id) }}"></a>
            <a class="btn btn-outline-primary fa {{ $status == 1 ? 'fa-spinner fa-spin' : 'fa-stopwatch' }} p-2 rounded-circle" onclick="swap({{ $id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="Start Or End Exam" href="javascript:void(0)"></a>
            <a class="btn btn-outline-danger fa fa-trash p-2 rounded-circle" onclick="distroy({{ $id }})" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Exam" href="javascript:void(0)"></a>
        @endif
    </div>
</div>

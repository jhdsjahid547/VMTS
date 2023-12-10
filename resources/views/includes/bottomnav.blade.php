<section class="d-lg-none hk-fixed-footer">
    <div class="row">
        <div class="col-md-12">
            @role('creator')
            <!--student-->
            <div class="row display-1 text-center px-6 bg-light">
                <div class="col-3 border border-secondary rounded-4"><a class="fa fa-newspaper" href="{{ route('creator.index') }}"></a></div>
                <div class="col-3 border border-primary rounded-4"><a class="fa fa-users" href="#"></a></div>
                <div class="col-3 border border-secondary rounded-4"><a class="fa fa-book" href="#"></a></div>
                <div class="col-3 border border-primary rounded-4"><a class="fa fa-align-justify" href="#"></a></div>
            </div>
            <!--/student <i class="fa-regular fa-users-medical"></i>-->
            @else
            <!--teacher-->
            <div class="row display-2 text-center px-6 bg-light rounded-4">
                <div class="col-3 border border-secondary rounded-4"><a class="fa fa-newspaper" href="#"></a></div>
                <div class="col-3 border border-primary rounded-4"><a class="fa fa-users" href="#"></a></div>
                <div class="col-3 border border-secondary rounded-4"><a class="fa fa-book" href="#"></a></div>
                <div class="col-3 border border-primary rounded-4"><a class="fa fa-align-justify" href="#"></a></div>
            </div>
            <!--/teacher-->
            @endrole
        </div>
    </div>
</section>

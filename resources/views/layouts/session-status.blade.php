@if (session('status'))
    <div class="col-lg-8 mx-auto">
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <h5>{{ session('status') }}</h5>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

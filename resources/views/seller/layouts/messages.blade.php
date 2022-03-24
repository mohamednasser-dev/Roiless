@if(Session('success'))
    <div class="alert alert-success" role="alert">
        {{ Session('success') }}
    </div>
@endif
@if(Session('danger'))
    <div class="alert alert-danger" role="alert">
        {{ Session('danger') }}
    </div>
@endif


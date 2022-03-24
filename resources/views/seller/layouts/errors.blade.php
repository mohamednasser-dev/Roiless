@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach ($errors->all() as  $value)
            {{ $value }}
        @endforeach
    </div>
@endif

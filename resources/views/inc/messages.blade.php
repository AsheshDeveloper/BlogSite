{{-- Check error array, session values- there are flash messages --}}
@if(count($errors) > 0)
    @foreach($errors->all() as $error)
    {{-- since errors are objects, so $error->all() --}}
    <div class="alert alert-danger">
        {{$error}}
    </div>
    @endforeach
@endif

{{-- Session Success --}}
@if(session('success'))
    <div class="alert alert-success">
        {{{session('success')}}}
    </div>
@endif

{{-- Session Error --}}
@if(session('error'))
    <div class="alert alert-danger">
        {{{session('error')}}}
    </div>
@endif

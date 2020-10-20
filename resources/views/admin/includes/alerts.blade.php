@if ($errors->any())
<div class="alert alert-warning">
    @foreach ($errors->all() as $erro)
        <p>{{ $erro }}</p>
    @endforeach
</div>
@endif

@if(session('message'))
<div class="alert alert-info">
   {{session('message')}}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
   {{session('error')}}
</div>
@endif

@if(session('info'))
<div class="alert alert-warning">
   {{session('info')}}
</div>
@endif

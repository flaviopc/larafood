@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $erro)
        <p>{{ $erro }}</p>
    @endforeach
</div>
@endif

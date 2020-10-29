@extends('adminlte::page')

@section('title', 'Detalhes do Produto')

@section('content_header')
<h1>Detalhes do Produto - {{ $product->title }} </h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        @include('admin.includes.alerts')
        <div class="row">
            <div class="form-group">
                <img src="{{ url("storage/{$product->image}")}}" alt="{{ $product->title }}" style="max-width:100px">
            </div>
            <div class="form-group">
                <ul>
                    <li>
                        <strong>Titulo: </strong>{{ $product->title }}
                    </li>
                    <li>
                        <strong>Flag: </strong>{{ $product->flag }}
                    </li>
                    <li>
                        <strong>Descrição: </strong>{{ $product->description }}
                    </li>
                </ul>
            </div>
        </div>
        <form action="{{ route('products.destroy',$product->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">DELETAR</button>
        </form>
    </div>
</div>
@endsection

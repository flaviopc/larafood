@extends('adminlte::page')

@section('title', 'Categorias do produto')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.categories',$product->id) }}">Categorias</a></li>
    </ol>
    <h1>Categorias do produto {{$product->title}}
        <a href="{{ route('products.categories.available',$product->id) }}" class="btn btn-default">ADD</a>
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-border">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descricao</th>
                        <th style="width: 150px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description ?? '' }}</td>
                        <td>
                            <a href="{{ route('products.category.detach',[$product->id,$category->id]) }}" class="btn btn-danger">Remover</a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $categories->appends($filters)->links() !!}
            @else
                {!! $categories->links() !!}
            @endif

        </div>
    </div>
@stop

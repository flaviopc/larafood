@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('tenants.index') }}">Empresas</a></li>
    </ol>
    <h1>Empresas <a href="{{ route('tenants.create') }}" class="btn btn-default">ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
        <form action="{{ route('tenants.search') }}" method="POST" class="form form-inline">
                @csrf
        <input type="text" name="filter" placeholder="Pesquisar" class="form-control" value="{{ $filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-default">Pesquisar</button>
            </form>
        </div>
        <div class="card-border">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>CNPJ</th>
                        <th>Ativo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tenants as $tenant)
                        <tr>
                            <td><img src="{{ url("storage/{$tenant->logo}")}}" alt="{{ $tenant->name }}" style="max-width:60px"></td>
                            <td>{{ $tenant->name }}</td>
                            <td>{{ $tenant->cnpj }}</td>
                            <td>{{ $tenant->active == 'Y' ? 'SIM' : 'NÃO' }}</td>
                            <td>
                                <a href="{{ route('tenants.edit',$tenant->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('tenants.show',$tenant->id) }}" class="btn btn-warning">VER</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $tenants->appends($filters)->links() !!}
            @else
                {!! $tenants->links() !!}
            @endif

        </div>
    </div>
@stop

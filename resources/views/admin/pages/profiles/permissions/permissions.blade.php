@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Perfis</a></li>
    </ol>
    <h1>Permissões do perfil {{$profile->name}}
        <a href="{{ route('profiles.permissions.available',$profile->id) }}" class="btn btn-default">ADD PERMISSÃO</a>
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
        <form action="{{ route('permissions.search') }}" method="POST" class="form form-inline">
                @csrf
        <input type="text" name="filter" placeholder="Pesquisar" class="form-control" value="{{ $filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-default">Pesquisar</button>
            </form>
        </div>
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
                    @foreach ($permissions as $permission)
                        <tr>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->description ?? '' }}</td>
                        <td>
                            <a href="{{ route('profiles.edit',$permission->id) }}" class="btn btn-info">Edit</a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $permissions->appends($filters)->links() !!}
            @else
                {!! $permissions->links() !!}
            @endif

        </div>
    </div>
@stop

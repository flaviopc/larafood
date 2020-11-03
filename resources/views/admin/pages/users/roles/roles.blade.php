@extends('adminlte::page')

@section('title', "Cargos do Usuário {$user->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
    </ol>
    <h1>Cargos do Usuário {{$user->name}}
        <a href="{{ route('users.roles.available',$user->id) }}" class="btn btn-default">ADD Cargo</a>
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
        <form action="{{ route('roles.search') }}" method="POST" class="form form-inline">
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
                    @foreach ($roles as $role)
                        <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description ?? '' }}</td>
                        <td>
                            <a href="{{ route('users.roles.detach',[$user->id,$role->id]) }}" class="btn btn-danger">Remover</a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $roles->appends($filters)->links() !!}
            @else
                {!! $roles->links() !!}
            @endif

        </div>
    </div>
@stop

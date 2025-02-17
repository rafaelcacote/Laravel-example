@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Perfis</h1>
@stop

@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Lista de Perfis</h3>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"></h3>

            <div class="card-tools">
                <ul class="pagination pagination-sm float-right">

                </ul>
            </div>
        </div>
        <div class="card-header">
            <form action="{{ route('roles.index') }}" method="GET">
                <div class="row">
                    <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                            <input type="text" class="form-control" name="search_role"
                                placeholder="Pesquisar por perfil">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search"></i>
                                Pesquisar</button>
                            <a href="{{ route('roles.index') }}" class="btn btn btn-warning mb-2"><i class="fa-solid fa-eraser"></i>
                                Limpar
                            </a>
                        </div>
                    </div>
            </form>
            <div class="col-sm-4">
                <!-- text input -->
                <div class="form-group">
                    @can('role-create')
                        <a class="btn btn-success float-right" href="{{ route('roles.create') }}"><i class="fa-solid fa-plus"></i>  Criar novo
                        Perfil</a>
                        @endcan
                </div>
            </div>
        </div>

    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        @if ($roles->isEmpty())
        <div class="alert alert-info col-6 offset-3 mt-2">
            {{-- <button type="button" class="close" data-dismiss="alert"
            aria-hidden="true">×</button> --}}
            <i class="icon fas fa-info"></i>
            Nenhum!
        </div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th width="150">No</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $key => $role)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $role->name }}</td>

                        <td>
                            @can('role-delete')
                            <form method="POST" action="{{ route('roles.destroy', $role->id) }}">
                                        @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger show-alert-delete-box float-right m-1">
                                    <i class="fa-solid fa-trash-can"></i>

                                </button>
                            </form>
                        @endcan
                            @can('role-edit')
                                <a class="btn btn-sm btn-primary float-right m-1" href="{{ route('roles.edit',$role->id) }}"><i class="fa-solid fa-pencil"></i></a>
                            @endcan

                            <a class="btn btn-sm btn-info float-right m-1" href="{{ route('roles.show',$role->id) }}"><i class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">

        {{ $roles->links('vendor.pagination.adminlte-paginate') }}

    </div>
</div>
</div>

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')

    <script type="text/javascript">
        $('.show-alert-delete-box').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: "Deseja deletar este Perfil?",
                text: "Este Perfil será deletado permanentemente.",
                icon: "warning",
                type: "warning",
                buttons: ["Cancelar", "Sim!"],
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, Deletar!'
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    </script>
@stop

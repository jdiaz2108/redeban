@extends('layouts.app')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">Lista Usuarios</div>
                            <div class="col-md-10 text-right">
                              <a class="btn btn-primary btn-sm" href="/dashboard/prizes/create" role="button">Crear <i class="fa fa-plus" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @if (session('status'))
                                <div class="alert alert-success status">
                                    {{ session('status') }}
                                </div>
                                @endif
                                @if (session('error'))
                                <div class="alert alert-warning error">
                                    {{ session('error') }}
                                </div>
                                @endif
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre Compañía</th>
                                            <th>Codigo Único</th>
                                            <th>Correo Electrónico</th>
                                            <th>Teléfono</th>
                                            <th>Fecha Afiliación</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="content-directory">
                                        @forelse($users as $user)
                                        <tr>
                                            <td>
                                                {{$user->id}}
                                            </td>
                                            <td>
                                                {{$user->name_company}}
                                            </td>
                                            <td>
                                                {{$user->code}}
                                            </td>
                                            <td>
                                                {{$user->email}}
                                            </td>
                                            <td>
                                                {{$user->phone}}
                                            </td>
                                            <td>
                                                {{$user->created_at}}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                        <button class="btn btn-default border border-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                          <a class="dropdown-item" href="#">Editar</a>
                                                          <div class="dropdown-divider"></div>
                                                          <form action="/dashboard/prizes/{{$user['code']}}" method="POST">
                                                            @method('DELETE') @csrf
                                                            <button class="dropdown-item">Eliminar</button>
                                                       </form>
                                                        </div>
                                                      </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="alert aler-warning">
                                                <center>No existen registros.</center>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')
@section('content')
<div class="page admin">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
        <div class="row">
          <div class="col-4">
            <h2 class="title">Usuarios</h2>
            <hr class="line">
          </div>
          <div class="col-6">
          <form action="{{ route('admin::find.users') }}" method="POST" class="form-inline">
            @csrf
                        <input class="form-control mr-sm-2" type="search" placeholder="Nombre ó identificación" name="query">
                        <button class="btn btn-primary my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                      </form>
              </div>
          <div class="col-2 text-right">
            <a href="" class="btn btn-custom-green btn-sm" data-toggle="modal" data-target="#upload-users"><i class="fa fa-upload"></i> Cargar</a>
          </div>
        </div>
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
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
              <table class="table table-striped table-custom">
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
              {{$users->links()}}
          </div>
        </div>
    </div>
</div>

<!-- Small modal -->
<div class="modal fade" id="upload-users" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cargar Usuarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/dashboard/users" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="file" name="data" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">SUBIR</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@extends('layouts.app')
@section('content')
<div class="page admin">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
        <div class="row">
          <div class="col-md-5">
            <h2 class="title">Usuarios</h2>
            <hr class="line">
          </div>
          <div class="col-md-7">
            <form action="{{ route('admin::users.index') }}" method="GET">
              <div class="form-group row">
                <div class="col-md-7">
                  <input class="form-control input-custom2" type="search" placeholder="Nombre ó identificación" name="query">
                </div>
                <div class="col-md-5 text-center">
                  <button class="btn btn-custom fontSize18" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            @include('layouts.messages')
              <table class="table table-striped table-custom">
                  <thead>
                      <tr>
                          <th>Id</th>
                          <th>Nombre Compañía</th>
                          <th>Codigos Únicos</th>
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
                              {{$user->identification}}
                          </td>
                          <td>
                              {{$user->name_company}}
                          </td>
                          <td>
                              {{$user->shops->count()}}
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
          <div class="col-md-12 text-right">
            <a href="{{ route('admin::user.point') }}" class="btn btn-custom float-left"><i class="fa fa-cloud-download"></i> Descargar usuarios y puntos</a>
            <a href="" class="btn btn-custom-green" data-toggle="modal" data-target="#upload-users"><i class="fa fa-upload"></i> Cargar</a>
          </div>
        </div>
    </div>
</div>

<!-- Small modal -->
<div class="modal fade modal-custom" id="upload-users" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cargar Usuarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <form action="/dashboard/users" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="">Archivo <span>*</span>  </label>
              <input type="file" name="data" class="form-control input-custom2" required>
            <a href="{{ route('admin::user.base') }}">Descargar archivo base</a>
            </div>
            <button type="submit" class="btn btn-custom fontSize18">SUBIR</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

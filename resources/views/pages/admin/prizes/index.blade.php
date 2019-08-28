@extends('layouts.app')
@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">Catalogo items</div>
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
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Imagen</th>
                                            <th scope="col">Descripción</th>
                                            <th scope="col">Unidades</th>
                                            <th scope="col">Puntos</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="content-directory">
                                        @if(count($prizes))
                                        @foreach ($prizes as $prize)
                                        <tr>
                                            <td>{{$prize['name']}}</td>
                                            <td>@if ($prize['image'])
                                                    <img src="{{$prize['image']}}" width="110">
                                            @else
                                            <img src="https://schneidereit-berlin.de/wp-content/uploads/2019/01/platzhalter.png" width="110">
                                            @endif
                                                </td>
                                            <td>{{$prize['description']}}</td>
                                            <td class="{{($prize['stock'] <= 2) ? 'alert alert-danger' : 'alert alert-info'}}">
                                                {{$prize['stock']}}</td>
                                            <td>{{$prize['point']}}</td>
                                            <td>
                                                <div class="dropdown">
                                                        <button class="btn btn-default" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                          <a class="dropdown-item" href="#">Editar</a>
                                                          <div class="dropdown-divider"></div>
                                                          <form action="/dashboard/prizes/{{$prize['code']}}" method="POST">
                                                            @method('DELETE') @csrf
                                                            <button class="dropdown-item">Eliminar</button>
                                                       </form>
                                                        </div>
                                                      </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="9" class="alert aler-warning">
                                                <center>No existen registros.</center>
                                            </td>
                                        </tr>
                                        @endif
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
@extends('layouts.app')
@section('content')
<div class="page admin">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
        <div class="row">
          <div class="col-8">
            <h2 class="title">Premios</h2>
            <hr class="line">
          </div>
          <div class="col-4 text-right">
            <a href="{{url('dashboard/prizes/create')}}" class="btn btn-custom-green btn-sm"><i class="fa fa-plus"></i> Crear Premio</a>
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
            <div class="table-responsive">
            <table class="table table-custom table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Unidades</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="content-directory">
                    @forelse($prizes as $prize)
                    <tr>
                        <td>{{$prize['name']}}</td>
                        <td>@if ($prize['image'])
                                <img src="{{$prize['image']}}" width="110">
                        @else
                        <img src="{{asset('images/image.png')}}" width="110">
                        @endif
                            </td>
                        <td>{{$prize['description']}}</td>
                        <td>
                          <a class="btn btn-sm {{($prize['totalStock'] <= 2) ? 'btn-danger' : 'btn-success'}}">{{$prize['totalStock']}}</a>
                        </td>
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-default border border-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="/dashboard/prizes/{{$prize['code']}}/edit">Editar</a>
                              <div class="dropdown-divider"></div>
                              <form action="/dashboard/prizes/{{$prize['code']}}" method="POST">
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
            {{$prizes->links()}}
            </div>
        </div>
    </div>
</div>
@endsection

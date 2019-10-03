@extends('layouts.app')
@section('content')
<div class="page admin">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
        <div class="row">
          <div class="col-md-12">
            <h2 class="title">PQRS</h2>
            <hr class="line">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            @include('layouts.messages')
            <div class="table-responsive">
              <table class="table table-striped table-custom">
                  <thead>
                      <tr>
                          <th>Nombre</th>
                          <th>Correo</th>
                          <th>Telefono</th>
                          <th>Ciudad</th>
                          <th>Descripción</th>
                          <th>Fecha</th>
                          <th>Estado</th>
                      </tr>
                  </thead>
                  <tbody class="content-directory">
                      @forelse($contacts as $item)
                      <tr>
                          <td>{{$item['name']}}</td>
                          <td>{{$item['email']}}</td>
                          <td>{{$item['phone']}}</td>
                          <td>{{$item['city']['name']}}</td>
                          <td>{{$item['description']}}</td>
                          <td>{{$item['created_at']}}</td>
                          <td>
                            @if($item->state == 0)
                            <a href="{{url('dashboard/contacts',$item->id)}}">Marcar como Contactado</a>
                            @else
                            Contactado
                            @endif
                          </td>
                      </tr>
                      @empty
                      <tr>
                          <td colspan="7" class="alert aler-warning">
                              <center>No existen registros.</center>
                          </td>
                      </tr>
                      @endforelse
                  </tbody>
              </table>
            </div>
              {{$contacts->links()}}
          </div>
        </div>
    </div>
</div>
@endsection

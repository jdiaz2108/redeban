@extends('layouts.app')
@section('content')
<div class="page admin">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
        <div class="row">
          <div class="col-8">
          <h2 class="title">Editar Premios</h2>
            <hr class="line">
          </div>
          <div class="col-4 text-right">
            <small><a class="btn btn-custom-green btn-sm" href="{{ URL::previous() }}">Volver <i class="fa fa-arrow-right"></i> </a></small>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            @include('layouts.messages')
          </div>
          <div class="col-12">
          <form action="/dashboard/prizes/{{$prize['code']}}" method="POST" enctype="multipart/form-data">
                @method('PUT') @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nombre *</label>
                            <input type="text" class="form-control" name="name" value="{{old('name', $prize['name'] ?? '')}}"
                                required placeholder="Nombre">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Puntos *</label>
                            <input type="number" class="form-control" name="point" value="{{old('point', $prize['point'] ?? '')}}"
                                required placeholder="Puntos">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Unidades *</label>
                            <input type="number" class="form-control" name="stock" value="{{old('stock', $prize['stock'] ?? '')}}"
                                required placeholder="Unidades">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Codigo *</label>
                            <input type="text" class="form-control" name="code"
                                value="{{old('code', $prize['code'] ?? '')}}" required placeholder="Codigo">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>
                                Imagen *
                            </label>
                            <input type="file" class="form-control" name="image" value="{{old('image', $prize['image'] ?? '')}}"
                                multiple="false">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Descripción</label>
                            <textarea name="description" rows="10"
                            class="wysiwyg form-control">{{old('description', $prize['description'] ?? '')}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                      <button class="btn btn-primary btn-custom" type="submit">
                          Editar Item
                      </button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

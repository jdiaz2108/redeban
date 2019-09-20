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
                            <label>Unidades totales:</label>
                            <h4 class="py-1 {{($prize['totalStock'] <= 2) ? 'text-danger' : 'text-success'}}">
                                {{$prize['totalStock']}}
                            </h4>
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
                            <textarea name="description" rows="4"
                            class="wysiwyg form-control">{{old('description', $prize['description'] ?? '')}}</textarea>
                        </div>
                    </div>

                    @if ($prize->prizeCategories)
                        <div class="col-md-12">
                            <ul class="list-group">
                                @foreach ($prize->prizeCategories as $prizeCategory)
                                    <li class="list-group-item">Categoria: {{$prizeCategory['category']->name}}, Unidades: {{$prizeCategory['stock']}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                            @if ($categories->isNotEmpty())
                                <div class="col-md-12 my-3">
                                    <a href="" class="btn btn-custom-green" data-toggle="modal" data-target="#upload-users"><i class="fa fa-upload"></i> Agregar unidades a categoria</a>
                                </div>
                            @endif
                    <div class="col-md-12 text-center">
                      <button class="btn btn-primary btn-custom mt-4" type="submit">
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

<!-- Small modal -->
<div class="modal fade modal-custom" id="upload-users" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar unidades a categoria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <form action="/dashboard/prize-category" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="prize_id" value="{{$prize['id']}}">
              <div class="form-group row">
                <label for="exampleFormControlSelect1" class="col-sm-3 col-form-label">Seleccionar categoria</label>
                <div class="col-sm-9 my-auto">
                        <select class="form-control" name="category_id">
                            @forelse ($categories as $category)
                                <option value="{{$category['id']}}">{{$category['name']}}</option>
                            @empty
                                <option>Todas las categorias han sido seleccionadas</option>
                            @endforelse
                        </select>
                    </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputEmail1" class="col-sm-3 col-form-label">Unidades</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="stock" placeholder="Ingrese las unidades">
                </div>
              </div>
              <button type="submit" class="btn btn-custom fontSize18 my-3">AGREGAR</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

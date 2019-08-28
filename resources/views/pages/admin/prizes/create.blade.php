@extends('layouts.app')
@section('content')
<div class="page dashboard create-prizes">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        Crear Item <br>
                        <small><a href="{{ URL::previous() }}">Volver</a></small>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                        <form action="/dashboard/prizes" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nombre *</label>
                                        <input type="text" class="form-control" name="name" value="{{old('name')}}"
                                            required placeholder="Nombre">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Puntos *</label>
                                        <input type="number" class="form-control" name="point" value="{{old('point')}}"
                                            required placeholder="Puntos">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Unidades *</label>
                                        <input type="number" class="form-control" name="stock" value="{{old('stock')}}"
                                            required placeholder="Unidades">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Codigo *</label>
                                        <input type="text" class="form-control" name="code"
                                            value="{{old('code')}}" required placeholder="Codigo">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                            Imagen *
                                        </label>
                                        <input type="file" class="form-control" name="image" value="{{old('image')}}"
                                            multiple="false">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <textarea name="description" rows="10" value="{{old('description')}}"
                                            class="wysiwyg form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">
                                Crear Item
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
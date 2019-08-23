@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 py-3">
            <div class="card shadow">
                <div class="card-body mx-auto">
                    {{$user->name_company}}
                </div>
            </div>
        </div>
        <div class="col-6 py-3">
            <div class="card shadow">
                <div class="card-body mx-auto">
                    {{$user->sumpoints}}
                </div>
            </div>
        </div>
        <div class="col-6 py-3">
                <div class="card shadow">
                    <div class="card-body mx-auto">
                        categoría
                    </div>
                </div>
            </div>
        <div class="col-12 py-3">
            <div class="card shadow">
                <div class="card-header">Actualización de datos</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form @if ($user->updated)
                        action="/update-data/{{$updatedData['id']}}" {{ route('login') }}
                        @else
                        action="/update-data" 
                        @endif method="POST">
                        @if ($user->updated)
                        @method('PUT')
                        @endif
                        @csrf
                        <div class="row pb-4">
                            <div class="col-4">
                                    <div class="form-group">
                                            <label for="address">Nombre encargado:</label>
                                            <input name="name" type="text" class="form-control  @error('name') is-invalid @enderror" value="{{$updatedData->name}}" placeholder="Nombre encargado">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                            </div>
                            <div class="col-4">
                                    <div class="form-group">
                                            <label for="address">Correo electrónico:</label>
                                            <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{$updatedData->email}}" placeholder="Correo electrónico">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                        <label for="address">Telefono ó celular:</label>
                                <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" value="{{$updatedData->phone}}" placeholder="Telefono ó celular">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                    </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="address">Dirección:</label>
                                    <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" value="{{$updatedData->address}}" placeholder="Dirección">
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                        <label for="address">Ciudad:</label>
                                <input name="city_id" type="text" class="form-control @error('city_id') is-invalid @enderror" value="{{$updatedData->city_id}}" placeholder="Ciudad">
                                @error('city_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                    </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar Datos</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
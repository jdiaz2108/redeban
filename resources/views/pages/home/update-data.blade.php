@extends('layouts.app')

@section('content')
<div class="page update-data">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
            @include('layouts.points')
          <div class="row">
              <div class="col-md-12">
                @include('layouts.messages')
              </div>
              <div class="col-md-2"></div>
              <div class="col-md-8 text-center content-update">
                <h3>Actualización de datos</h3>

                <form action="{{$action}}" class="form-update" method="POST">
                    @if ($user->updated)
                      @method('PUT')
                    @endif
                    @csrf
                    <div class="form-group row row-input">
                      <div class="col-md-1 icon-col">
                        <img src="{{asset('images/icons/name.png')}}" alt="">
                      </div>
                      <div class="col-md-11">
                        <input name="name" type="text" class="input-custom  @error('name') is-invalid @enderror"
                          value="{{$updatedData->name}}" placeholder="Nombre encargado" required>
                      </div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row row-input">
                      <div class="col-md-1 icon-col">
                        <img src="{{asset('images/icons/email.png')}}" alt="">
                      </div>
                      <div class="col-md-11">
                        <input name="email" type="text" class="input-custom @error('email') is-invalid @enderror"
                          value="{{$updatedData->email}}" placeholder="Correo electrónico" required>
                      </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group row row-input">
                      <div class="col-md-1 icon-col">
                        <img src="{{asset('images/icons/cellphone.png')}}" alt="">
                      </div>
                      <div class="col-md-11">
                        <input name="phone" type="text" class="input-custom @error('phone') is-invalid @enderror"
                        value="{{$updatedData->phone}}" placeholder="Telefono ó celular" required>
                      </div>
                      @error('phone')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="form-group row row-input">
                      <div class="col-md-1 icon-col">
                        <img src="{{asset('images/icons/address.png')}}" alt="">
                      </div>
                      <div class="col-md-11">
                        <input name="address" type="text" class="input-custom @error('address') is-invalid @enderror"
                         value="{{$updatedData->address}}" placeholder="Dirección" required>
                      </div>
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group  row row-input">
                      <div class="col-md-12">
                        <strong class="text-white">Tu ciudad actual es: {{$city}}</strong>
                      </div>
                      <div class="col-md-1 icon-col">
                        <img src="{{asset('images/icons/city.png')}}" alt="">
                      </div>
                      <div class="col-md-5">
                        <select class="select-custom" id="department_id">
                          <option value="" disabled selected>Selecione una opción</option>
                          @foreach($departments as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-md-5">
                        <select name="city_id" id="city_id" type="text" class="select-custom @error('city_id') is-invalid @enderror" placeholder="Ciudad">
                          <option value="" disabled selected>Selecione una opción</option>
                        </select>
                      </div>
                      @error('city_id')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-custom">ENVIAR</button>
                    </div>
                </form>
                  </div>
              </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

@if (1 == 2)

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
      </div>
      <div class="modal-body">
          <p>

              Felicitaciones has ganado 100 puntos, selecciona un punto de venta para agregar los puntos.
          </p>
              <form>
                      <div class="form-row align-items-center">
                        <div class="col-12 my-1">
                          <label class="mr-sm-2 sr-only" for="inlineFormCustomSelect">Preference</label>
                          <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                            <option selected>Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>
                        </div>
                        <div class="col-auto my-3">
                          <button type="submit" class="btn btn-custom">Agregar puntos</button>
                        </div>
                      </div>
                    </form>
      </div>
    </div>
  </div>
</div>
@else

@endif

@endsection

@section('scripts')
    <script>
        $('#myModal').modal({
        keyboard: false,
        backdrop: 'static'
        })
    </script>
@endsection

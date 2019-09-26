@extends('layouts.app')

@section('content')
<div class="page login pt-0">
  <div class="container">
    <div class="row">
        <div class="col-md-5 pt-3">
          <div class="login-form">
              @include('layouts.messages')
            <form method="POST" action="{{ route('change.password') }}">
                @csrf
                <div class="form-group text-center">
                  <h2 class="title">Actualizar Contraseña</h2>
                </div>
                <div class="form-group row row-input">
                    <div class="col-1 icon-col">
                      <img src="{{asset('images/icons/pass.png')}}" alt="">
                    </div>
                    <div class="col-11">
                        <input id="password" type="password" class="input-custom @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" autofocus placeholder="Nueva Contraseña">
                    </div>
                    @error('identification')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row row-input">
                  <div class="col-1 icon-col">
                    <img src="{{asset('images/icons/pass.png')}}" alt="">
                  </div>
                  <div class="col-11">

                      <input id="password-confirm" type="password" class="input-custom" name="password_confirmation" required autocomplete="new-password" placeholder="Repetir Nueva Contraseña">
                  </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group text-center pt-4">
                    <button type="submit" class="btn btn-primary btn-custom">
                        ACTUALIZAR
                    </button>
                </div>
            </form>
          </div>
        </div>

        <div class="col-md-7 content-page h-100">
                <div class="row">
                    <div class="col-md-12 my-3">
                      <div class="content-text" style="font-size: 20px">
                        ¡Bienvenido! Estás a un paso de activarte en la Transacción Ganadora de Redeban,
                        actualiza tu contraseña para conocer cómo ganar premios haciendo transacciones con tus datáfonos Redeban.
                      </div>
                    </div>
                    {{-- <div class="col-md-4">
                      <img src="http://redeban.local/images/terms.png" class="img-fluid" alt="">
                    </div> --}}
                </div>
              </div>
    </div>
  </div>
</div>
@endsection

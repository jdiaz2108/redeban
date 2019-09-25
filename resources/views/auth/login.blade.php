@extends('layouts.app')

@section('content')
<div class="page login">
  <div class="container">
    <div class="row">
        <div class="col-md-5">
          <div class="login-form">
              @include('layouts.messages')
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group text-center">
                  <h2 class="title">Inicia Sesión</h2>
                </div>
                <div class="form-group row row-input">
                    <div class="col-1 icon-col">
                      <img src="{{asset('images/icons/user.png')}}" alt="">
                    </div>
                    <div class="col-11">
                      <input id="identification" type="text" class="input-custom @error('identification') is-invalid @enderror"
                        name="identification" value="{{ old('identification') }}" required autocomplete="identification" placeholder="Usuario (NIT)" autofocus>
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
                    <input id="password" type="password" class="input-custom @error('password') is-invalid @enderror"
                      name="password" required autocomplete="current-password" placeholder="Contraseña">
                  </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  @if (Route::has('password.request'))
                      <a class="text-restore-password" href="{{ route('password.request') }}">
                          Recuperar contraseña
                      </a>
                  @endif
                  <br> <br>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary btn-custom">
                        INGRESAR
                    </button>
                </div>
            </form>
          </div>
        </div>
        <div class="col-md-7">
          <img src="{{asset('images/transaccion-ganadora.png')}}" class="img-fluid img-logo d-block" alt="Transacción Ganadora">
        </div>
    </div>
  </div>
</div>
@endsection

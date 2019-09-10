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

        <div class="col-md-7 content-page">
                <div class="row">
                    <div class="col-md-12">
                      <div class="content-text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                        enim ad minim veniam, quis nostrud exercitation ullamco laboris
                        nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                        in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                        nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                        sunt in culpa qui officia deserunt mollit anim id est laborum.
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

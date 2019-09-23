@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 reset-pass">
            <div class="card">
                <div class="card-header title row">
                    <div class="col-8">
                        Restaurar contraseña
                    </div>
                    <div class="col-4">
                            <a href="/" class="btn btn-custom-green text-right">Volver al inicio</a>
                        </div>
                </div>

                <div class="card-body">
                        @include('layouts.messages')

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Correo electrónico:</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="input-custom input-line @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-custom">
                                    Restaurar contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

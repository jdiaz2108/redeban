@extends('layouts.app')
@section('content')
<div class="page history-points">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
        <div class="row">
          <div class="col-10 my-auto">
            <h2 class="title">Términos y condiciones</h2>
            <hr class="line-text">
          </div>
          <div class="col-md-2">
            <img src="{{asset('images/terms.png')}}" class="img-fluid" alt="">
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="content-text">
                    <iframe class="w-100" style="min-height: 600px; border-radius: 20px;" src="/documents/Terminos_y_Condiciones_La_Trasanccion_Ganadora_Octubre_2019"></iframe>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

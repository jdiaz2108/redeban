@extends('layouts.app')
@section('content')
<div class="page history-points">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
        <div class="row">
          <div class="col-9">
            <h2 class="title">¿Qué es?</h2>
            <hr class="line-text">
          </div>
        </div>
        <div class="row">
            <div class="col-md-9">
              <div class="content-text py-5" style="font-size: 18px">
                La Transacción Ganadora es un programa de recompensas pensado para nuestros clientes que tienen pequeños y medianos negocios, para que por medio de transacciones, puedan ganar diferentes premios.
                <br><br>
                Recuerda que estarás concursando por código único, vas a tener una meta, si la cumples ganarás un premio, y si sobre cumples ganarás mucho más.
                <br><br>
                Aquí ganas por utilizar tu código único y ayudas a impulsar aún más tu negocio. Así que te invitamos a ser parte de esta gran experiencia donde entre más transacciones realices, más oportunidades tendrás de ganar increíbles premios.

              </div>
            </div>
            <div class="col-md-3">
              <img src="{{asset('images/about.png')}}" class="img-fluid" alt="">
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

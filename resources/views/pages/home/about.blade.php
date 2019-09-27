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
              <div class="content-text py-5">
                1.	Haz clic en el link de abajo para ingresar a la plataforma<br>
                2.	Una vez ingresas encontrarás el paso a paso pero acá te los recordamos<br>
                3.	Después actualiza tus datos para activarte<br>
                4.	Por actualizar tus datos ganarás tus primeros puntos para que empueces a acumular<br>
                5.	Recuerda que podrás acumular y redimir tus puntos por código único <br>
                6.	Asigna los puntos a un solo código único o si prefieres a todos por igual<br>
                7.	Después irás a home donde podrás ver cuántos puntos tienes por cada código único y la meta de cada uno<br>
                8.	Deberás seleccionar el código único con el que quieras:<br>
                -	Revisar historial de puntos<br>
                -	Historial de transacciones<br>
                -	Redimir premios<br>
                (todas las opciones anteriores als encontrarás en el menú)<br>
                <br>
                Recuerda que tendrás que regresar al home para revisar la información anterior, de cada código único.<br>
                <br>
                <br>
                1.	Actualiza tus datos para activarte en la transacción ganadora y ganar los primeros puntos para que empieces a acumular<br>
                2.	Escoge el código único al que quieras asignar los puntos (puedes escoger uno o asignarlos por igual en todos tus códigos únicos)<br>
                9.	Regresa al home para ver cuántos puntos tienes por cada código único y la meta de cada uno<br>
                10.	Deberás seleccionar el código único con el que quieras:<br>
                -	Revisar historial de puntos<br>
                -	Historial de transacciones<br>
                -	Redimir premios<br>
                (todas las opciones anteriores als encontrarás en el menú)<br>
                <br>
                Recuerda que tendrás que regresar al home para revisar la información anterior, de cada código único.<br>
                <br>
                Y listo empieza a acumular y a ganar con la transacción ganadora!<br>

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

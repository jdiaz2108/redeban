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
                <h5 class="font-weight-bold" style="color: #fff06e;">¿QUÉ ES?:</h5>
                La Transacción Ganadora es un programa de recompensas especialmente pensado para nuestros clientes que tienen pequeños y medianos negocios. Por medio de transacciones que realicen con su datáfono de Redeban, podrán acumular puntos para redimirlos en diferentes premios.
                <br><br>
                <h5 class="font-weight-bold" style="color: #fff06e;">¿CÓMO SÉ CUÁL ES MI META?:</h5>
                Dirígete a tu perfil dando clic en INICIO. En esta sección podrás encontrar tus puntos acumualdos a la fecha, tú meta actual de transacciones y las transacciones hechas hasta la fecha.
                <br><br>
                <h5 class="font-weight-bold" style="color: #fff06e;">¿CÓMO ACUMULO PUNTOS?:</h5>
                Podrás acumular puntos por código único. Es decir, entre más transacciones realices con tu datáfono, o datáfonos de Redeban, más puntos acumularás para redimirlos en increíbles premios.
                <br><br>
                <h5 class="font-weight-bold" style="color: #fff06e;">¿CÓMO USO LOS PUNTOS?:</h5>
                Tus puntos podrás usarlos para redimir premios. Primero deberás estar logueado en tu sesión dentro de la plataforma, luego tendrás que dirigirte al Catálogo y revisar los premios que están disponibles para ti según los puntos que tengas. Al tratar de redimir, la plataforma te guiará e indicará si cuentas con los puntos necesarios para realizar la redención y de ser así, podrás seguir el proceso que la plataforma te irá indicando para lograrlo.
                <br><br>
                <h5 class="font-weight-bold" style="color: #fff06e;">¿A DÓNDE LLEGAN LAS REDENCIONES?:</h5>
                Los premios que has redimido serán enviadas a la dirección que está registrada en la plataforma, de no ser así, deberás actualizarla. Recuerda que tenemos 15 días hábiles para hacer llegar tu premio.
                <br><br>
                <h5 class="font-weight-bold" style="color: #fff06e;">¿CUÁL ES LA VIGENCIA DE LOS PUNTOS?:</h5>
                La vigencia de los puntos acaba el 30 de noviembre, fecha en la que se acaba esta primera fase del programa.
                <br><br>
                <h5 class="font-weight-bold" style="color: #fff06e;">¿CUÁL ES LA VIGENCIA DE LA META?:</h5>
                La vigencia de la meta es mensual, es decir que en noviembre tendrás la oportunidad de cumplir una nueva meta.
                <br><br>
                <h5 class="font-weight-bold" style="color: #fff06e;">ACTUALIZACIÓN DE TRANSACCIONES Y PUNTOS:</h5>
                Recuerda que estas actualizaciones se realizan dentro de la plataforma todos los miércoles al final del día. Si tienes problemas al verlos, dirígete a mesa de ayuda para poder contactarnos y brindarte la información que necesitas.
                <br><br>
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

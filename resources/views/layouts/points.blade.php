<div class="row mb-3">
        <div class="col-8">
          <h2 class="name-company">{{$user->name_company}}</h2>
          <hr class="line">
          @if (session('current_shop'))
            <p class="points">Puntos {{$user->points}}</p>
            @else
            <a href="/shop" class="btn btn-custom">Seleccionar punto de venta</a>
            @endif
        </div>
        <div class="col-4 row text-right">
            <div class="col-8 my-auto">

              <h4 class="text-points-cu">
                  C.U. {{session('current_shop')}}
                  </h4>
                  <h4 class="text-points-cu">
                      Puntos {{$user->points}}
                      </h4>
            </div>
            <div class="col-4 my-auto">

                @if(!is_null($user->category_id))
                  <img src="{{asset('/images/img-datafono.png')}}" class="" alt="">
                @endif
            </div>
        </div>
      </div>

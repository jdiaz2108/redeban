<div class="row mb-3">
        <div class="col-9">
          <h2 class="name-company">{{$user->name_company}}</h2>
          <hr class="line">
          @if (session('current_shop'))
            <p class="points">Puntos {{$user->points}}</p>
            @else
            <a href="/shop" class="btn btn-custom">Seleccionar punto de venta</a>
            @endif
        </div>
        <div class="col-3">
          @if(!is_null($user->category_id))
            <img src="{{asset($user->categoryImage($user->category_id))}}" alt="">
          @endif
        </div>
      </div>

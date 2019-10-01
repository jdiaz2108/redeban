<div class="row mb-3 global-point">
    <div class="col-12 col-md-8">

        <div class="d-none d-md-block">
            <h2 class="name-company" style="color: #ffffff">{{$user->name_company}}</h2>
        </div>
        <div class="d-block d-md-none">
            <h5 class="name-company" style="color: #ffffff">{{$user->name_company}}</h5>
        </div>

        <hr class="line-purple">
        <div class="d-none d-md-block">
            <h3 class="name-company" style="color: #ffffff">{{$title ?? ''}}</h3>
        </div>
        <div class="d-block d-md-none">
            <h5 class="name-company" style="color: #ffffff">{{$title ?? ''}}</h5>
        </div>
    </div>
    <div class="col-12 col-md-4 row text-right">
        <div class="col-8 my-auto p-0">
            @if (session('current_shop'))
                <h4 class="text-points-cu">
                    C.U. {{session('current_shop')}}
                </h4>
                <h4 class="text-points-cu">
                    Puntos {{$user->points}}
                </h4>
            @endif
        </div>
        <div class="col-4 p-0 my-auto">
            @if(!is_null($user->category_id))
                <img src="{{asset('/images/img-datafono.png')}}" class="" alt="">
            @endif
        </div>
    </div>
</div>

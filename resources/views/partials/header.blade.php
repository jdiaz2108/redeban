<div class="container">
  <div class="row header-custom @auth auth-header @endauth">
    @guest
    <div class="col-md-4">
      <img src="{{asset('images/logo-redeban-white.png')}}" class="img-fluid" alt="Redeban">
    </div>
    <div class="col-md-8"></div>
    @else
    <div class="col-md-4">
      @role('admin')
      <a href="{{url('dashboard')}}">
      @else
      <a href="{{url('home')}}">
      @endrole
        <img src="{{asset('images/logo.png')}}" class="img-fluid" width="140" alt="La Transacción Ganadora">
        <img src="{{asset('images/logo-redeban-white.png')}}" alt="Logo Redeban">
      </a>
    </div>
    <div class="col-md-4">

    </div>
    <div class="col-md-4">
      <p class="pull-right text-menu">
        @role('user')
        <a href="{{url('catalog')}}" class="catalog">CATÁLOGO <i class="fa fa-shopping-cart"></i></a>
        @endrole
        <span id="btn-custom-sidemenu">MENÚ <i class="fa fa-bars"></i></span>
      </p>
    </div>
    @endauth
  </div>
</div>

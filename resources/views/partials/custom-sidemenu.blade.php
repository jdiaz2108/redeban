@php
    $menu = (new \App\Helpers\GlobalApp)->menu();

    function isCurrentUrl($item)
    {
        $val = false;

        $baseUrl = explode($item, url()->current());
        $route = explode($baseUrl[0], url()->current());

        if ($item == $route[1]) {
            $val = true;
        }

        return $val;
    }
@endphp

<input type="hidden" id="val_sidemenu" value="0">

<div class="custom-sidemenu d-none" id="custom-sidemenu">
  <div class="list-group list-group-root well menuright">
    <a id="btn-custom-sidemenu-close" class="list-group-item item-menu">
      <i class="fa fa-times-circle"></i> &nbsp; MENÚ
    </a>
    @if (session('current_shop'))
    <a class="list-group-item">
        <i class="fa fa-circle-o"></i> &nbsp; Código único: {{session('current_shop')}}
    </a>
    @endif
    @if (Auth::user()->changedPassword)
    @foreach($menu as $item)
      @hasanyrole($item['roles'])
        <a href="{{url($item['url'])}}" class="list-group-item @if(strpos(url()->current(), $item['url']) !== FALSE) 'active' @endif">
            <i class="fa fa-circle"></i> &nbsp; {{$item['name']}}
        </a>
      @endhasanyrole
    @endforeach
    @endif
    @role('user')
    <a class="list-group-item" onclick="window.scrollTo(0,document.body.scrollHeight);document.getElementById('btn-custom-sidemenu-close').click()">
        <i class="fa fa-circle"></i> &nbsp; CONTACTO | MESA DE AYUDA
    </a>
@endrole
    <a class="list-group-item"  id="btn-custom-sidemenu-close" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
      <i class="fa fa-circle"></i> &nbsp; CERRAR SESIÓN
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
         @csrf
    </form>
  </div>
</div>

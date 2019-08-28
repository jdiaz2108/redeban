<div class="sidebar" data-color="rose" data-background-color="black" data-image="https://demos.creative-tim.com/material-dashboard-pro/assets/img/sidebar-1.jpg">

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
  
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
          Api
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          Whatsapp
        </a>
      </div>
      <div class="sidebar-wrapper ps-container ps-theme-default ps-active-y" data-ps-id="ed08d521-f254-6547-5bda-c84c934cb8af">
        <div class="user">
          <div class="photo">
            <img src="/images/avatar.jpg">
          </div>
          <div class="user-info">
                  @guest
                  <a data-toggle="collapse" href="#collapseExample" class="username">
                          <span>
                              No Registro
                            <b class="caret"></b>
                          </span>
                        </a>
  
                        @else
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
                  {{ Auth::user()->name }}
                <b class="caret"></b>
              </span>
            </a>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                  @csrf
                                              </form>
                    <span class="sidebar-mini"> C </span>
                    <span class="sidebar-normal"> Cerrar Sesión </span>
                  </a>
                </li>
              </ul>
            </div>
                @endguest
          </div>
        </div>
            <ul class="nav navbar-nav nav-mobile-menu">
            </ul>
            <ul class="nav">
                @guest
                <li class="nav-item {{(strpos(Route::currentRouteName(), 'login') !== false) ? 'active' : ''}}">
                      <a class="nav-link" href="../login">
                          <i class="material-icons">vpn_key</i>
                          <p>Iniciar Sesión</p>
                      </a>
                  </li>
                  <li class="nav-item {{(strpos(Route::currentRouteName(), 'register') !== false) ? 'active' : ''}}">
                          <a class="nav-link" href="../register">
                              <i class="material-icons">how_to_reg</i>
                              <p>Registrar</p>
                          </a>
                      </li>
                      @else
                      @foreach($menu as $item)
                      @hasanyrole($item['roles'])
                      <li class="nav-item {{(strpos(Route::currentRouteName(), $item['current']) !== false) ? 'active' : ''}}">
                        <a class="nav-link" href="{{$item['url']}}">
                          <i class="material-icons">{{$item['icon']}}</i>
                          <p>{{$item['name']}}</p>
                        </a>
                      </li>
                      @endhasanyrole
                      @endforeach
          @endguest
        </ul>
  </div>
    <div class="sidebar-background" style="background-image: url(https://demos.creative-tim.com/material-dashboard-pro/assets/img/sidebar-1.jpg) "></div></div>
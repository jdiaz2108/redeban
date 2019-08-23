<header id="header" class="main-header">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="{{url('/')}}">
                    <img src="{{asset('images/logo.png')}}" alt="Club minidatafono - Redeban" class="img-responsive">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                @if(Auth::check())
                 @if(Auth::user()->hasAnyRole(['user'])) 
                <ul class="nav navbar-nav">
                    <li><a href="#">Noticias</a></li>
                    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"
                     role="button" aria-haspopup="true" aria-expanded="false">Herramientas<span class="caret"></span></a>
                     <ul class="dropdown-menu">
                        <li><a href="#">Directorio</a></li>
                        <li><a href="#">Canvas</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                  role="button" aria-haspopup="true" aria-expanded="false">Acerca de<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">¿Qué es Club MiniDatáfono?</a></li>
                    <li><a href="#">¿Cómo operar?</a></li>
                </ul>
            </li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Contacto</a></li>
            <li><button class="btn-accumulation" onclick="#">Programa de Acumulación</button></li>
        </ul>
         @endif 
        <ul class="nav navbar-nav navbar-right">
            <li>
                <label class="user-info">
                    @if(Auth::user()->hasAnyRole(['admin']))
                    {{ 'Admin' }}
                    @endif
                </label>
            </li>
            <li>
               <button class="btn-logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Cerrar Sesión</button>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
    @else
    @include('partials.login')
    @endif
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
    </nav>
        <div class="deco-line">
            <div class="line orange"></div>
            <div class="line purple"></div>
            <div class="line green"></div>
            <div class="line red"></div>
            <div class="line blue"></div>
        </div>
    </header>
    
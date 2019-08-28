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
                @auth
                @hasrole('admin')
                    <ul class="nav navbar-nav">
                        <li><a href="/prizes">/prizes</a><a href="/update-data">/update-data</a></li>
                        <li><a href="/dashboard/prizes">/dashboard/prizes</a></li>
{{--                     <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                      role="button" aria-haspopup="true" aria-expanded="false">Acerca de<span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">¿Qué es Club MiniDatáfono?</a></li>
                        <li><a href="#">¿Cómo operar?</a></li>
                    </ul>
                </li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contacto</a></li>
                <li><button class="btn-accumulation" onclick="#">Programa de Acumulación</button></li> --}}
            </ul>
             @endhasrole 
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <label class="user-info">
                            @hasrole('admin')
                        {{ 'admin' }}
                        @endhasrole
                    </label>
                </li>
                <li>
                   <button class="btn-logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Cerrar Sesión</button>
                   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
                @endauth
                
                @guest
                    @include('partials.login')
                @endguest
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
    
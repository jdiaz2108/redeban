@extends('layouts.app')
@section('content')
<div class="page history-points">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
        <div class="row">
          <div class="col-9">
            <h2 class="title">Términos y condiciones</h2>
            <hr class="line-text">
          </div>
        </div>
        <div class="row">
            <div class="col-md-9">
              <div class="content-text">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                enim ad minim veniam, quis nostrud exercitation ullamco laboris
                nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                sunt in culpa qui officia deserunt mollit anim id est laborum.
              </div>
            </div>
            <div class="col-md-3">
              <img src="{{asset('images/datafono.png')}}" class="img-fluid" alt="">
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

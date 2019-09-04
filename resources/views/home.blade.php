@extends('layouts.app')

@section('content')
<div class="page dashboard">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              @if (session('status'))
                  <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                  </div>
              @endif

              You are logged in!
          </div>
      </div>
  </div>
</div>
@endsection

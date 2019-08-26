@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 py-3">
                <div class="row">
                    <div class="col-6">
                        <img src="https://schneidereit-berlin.de/wp-content/uploads/2019/01/platzhalter.png" class="card-img-top bg-secondary rounded" alt="...">
                    </div>
                    <div class="col-6">
                        <h2 class="text-center">{{$prize['name']}}</h2>
                        <div class="card shadow my-3">
                            <div class="card-body">
                                <p class="card-text">{{$prize['description']}}</p>
                            </div>
                        </div>
                        <div class="card shadow my-3">
                            <div class="card-body">
                                <p class="card-text text-center">Valor: {{$prize['point']}} Puntos</p>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush mb-0">
                            <li class="list-group-item">Quedan: {{$prize['stock']}} unidades</li>
                        </ul>
                        <div class="card shadow my-3">
                                <div class="card-body mx-auto">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalRedeem">
                                            Redimir
                                        </button>
                                </div>
                            </div>
                    </div>
                </div>
        </div>
    </div>


          
          <!-- Modal -->
          <div class="modal fade" id="ModalRedeem" tabindex="-1" role="dialog" aria-labelledby="ModalRedeemTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="ModalRedeemTitle">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  ...
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>


</div>
@endsection
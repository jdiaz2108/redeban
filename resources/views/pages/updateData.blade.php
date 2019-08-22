@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{$updatedData}}
                    <form @if (Auth::user()->updated)
                            action="/update-data/{{$updatedData['id']}}"
                            @else
                            action="/update-data"
                    @endif method="POST">
                    @if (Auth::user()->updated)      <input type="hidden" name="_method" value="PUT"> @endif
                        @csrf
                        <div class="row pb-4">
                            <div class="col">
                                <input name="name" type="text" class="form-control" value="{{$updatedData->name}}" placeholder="Nombre compañia">
                            </div>
                            <div class="col">
                                <input name="in_charge" type="text" class="form-control" value="{{$updatedData->in_charge}}" placeholder="Nombre encargado">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
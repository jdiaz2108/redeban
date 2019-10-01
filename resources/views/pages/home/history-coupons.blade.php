@extends('layouts.app')
@section('content')
<div class="page history-points">
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 content-page">
            @include('layouts.points', ['title' => 'Historial de redenciones'])
        <div class="row">
            <div class="col-md-9">
                @include('layouts.messages')
                <div class="table-responsive-md">
                <table class="table table-custom table-striped">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Imagen Bono</th>
                            <th>Nombre bono</th>
                            <th>fecha</th>
                        </tr>
                    </thead>
                    <tbody class="content-directory">
                        @forelse($coupons as $coupon)
                        <tr>
                            <td>{{$coupon['code']}}</td>
                            <td>
                                @if ($coupon['prizecategory']['prize']['image'])
                                    <img src="{{$coupon['prizecategory']['prize']['image']}}" width="110">
                                @else
                                    <img src="{{asset('images/image.png')}}" width="110">
                                @endif
                            </td>
                            <td>{{$coupon['prizecategory']['prize']['name']}}</td>
                            <td>{{$coupon['created_at']}}</td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="4" align="center">No existen registros</td>
                        </tr>
                      @endforelse
                    </tbody>
                </table>
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

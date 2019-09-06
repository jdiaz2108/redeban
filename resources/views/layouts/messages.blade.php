@if ($errors->any())
<div class="alert alert-danger text-center alert-custom-red">
  @foreach ($errors->all() as $error)
  <span>{{ $error }}</span> <br>
  @endforeach
</div>
@endif
@if (session('status'))
<div class="alert alert-success text-center alert-custom-green">
    {{ session('status') }}
</div>
@endif

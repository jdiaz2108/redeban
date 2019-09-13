@php
    $departments = (new \App\Helpers\GlobalApp)->departments();
@endphp
<div class="container-fluid contact">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Contacto</h2>
				<hr class="line">
			</div>
			<div class="col-md-12">
				<form class="" action="{{url('contact')}}" method="post">
					@csrf
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<input type="text" name="name" class="form-control input-custom" placeholder="Nombres" required>
							</div>
							<input type="text" name="phone" class="form-control input-custom" placeholder="Celular" required>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<input type="text" name="email" class="form-control input-custom" placeholder="Correo" required>
							</div>
							<div class="row">
								<div class="col-md-6">
									<select class="form-control select-custom" id="department_contact">
										<option value="" disabled selected>Selecione Departamento</option>
										@foreach($departments as $item)
											<option value="{{$item->id}}">{{$item->name}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-6">
									<select name="city_id" id="city_contact" type="text" class="form-control select-custom" placeholder="Ciudad">
										<option value="" disabled selected>Selecione Ciudad</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-4 form-group">
							<textarea name="description" class="form-control input-custom" rows="3" placeholder="Escribe tu mensaje aquí..." required></textarea>
						</div>
						<div class="col-md-2 text-center">
							<br>
							<button type="submit" class="btn btn-custom-red">Enviar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

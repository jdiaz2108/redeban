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
							<input type="text" name="cellphone" class="form-control input-custom" placeholder="Celular" required>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<input type="text" name="email" class="form-control input-custom" placeholder="Correo" required>
							</div>
							<input type="text" name="city" class="form-control input-custom" placeholder="Ciudad" required>
						</div>
						<div class="col-md-4 form-group">
							<textarea name="message" class="form-control input-custom" rows="3" placeholder="Escribe tu mensaje aquí..." required></textarea>
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


<style>
.example-modal .modal {
	position: relative;
	top: auto;
	bottom: auto;
	right: auto;
	left: auto;
	display: block;
	z-index: 1;
}

.example-modal .modal {
	background: transparent !important;
}
</style>
<div class="col-md-12">
	<div class="modal fade" id="modal-registrocliente">
		<div class="modal-dialog">
			<div class="modal-content">
				{!! Form::open(['id'=>'myForm'])  !!}
				{{ csrf_field() }}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>

						<h4 class="modal-title">Registrar Nuevo Cliente</h4>           

					</div>
					<div class="modal-body">
						<div class="box box-default">
							<div class="panel-heading">

								<br />
								<br />
								@if ($errors->any())
								<ul class="alert alert-danger">
									@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
									@endforeach
								</ul>
								@endif

							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div class="row">

									<form method="POST" action="{{ url('/person/cliente') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
										{{ csrf_field() }}

										<div class="col-md-12">
											<div class="form-group {{ $errors->has('nom_cli') ? 'has-error' : ''}}">
												<label for="nom_cli" class="col-md-4 col-lg-4 control-label">{{ 'Nombre' }}</label>
												<div class="col-md-6 col-lg-8">
													<input class="form-control" name="nom_cli" type="text" id="nom_cli_modal" value="{{ $cliente->nom_cli or ''}}" autofocus="">
													{!! $errors->first('nom_cli', '<p class="help-block">:message</p>') !!}
												</div>
											</div>
											<div class="form-group {{ $errors->has('app_cli') ? 'has-error' : ''}}">
												<label for="app_cli" class="col-md-4 col-lg-4 control-label">{{ 'Apellido' }}</label>
												<div class="col-md-6 col-lg-8">
													<input class="form-control" name="app_cli" type="text" id="app_cli_modal" value="{{ $cliente->app_cli or ''}}" >
													{!! $errors->first('app_cli', '<p class="help-block">:message</p>') !!}
												</div>
											</div>
											<div class="form-group {{ $errors->has('ced_cli') ? 'has-error' : ''}}">
												<label for="ced_cli" class="col-md-4 col-lg-4 control-label">{{ 'Cedula' }}</label>
												<div class="col-md-6 col-lg-8">
													<input class="form-control" name="ced_cli" type="number" id="ced_cli_modal" value="{{ $cliente->ced_cli or ''}}" >
													{!! $errors->first('ced_cli', '<p class="help-block">:message</p>') !!}
												</div>
											</div>
											<div class="form-group {{ $errors->has('ruc_cli') ? 'has-error' : ''}}">
												<label for="ruc_cli" class="col-md-4 col-lg-4 control-label">{{ 'Ruc' }}</label>
												<div class="col-md-6 col-lg-8">
													<input class="form-control" name="ruc_cli" type="number" id="ruc_cli_modal" value="{{ $cliente->ruc_cli or ''}}" >
													{!! $errors->first('ruc_cli', '<p class="help-block">:message</p>') !!}
												</div>
											</div>
											<div class="form-group {{ $errors->has('dir_cli') ? 'has-error' : ''}}">
												<label for="dir_cli" class="col-md-4 col-lg-4 control-label">{{ 'Dirección' }}</label>
												<div class="col-md-6 col-lg-8">
													<input class="form-control" name="dir_cli" type="text" id="dir_cli_modal" value="{{ $cliente->dir_cli or ''}}" >
													{!! $errors->first('dir_cli', '<p class="help-block">:message</p>') !!}
												</div>
											</div>
											<div class="form-group {{ $errors->has('mail_cli') ? 'has-error' : ''}}">
												<label for="mail_cli" class="col-md-4 col-lg-4 control-label">{{ 'Correo' }}</label>
												<div class="col-md-6 col-lg-8">
													<input class="form-control" name="mail_cli" type="text" id="mail_cli_modal" value="{{ $cliente->mail_cli or ''}}" >
													{!! $errors->first('mail_cli', '<p class="help-block">:message</p>') !!}
												</div>
											</div>
											<div class="form-group {{ $errors->has('tlf_cli') ? 'has-error' : ''}}">
												<label for="tlf_cli" class="col-md-4 col-lg-4 control-label">{{ 'Teléfono' }}</label>
												<div class="col-md-6 col-lg-8">
													<input class="form-control" name="tlf_cli" type="text" id="tlf_cli_modal" value="{{ $cliente->tlf_cli or ''}}" >
													{!! $errors->first('tlf_cli', '<p class="help-block">:message</p>') !!}
												</div>
											</div>
										</div>

										<div class="form-group">
											<div class="col-md-offset-10 col-md-4">
												<input class="btn btn-primary save_cli_person" type="submit" value="{{ $submitButtonText or 'Crear' }}">
											</div>
										</div>

									</form>
								</div>
								<!-- /.row -->
							</div>
							<!-- /.box-body -->

						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<!--{!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}-->
					</div>
					{!! Form::close() !!}
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
	</div>


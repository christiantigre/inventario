@extends('person.page')
@section('content')
@include('errors.messages')
@include('admin.contabilidad.infosection')
<section class="content">
  <div class="row">
    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-8">

          <!-- Main content -->
          <section class="content">

            <div class="row">
              <div class="col-md-12">

                <!-- Profile Image -->
                <div class="panel panel-default">
                  <div class="panel-heading">Editar Perfíl #{{ $perfil->email }}</div>
                  <div class="panel-body">
                    <a href="{{ url('/person/settings') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                    <ul class="alert alert-danger">
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                    @endif


                    {!! Form::model($perfil, [
                      'method' => 'PATCH',
                      'url' => ['/person/settings', $perfil->id],
                      'class' => 'form-horizontal', 
                      'enctype'=>'multipart/form-data',
                      'files' => true,
                      'accept-charset'=>'UTF-8'
                      ]) !!}

                      {{ method_field('PATCH') }}
                      {{ csrf_field() }}

                      <div class="col-md-12">
                        PERFÍL
                        <fieldset>
                          <legend>
                          </legend>
                          <div class="col-md-6">

                            <div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
                              <label for="cliente" class="col-md-4 control-label">{{ 'Nombre' }}</label>
                              <div class="col-md-8">
                                 {!! Form::text('nombre', $perfil->nombre , ['class' => 'form-control input-sm', 'id'=>'nombre','placeholder'=>'Nombre','autocomplete'=>'off']) !!}
                               
                               {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
                             </div>
                           </div>

                           <div class="form-group {{ $errors->has('apellido') ? 'has-error' : ''}}">
                            <label for="apellido" class="col-md-4 control-label">{{ 'Apellido' }}</label>
                            <div class="col-md-8">
                              {!! Form::text('apellido', $perfil->apellido , ['class' => 'form-control input-sm', 'id'=>'apellido','placeholder'=>'Apellido','autocomplete'=>'off']) !!}

                             {!! $errors->first('apellido', '<p class="help-block">:message</p>') !!}
                           </div>
                         </div>

                         <div class="form-group {{ $errors->has('cedula') ? 'has-error' : ''}}">
                          <label for="cedula" class="col-md-4 control-label">{{ 'ID' }}</label>
                          <div class="col-xs-4">
                              {!! Form::text('cedula', $perfil->cedula , ['class' => 'form-control input-sm', 'id'=>'cedula','placeholder'=>'Cedula','autocomplete'=>'off']) !!}

                            {!! $errors->first('cedula', '<p class="help-block">:message</p>') !!}
                          </div>
                          <div class="col-xs-4">

                              {!! Form::text('ruc', $perfil->ruc , ['class' => 'form-control input-sm', 'id'=>'ruc','placeholder'=>'RUC','autocomplete'=>'off']) !!}

                            {!! $errors->first('ruc', '<p class="help-block">:message</p>') !!}
                          </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                          <label for="email" class="col-md-4 control-label">{{ 'Correo' }}</label>
                          <div class="col-md-8">
                            {!! Form::text('email', $perfil->email , ['class' => 'form-control input-sm', 'id'=>'email','placeholder'=>'Email','autocomplete'=>'off','disabled'=>'disabled']) !!}

                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                          </div>
                        </div>

                        <div class="form-group {{ $errors->has('fecha_nacimiento') ? 'has-error' : ''}}">
                          <label for="fecha_nacimiento" class="col-md-4 control-label">{{ 'Cumpleaños' }}</label>
                          <div class="col-md-8">

                            {!! Form::text('fecha_nacimiento', $perfil->fecha_nacimiento , ['class' => 'form-control input-sm datepicker', 'id'=>'fecha_nacimiento','placeholder'=>'YYYY-MM-DD']) !!}

                            {!! $errors->first('fecha_nacimiento', '<p class="help-block">:message</p>') !!}
                          </div>
                        </div>

                        <div class="form-group {{ $errors->has('titulo') ? 'has-error' : ''}}">
                          <label for="titulo" class="col-md-4 control-label">{{ 'Titulo' }}</label>
                          <div class="col-md-8">

                            {!! Form::text('titulo', $perfil->titulo , ['class' => 'form-control input-sm', 'id'=>'titulo','placeholder'=>'Area especialización']) !!}

                            {!! $errors->first('titulo', '<p class="help-block">:message</p>') !!}
                          </div>
                        </div>

                      </div>

                      <div class="col-md-6">

                        <div class="form-group {{ $errors->has('telefono') ? 'has-error' : ''}}">
                          <label for="telefono" class="col-md-4 control-label">{{ 'Telefono' }}</label>
                          <div class="col-md-6">


                            {!! Form::text('telefono', $perfil->telefono , ['class' => 'form-control input-sm', 'id'=>'telefono','placeholder'=>'Telefono','autocomplete'=>'off']) !!}

                            {!! $errors->first('telefono', '<p class="help-block">:message</p>') !!}
                          </div>
                        </div>

                        <div class="form-group {{ $errors->has('celular') ? 'has-error' : ''}}">
                          <label for="celular" class="col-md-4 control-label">{{ 'Celular' }}</label>
                          <div class="col-md-6">

                             {!! Form::text('celular', $perfil->celular , ['class' => 'form-control input-sm', 'id'=>'celular','placeholder'=>'Celular','autocomplete'=>'off']) !!}

                            {!! $errors->first('celular', '<p class="help-block">:message</p>') !!}
                          </div>
                        </div>

                        <div class="form-group {{ $errors->has('genero') ? 'has-error' : ''}}">
                          <label for="genero" class="col-md-4 control-label">{{ 'Genero' }}</label>
                          <div class="col-md-8">



                            <select name="genero" class="form-control" id="genero" >
                                @foreach (json_decode('{"1":"Femenino","0":"Masculino"}', true) as $optionKey => $optionValue)
                                    <option value="{{ $optionKey }}" {{ (isset($perfil->genero) && $perfil->genero == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                                @endforeach
                            </select>


                            {!! $errors->first('genero', '<p class="help-block">:message</p>') !!}
                          </div>
                        </div>

                        <div class="form-group {{ $errors->has('estado_civil') ? 'has-error' : ''}}">
                          <label for="estado_civil" class="col-md-4 control-label">{{ 'Estado Civil' }}</label>
                          <div class="col-md-8">

                            <select name="estado_civil" class="form-control" id="estado_civil" >
                                @foreach (json_decode('{"1" : "Soltero(a)", "2" : "Casado(a)","3" : "Divorciado(a)","4" : "Union Libre","5" : "Viudo(a)"}', true) as $optionKey => $optionValue)
                                    <option value="{{ $optionKey }}" {{ (isset($perfil->estado_civil) && $perfil->estado_civil == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
                                @endforeach
                            </select>

                            {!! $errors->first('estado_civil', '<p class="help-block">:message</p>') !!}
                          </div>
                        </div>

                        <div class="form-group {{ $errors->has('foto') ? 'has-error' : ''}}">
                          <label for="foto" class="col-md-4 control-label">{{ 'Foto' }}</label>
                          <div class="col-md-8">
                            {!! Form::File('foto', null , ['class' => 'form-control input-sm', 'id'=>'foto','placeholder'=>'Foto']) !!}

                            {!! $errors->first('foto', '<p class="help-block">:message</p>') !!}
                          </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">
                                <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Actualizar' }}">
                            </div>
                        </div>

                      </div>
                    </fieldset>
                  </div>

                </form>

              </div>
            </div>
            <!-- /.box -->

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

      </section>
      <!-- /.content -->

</div>
</div>
</section>

<script type="text/javascript">
    $('.datepicker').datepicker({
    format: "yyyy-mm-dd",
    language: "es",
    autoclose: true
});
</script>
@endsection

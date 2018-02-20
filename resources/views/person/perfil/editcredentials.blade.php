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
                  'method' => 'POST',
                  'url' => ['/person/settings/updatecredentials', $perfil->id],
                  'class' => 'form-horizontal', 
                  'enctype'=>'multipart/form-data',
                  'files' => true,
                  'accept-charset'=>'UTF-8'
                  ]) !!}


                  {{ method_field('POST') }}
                  {{ csrf_field() }}

                  <div class="col-md-12">
                    PERFÍL
                    <fieldset>
                      <legend>
                      </legend>
                      <div class="col-md-6">

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                          <label for="cliente" class="col-md-4 control-label">{{ 'Usuario' }}</label>
                          <div class="col-md-8">
                           {!! Form::text('name', $perfil->name , ['class' => 'form-control input-sm', 'id'=>'name','placeholder'=>'Usuario','autocomplete'=>'off']) !!}

                           {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                         </div>
                       </div>


                       <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                        <label for="password" class="col-md-4 control-label">{{ 'Clave' }}</label>
                        <div class="col-md-8">
                          {!! Form::password('password', null , ['type'=>'password','class' => 'form-control input-sm', 'id'=>'password','placeholder'=>'Clave','autocomplete'=>'off']) !!}

                          {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                        </div>
                      </div>

                    </div>

                    <div class="col-md-6">


                     <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                      <label for="email" class="col-md-4 control-label">{{ 'Correo' }}</label>
                      <div class="col-md-8">
                        {!! Form::text('email', $perfil->email , ['class' => 'form-control input-sm', 'id'=>'email','placeholder'=>'email','autocomplete'=>'off']) !!}

                        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                      </div>
                    </div>

                    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
                      <label for="password_confirmation" class="col-md-4 control-label">{{ 'Confirma Clave' }}</label>
                      <div class="col-md-8">
                        {!! Form::password('password_confirmation', null, ['type'=>'password','class' => 'form-control input-sm', 'id'=>'password_confirmation','placeholder'=>'Confirme clave','autocomplete'=>'off']) !!}

                        {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
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


@endsection

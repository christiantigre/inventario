@extends('person.page')

@section('content')
@include('errors.messages')
        <div class="row">

            <div class="col-md-11">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Cliente #{{ $cliente->ced_cli }}</div>
                    <div class="panel-body">
                        <a href="{{ url('/person/cliente') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                            {!! Form::model($cliente, [
                            'method' => 'PATCH',
                            'url' => ['/person/cliente', $cliente->id],
                            'class' => 'form-horizontal', 
                            'enctype'=>'multipart/form-data',
                            'files' => true,
                            'accept-charset'=>'UTF-8'
                        ]) !!}


                            {{ csrf_field() }}

                            @include ('person.cliente.form', ['submitButtonText' => 'Actualizar'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $("#id_provincia").change(function(event){
    var url = '{{ url("/getcanton") }}';
    console.log(url);
    $.get(url+"/"+event.target.value+"",function(response, state){
        $("#id_canton").empty();
        for(i=0; i<response.length; i++){
            $("#id_canton").append("<option value='"+response[i].id+"'> "+response[i].canton+"</option>");
        }
    });
});
        </script>
@endsection

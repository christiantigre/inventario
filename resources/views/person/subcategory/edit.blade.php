@extends('person.page')

@section('content')
@include('errors.messages')
        <div class="row">

            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Sub-categoria #{{ $subcategory->subcategory }}</div>
                    <div class="panel-body">
                        <a href="{{ url('/person/subcategory') }}" title="Atras"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                            {!! Form::model($subcategory, [
                            'method' => 'PATCH',
                            'url' => ['/person/subcategory', $subcategory->id],
                            'class' => 'form-horizontal', 
                            'enctype'=>'multipart/form-data',
                            'files' => true,
                            'accept-charset'=>'UTF-8'
                            ]) !!}

                            @include ('person.subcategory.form', ['submitButtonText' => 'Actualziar'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

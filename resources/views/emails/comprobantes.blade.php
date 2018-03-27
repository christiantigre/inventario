@component('mail::message')
# Asunto : {{ $data['empresa'] }}.

# Mensaje emitido por {{ $data['empresa'] }}, 
  Estimado(a) Cliente {{ $data['name'] }}.

 Sírvase encontrar el comprobante electrónico (XML&sup1; y RIDE&sup2;) que hemos emitido en nuestra empresa. 
 Descargue sus documentos electrónicos, 
 Gracias por Preferirnos.
                                        Atentamente, {{ $data['empresa'] }}. 


# {{ $data['message'] }}.

@component('mail::button', ['url' => $data['pagweb']])
PcSolution´s
@endcomponent

Gracias,
{{ config('app.name') }}
@endcomponent

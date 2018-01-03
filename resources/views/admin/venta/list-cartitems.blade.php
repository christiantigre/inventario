 {{ csrf_field() }}
 @if(count($carrito)>0)
 <table class="table table-condensed" id="itemscart">
  <tbody>
    <tr>
      <th style="width: 10px">#</th>
      <th>Cod barra</th>
      <th>Producto</th>
      <th>Cantidad</th>
      <th>Precio</th>
      <th>Total</th>
      <th>Acción</th>
    </tr>
    <?php $i=1; ?>
    @foreach($carrito as $item)
    <tr>
      <td style="width: 10px"><?Php echo $i; ?></td>
      <td>{{ $item->codbarra }}</td>
      <td>{{ $item->producto }}</td>
      <td>{{ $item->cant }}</td>
      <td>{{ $item->precio }}</td>
      <td>{{ $item->total }}</td>
      <td>
        <button class="btn btn-default delete_item" id="{{ $item->id }}" value="{{ $item->id }}" type="button" title="QUITAR" onClick="delete_item(this.id);"><i class="fa fa-trash" aria-hidden="true"></i> </button>
      </td>
    </tr>
    <?Php $i++; ?>
    @endforeach    
  </tbody>
</table>

<div class="row">
  <!-- accepted payments column -->
  <div class="col-xs-6">
  </div>
  <!-- /.col -->
  <div class="col-xs-6">
    <div class="table-responsive">
      <table class="table">
        <tr>
          <th style="width:50%">Subtotal:</th>
          <td>${{ number_format($subtotal,2) }}</td>
        </tr>
        <tr>
          <th>Iva 0%</th>
          <td>$0</td>
        </tr>
        <tr>
          <th>Iva {{ number_format($ivavalor,2) }}%:</th>
          <td>${{ number_format($iva,2) }}</td>
        </tr>
        <tr>
          <th>Total:</th>
          <td>${{ number_format($total,2) }}</td>
        </tr>       
      </table>
    </div>
  </div>
  <!-- /.col -->
</div>
@else
<table class="table table-condensed" id="itemscart">
  <tbody>
    <tr>
      <th></th>
    </tr>
    <tr>
      <td>Sin items</td>      
    </tr>   
  </tbody>
</table>
@endif
<table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Subcuenta</th><th>Secuencia</th><th>Codigo</th><th>Detall</th><th>Activo</th><th>Cuenta</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($tempsubcta as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->subcuenta }}</td><td>{{ $item->secuencia }}</td><td>{{ $item->codigo }}</td><td>{{ $item->detall }}</td><td>{{ $item->activo }}</td><td>{{ $item->cuenta }}</td>
                                        <td>
                                            <a href="{{ url('/admin/tempsubcta/' . $item->id) }}" title="View Tempsubctum"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/tempsubcta/' . $item->id . '/edit') }}" title="Edit Tempsubctum"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/tempsubcta' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete Tempsubctum" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
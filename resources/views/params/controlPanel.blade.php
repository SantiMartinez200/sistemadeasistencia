@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-3">
  <div class="col-md-12">
    <div class="container">
      <div class="card">
        <div class="card-header">Listado de Parametros</div>
        <div class="card-body">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">Promoción</th>
                <th scope="col">Regular</th>
                <th scope="col">Clases totales</th>
                <th scope="col">Creado el</th>
                <th scope="col">Modificado el</th>
                <th scope="col">Acción</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($params as $eachParam)
        <tr>
        <td>{{ $eachParam->promote }}</td>
        <td>{{ $eachParam->regular }}</td>
        <td>{{ $eachParam->total_classes }}</td>
        <td>{{ $fecha = date('d/m/Y H:i:s', strtotime($eachParam->created_at)) }}</td>
        <td>{{ $fecha = date('d/m/Y H:i:s', strtotime($eachParam->updated_at)) }}</td>
        <td>
        <a href="{{route("edit", $eachParam->id)}}" class="btn btn-primary btn-sm m-1"><i
          class="bi bi-pencil-square"></i>Editar</a>

        </td>
        </tr>
      @empty
    <td colspan="6">
      <span class="text-danger">
      <strong>No hay parámetros registrados!</strong>
      </span>
    </td>
  @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection
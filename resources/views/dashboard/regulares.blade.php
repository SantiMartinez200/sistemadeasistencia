@extends('layouts.app')
  @section('content')
  <div class="container mt-2">
    <a href="{{ route('pdfAssistReg') }}" class="btn btn-primary btn-sm">Generar Informe de Regulares por asistencias</a>
  </div>
<div class="row justify-content-center mt-3">
    <div class="col-md-12">
      <div class="container">
        <div class="card">
            <div class="card-header"><strong>Alumnos Regulares</strong>
          <div class="float-end">
            <a href="{{ route('/dashboard') }}" class="btn btn-primary btn-sm">&larr; Volver</a>
          </div>
        </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">DNI del alumno</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Cantidad de asistencias</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($results as $row)
              <tr>
                <td>{{ $row["dni"] }}</td>
                <td>{{ $row["nombre"] }}</td>
                <td>{{ $row["apellido"] }}</td>
                <td>{{ $row["cantidad_de_asistencias"] }}</td>
              </tr>
            @empty
                            <td colspan="6">
                                <span class="text-danger">
                                    <strong>No hay alumnos regulares!</strong>
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
    
@endsection
@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-3">
  <div class="col-md-8">
    <div class="container">
      <div class="card">
        <div class="card-header">
          <div class="float-start">
            Informacion del Estudiante
          </div>
          <div class="float-end">
            <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Volver</a>
          </div>
        </div>
        <div class="card-body">

          <div class="row">
            <label for="dni_student"
              class="col-md-4 col-form-label text-md-end text-start"><strong>DNI:</strong></label>
            <div class="col-md-6" style="line-height: 35px;">
              {{ $student->dni_student }}
            </div>
          </div>

          <div class="row">
            <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Nombre:</strong></label>
            <div class="col-md-6" style="line-height: 35px;">
              {{ $student->name }}
            </div>
          </div>

          <div class="row">
            <label for="last_name"
              class="col-md-4 col-form-label text-md-end text-start"><strong>Apellido:</strong></label>
            <div class="col-md-6" style="line-height: 35px;">
              {{ $student->last_name }}
            </div>
          </div>

          <div class="row">
            <label for="birthday" class="col-md-4 col-form-label text-md-end text-start"><strong>Fecha de
                Nacimiento:</strong></label>
            <div class="col-md-6" style="line-height: 35px;">
              {{ $fecha = date('d/m/Y ',strtotime($student->birthday)) }}
            </div>
          </div>

          <div class="row">
            <label for="group_student"
              class="col-md-4 col-form-label text-md-end text-start"><strong>Grupo:</strong></label>
            <div class="col-md-6" style="line-height: 35px;">
              {{ $student->group_student }}
            </div>
          </div>


             <div class="row">
            <label for="avergae"
              class="col-md-4 col-form-label text-md-end text-start"><strong>Promedio:</strong></label>
            <div class="col-md-6" style="line-height: 35px;">
              {{ $average }}%
            </div>
          </div>

          <div class="row">
            <label for="group_student"
              class="col-md-4 col-form-label text-md-end text-start"><strong>Asistencias:</strong></label>
            <div class="col-md-6" style="line-height: 35px;">
              @if(isset($assist))
    @if($assist > 0)
      {{$assist}}
    @else
    <span class="text-danger">
    <strong>No tiene asistencias!</strong>
    </span>
    @endif
    @endif
            </div>
          </div>
          <div class="row">
            <label for="group_student"
              class="col-md-4 col-form-label text-md-end text-start"><strong>Condición:</strong></label>
            <div class="col-md-6" style="line-height: 35px;">
            {{$status}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
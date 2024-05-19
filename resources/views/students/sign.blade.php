@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-3">
  <div class="col-md-8">
    <div class="container">
      <div class="card">
        <div class="card-header">
          <div class="float-start">
            <strong>Coloca el DNI del estudiante en el campo</strong>
          </div>
          <div class="float-end">
            <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Volver</a>
          </div>
        </div>
        <div class="card-body">
          <div class="container">
            <form action="{{route('findThis')}}" method="POST">
              @csrf
              <div class="row align-items-center">
                <div class="col-sm">
                  <input type="number" name="dni_student" class="form-control form-control-sm">
                  @if ($errors->has('dni_student'))
          <span class="text-danger">{{ $errors->first('dni_student') }}</span>
        @endif
                </div>
                <div class="col-sm">
                  <input type="submit" value="Buscar" class="form-control btn btn-success m-2">
                </div>
                <div class="col"></div>
                <div class="col"></div>
              </div>
            </form>
          </div>
        </div>
      </div>
      @if ($message = Session::get('status'))
    <div class="alert alert-success mt-2" role="alert">
      {{ $message }}
    </div>
  @endif
      <div class="container">
        @if (isset($student))
      @if(($student->isEmpty()) != true)
    <table class="table table-striped table-bordered">
    <thead>
      <tr>
      <th scope="col"><strong>ID</strong></th>
      <th scope="col"><strong>Nombre</strong></th>
      <th scope="col"><strong>Apellido</strong></th>
      <th scope="col"><strong>Acción</strong></th>
      </tr>
    </thead>
    <tbody>
      <td>{{$student[0]->id}}</td>
      <td>{{$student[0]->name}}</td>
      <td>{{$student[0]->last_name}}</td>
      <td>
      <a href="{{route("storeFromButton", $student[0]->id)}}" class="btn btn-success btn-sm m-1"><i
      class="bi bi-pencil-square">Asistir!</i></a>
      <a href="{{route("StudentAssist", $student[0]->id)}}" class="btn btn-primary btn-sm m-1"><i
      class="bi bi-eye">Ver
      Asistencias!</i></a>
      </td>

    </tbody>
    </table>
  @else
  <div class="alert alert-danger mt-2" role="alert">
  No se ha encontrado el estudiante
  </div>
@endif
    @endif
      </div>
      @if ($message = Session::get('success'))
    <div class="alert alert-success mt-2" role="alert">
      {{ $message }}
    </div>
  @elseif($message = Session::get('error'))
  <div class="alert alert-danger mt-2" role="alert">
    {{$message}}
  </div>
  @elseif($message = Session::get('info'))
  <div class="alert alert-info mt-2" role="alert">
    {{$message}}
  </div>
@endif
    </div>

  </div>
</div>
@endsection
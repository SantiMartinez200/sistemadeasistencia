@extends('layouts.app')
@section('content')

<div class="row justify-content-center mt-3">
  <div class="col-md-8">
    @if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
    {{ $message }}
    </div>
  @endif
    @if ($message = Session::get('status'))
    <div class="alert alert-danger" role="alert">
    {{ $message }}
    </div>
  @endif
    <div class="container">
      <div class="card">
        <div class="card-header">
          <div class="float-start">
            Editar Estudiante
          </div>
          <div class="float-end">
            <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Volver</a>
          </div>
        </div>
        <div class="card-body">
          <form action="{{ route('students.update', $student->id) }}" method="post">
            @csrf
            @method("PUT")

            <div class="mb-3 row">
              <label for="dni_student" class="col-md-4 col-form-label text-md-end text-start">DNI</label>
              <div class="col-md-6">
                <input type="number" class="form-control @error('dni_student') is-invalid @enderror" id="dni_student"
                  name="dni_student" value="{{ $student->dni_student }}">
                @if ($errors->has('dni_student'))
          <span class="text-danger">{{ $errors->first('dni_student') }}</span>
        @endif
              </div>
            </div>

            <div class="mb-3 row">
              <label for="name" class="col-md-4 col-form-label text-md-end text-start">Nombre</label>
              <div class="col-md-6">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                  value="{{ $student->name }}">
                @if ($errors->has('name'))
          <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
              </div>
            </div>

            <div class="mb-3 row">
              <label for="last_name" class="col-md-4 col-form-label text-md-end text-start">Apellido</label>
              <div class="col-md-6">
                <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                  name="last_name" value="{{ $student->last_name }}">
                @if ($errors->has('last_name'))
          <span class="text-danger">{{ $errors->first('last_name') }}</span>
        @endif
              </div>
            </div>

            <div class="mb-3 row">
              <label for="birthday" class="col-md-4 col-form-label text-md-end text-start">Fecha de Nacimiento</label>
              <div class="col-md-6">
                <input type="date" class="form-control @error('birthday') is-invalid @enderror" id="birthday"
                  name="birthday" value="{{ $student->birthday }}">
                @if ($errors->has('birthday'))
          <span class="text-danger">{{ $errors->first('birthday') }}</span>
        @endif
              </div>
            </div>

            <div class="mb-3 row">
              <label for="group_student" class="col-md-4 col-form-label text-md-end text-start">Grupo</label>
              <div class="col-md-6">
                <select class="form-control @error('group_student') is-invalid @enderror" id="group_student"
                  name="group_student">
                  <option selected>{{$student->group_student}}</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                </select>
                @if ($errors->has('group_student'))
          <span class="text-danger">{{ $errors->first('group_student') }}</span>
        @endif
              </div>
            </div>

            <div class="mb-3 row">
              <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Actualizar Informacion">
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
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
            Editar Parámetro
          </div>
          <div class="float-end">
            <a href="{{ route('panel') }}" class="btn btn-primary btn-sm">&larr; Volver</a>
          </div>
        </div>
        <div class="card-body">
          <form action="{{ route('param-update', $param->id) }}" method="post">
            @csrf
            @method("PUT")
            <div class="mb-3 row">
              <label for="promote" class="col-md-4 col-form-label text-md-end text-start">Porcentaje de
                Promocion</label>
              <div class="col-md-6">
                <input type="number" class="form-control @error('promote') is-invalid @enderror" id="promote"
                  name="promote" value="{{ $param->promote }}">
                @if ($errors->has('promote'))
          <span class="text-danger">{{ $errors->first('promote') }}</span>
        @endif
              </div>
            </div>

            <div class="mb-3 row">
              <label for="regular" class="col-md-4 col-form-label text-md-end text-start">Porcentaje de
                Regularidad</label>
              <div class="col-md-6">
                <input type="number" class="form-control @error('regular') is-invalid @enderror" id="regular"
                  name="regular" value="{{ $param->regular }}">
                @if ($errors->has('regular'))
          <span class="text-danger">{{ $errors->first('regular') }}</span>
        @endif
              </div>
            </div>
            <div class="mb-3 row">
              <label for="total_classes" class="col-md-4 col-form-label text-md-end text-start">Cantidad de clases
                (Total)</label>
              <div class="col-md-6">
                <input type="number" class="form-control @error('total_classes') is-invalid @enderror"
                  id="total_classes" name="total_classes" value="{{ $param->total_classes }}">
                @if ($errors->has('total_classes'))
          <span class="text-danger">{{ $errors->first('total_classes') }}</span>
        @endif
              </div>
            </div>
            <div class="mb-3 row">
              <div class="col-md-6">
                <input type="text" name="updated_at" value="{{$now}}" id="updated_at"
                  class="form-control @error('total_classes') is-invalid @enderror" hidden>
                @if ($errors->has('updated_at'))
          <span class="text-danger">{{ $errors->first('updated_at') }}</span>
        @endif
              </div>
            </div>
            <div class="mb-3 row">
              <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Actualizar Configuración">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@extends('layouts.app')
  @section('content')
  
<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif
      <div class="container">
        <div class="card">
            <div class="card-header"><strong>{{$student->name}} {{$student->last_name}} <h1>DNI: ({{$student->dni_student}}) <h1>ID: ({{$student->id}})</h1></strong></div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Id del registro</th>
                        <th scope="col">Fecha asistida</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($cant as $eachStudent)
                        <tr>
                            <td>{{ $eachStudent->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($eachStudent->created_at)->format('d/m/y H:i') }}</td>
                        </tr>
                        @empty
                            <td colspan="6">
                                <span class="text-danger">
                                    <strong>No tiene asistencias!</strong>
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
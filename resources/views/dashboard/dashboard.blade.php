<x-app-layout>
  @if (isset($birthdays))
  @if((empty($birthdays)) != true)
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    @if ($results['promoted'] > 0)
    <div class="float-end mt-4 mr-5 p-3">
    </div>
  @endif
    <div class="p-6 text-gray-900">
    {{__("¡Estudiantes de cumpleaños! Hoy, ")}}{{$birthdays[0]['birthday']}}
    @foreach($birthdays as $eachStudent)
    <p class="text-bold ml-5 h4 m-2"><strong>{{$eachStudent["last_name"]}}, {{$eachStudent["name"]}}</strong></p>
  @endforeach
    </div>
    </div>
    </div>
  </div>
@endif
@endif
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        @if ($results['promoted'] > 0)
      <div class="float-end mt-4 mr-5 p-3">
      <a href="{{ route('aprobados') }}" class="btn btn-primary btn-sm">Ver promocionados &rArr;</a>
      </div>
    @endif
        <div class="p-6 text-gray-900 d-flex align-items-center">
          {{__("Cantidad de Aprobados")}}
          <p class="text-success ml-5 h1"><strong>{{$results['promoted']}}</strong></p>
        </div>
      </div>
    </div>
  </div>

  <div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        @if ($results['regularized'] > 0)
      <div class="float-end mt-4 mr-5 p-3">
      <a href="{{ route('regulares') }}" class="btn btn-primary btn-sm">Ver regularizados &rArr;</a>
      </div>
    @endif
        <div class="p-6 text-gray-900 d-flex align-items-center">
          {{__("Cantidad de Regulares")}}
          <style>
            .specialColor {
              color: #ffd400;
            }
          </style>
          <p class="specialColor ml-5 h1"><strong>{{$results['regularized']}}</strong></p>
        </div>
      </div>

    </div>

  </div>

  <div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        @if ($results['auditors'] > 0)
      <div class="float-end mt-4 mr-5 p-3">
      <a href="{{ route('libres') }}" class="btn btn-primary btn-sm">Ver libres &rArr;</a>
      </div>
    @endif
        <div class="p-6 text-gray-900 d-flex align-items-center">
          {{__("Cantidad de Libres")}}
          <p class="text-danger ml-5 h1"><strong>{{$results['auditors']}}</strong></p>
        </div>
      </div>
    </div>
  </div>

  <div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        @if ($total_assists > 0)
      <div class="float-end mt-4 mr-5 p-3">
      <a href="{{ route('asistencias') }}" class="btn btn-primary btn-sm">Ver asistencias &rArr;</a>
      </div>
    @endif
        <div class="p-6 text-gray-900 d-flex align-items-center">
          {{__("Total de asistencias registradas")}}
          <p class="text-primary ml-5 h1"><strong>{{$total_assists}}</strong></p>

        </div>
      </div>

    </div>

  </div>
</x-app-layout>
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Param;
class StudentStatusController extends Controller
{
  public static function getStudentsAssists()
  {
    $distinctStudentsAssists = DB::table('assists')
      ->join('students', 'assists.student_id', '=', 'students.id')
      ->select(DB::raw('count(*) as assist_count, students.id,students.name,students.last_name,students.dni_student'))
      ->groupBy('students.id')
      ->get();
    return $distinctStudentsAssists;
  }

  public static function getParams()
  {
    $params = Param::all();
    return $params;
  }

  public function determineRegularized()
  {
    $params = $this->getParams();
    $distinctStudentsAssists = $this->getStudentsAssists();
    $avgRegularized = [];
    for ($i = 0; $i < count($distinctStudentsAssists); $i++) {
      $calculate = ($distinctStudentsAssists[$i]->assist_count) / ($params[0]->total_classes) * 100;
      if (($calculate >= $params[0]->regular) && ($calculate < $params[0]->promote)) {
        $avgRegularized[$i] = ['nombre' => $distinctStudentsAssists[$i]->name, 'apellido' => $distinctStudentsAssists[$i]->last_name, 'dni' => $distinctStudentsAssists[$i]->dni_student, 'condicion' => 'Regular', 'cantidad_de_asistencias' => $distinctStudentsAssists[$i]->assist_count];
      }
    }
    return $avgRegularized;
  }


  public function determinePromoted()
  {
    $params = $this->getParams();
    $distinctStudentsAssists = $this->getStudentsAssists();
    $avgPromoted = [];
    for ($i = 0; $i < count($distinctStudentsAssists); $i++) {
      $calculate = ($distinctStudentsAssists[$i]->assist_count) / ($params[0]->total_classes) * 100;
      if (($calculate >= $params[0]->promote)) {
        $avgPromoted[$i] = ['nombre' => $distinctStudentsAssists[$i]->name, 'apellido' => $distinctStudentsAssists[$i]->last_name, 'dni' => $distinctStudentsAssists[$i]->dni_student, 'condicion' => 'Promocion', 'cantidad_de_asistencias' => $distinctStudentsAssists[$i]->assist_count];
      }
    }
    return $avgPromoted;
  }


  public function determineAuditor()
  {

    $params = $this->getParams();
    $distinctStudentsAssists = $this->getStudentsAssists();
    $avgAuditor = [];
    for ($i = 0; $i < count($distinctStudentsAssists); $i++) {
      $calculate = ($distinctStudentsAssists[$i]->assist_count) / ($params[0]->total_classes) * 100;
      if (($calculate < $params[0]->regular)) {
        $avgAuditor[$i] = ['nombre' => $distinctStudentsAssists[$i]->name, 'apellido' => $distinctStudentsAssists[$i]->last_name, 'dni' => $distinctStudentsAssists[$i]->dni_student, 'condicion' => 'Libre', 'cantidad_de_asistencias' => $distinctStudentsAssists[$i]->assist_count];
      }
    }
    return $avgAuditor;
  }

  public static function getAllAssists()
  {
    $getAllAssists = DB::table('assists')
      ->join('students', 'assists.student_id', '=', 'students.id')
      ->select(DB::raw('count(*) as assist_count, students.id,students.name,students.last_name,students.dni_student,assists.id,assists.created_at'))
      ->groupBy('assists.id')
      ->get()->toArray();
    $assistsArray = [];
    for ($i = 0; $i < count($getAllAssists); $i++) {
      $assistsArray[$i] = ['id' => $getAllAssists[$i]->id, 'nombre' => $getAllAssists[$i]->name, 'apellido' => $getAllAssists[$i]->last_name, 'dni' => $getAllAssists[$i]->dni_student, 'registrada' => $getAllAssists[$i]->created_at];
    }
    return $assistsArray;
  }
  public function compactPromoted()
  {
    $results = $this->determinePromoted();
    return view('dashboard.aprobados', compact('results'));
  }

  public function compactRegularized()
  {
    $results = $this->determineRegularized();
    return view('dashboard.regulares', compact('results'));
  }

  public function compactAuditors()
  {
    $results = $this->determineAuditor();
    return view('dashboard.libres', compact('results'));
  }

  public function compactAssists()
  {
    $results = $this->getAllAssists();
    return view('dashboard.asistencias', compact('results'));
  }
}
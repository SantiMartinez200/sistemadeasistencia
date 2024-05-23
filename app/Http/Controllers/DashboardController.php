<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Param;
use Carbon\Carbon;
use App\Models\Student;

class DashboardController extends Controller
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
  public function determineResults()
  {
    $params = $this->getParams();
    $distinctStudentsAssists = $this->getStudentsAssists();
    $countRegulars = 0;
    $countPromoted = 0;
    $countAuditors = 0;
    $array = [];
    for ($i = 0; $i < count($distinctStudentsAssists); $i++) {
      $calculate = ($distinctStudentsAssists[$i]->assist_count) / ($params[0]->total_classes) * 100;
      if (($calculate >= $params[0]->regular) && ($calculate < $params[0]->promote)) {
        $countRegulars = $countRegulars + 1;
      }elseif($calculate >= $params[0]->promote){
        $countPromoted = $countPromoted + 1;
      }elseif($calculate < $params[0]->regular){
        $countAuditors = $countAuditors + 1;
      }
    }
    $array = [
      'promoted' => $countPromoted,
      'regularized' => $countRegulars,
      'auditors' => $countAuditors
    ];
    return $array;
  }
  public static function countAllAssists()
  {
    $allAssists = DB::table('assists')
      ->join('students', 'assists.student_id', '=', 'students.id')
      ->select(DB::raw('students.id,students.name,students.last_name,students.dni_student'))
      ->get()
      ->count();
    return $allAssists;
  }
  public static function birthdays()
  {
    $student = Student::all()->toArray();
    $date = Carbon::now()->format('d-m');
    $StudentAndBirthday = [];
    $j = 0;
    for ($i = 0; $i < count($student); $i++) {
      $studentBirthday = Carbon::parse($student[$i]['birthday']);
      $studentDateFormat = $studentBirthday->format('d-m');
      if ($date == $studentDateFormat) {
        $studentDateFormat = $studentBirthday->format('d/m');
        $StudentAndBirthday[$j] = ['name' => $student[$i]['name'], 'last_name' => $student[$i]['last_name'], 'birthday' => $studentDateFormat];
        $j++;
      }
    }
    return $StudentAndBirthday;
  }
  public function compactData()
  {
    $results = $this->determineResults();
    $total_assists = $this->countAllAssists();
    $birthdays = $this->birthdays();
    return view('dashboard.dashboard', compact('results', 'birthdays', 'total_assists'));
  }


}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Assist;
use App\Models\Param;
use App\Models\Student;
use App\Http\Requests\AssistRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\IsEmpty;
use Illuminate\View\View;

class AssistController extends Controller
{
  public static function ValidateDate($id)
  {
    $todayDate = Carbon::now()->toDateString();;
    $todayDate = $todayDate . "%";
    $studentDate = DB::table('assists')
      ->select()
      ->where('student_id', '=', $id)
      ->where('created_at', 'LIKE', $todayDate)
      ->get();
    if ($studentDate->IsEmpty()) {
      return true; //Cargar asistencia.
    } else {
      return false; //No cargar la asistencia
    }
  }

  public function storeFromButton($id)
  {
    $bool = $this->ValidateDate($id);
    $params = Param::all();
    $assists = DB::table('assists')
      ->where('student_id', '=', $id)
      ->count();
    if($assists < ($params[0]->total_classes)){
      if ($bool == true) {
        $assist = Assist::create(['student_id' => $id]);
        return redirect()->route('signView')->withSuccess('Se ha marcado la asistencia del alumno');
      } else {
        return redirect()->route('signView')->with('error', 'Este Estudiante ya ha asistido hoy.');
      }
    }else{
      return redirect()->route('signView')->with('info', 'Este Estudiante alcanzó el limite de asistencias.');
    }
    
  }


}

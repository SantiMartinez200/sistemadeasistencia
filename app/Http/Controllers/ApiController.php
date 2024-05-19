<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Param;
use Illuminate\Http\Request;

class ApiController extends Controller
{
  /*
  public function studentCondition($id)
  {
    dd($id);
    $assistCount = DB::table('assists')
                    ->join('students', 'assists.student_id', '=','students.id')
                    ->select(DB::raw('COUNT(*) as assist_count'))
                    ->where('student_id', '=', 1)
                    ->get();
    
    $getParams = Param::all();
    $promote = $getParams[0]->promote;
    $regular = $getParams[0]->regular;
    $total_classes = $getParams[0]->total_classes;
    $assist_count = $assistCount[0]->assist_count; #-> Cuenta de asistencias.
    $ec = ($assist_count * 100) / $total_classes;
    $condition = '';
    if($ec >= $promote){
      $condition = "promote";
    }elseif($ec >= $regular){
      $condition = "regular";
    }else{
      $condition = "insufficient";
    }
    return redirect()->route('students.show', ['student'=> $id,'condition' => $condition]);
    //return redirectresponse()->json(['UserCondition' => $condition]);
    }*/
}

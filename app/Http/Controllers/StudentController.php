<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Param;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StudentController extends Controller
{

  public function index(): View
  {
    return view('students.index', [
      'students' => Student::latest()->paginate(10),
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(): View
  {
    return view('students.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreStudentRequest $request): RedirectResponse
  {
    $val = $request->birthday;
    $onlyYear = date('Y', strtotime($val));
    //$thisYear = Carbon::now()->format('Y');
    $thisYear = date('Y');
    if(($thisYear - $onlyYear) < 17){
      return redirect()->route('students.create')
        ->with('status','La fecha de nacimiento es inválida, solo mayores a 18');
    }else{
      Student::create($request->all());
      return redirect()->route('students.index')
        ->withSuccess('Se ha añadido un nuevo estudiante correctamente.');
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(Student $student): View
  {
    //get assists
    $getAllAssists = DB::table('assists')
      ->join('students', 'assists.student_id', '=', 'students.id')
      ->select(DB::raw('count(*) as assist_count'))
      ->where('students.dni_student', 'LIKE', $student->dni_student)
      ->get();
    $val = $getAllAssists[0]->assist_count;
    //get params and calculate student status
    $params = Param::all();
    $calculate = ($val) / ($params[0]->total_classes) * 100;
    $status = 'undefined';
    if ($val > 0) {
      if ($calculate >= $params[0]->promote) {
        $status = "Promoción";
      } elseif (($calculate < $params[0]->promote) && ($calculate >= $params[0]->regular)) {
        $status = "Regular";
      } elseif (($calculate < $params[0]->regular)) {
        $status = "Libre";
      }
    }else{
      $status = "Indefinido";
    }
    return view('students.show', [
      'student' => $student,
      'assist' => $val,
      'status' => $status
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Student $student): View
  {
    return view('students.edit', [
      'student' => $student
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateStudentRequest $request, Student $student): RedirectResponse
  {
    $val = $request->birthday;
    $onlyYear = date('Y', strtotime($val));
    //$thisYear = Carbon::now()->format('Y');
    $thisYear = date('Y');
    if (($thisYear - $onlyYear) < 17) {
      return redirect()->back()
        ->with('status', 'La fecha de nacimiento es inválida, solo mayores a 18');
    } else {
      $student->update($request->all());
      return redirect()->back()
        ->withSuccess('El estudiante se actualizó correctamente.');
    }
    
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Student $student): RedirectResponse
  {
    $deleteAssists = DB::table('assists')
      ->where('student_id', '=', $student->id)
      ->delete();
    $student->delete();
    return redirect()->route('students.index')
      ->withSuccess('El estudiante se eliminó correctamente.');
  }

  public function find($id)
  {
    $student = Student::find($id);
    $cant = $student->assists;
    return view('students.assists', compact('cant', 'student'));
  }

  public function findThis(Request $request)
  {
    $student = DB::table('students')
      ->select('*')
      ->where('dni_student', '=', $request->dni_student)
      ->get();
    return view('students.sign', [
      'student' => $student
    ]);
  }
}

<?php

use App\Http\Controllers\AssistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ParamController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentStatusController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
  return view('register');
});

Route::middleware('auth')->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'compactData'])->name('/dashboard');

  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  Route::resource('students', StudentController::class);

  Route::get('assist/{id}', [StudentController::class, 'find'])->name("StudentAssist");

  Route::get('params.controlPanel', [ParamController::class,'getParams'])->name('panel');
  Route::get('params.editControlPanel/{id}', [ParamController::class, 'edit'])->name('edit');

  Route::put('param-update/{id}', [ParamController::class, 'updateParam'])->name("param-update");

  Route::get('/sign', function () {
    return view('students.sign');
  })->name('signView');
  
  Route::POST('findThis', [StudentController::Class,'findThis'])->name('findThis');

  Route::GET('storeFromButton/{id}', [AssistController::class, 'storeFromButton'])->name('storeFromButton');

  Route::get('/libres', [StudentStatusController::class,'compactAuditors'])->name('libres');
  Route::get('/aprobados', [StudentStatusController::class, 'compactPromoted'])->name('aprobados');
  Route::get('/regulares', [StudentStatusController::class, 'compactRegularized'])->name('regulares');
  Route::get('/asistencias', [StudentStatusController::class, 'compactAssists'])->name('asistencias');

  //Route::get('test', [StudentController::class, 'staticCompleteStudentStatus'])->name('test');

  Route::get('pdf/pdf', [StudentController::class,'pdfAssistGeneral'])->name('pdfAssistGeneral');


  Route::get('pdf/pdfpromocion', [StudentController::class, 'pdfAssistProm'])->name('pdfAssistProm');


  Route::get('pdf/pdfregular', [StudentController::class, 'pdfAssistReg'])->name('pdfAssistReg');


  Route::get('pdf/pdflibre', [StudentController::class, 'pdfAssistAud'])->name('pdfAssistAud');


});

require __DIR__.'/auth.php';

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Param;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;



class ParamController extends Controller
{
  public function getParams()
  {
    $params = Param::all();
    return view('params.controlPanel',compact('params'));
  }

  public function edit($id){
    $param = Param::find($id);
    $now = Carbon::now()->setTimezone('America/Argentina/Buenos_Aires')->format('Y-m-d H:i:s');
    return view('params.editControlPanel', compact('param','now'));
  }

  public function updateParam(Request $request): RedirectResponse
  {
    if (($request->promote) <= 0 || ($request->regular) <= 0 || ($request->total_classes) <= 0){
      return redirect()->back()
      ->with('status','Los campos no pueden ser cero, negativos o nulos.');
    }elseif(($request->promote) > 100 || ($request->regular) > 100 || ($request->total_classes) > 9999){
      return redirect()->back()
        ->with('status', 'Los campos exceden los valores permitidos');
    }elseif(($request->promote) < ($request->regular)){
      return redirect()->back()
        ->with('status', 'El promedio de alumno regular no puede exceder el de alumno promocional');
    }else{
      $affected = DB::table('params')
        ->where('id', $request->id)
        ->update(['promote' => $request->promote, 'regular' => $request->regular, 'total_classes' => $request->total_classes,'updated_at'=>$request->updated_at]);
      return redirect()->back()
        ->withSuccess('Se actualizó la configuración correctamente.');
    }
  }
}

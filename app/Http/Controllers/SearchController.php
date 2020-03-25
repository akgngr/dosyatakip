<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\IcraDosya;
use App\InfazDosya;
use Validator;
use Prologue\Alerts\AlertsMessageBag;
use Prologue\Alerts\Facades\Alert;

class searchController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
    public function index()
    {
      return view('icra.search');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function arama(Request $request)
    {
      $validate = Validator::make($request->all(),
        [
        'q' => 'required|min:3',
        ]);
      if ($validate->fails()) {
        $errors = $validate->errors();
            Alert::warning('Lütfen boş bırakmayın yada en az 3 kelime azın!')->flash();
            return redirect()->back();
      }
      $q = Input::get ( 'q' );
      
      $icra = IcraDosya::where('alacakli','LIKE','%'.$q.'%')
              ->orWhere('borclu','LIKE','%'.$q.'%')
              ->orWhere('mahkeme','LIKE','%'.$q.'%')
              ->orWhere('dosya_no','LIKE','%'.$q.'%')
              ->orWhere('ili','LIKE','%'.$q.'%')
              ->orWhere('durum','LIKE','%'.$q.'%')
              ->get();

      $infazlar = InfazDosya::where('dosya_no', 'LIKE', '%'.$q.'%')
              ->orWhere('mahkeme','LIKE','%'.$q.'%')
              ->orWhere('davaci','LIKE','%'.$q.'%')
              ->orWhere('davali','LIKE','%'.$q.'%')
              ->orWhere('ili','LIKE','%'.$q.'%')
              ->orWhere('durum','LIKE','%'.$q.'%')
              ->get();
      
      if( count($icra) > 0 || count($infazlar) > 0 ){
        return view('icra.search')->withDetails($icra)->withQuery($q)->with('infazlar', $infazlar);
      }
      else {
        return view ('icra.search')->withMessage('Herhangi bir sonuç bulunamadı. Lütfen tekrar deneyin !');
      }
    }
}

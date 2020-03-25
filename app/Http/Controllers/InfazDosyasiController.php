<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\InfazDosya;
use App\Kategori;
use App\User;
use Prologue\Alerts\AlertsMessageBag;
use Prologue\Alerts\Facades\Alert;
use Illuminate\Support\MessageBag;
use App\Iller;
use Yajra\Datatables\Datatables;
use Auth;
use App\Yorum;
use App\Tahsilat;
use App\Tahsilat_ana;



class InfazDosyasiController extends Controller
{
  public function __construct()
  {
    $this->middleware(backpack_middleware());
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = '/admin/icra/infaz/infaz_data';
      return view('icra.infaz.index')->with('url', $url);
    }

    public function infaz_derdest_data(Datatables $datatables)
    {
        return $datatables->eloquent(InfazDosya::query()->where('durum', 'Derdest'))
        ->editColumn('dosya_no', function ($infaz) {
            return '<a href="/admin/icra/mahkeme/'.$infaz->id.'">' . $infaz->dosya_no . '</a>';
        })
        ->editColumn('kategori', function ($infaz)
        {
            if(isset($infaz->parent)){
                $ust_kategori=$infaz->parent;
                if(isset($ust_kategori->parent)){
                    $ust_ust_kategori=$ust_kategori->parent;
                    if(isset($ust_ust_kategori->parent)){
                        //return $ust_ust_kategori->parent->title.'->';
                    }
                    //return $ust_kategori->parent->title.'->';
                }
                return $infaz->parent->title;
            }
        })
        ->addColumn('action',function ($infaz) {
        return '<a class="btn btn-twitter" href="/admin/icra/mahkeme/'.$infaz->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/mahkeme/'.$infaz->id.'/edit"><i class="fa fa-edit"></i> </a>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
            <i class="fa fa-trash"></i>
        </button>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <form method="POST" action="/admin/icra/infaz/'. $infaz->id.'">
                            <input type="hidden" name="_method" value="DELETE">
                            '.csrf_field().'
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <label for="">Dosyayı Silmek İstediğinizden Eminmisiniz!</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Çık</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>  Sil</button>
                        
                    </div>
                </form>
                </div>
            </div>
        </div>
        
        ';})
        ->rawColumns(['dosya_no', 'action'])
        ->make(true);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_infaz()
    {
      return view('icra.infaz.indexinfaz');
    }

    public function infaz_infaz_data(Datatables $datatables)
    {
        return $datatables->eloquent(InfazDosya::query()->where('durum', 'infaz'))
        ->setRowClass(function ($infaz) {
            return $infaz->durum == 'infaz' ? 'alert-warning': 'alert-warning';
        })
        ->editColumn('dosya_no', function ($infaz) {
            return '<a href="/admin/icra/infaz/'.$infaz->id.'">' . $infaz->dosya_no . '</a>';
        })
        ->editColumn('kategori', function ($infaz)
        {
            if(isset($infaz->parent)){
                $ust_kategori=$infaz->parent;
                if(isset($ust_kategori->parent)){
                    $ust_ust_kategori=$ust_kategori->parent;
                    if(isset($ust_ust_kategori->parent)){
                        //return $ust_ust_kategori->parent->title.'->';
                    }
                    //return $ust_kategori->parent->title.'->';
                }
                return $infaz->parent->title;
            }
        })
        ->addColumn('action',function ($infaz) {
        return '<a class="btn btn-twitter" href="/admin/icra/infaz/'.$infaz->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/infaz/'.$infaz->id.'/edit"><i class="fa fa-edit"></i> </a>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
            <i class="fa fa-trash"></i>
        </button>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <form method="POST" action="/admin/icra/infaz/'. $infaz->id.'">
                            <input type="hidden" name="_method" value="DELETE">
                            '.csrf_field().'
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <label for="">Dosyayı Silmek İstediğinizden Eminmisiniz!</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Çık</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>  Sil</button>
                        
                    </div>
                </form>
                </div>
            </div>
        </div>
        
        ';})
        ->rawColumns(['dosya_no', 'action'])
        ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoriler = Kategori::where('ust_kategori', '0')->where('id','>',25)->get();
        $iller = Iller::all();
        return view('icra.infaz.create')->with('kategoriler', $kategoriler)->with('iller', $iller);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
          'dosya_no'  => 'required|string|max:255',
          'kategori'  => 'required|string|max:255',
          'ili'       => 'required|string|max:255',
          'mahkeme'   => 'required|string|max:255',
          'davali'  => 'required|string|max:255',
          'davaci'    => 'required|string|max:255',
      ]);

      $user_id = backpack_auth()->user()->id;

      if (!$validate->fails()) {
      $infazlar = new InfazDosya();
      $infazlar->dosya_no  = $request->dosya_no;
      $infazlar->kategori  = $request->kategori;
      $infazlar->ili       = $request->ili;
      $infazlar->mahkeme   = $request->mahkeme;
      $infazlar->davali    = $request->davali;
      $infazlar->davaci    = $request->davaci;
      $infazlar->user_id   = $user_id;
      $infazlar->save();

      if ($infazlar->save()) {
          Alert::success('Dosya Kaydedildi!')->flash();
          return redirect()->route('infaz.show', $infazlar->id);
      }
      else{
          Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!')->flash();
          return redirect()->route('infaz.create');
      }
      } else {
          $errors = $validate->errors();
          Alert::warning('Kayıt Başarısız. Lütfen alanları doğru doldurun'.$errors)->flash();
          return redirect()->back();
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $infazlar = InfazDosya::where('id', $id)->first();
        $kategori = Kategori::where('ust_kategori', '0')->get();
        return view('icra.infaz.show')->with('infazlar', $infazlar)->with('kategori', $kategori);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $iller = Iller::all();
        $infazlar = InfazDosya::where('id', $id)->first();
        $kategoriler = Kategori::where('ust_kategori', '0')->get();
        return view('icra.infaz.edit')->with('infazlar', $infazlar)->with('kategoriler', $kategoriler)->with('iller', $iller);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (!isset($request->durum)){
            $validate = Validator::make($request->all(), [
                'dosya_no'  => 'required|string|max:255',
                'kategori'  => 'required|string|max:255',
                'ili'       => 'required|string|max:255',
                'mahkeme'   => 'required|string|max:255',
                'davali'    => 'required|string|max:255',
                'davaci'    => 'required|string|max:255',
            ]);

            if (!$validate->fails()) {
                $infazlar = InfazDosya::findorFail($id);
                $infazlar->dosya_no  = $request->dosya_no;
                $infazlar->kategori  = $request->kategori;
                $infazlar->ili       = $request->ili;
                $infazlar->mahkeme   = $request->mahkeme;
                $infazlar->davali    = $request->davali;
                $infazlar->davaci    = $request->davaci;
                $infazlar->save();

                if ($infazlar->save()) {
                    Alert::success('Dosya Güncellendi!')->flash();
                    return redirect()->route('infaz.show', $infazlar->id);
                }
                else{
                    Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!')->flash();
                    return redirect()->back();
                }
            } else {
                $errors = $validate->errors();
                Alert::warning('Kayıt Başarısız. Lütfen alanları doğru doldurun'.$errors)->flash();
                return redirect()->back();
            }
        }else{
            $validate= Validator::make($request->all(),[
                'durum' =>'required'
            ]);

            if (!$validate->fails()){

                if ($request->eski_durum == 'Derdest' && $request->durum == 'infaz'){
                    switch ($request->kategori)
                    {
                        case 27:
                            $infazlar= InfazDosya::findorFail($id);
                            $infazlar->durum    = $request->durum;
                            $infazlar->kategori  = 34;
                            $infazlar->save();

                            if ($infazlar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->back();
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 28:
                            $kategori = 35;
                            $infazlar= InfazDosya::findorFail($id);
                            $infazlar->durum    = $request->durum;
                            $infazlar->kategori  = $kategori;
                            $infazlar->save();

                            if ($infazlar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->back();
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 29:
                            $kategori = 36;
                            $infazlar= InfazDosya::findorFail($id);
                            $infazlar->durum    = $request->durum;
                            $infazlar->kategori  = $kategori;
                            $infazlar->save();

                            if ($infazlar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->back();
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 30:
                            $kategori = 37;
                            $infazlar= InfazDosya::findorFail($id);
                            $infazlar->durum    = $request->durum;
                            $infazlar->kategori  = $kategori;
                            $infazlar->save();

                            if ($infazlar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->back();
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 31:
                            $kategori = 38;
                            $infazlar= InfazDosya::findorFail($id);
                            $infazlar->durum    = $request->durum;
                            $infazlar->kategori  = $kategori;
                            $infazlar->save();

                            if ($infazlar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->back();
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 32:
                            $kategori = 39;
                            $infazlar= InfazDosya::findorFail($id);
                            $infazlar->durum    = $request->durum;
                            $infazlar->kategori  = $kategori;
                            $infazlar->save();

                            if ($infazlar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->back();
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 40:
                            $kategori = 41;
                            $infazlar= InfazDosya::findorFail($id);
                            $infazlar->durum    = $request->durum;
                            $infazlar->kategori  = $kategori;
                            $infazlar->save();

                            if ($infazlar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->back();
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz')->flash();
                                return redirect()->back();
                            }
                            break;

                    }

                }

                elseif ($request->eski_durum == 'infaz' && $request->durum == 'Derdest'){
                    switch ($request->kategori)
                    {
                        case 34:
                            $kategori = 27;
                            $infazlar= InfazDosya::findorFail($id);
                            $infazlar->durum    = $request->durum;
                            $infazlar->kategori  = $kategori;
                            $infazlar->save();

                            if ($infazlar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->back();
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 35:
                            $kategori = 28;
                            $infazlar= InfazDosya::findorFail($id);
                            $infazlar->durum    = $request->durum;
                            $infazlar->kategori  = $kategori;
                            $infazlar->save();

                            if ($infazlar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->back();
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 36:
                            $kategori = 29;
                            $infazlar= InfazDosya::findorFail($id);
                            $infazlar->durum    = $request->durum;
                            $infazlar->kategori  = $kategori;
                            $infazlar->save();

                            if ($infazlar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->back();
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 37:
                            $kategori = 30;
                            $infazlar= InfazDosya::findorFail($id);
                            $infazlar->durum    = $request->durum;
                            $infazlar->kategori  = $kategori;
                            $infazlar->save();

                            if ($infazlar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->back();
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 38:
                            $kategori = 31;
                            $infazlar= InfazDosya::findorFail($id);
                            $infazlar->durum    = $request->durum;
                            $infazlar->kategori  = $kategori;
                            $infazlar->save();

                            if ($infazlar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->back();
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 39:
                            $kategori = 32;
                            $infazlar= InfazDosya::findorFail($id);
                            $infazlar->durum    = $request->durum;
                            $infazlar->kategori  = $kategori;
                            $infazlar->save();

                            if ($infazlar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->back();
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 41:
                            $kategori = 40;
                            $infazlar= InfazDosya::findorFail($id);
                            $infazlar->durum    = $request->durum;
                            $infazlar->kategori  = $kategori;
                            $infazlar->save();

                            if ($infazlar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->back();
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!')->flash();
                                return redirect()->back();
                            }
                            break;
                    }
                }

                else {
                    Alert::warning('Her hangi bir işlem yapılmadı')->flash();
                    return redirect()->back();
                }




                $infazlar= InfazDosya::findorFail($id);
                $infazlar->durum    = $request->durum;
                $infazlar->save();

                if ($infazlar->save()) {
                    Alert::success('Dosya Güncellendi!')->flash();
                    return redirect()->route('infaz.show', $infazlar->id);
                }
                else{
                    Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz'.$errors)->flash();
                    return redirect()->back();
                }
            }else {
                $errors = $validate->errors();
                Alert::warning('Kayıt Başarısız. Lütfen alanları doğru doldurun'.$errors)->flash();
                return redirect()->back();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $infaz = InfazDosya::findOrFail($id);
        $infaz->tahsilat_ana()->delete();
        $infaz->delete();
        Alert::success('Silme İşlemi Başarılı')->flash();
        return redirect()->back();
    }

}

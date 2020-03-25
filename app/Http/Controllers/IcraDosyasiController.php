<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Prologue\Alerts\AlertsMessageBag;
use Prologue\Alerts\Facades\Alert;
use Illuminate\Support\MessageBag;
use App\IcraDosya;
use App\Kategori;
use App\User;
use Auth;
use App\Yorum;
use App\Tahsilat;
use App\Tahsilat_ana;
use App\Iller;
use Yajra\Datatables\Datatables;
 
class IcraDosyasiController extends Controller
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
      $icralar = IcraDosya::where('durum','Derdest')->get();
      $url = 'admin/icra/icra/derdest';
      return view('icra.icra.index')->with('icralar', $icralar)->with('url', $url);
    }

    public function icra_derdest_data(Datatables $datatables)
    {
        return $datatables->eloquent(IcraDosya::query()->where('durum', 'Derdest'))
        ->editColumn('dosya_no', function ($icra) {
            return '<a href="/admin/icra/icra/'.$icra->id.'">' . $icra->dosya_no . '</a>';
        })
        ->editColumn('kategori', function ($icra)
        {
            if(isset($icra->parent)){
                $ust_kategori=$icra->parent;
                if(isset($ust_kategori->parent)){
                    $ust_ust_kategori=$ust_kategori->parent;
                    if(isset($ust_ust_kategori->parent)){
                        //return $ust_ust_kategori->parent->title.'->';
                    }
                    //return $ust_kategori->parent->title.'->';
                }
                return $icra->parent->title;
            }
        })
        ->addColumn('action',function ($icra) {
        return '<a class="btn btn-twitter" href="/admin/icra/icra/'.$icra->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/icra/'.$icra->id.'/edit"><i class="fa fa-edit"></i> </a>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
            <i class="fa fa-trash"></i>
        </button>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <form method="POST" action="/admin/icra/icra/'. $icra->id.'">
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
      return view('icra.icra.indexinfaz');
    }

    public function icra_infaz_data(Datatables $datatables)
    {
        return $datatables->eloquent(IcraDosya::query()->where('durum', 'infaz'))
        ->setRowClass(function ($icra) {
            return $icra->durum == 'infaz' ? 'alert-warning': 'alert-warning';
        })
        ->editColumn('dosya_no', function ($icra) {
            return '<a href="/admin/icra/icra/'.$icra->id.'">' . $icra->dosya_no . '</a>';
        })
        ->editColumn('kategori', function ($icra)
        {
            if(isset($icra->parent)){
                $ust_kategori=$icra->parent;
                if(isset($ust_kategori->parent)){
                    $ust_ust_kategori=$ust_kategori->parent;
                    if(isset($ust_ust_kategori->parent)){
                        //return $ust_ust_kategori->parent->title.'->';
                    }
                    //return $ust_kategori->parent->title.'->';
                }
                return $icra->parent->title;
            }
        })
        ->addColumn('action',function ($icra) {
        return '<a class="btn btn-twitter" href="/admin/icra/icra/'.$icra->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/icra/'.$icra->id.'/edit"><i class="fa fa-edit"></i> </a>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
            <i class="fa fa-trash"></i>
        </button>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <form method="POST" action="/admin/icra/icra/'. $icra->id.'">
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
        $iller = Iller::all();
        $kategoriler = Kategori::where('ust_kategori', '0')->where('id', '<', 26)->get();
        return view('icra.icra.create')->with('kategoriler', $kategoriler)->with('iller', $iller);
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
          'alacakli'  => 'required|string|max:255',
          'borclu'    => 'required|string|max:255',
      ]);

        $user_id = backpack_auth()->user()->id;

        if (!$validate->fails()) {
            $icralar = new IcraDosya();
            $icralar->dosya_no  = $request->dosya_no;
            $icralar->kategori  = $request->kategori;
            $icralar->ili       = $request->ili;
            $icralar->mahkeme   = $request->mahkeme;
            $icralar->alacakli  = $request->alacakli;
            $icralar->borclu    = $request->borclu;
            $icralar->user_id   = $user_id;
            $icralar->save();

            if ($icralar->save()) {
                Alert::success('Kayıt Başarılı')->flash();
                return redirect()->route('icra.show', $icralar->id);
            }else{
                Alert::warning('denger', 'Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz.<br />'.$errors);
                return redirect()->back();
            }
        } else {
            $errors = $validate->errors();
            Alert::warning('Kayıt Başarısız. Lütfen alanları doğru doldurun!<br />'.$errors)->flash();
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
        $icralar = IcraDosya::where('id', $id)->first();
        $kategori = Kategori::where('ust_kategori', '0')->get();
        return view('icra.icra.show')->with('icralar', $icralar)->with('kategori', $kategori);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $icralar = IcraDosya::where('id', $id)->first();
        $kategoriler = Kategori::where('ust_kategori', '0')->get();
        $iller = Iller::all();
        return view('icra.icra.edit')->with('icralar', $icralar)->with('kategoriler', $kategoriler)->with('iller', $iller);
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
              'alacakli'  => 'required|string|max:255',
              'borclu'    => 'required|string|max:255',
          ]);

          if (!$validate->fails()) {
            $icralar = IcraDosya::findorFail($id);
            $icralar->dosya_no  = $request->dosya_no;
            $icralar->kategori  = $request->kategori;
            $icralar->ili       = $request->ili;
            $icralar->mahkeme   = $request->mahkeme;
            $icralar->alacakli  = $request->alacakli;
            $icralar->borclu    = $request->borclu;
            $icralar->save();

            if ($icralar->save()) {
                Alert::success('Kayıt Başarılı')->flash();
                return redirect()->route('icra.show', $icralar->id);
            }else{
                Alert::warning('denger', 'Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz.');
                return redirect()->back();
            }
          } else {
              $errors = $validate->errors();
              Alert::warning('Kayıt Başarısız. Lütfen alanları doğru doldurun!<br />'.$errors)->flash();
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
                        case '7':
                            $icralar= IcraDosya::findorFail($id);
                            $icralar->durum    = $request->durum;
                            $icralar->kategori  = 17;
                            $icralar->save();

                            if ($icralar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->route('icra.show', $icralar->id);
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!<br />')->flash();
                                return redirect()->back();
                            }
                            break;
                        case '8':
                            $kategori = 18;
                            $icralar= IcraDosya::findorFail($id);
                            $icralar->durum    = $request->durum;
                            $icralar->kategori  = $kategori;
                            $icralar->save();

                            if ($icralar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->route('icra.show', $icralar->id);
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!<br />')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 9:
                            $kategori = 19;
                            $icralar= IcraDosya::findorFail($id);
                            $icralar->durum    = $request->durum;
                            $icralar->kategori  = $kategori;
                            $icralar->save();

                            if ($icralar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->route('icra.show', $icralar->id);
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!<br />')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 10:
                            $kategori = 20;
                            $icralar= IcraDosya::findorFail($id);
                            $icralar->durum    = $request->durum;
                            $icralar->kategori  = $kategori;
                            $icralar->save();

                            if ($icralar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->route('icra.show', $icralar->id);
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!<br />')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 11:
                            $kategori = 21;
                            $icralar= IcraDosya::findorFail($id);
                            $icralar->durum    = $request->durum;
                            $icralar->kategori  = $kategori;
                            $icralar->save();

                            if ($icralar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->route('icra.show', $icralar->id);
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!<br />')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 12:
                            $kategori = 22;
                            $icralar= IcraDosya::findorFail($id);
                            $icralar->durum    = $request->durum;
                            $icralar->kategori  = $kategori;
                            $icralar->save();

                            if ($icralar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->route('icra.show', $icralar->id);
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!<br />')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 13:
                            $kategori = 23;
                            $icralar= IcraDosya::findorFail($id);
                            $icralar->durum    = $request->durum;
                            $icralar->kategori  = $kategori;
                            $icralar->save();

                            if ($icralar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->route('icra.show', $icralar->id);
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!<br />')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 14:
                            $kategori = 24;
                            $icralar= IcraDosya::findorFail($id);
                            $icralar->durum    = $request->durum;
                            $icralar->kategori  = $kategori;
                            $icralar->save();

                            if ($icralar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->route('icra.show', $icralar->id);
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!<br />')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 15:
                            $kategori = 25;
                            $icralar= IcraDosya::findorFail($id);
                            $icralar->durum    = $request->durum;
                            $icralar->kategori  = $kategori;
                            $icralar->save();

                            if ($icralar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->route('icra.show', $icralar->id);
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!<br />')->flash();
                                return redirect()->back();
                            }
                            break;

                    }

                }

                elseif ($request->eski_durum == 'infaz' && $request->durum == 'Derdest'){
                    switch ($request->kategori)
                    {
                        case '17':
                            $kategori = 7;
                            $icralar= IcraDosya::findorFail($id);
                            $icralar->durum    = $request->durum;
                            $icralar->kategori  = $kategori;
                            $icralar->save();

                            if ($icralar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->route('icra.show', $icralar->id);
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!<br />')->flash();
                                return redirect()->back();
                            }
                            break;
                        case '18':
                            $kategori = 8;
                            $icralar= IcraDosya::findorFail($id);
                            $icralar->durum    = $request->durum;
                            $icralar->kategori  = $kategori;
                            $icralar->save();

                            if ($icralar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->route('icra.show', $icralar->id);
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!<br />')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 19:
                            $kategori = 9;
                            $icralar= IcraDosya::findorFail($id);
                            $icralar->durum    = $request->durum;
                            $icralar->kategori  = $kategori;
                            $icralar->save();

                            if ($icralar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->route('icra.show', $icralar->id);
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!<br />')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 20:
                            $kategori = 10;
                            $icralar= IcraDosya::findorFail($id);
                            $icralar->durum    = $request->durum;
                            $icralar->kategori  = $kategori;
                            $icralar->save();

                            if ($icralar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->route('icra.show', $icralar->id);
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!<br />')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 21:
                            $kategori = 11;
                            $icralar= IcraDosya::findorFail($id);
                            $icralar->durum    = $request->durum;
                            $icralar->kategori  = $kategori;
                            $icralar->save();

                            if ($icralar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->route('icra.show', $icralar->id);
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!<br />')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 22:
                            $kategori = 12;
                            $icralar= IcraDosya::findorFail($id);
                            $icralar->durum    = $request->durum;
                            $icralar->kategori  = $kategori;
                            $icralar->save();

                            if ($icralar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->route('icra.show', $icralar->id);
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!<br />')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 23:
                            $kategori = 13;
                            $icralar= IcraDosya::findorFail($id);
                            $icralar->durum    = $request->durum;
                            $icralar->kategori  = $kategori;
                            $icralar->save();

                            if ($icralar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->route('icra.show', $icralar->id);
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!<br />')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 24:
                            $kategori = 14;
                            $icralar= IcraDosya::findorFail($id);
                            $icralar->durum    = $request->durum;
                            $icralar->kategori  = $kategori;
                            $icralar->save();

                            if ($icralar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->route('icra.show', $icralar->id);
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!<br />')->flash();
                                return redirect()->back();
                            }
                            break;
                        case 25:
                            $kategori = 15;
                            $icralar= IcraDosya::findorFail($id);
                            $icralar->durum    = $request->durum;
                            $icralar->kategori  = $kategori;
                            $icralar->save();

                            if ($icralar->save()) {
                                Alert::success('Dosya Güncellendi!')->flash();
                                return redirect()->route('icra.show', $icralar->id);
                            }
                            else{
                                Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!<br />')->flash();
                                return redirect()->back();
                            }
                            break;


                    }
                }

                else {
                    Alert::warning('Her hangi bir işlem yapılmadı')->flash();
                    return redirect()->back();
                }

            }else {
                $errors = $validate->errors();
                Alert::warning('Kayıt Başarısız. Lütfen alanları doğru doldurun!<br />'.$errors)->flash();
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
        $icralar = IcraDosya::findOrFail($id)->delete();
        Alert::success('Silme İşlemi Başarılı')->flash();
        return redirect()->route('icra.index');
    }
}

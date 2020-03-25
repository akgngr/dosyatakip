<?php

namespace App\Http\Controllers;

use Validator;
use Prologue\Alerts\AlertsMessageBag;
use Prologue\Alerts\Facades\Alert;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use App\Tahsilat;
use App\Tahsilat_ana;
class TahsilatController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:admin');
    }

    /*
    *
    */
    public function alinan_store(Request $request)
    {
        $validate = Validator::make($request->all(),
            [
                'veren_kisi'            => 'required',
                'ucret'                 => 'required|numeric',
                'veren_kisi_iletisim'   => 'required'
            ]);

        $user_id = backpack_auth()->user()->id;

        if (!$validate->fails()) {
            $alinan                       = new Tahsilat();
            $alinan->veren_kisi           = $request->veren_kisi;
            $alinan->ucret                = $request->ucret;
            $alinan->veren_kisi_iletisim  = $request->veren_kisi_iletisim;
            $alinan->alan_kisi            = $user_id;
            $alinan->icra_id              = $request->icra_id;
            $alinan->infaz_id             = $request->infaz_id;
            $alinan->save();

            if (isset($request->icra_id)){
                Alert::success('Kayıt Başarılı')->flash();
                return redirect()->route('icra.show', $request->icra_id);
            }else{
                Alert::success('Kayıt Başarılı')->flash();
                return redirect()->route('infaz.show', $request->infaz_id);
            }
        }else {
            $errors = $validate->errors();
            Alert::warning('Kayıt Başarısız. Lütfen alanları doğru doldurun!<br />'.$errors)->flash();
            return redirect()->back();
        }
    }


    /*
    ** Alnacak ücret buraya kaydediliyor.
    */
    public function alacak_store(Request $request)
    {
      $validate = Validator::make($request->all(),
      [
        'anlasilan_kisi'    => 'required',
        'ucret'             => 'required|numeric',
        'iletisim'          => 'required'
      ]);

      $user_id = backpack_auth()->user()->id;

      if (!$validate->fails()) {
        $tahsilat                 = new Tahsilat_ana();
        $tahsilat->anlasilan_kisi = $request->anlasilan_kisi;
        $tahsilat->ucret          = $request->ucret;
        $tahsilat->iletisim       = $request->iletisim;
        $tahsilat->alan_kisi      = $user_id;
        $tahsilat->icra_id        = $request->icra_id;
        $tahsilat->infaz_id       = $request->infaz_id;
        $tahsilat->save();

        if (isset($request->icra_id)){
            Alert::success('Kayıt Başarılı')->flash();
            return redirect()->route('icra.show', $request->icra_id);
        }else{
            Alert::success('Kayıt Başarılı')->flash();
            return redirect()->route('infaz.show', $request->infaz_id);
        }
      }else {
        $errors = $validate->errors();
        Alert::warning('Kayıt Başarısız. Lütfen alanları doğru doldurun!<br />'.$errors)->flash();
        return redirect()->back();
      }
    }


    public function alinan_delete($id)
    {
        $alinan = Tahsilat::findOrFail($id);
        $alinan->delete();
        Alert::success('Silme İşlemi Başarılı')->flash();
        return redirect()->back();
    }

    public function alacak_delete($id)
    {
        $alacak = Tahsilat_ana::findOrFail($id);
        $alacak->delete();
        Alert::success('Silme İşlemi Başarılı')->flash();
        return redirect()->back();
    }
}

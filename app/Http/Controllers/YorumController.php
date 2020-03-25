<?php

namespace App\Http\Controllers;

use Prologue\Alerts\Facades\Alert;
use Illuminate\Http\Request;
use App\Yorum;
use App\IcraDosya;
use App\User;
use App\InfazDosya;
use Prologue\Alerts\AlertsMessageBag;

class YorumController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:editor');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'         => 'required|max:255',
            'govde'        => 'required'
        ]);
        $user_id = backpack_auth()->user()->id;

        $yorum = new Yorum;
        $yorum->name    = $request->name;
        $yorum->user_id = $user_id;
        $yorum->govde   = $request->govde;
        $yorum->icra    = $request->icra;
        $yorum->save();

        if ($yorum) {
            Alert::success('Yorum Kaydedildi!')->flash();
            return redirect()->route('icra.show', $request->icra);
        }
        else{
            Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!')->flash();
            return redirect()->route('icra.show', $id);
        }
    }


    public function infaz_store(Request $request)
    {
        $this->validate($request, [
            'name'         => 'required|max:255',
            'govde'        => 'required'
        ]);

        $user_id = backpack_auth()->user()->id;
        $yorum = new Yorum;
        $yorum->name    = $request->name;
        $yorum->user_id = $user_id;
        $yorum->govde   = $request->govde;
        $yorum->infaz   = $request->infaz;
        $yorum->save();

        if ($yorum) {
            Alert::success('Yorum Kaydedildi!')->flash();
            return redirect()->route('infaz.show', $request->infaz);
        }
        else{
            Alert::denger('Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz!')->flash();
            return redirect()->route('infaz.show', $id);
        }
    }

    public function destroy($id)
    {
        $yorum = Yorum::findOrFail($id);
        $yorum->delete();
        Alert::success('Silme İşlemi Başarılı')->flash();
        return redirect()->back();
    }
}

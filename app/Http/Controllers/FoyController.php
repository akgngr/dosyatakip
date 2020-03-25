<?php /** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\IcraDerdestFoyNo;
use App\IcraInfazFoyNo;
use App\MahkemeFoyNo;
use App\MahkemeInfazFoyNo;
use Prologue\Alerts\AlertsMessageBag;
use Prologue\Alerts\Facades\Alert;

class FoyController extends Controller
{
    public function __construct()
    {
        $this->middleware(backpack_middleware());
    }


    public function icra_derdest_foyno_kaydet(Request $request)
    {
        $id         = $request->icra_id;
        $kategori   = $request->kategori;

        $sorgu = IcraDerdestFoyNo::where('kategori', $kategori)->orderBy('foy_no', 'desc')->take(1)->first();



        if (!empty($sorgu->foy_no)) {
            $validate = Validator::make($request->all(),[
                'icra_id' => 'unique:icra_derdest_foy_no',
            ]);

            if (!$validate->fails()) {
                $foyNo = $sorgu->foy_no;
                $yenifoyNo = $foyNo + 1;

                $derdestFoy = new IcraDerdestFoyNo();

                $derdestFoy->icra_id = $id;
                $derdestFoy->kategori = $kategori;
                $derdestFoy->foy_no = $yenifoyNo;
                $derdestFoy->save();

                if ($derdestFoy->save()) {
                    Alert::success('Föy No Güncellendi!')->flash();
                    return redirect()->back();
                } else {
                    Alert::denger('Bir sorun var!')->flash();
                    return redirect()->back();
                }
            }else{
                Alert::denger('Bir sorun var!'.$validate->errors())->flash();
                return redirect()->back();
            }
        }else {
            $validate = Validator::make($request->all(),[
                'icra_id' => 'unique:icra_derdest_foy_no',
            ]);
            if (!$validate->fails()) {
                $derdestFoy = new IcraDerdestFoyNo();

                $derdestFoy->icra_id = $id;
                $derdestFoy->kategori = $kategori;
                $derdestFoy->foy_no = 1;
                $derdestFoy->save();

                if ($derdestFoy->save()) {
                    Alert::success('Föy No Güncellendi!')->flash();
                    return redirect()->back();
                } else {
                    Alert::denger('Bir sorun var!')->flash();
                    return redirect()->back();
                }
            }else{
                Alert::denger('Bir sorun var!'.$validate->errors())->flash();
                return redirect()->back();
            }
        }

    }

    public function icra_infaz_foyno_kaydet(Request $request)
    {
        $id         = $request->icra_id;
        $kategori   = $request->kategori;

        $sorgu = IcraInfazFoyNo::where('kategori', $kategori)->orderBy('foy_no', 'desc')->take(1)->first();



        if (!empty($sorgu->foy_no)) {
            $validate = Validator::make($request->all(),[
                'icra_id' => 'unique:icra_infaz_foy_no',
            ]);

            if (!$validate->fails()) {
                $foyNo = $sorgu->foy_no;
                $yenifoyNo = $foyNo + 1;

                $derdestFoy = new IcraInfazFoyNo();

                $derdestFoy->icra_id = $id;
                $derdestFoy->kategori = $kategori;
                $derdestFoy->foy_no = $yenifoyNo;
                $derdestFoy->save();

                if ($derdestFoy->save()) {
                    Alert::success('Föy No Güncellendi!')->flash();
                    return redirect()->back();
                } else {
                    Alert::denger('Bir sorun var!')->flash();
                    return redirect()->back();
                }
            }else{
                Alert::denger('Bir sorun var!'.$validate->errors())->flash();
                return redirect()->back();
            }

        }else {
            $validate = Validator::make($request->all(),[
                'icra_id' => 'unique:icra_infaz_foy_no',
            ]);

            if (!$validate->fails()) {
                $derdestFoy = new IcraInfazFoyNo();

                $derdestFoy->icra_id  = $id;
                $derdestFoy->kategori = $kategori;
                $derdestFoy->foy_no   = 1;
                $derdestFoy->save();

                if ($derdestFoy->save()){
                    Alert::success('Föy No Güncellendi!')->flash();
                    return redirect()->back();
                }else{
                    Alert::denger('Bir sorun var!')->flash();
                    return redirect()->back();
                }
            }else{
                Alert::denger('Bir sorun var!'.$validate->errors())->flash();
                return redirect()->back();
            }
        }

    } 

    public function mahkeme_derdest_foyno_kaydet(Request $request)
    {
        $id         = $request->mahkeme_id;
        $kategori   = $request->kategori;

        $sorgu = MahkemeFoyNo::where('kategori', $kategori)->orderBy('foy_no', 'desc')->first();

        if (!empty($sorgu->foy_no)) {
            $validate = Validator::make($request->all(),[
                'mahkeme_id' => 'unique:mahkeme_derdest_foy_no,mahkeme_id'
            ]);

            if (!$validate->fails()) {
                $foyNo = $sorgu->foy_no;
                $yenifoyNo = $foyNo + 1;

                $derdestFoy = new MahkemeFoyNo();

                $derdestFoy->mahkeme_id = $id;
                $derdestFoy->kategori = $kategori;
                $derdestFoy->foy_no = $yenifoyNo;
                $derdestFoy->save();

                if ($derdestFoy->save()) {
                    Alert::success('Föy No Güncellendi!')->flash();
                    return redirect()->back();
                } else {
                    Alert::denger('Bir sorun var!')->flash();
                    return redirect()->back();
                }
            }else{
                Alert::denger('Bir sorun var!'.$validate->errors())->flash();
                return redirect()->back();
            }
        }else {
            $validate = Validator::make($request->all(),[
                'mahkeme_id' => 'unique:mahkeme_derdest_foy_no,mahkeme_id'
            ]);
            if (!$validate->fails()) {
                $derdestFoy = new MahkemeFoyNo();

                $derdestFoy->mahkeme_id = $id;
                $derdestFoy->kategori = $kategori;
                $derdestFoy->foy_no = 1;
                $derdestFoy->save();

                if ($derdestFoy->save()) {
                    Alert::success('Föy No Güncellendi!')->flash();
                    return redirect()->back();
                } else {
                    Alert::denger('Bir sorun var!')->flash();
                    return redirect()->back();
                }
            }else{
                Alert::denger('Bir sorun var!'.$validate->errors())->flash();
                return redirect()->back();
            }
        }

    }

    public function mahkeme_infaz_foyno_kaydet(Request $request)
    {
        $id         = $request->mahkeme_id;
        $kategori   = $request->kategori;

        $sorgu = MahkemeInfazFoyNo::where('kategori', $kategori)->orderBy('foy_no', 'desc')->take(1)->first();



        if (!empty($sorgu->foy_no)) {
            $validate = Validator::make($request->all(),[
                'mahkeme_id' => 'unique:mahkeme_infaz_foy_no',
            ]);

            if (!$validate->fails()) {
                $foyNo = $sorgu->foy_no;
                $yenifoyNo = $foyNo + 1;

                $derdestFoy = new MahkemeInfazFoyNo();

                $derdestFoy->mahkeme_id = $id;
                $derdestFoy->kategori = $kategori;
                $derdestFoy->foy_no = $yenifoyNo;
                $derdestFoy->save();

                if ($derdestFoy->save()) {
                    Alert::success('Föy No Güncellendi!')->flash();
                    return redirect()->back();
                } else {
                    Alert::denger('Bir sorun var!')->flash();
                    return redirect()->back();
                }
            }else{
                Alert::denger('Bir sorun var!'.$validate->errors())->flash();
                return redirect()->back();
            }

        }else {
            $validate = Validator::make($request->all(),[
                'mahkeme_id' => 'unique:mahkeme_infaz_foy_no',
            ]);

            if (!$validate->fails()) {
                $derdestFoy = new MahkemeInfazFoyNo();

                $derdestFoy->mahkeme_id  = $id;
                $derdestFoy->kategori = $kategori;
                $derdestFoy->foy_no   = 1;
                $derdestFoy->save();

                if ($derdestFoy->save()){
                    Alert::success('Föy No Güncellendi!')->flash();
                    return redirect()->back();
                }else{
                    Alert::denger('Bir sorun var!')->flash();
                    return redirect()->back();
                }
            }else{
                Alert::denger('Bir sorun var!'.$validate->errors())->flash();
                return redirect()->back();
            }
        }

    }
}

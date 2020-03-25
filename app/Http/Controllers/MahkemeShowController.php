<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Prologue\Alerts\AlertsMessageBag;
use Prologue\Alerts\Facades\Alert;
use Illuminate\Support\MessageBag;
use App\InfazDosya;
use App\Kategori;
use App\User;
use Auth;
use App\Yorum;
use App\Tahsilat;
use App\Tahsilat_ana;
use App\Iller;
use Yajra\Datatables\Datatables;


class MahkemeShowController extends Controller
{
    public function __construct()
    {
        $this->middleware(backpack_middleware());
    }

    public function is_ve_aile()
    {
        $url = 'admin/icra/mahkeme/is_ve_aile/data';
        return view('icra.infaz.index')->with('url', $url);
    }
    public function asliye_tuketici()
    {
        $url = 'admin/icra/mahkeme/asliye_tuketici/data';
        return view('icra.infaz.index')->with('url', $url);
    }
    public function cek()
    {
        $url = 'admin/icra/mahkeme/cek/data';
        return view('icra.infaz.index')->with('url', $url);
    }
    public function ceza()
    {
        $url = 'admin/icra/mahkeme/ceza/data';
        return view('icra.infaz.index')->with('url', $url);
    }
    public function icra_hukuk()
    {
        $url = 'admin/icra/mahkeme/icra_hukuk/data';
        return view('icra.infaz.index')->with('url', $url);
    }
    public function savcilik()
    {
        $url = 'admin/icra/mahkeme/savcilik/data';
        return view('icra.infaz.index')->with('url', $url);
    }
    public function gapel()
    {
        $url = 'admin/icra/mahkeme/gapel/data';
        return view('icra.infaz.index')->with('url', $url);
    }

    /*
     * Mahkme Dataları
     */

    public function is_ve_aile_data(Datatables $datatables)
    {
        return $datatables->eloquent(InfazDosya::query()->where('kategori', '27')->where('durum', 'Derdest'))
            ->setRowClass(function ($infaz) {
                if ($infaz->durum == 'infaz'){
                    return $infaz->durum === 'infaz' ? 'alert-warning': 'alert-warning';
                }else{
                    return;
                }

            })
            ->editColumn('dosya_no', function ($infaz) {
                return '<a href="/admin/icra/mahkeme/is_ve_aile/show/'.$infaz->id.'">' . $infaz->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($infaz)
            {
                 if($infaz->durum == 'Derdest')
                 {
                    if(isset($infaz->mahkeme_derdest_foy_no)){
                        return $infaz->mahkeme_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($infaz->mahkeme_infaz_foy_no)){
                        return $infaz->mahkeme_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->addColumn('action',function ($infaz) {
                return '<a class="btn btn-twitter" href="/admin/icra/mahkeme/is_ve_aile/show/'.$infaz->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/mahkeme/is_ve_aile/'.$infaz->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('infaz.destroy', $infaz->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function asliye_tuketici_data(Datatables $datatables)
    {
        return $datatables->eloquent(InfazDosya::query()->where('kategori', '28')->where('durum', 'Derdest'))
            ->setRowClass(function ($infaz) {
                if ($infaz->durum == 'infaz'){
                    return $infaz->durum === 'infaz' ? 'alert-warning': 'alert-warning';
                }else{
                    return;
                }

            })
            ->editColumn('dosya_no', function ($infaz) {
                return '<a href="/admin/icra/mahkeme/asliye_tuketici/show/'.$infaz->id.'">' . $infaz->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($infaz)
            {
                 if($infaz->durum == 'Derdest')
                 {
                    if(isset($infaz->mahkeme_derdest_foy_no)){
                        return $infaz->mahkeme_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($infaz->mahkeme_infaz_foy_no)){
                        return $infaz->mahkeme_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->addColumn('action',function ($infaz) {
                return '<a class="btn btn-twitter" href="/admin/icra/mahkeme/asliye_tuketici/show/'.$infaz->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/mahkeme/asliye_tuketici/'.$infaz->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('infaz.destroy', $infaz->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function cek_data(Datatables $datatables)
    {
        return $datatables->eloquent(InfazDosya::query()->where('kategori', '29')->where('durum', 'Derdest'))
            ->setRowClass(function ($infaz) {
                if ($infaz->durum == 'infaz'){
                    return $infaz->durum === 'infaz' ? 'alert-warning': 'alert-warning';
                }else{
                    return;
                }

            })
            ->editColumn('dosya_no', function ($infaz) {
                return '<a href="/admin/icra/mahkeme/cek/show/'.$infaz->id.'">' . $infaz->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($infaz)
            {
                 if($infaz->durum == 'Derdest')
                 {
                    if(isset($infaz->mahkeme_derdest_foy_no)){
                        return $infaz->mahkeme_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($infaz->mahkeme_infaz_foy_no)){
                        return $infaz->mahkeme_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->addColumn('action',function ($infaz) {
                return '<a class="btn btn-twitter" href="/admin/icra/mahkeme/cek/show/'.$infaz->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/mahkeme/cek/'.$infaz->id.'/edit"><i class="fa fa-edit"></i> </a>
         <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('infaz.destroy', $infaz->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function ceza_data(Datatables $datatables)
    {
        return $datatables->eloquent(InfazDosya::query()->where('kategori', '30')->where('durum', 'Derdest'))
            ->setRowClass(function ($infaz) {
                if ($infaz->durum == 'infaz'){
                    return $infaz->durum === 'infaz' ? 'alert-warning': 'alert-warning';
                }else{
                    return;
                }

            })
            ->editColumn('dosya_no', function ($infaz) {
                return '<a href="/admin/icra/mahkeme/ceza/show/'.$infaz->id.'">' . $infaz->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($infaz)
            {
                 if($infaz->durum == 'Derdest')
                 {
                    if(isset($infaz->mahkeme_derdest_foy_no)){
                        return $infaz->mahkeme_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($infaz->mahkeme_infaz_foy_no)){
                        return $infaz->mahkeme_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->addColumn('action',function ($infaz) {
                return '<a class="btn btn-twitter" href="/admin/icra/mahkeme/ceza/show/'.$infaz->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/mahkeme/ceza/'.$infaz->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('infaz.destroy', $infaz->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function icra_hukuk_data(Datatables $datatables)
    {
        return $datatables->eloquent(InfazDosya::query()->where('kategori', '31')->where('durum', 'Derdest'))
            ->setRowClass(function ($infaz) {
                if ($infaz->durum == 'infaz'){
                    return $infaz->durum === 'infaz' ? 'alert-warning': 'alert-warning';
                }else{
                    return;
                }

            })
            ->editColumn('dosya_no', function ($infaz) {
                return '<a href="/admin/icra/mahkeme/icra_hukuk/show/'.$infaz->id.'">' . $infaz->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($infaz)
            {
                 if($infaz->durum == 'Derdest')
                 {
                    if(isset($infaz->mahkeme_derdest_foy_no)){
                        return $infaz->mahkeme_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($infaz->mahkeme_infaz_foy_no)){
                        return $infaz->mahkeme_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->addColumn('action',function ($infaz) {
                return '<a class="btn btn-twitter" href="/admin/icra/mahkeme/icra_hukuk/show/'.$infaz->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/mahkeme/icra_hukuk/'.$infaz->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('infaz.destroy', $infaz->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function savcilik_data(Datatables $datatables)
    {
        return $datatables->eloquent(InfazDosya::query()->where('kategori', '32')->where('durum', 'Derdest'))
            ->setRowClass(function ($infaz) {
                if ($infaz->durum == 'infaz'){
                    return $infaz->durum === 'infaz' ? 'alert-warning': 'alert-warning';
                }else{
                    return;
                }

            })
            ->editColumn('dosya_no', function ($infaz) {
                return '<a href="/admin/icra/mahkeme/savcilik/show/'.$infaz->id.'">' . $infaz->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($infaz)
            {
                 if($infaz->durum == 'Derdest')
                 {
                    if(isset($infaz->mahkeme_derdest_foy_no)){
                        return $infaz->mahkeme_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($infaz->mahkeme_infaz_foy_no)){
                        return $infaz->mahkeme_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->addColumn('action',function ($infaz) {
                return '<a class="btn btn-twitter" href="/admin/icra/mahkeme/savcilik/show/'.$infaz->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/mahkeme/savcilik/'.$infaz->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('infaz.destroy', $infaz->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function gapel_data(Datatables $datatables)
    {
        return $datatables->eloquent(InfazDosya::query()->where('kategori', '40')->where('durum', 'Derdest'))
            ->setRowClass(function ($infaz) {
                if ($infaz->durum == 'infaz'){
                    return $infaz->durum === 'infaz' ? 'alert-warning': 'alert-warning';
                }else{
                    return;
                }

            })
            ->editColumn('dosya_no', function ($infaz) {
                return '<a href="/admin/icra/mahkeme/gapel/show/'.$infaz->id.'">' . $infaz->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($infaz)
            {
                 if($infaz->durum == 'Derdest')
                 {
                    if(isset($infaz->mahkeme_derdest_foy_no)){
                        return $infaz->mahkeme_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($infaz->mahkeme_infaz_foy_no)){
                        return $infaz->mahkeme_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->addColumn('action',function ($infaz) {
                return '<a class="btn btn-twitter" href="/admin/icra/mahkeme/gapel/show/'.$infaz->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/mahkeme/gapel/'.$infaz->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('infaz.destroy', $infaz->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }

    public function is_ve_aile_infaz()
    {
        $url = 'admin/icra/mahkeme/infaz/is_ve_aile/data';
        return view('icra.infaz.index')->with('url', $url);
    }
    public function asliye_tuketici_infaz()
    {
        $url = 'admin/icra/mahkeme/infaz/asliye_tuketici/data';
        return view('icra.infaz.index')->with('url', $url);
    }
    public function cek_infaz()
    {
        $url = 'admin/icra/mahkeme/infaz/cek/data';
        return view('icra.infaz.index')->with('url', $url);
    }
    public function ceza_infaz()
    {
        $url = 'admin/icra/mahkeme/infaz/ceza/data';
        return view('icra.infaz.index')->with('url', $url);
    }
    public function icra_hukuk_infaz()
    {
        $url = 'admin/icra/mahkeme/infaz/icra_hukuk/data';
        return view('icra.infaz.index')->with('url', $url);
    }
    public function savcilik_infaz()
    {
        $url = 'admin/icra/mahkeme/infaz/savcilik/data';
        return view('icra.infaz.index')->with('url', $url);
    }
    public function gapel_infaz()
    {
        $url = 'admin/icra/mahkeme/infaz/gapel/data';
        return view('icra.infaz.index')->with('url', $url);
    }


    /*
     * Mahkme İnfaz Dataları
     */

    public function is_ve_aile_infaz_data(Datatables $datatables)
    {
        return $datatables->eloquent(InfazDosya::query()->where('kategori', '34')->where('durum', 'infaz'))
            ->editColumn('dosya_no', function ($infaz) {
                return '<a href="/admin/icra/infaz/mahkeme/is_ve_aile/show/'.$infaz->id.'">' . $infaz->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($infaz)
            {
                 if($infaz->durum == 'Derdest')
                 {
                    if(isset($infaz->mahkeme_derdest_foy_no)){
                        return $infaz->mahkeme_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($infaz->mahkeme_infaz_foy_no)){
                        return $infaz->mahkeme_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->addColumn('action',function ($infaz) {
                return '<a class="btn btn-twitter" href="/admin/icra/infaz/mahkeme/is_ve_aile/show/'.$infaz->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/infaz/mahkeme/is_ve_aile/'.$infaz->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('infaz.destroy', $infaz->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function asliye_tuketici_infaz_data(Datatables $datatables)
    {
        return $datatables->eloquent(InfazDosya::query()->where('kategori', '35')->where('durum', 'infaz'))
            ->editColumn('dosya_no', function ($infaz) {
                return '<a href="/admin/icra/infaz/mahkeme/asliye_tuketici/show/'.$infaz->id.'">' . $infaz->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($infaz)
            {
                 if($infaz->durum == 'Derdest')
                 {
                    if(isset($infaz->mahkeme_derdest_foy_no)){
                        return $infaz->mahkeme_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($infaz->mahkeme_infaz_foy_no)){
                        return $infaz->mahkeme_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->addColumn('action',function ($infaz) {
                return '<a class="btn btn-twitter" href="/admin/icra/infaz/mahkeme/asliye_tuketici/show/'.$infaz->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/infaz/mahkeme/asliye_tuketici/'.$infaz->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('infaz.destroy', $infaz->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function cek_infaz_data(Datatables $datatables)
    {
        return $datatables->eloquent(InfazDosya::query()->where('kategori', '36')->where('durum', 'infaz'))
            ->editColumn('dosya_no', function ($infaz) {
                return '<a href="/admin/icra/infaz/mahkeme/cek/show/'.$infaz->id.'">' . $infaz->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($infaz)
            {
                 if($infaz->durum == 'Derdest')
                 {
                    if(isset($infaz->mahkeme_derdest_foy_no)){
                        return $infaz->mahkeme_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($infaz->mahkeme_infaz_foy_no)){
                        return $infaz->mahkeme_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->editColumn('action',function ($infaz) {
                return '<a class="btn btn-twitter" href="/admin/icra/infaz/mahkeme/cek/show/'.$infaz->id.'"><i class="fa fa-eye fa-sm"></i> </a>
                <a class="btn btn-primary" href="/admin/icra/infaz/mahkeme/cek/'.$infaz->id.'/edit"><i class="fa fa-edit fa-sm"></i> </a>
                
                <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('infaz.destroy', $infaz->id).'" method="POST">
                    '.csrf_field().'
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-danger"><i class="fa fa-trash "></i></button>
                </form>
                ';})
                    ->rawColumns(['dosya_no', 'action', 'foy_no'])
                    ->make(true);
    }
    public function ceza_infaz_data(Datatables $datatables)
    {
        return $datatables->eloquent(InfazDosya::query()->where('kategori', '37')->where('durum', 'infaz'))
            ->editColumn('dosya_no', function ($infaz) {
                return '<a href="/admin/icra/infaz/mahkeme/ceza/show/'.$infaz->id.'">' . $infaz->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($infaz)
            {
                 if($infaz->durum == 'Derdest')
                 {
                    if(isset($infaz->mahkeme_derdest_foy_no)){
                        return $infaz->mahkeme_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($infaz->mahkeme_infaz_foy_no)){
                        return $infaz->mahkeme_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->addColumn('action',function ($infaz) {
                return '<a class="btn btn-twitter" href="/admin/icra/infaz/mahkeme/ceza/show/'.$infaz->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/infaz/mahkeme/ceza/'.$infaz->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('infaz.destroy', $infaz->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function icra_hukuk_infaz_data(Datatables $datatables)
    {
        return $datatables->eloquent(InfazDosya::query()->where('kategori', '38')->where('durum', 'infaz'))
            ->editColumn('dosya_no', function ($infaz) {
                return '<a href="/admin/icra/infaz/mahkeme/icra_hukuk/show/'.$infaz->id.'">' . $infaz->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($infaz)
            {
                 if($infaz->durum == 'Derdest')
                 {
                    if(isset($infaz->mahkeme_derdest_foy_no)){
                        return $infaz->mahkeme_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($infaz->mahkeme_infaz_foy_no)){
                        return $infaz->mahkeme_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->addColumn('action',function ($infaz) {
                return '<a class="btn btn-twitter" href="/admin/icra/infaz/mahkeme/icra_hukuk/show/'.$infaz->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/infaz/mahkeme/icra_hukuk/'.$infaz->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('infaz.destroy', $infaz->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function savcilik_infaz_data(Datatables $datatables)
    {
        return $datatables->eloquent(InfazDosya::query()->where('kategori', '39')->where('durum', 'infaz'))
            ->editColumn('dosya_no', function ($infaz) {
                return '<a href="/admin/icra/infaz/mahkeme/savcilik/show/'.$infaz->id.'">' . $infaz->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($infaz)
            {
                 if($infaz->durum == 'Derdest')
                 {
                    if(isset($infaz->mahkeme_derdest_foy_no)){
                        return $infaz->mahkeme_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($infaz->mahkeme_infaz_foy_no)){
                        return $infaz->mahkeme_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->addColumn('action',function ($infaz) {
                return '<a class="btn btn-twitter" href="/admin/icra/infaz/mahkeme/savcilik/show/'.$infaz->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/infaz/mahkeme/savcilik/'.$infaz->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('infaz.destroy', $infaz->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }

    
    public function gapel_infaz_data(Datatables $datatables)
    {

        return $datatables->eloquent(InfazDosya::query()->where('kategori', '41')->where('durum', 'infaz')->with(['mahkeme_infaz_foy_no' =>function($query){
            return $query;
        }]))
            ->editColumn('dosya_no', function ($infaz) {
                return '<a href="/admin/icra/infaz/mahkeme/gapel/show/'.$infaz->id.'">' . $infaz->dosya_no . '</a>';
            })
        ->editColumn('foy_no', function ($infaz)
            {
                $infaz->with('mahkeme_infaz_foy_no');
                /*
                 if($infaz->durum == 'Derdest')
                 {
                    if(isset($infaz->mahkeme_derdest_foy_no)){
                        return $infaz->mahkeme_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($infaz->mahkeme_infaz_foy_no)){
                        return $infaz->mahkeme_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
                 */
            })
         /*
            ->editColumn('foy_no', function ($infaz)
            {
                
                 if($infaz->durum == 'Derdest')
                 {
                    return $infaz->mahkeme_derdest_foy_no->map(function($mahkeme_derdest_foy_no) {
                        if(isset($mahkeme_derdest_foy_no)){
                            return $mahkeme_derdest_foy_no->foy_no;
                        }else
                        {
                            return 'Boş';
                        }
                    });
                    
                 }else
                 {
                    return $infaz->mahkeme_infaz_foy_no->map(function($mahkeme_infaz_foy_no) {
                        if(isset($mahkeme_infaz_foy_no)){
                            return $mahkeme_infaz_foy_no->foy_no;
                        }else
                        {
                            return 'Boş';
                        }
                    });
                                    
                 }
            })
            */
            ->addColumn('action',function ($infaz) {
                return '<a class="btn btn-twitter" href="/admin/icra/infaz/mahkeme/gapel/show/'.$infaz->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/infaz/mahkeme/gapel/'.$infaz->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('infaz.destroy', $infaz->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->toJson();
    }

/*
    public function gapel_infaz_data(Request $request)
    {
        


    }
*/
    /*
     * Mahkeme dosyalarının detayı
     */

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
}

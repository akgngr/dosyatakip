<?php

namespace App\Http\Controllers;

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


class IcraShowController extends Controller
{
    public function __construct()
    {
        $this->middleware(backpack_middleware());
    }

    public function birinci_icra()
    {
        $url = 'admin/icra/1.icra/data';
        return view('icra.icra.index')->with('url', $url);
    }
    public function ikinci_icra()
    {
        $url = 'admin/icra/2.icra/data';
        return view('icra.icra.index')->with('url', $url);
    }
    public function ucuncu_icra()
    {
        $url = 'admin/icra/3.icra/data';
        return view('icra.icra.index')->with('url', $url);
    }
    public function dorduncu_icra()
    {
        $url = 'admin/icra/4.icra/data';
        return view('icra.icra.index')->with('url', $url);
    }
    public function dis_icra()
    {
        $url = 'admin/icra/dis/icra/data';
        return view('icra.icra.index')->with('url', $url);
    }
    public function gapel_birinci_icra()
    {
        $url = 'admin/icra/gapel_1.icra/data';
        return view('icra.icra.index')->with('url', $url);
    }
    public function gapel_ikinci_icra()
    {
        $url = 'admin/icra/gapel_2.icra/data';
        return view('icra.icra.index')->with('url', $url);
    }
    public function gapel_ucuncu_icra()
    {
        $url = 'admin/icra/gapel_3.icra/data';
        return view('icra.icra.index')->with('url', $url);
    }
    public function gapel_dorduncu_icra()
    {
        $url = 'admin/icra/gapel_4.icra/data';
        return view('icra.icra.index')->with('url', $url);
    }

    /*
     * İcra datası
     */
    public function birinci_icra_data(Datatables $datatables)
    {
        return $datatables->eloquent(IcraDosya::query()->where('kategori', '7')->where('durum', 'Derdest'))
            ->setRowClass(function ($icra) {
                if ($icra->durum == 'infaz'){
                    return $icra->durum === 'infaz' ? 'alert-warning': 'alert-warning';
                }else{
                    return;
                }

            })
            ->editColumn('foy_no', function ($icra)
            {
                 if($icra->durum == 'Derdest')
                 {
                    if(isset($icra->icra_derdest_foy_no)){
                        return $icra->icra_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($icra->icra_infaz_foy_no)){
                        return $icra->icra_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
                 
            })
            ->editColumn('dosya_no', function ($icra) {
                return '<a href="/admin/icra/1.icra/show/'.$icra->id.'">' . $icra->dosya_no . '</a>';
            })
            ->addColumn('action',function ($icra) {
                return '<a class="btn btn-twitter" href="/admin/icra/1.icra/show/'.$icra->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/1.icra/'.$icra->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('icra.destroy', $icra->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function ikinci_icra_data(Datatables $datatables)
    {
        return $datatables->eloquent(IcraDosya::query()->where('kategori', '8')->where('durum', 'Derdest'))
            ->setRowClass(function ($icra) {
                if ($icra->durum == 'infaz'){
                    return $icra->durum === 'infaz' ? 'alert-warning': 'alert-warning';
                }else{
                    return;
                }

            })
            ->editColumn('foy_no', function ($icra)
            {
                 if($icra->durum == 'Derdest')
                 {
                    if(isset($icra->icra_derdest_foy_no)){
                        return $icra->icra_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($icra->icra_infaz_foy_no)){
                        return $icra->icra_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->editColumn('dosya_no', function ($icra) {
                return '<a href="/admin/icra/2.icra/show/'.$icra->id.'">' . $icra->dosya_no . '</a>';
            })
            
            ->addColumn('action',function ($icra) {
                return '<a class="btn btn-twitter" href="/admin/icra/2.icra/show/'.$icra->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/2.icra/'.$icra->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('icra.destroy', $icra->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function ucuncu_icra_data(Datatables $datatables)
    {
        return $datatables->eloquent(IcraDosya::query()->where('kategori', '9')->where('durum', 'Derdest'))
            ->setRowClass(function ($icra) {
                if ($icra->durum == 'infaz'){
                    return $icra->durum === 'infaz' ? 'alert-warning': 'alert-warning';
                }else{
                    return;
                }

            })
            ->editColumn('foy_no', function ($icra)
            {
                 if($icra->durum == 'Derdest')
                 {
                    if(isset($icra->icra_derdest_foy_no)){
                        return $icra->icra_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($icra->icra_infaz_foy_no)){
                        return $icra->icra_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->editColumn('dosya_no', function ($icra) {
                return '<a href="/admin/icra/3.icra/show/'.$icra->id.'">' . $icra->dosya_no . '</a>';
            })
            
            ->addColumn('action',function ($icra) {
                return '<a class="btn btn-twitter" href="/admin/icra/3.icra/show/'.$icra->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/3.icra/'.$icra->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('icra.destroy', $icra->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function dorduncu_icra_data(Datatables $datatables)
    {
        return $datatables->eloquent(IcraDosya::query()->where('kategori', '10')->where('durum', 'Derdest'))
            ->setRowClass(function ($icra) {
                if ($icra->durum == 'infaz'){
                    return $icra->durum === 'infaz' ? 'alert-warning': 'alert-warning';
                }else{
                    return;
                }

            })
            ->editColumn('foy_no', function ($icra)
            {
                 if($icra->durum == 'Derdest')
                 {
                    if(isset($icra->icra_derdest_foy_no)){
                        return $icra->icra_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($icra->icra_infaz_foy_no)){
                        return $icra->icra_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->editColumn('dosya_no', function ($icra) {
                return '<a href="/admin/icra/4.icra/show/'.$icra->id.'">' . $icra->dosya_no . '</a>';
            })
            
            ->addColumn('action',function ($icra) {
                return '<a class="btn btn-twitter" href="/admin/icra/4.icra/show/'.$icra->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/4.icra/'.$icra->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('icra.destroy', $icra->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function dis_icra_data(Datatables $datatables)
    {
        return $datatables->eloquent(IcraDosya::query()->where('kategori', '11')->where('durum', 'Derdest'))
            ->setRowClass(function ($icra) {
                if ($icra->durum == 'infaz'){
                    return $icra->durum === 'infaz' ? 'alert-warning': 'alert-warning';
                }else{
                    return;
                }

            })
            ->editColumn('foy_no', function ($icra)
            {
                 if($icra->durum == 'Derdest')
                 {
                    if(isset($icra->icra_derdest_foy_no)){
                        return $icra->icra_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($icra->icra_infaz_foy_no)){
                        return $icra->icra_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->editColumn('dosya_no', function ($icra) {
                return '<a href="/admin/icra/dis/icra/show/'.$icra->id.'">' . $icra->dosya_no . '</a>';
            })
            
            ->addColumn('action',function ($icra) {
                return '<a class="btn btn-twitter" href="/admin/icra/dis/icra/show/'.$icra->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/dis/icra/'.$icra->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('icra.destroy', $icra->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function gapel_birinci_icra_data(Datatables $datatables)
    {
        return $datatables->eloquent(IcraDosya::query()->where('kategori', '12')->where('durum', 'Derdest'))
            ->setRowClass(function ($icra) {
                if ($icra->durum == 'infaz'){
                    return $icra->durum === 'infaz' ? 'alert-warning': 'alert-warning';
                }else{
                    return;
                }

            })
            ->editColumn('foy_no', function ($icra)
            {
                 if($icra->durum == 'Derdest')
                 {
                    if(isset($icra->icra_derdest_foy_no)){
                        return $icra->icra_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($icra->icra_infaz_foy_no)){
                        return $icra->icra_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->editColumn('dosya_no', function ($icra) {
                return '<a href="/admin/icra/gapel_1.icra/show/'.$icra->id.'">' . $icra->dosya_no . '</a>';
            })
            ->addColumn('action',function ($icra) {
                return '<a class="btn btn-twitter" href="/admin/icra//gapel_1.icra/show/'.$icra->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/gapel_1.icra/'.$icra->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('icra.destroy', $icra->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function gapel_ikinci_icra_data(Datatables $datatables)
    {
        return $datatables->eloquent(IcraDosya::query()->where('kategori', '13')->where('durum', 'Derdest'))
            ->setRowClass(function ($icra) {
                if ($icra->durum == 'infaz'){
                    return $icra->durum === 'infaz' ? 'alert-warning': 'alert-warning';
                }else{
                    return;
                }

            })
            ->editColumn('foy_no', function ($icra)
            {
                 if($icra->durum == 'Derdest')
                 {
                    if(isset($icra->icra_derdest_foy_no)){
                        return $icra->icra_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($icra->icra_infaz_foy_no)){
                        return $icra->icra_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->editColumn('dosya_no', function ($icra) {
                return '<a href="/admin/icra/gapel_2.icra/show/'.$icra->id.'">' . $icra->dosya_no . '</a>';
            })
            ->addColumn('action',function ($icra) {
                return '<a class="btn btn-twitter" href="/admin/icra/gapel_2.icra/show/'.$icra->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/gapel_2.icra/'.$icra->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('icra.destroy', $icra->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function gapel_ucuncu_icra_data(Datatables $datatables)
    {
        return $datatables->eloquent(IcraDosya::query()->where('kategori', '14')->where('durum', 'Derdest'))
            ->setRowClass(function ($icra) {
                if ($icra->durum == 'infaz'){
                    return $icra->durum === 'infaz' ? 'alert-warning': 'alert-warning';
                }else{
                    return;
                }

            })
            ->editColumn('foy_no', function ($icra)
            {
                 if($icra->durum == 'Derdest')
                 {
                    if(isset($icra->icra_derdest_foy_no)){
                        return $icra->icra_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($icra->icra_infaz_foy_no)){
                        return $icra->icra_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->editColumn('dosya_no', function ($icra) {
                return '<a href="/admin/icra/gapel_3.icra/show/'.$icra->id.'">' . $icra->dosya_no . '</a>';
            })
            ->addColumn('action',function ($icra) {
                return '<a class="btn btn-twitter" href="/admin/icra/gapel_3.icra/show/'.$icra->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/gapel_3.icra/'.$icra->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('icra.destroy', $icra->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function gapel_dorduncu_icra_data(Datatables $datatables)
    {
        return $datatables->eloquent(IcraDosya::query()->where('kategori', '15')->where('durum', 'Derdest'))
            ->setRowClass(function ($icra) {
                if ($icra->durum == 'infaz'){
                    return $icra->durum === 'infaz' ? 'alert-warning': 'alert-warning';
                }else{
                    return;
                }

            })
            ->editColumn('foy_no', function ($icra)
            {
                 if($icra->durum == 'Derdest')
                 {
                    if(isset($icra->icra_derdest_foy_no)){
                        return $icra->icra_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($icra->icra_infaz_foy_no)){
                        return $icra->icra_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->editColumn('dosya_no', function ($icra) {
                return '<a href="/admin/icra/gapel_4.icra/show/'.$icra->id.'">' . $icra->dosya_no . '</a>';
            })
            ->addColumn('action',function ($icra) {
                return '<a class="btn btn-twitter" href="/admin/icra/gapel_4.icra/show/'.$icra->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/gapel_4.icra/'.$icra->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('icra.destroy', $icra->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }


    public function birinci_icra_infaz()
    {
        $url = 'admin/icra/1.icra/infaz/data';
        return view('icra.icra.index')->with('url', $url);
    }
    public function ikinci_icra_infaz()
    {
        $url = 'admin/icra/2.icra/infaz/data';
        return view('icra.icra.index')->with('url', $url);
    }
    public function ucuncu_icra_infaz()
    {
        $url = 'admin/icra/3.icra/infaz/data';
        return view('icra.icra.index')->with('url', $url);
    }
    public function dorduncu_icra_infaz()
    {
        $url = 'admin/icra/4.icra/infaz/data';
        return view('icra.icra.index')->with('url', $url);
    }
    public function dis_icra_infaz()
    {
        $url = 'admin/icra/dis/icra/infaz/data';
        return view('icra.icra.index')->with('url', $url);
    }
    public function gapel_birinci_icra_infaz()
    {
        $url = 'admin/icra/gapel_1.icra/infaz/data';
        return view('icra.icra.index')->with('url', $url);
    }
    public function gapel_ikinci_icra_infaz()
    {
        $url = 'admin/icra/gapel_2.icra/infaz/data';
        return view('icra.icra.index')->with('url', $url);
    }
    public function gapel_ucuncu_icra_infaz()
    {
        $url = 'admin/icra/gapel_3.icra/infaz/data';
        return view('icra.icra.index')->with('url', $url);
    }
    public function gapel_dorduncu_icra_infaz()
    {
        $url = 'admin/icra/gapel_4.icra/infaz/data';
        return view('icra.icra.index')->with('url', $url);
    }

    /*
     * İcra İnfaz datası
     */
    public function birinci_icra_data_infaz(Datatables $datatables)
    {
        return $datatables->eloquent(IcraDosya::query()->where('kategori', '17')->where('durum', 'infaz'))
            ->editColumn('dosya_no', function ($icra) {
                return '<a href="/admin/icra/infaz/1.icra/show/'.$icra->id.'">' . $icra->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($icra)
            {
                 if($icra->durum == 'Derdest')
                 {
                    if(isset($icra->icra_derdest_foy_no)){
                        return $icra->icra_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($icra->icra_infaz_foy_no)){
                        return $icra->icra_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->addColumn('action',function ($icra) {
                return '<a class="btn btn-twitter" href="/admin/icra/infaz/1.icra/show/'.$icra->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/infaz/1.icra/'.$icra->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('icra.destroy', $icra->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function ikinci_icra_data_infaz(Datatables $datatables)
    {
        return $datatables->eloquent(IcraDosya::query()->where('kategori', '18')->where('durum', 'infaz'))
            ->editColumn('dosya_no', function ($icra) {
                return '<a href="/admin/icra/infaz/2.icra/show/'.$icra->id.'">' . $icra->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($icra)
            {
                 if($icra->durum == 'Derdest')
                 {
                    if(isset($icra->icra_derdest_foy_no)){
                        return $icra->icra_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($icra->icra_infaz_foy_no)){
                        return $icra->icra_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->addColumn('action',function ($icra) {
                return '<a class="btn btn-twitter" href="/admin/icra/infaz/2.icra/show/'.$icra->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/infaz/2.icra/'.$icra->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('icra.destroy', $icra->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function ucuncu_icra_data_infaz(Datatables $datatables)
    {
        return $datatables->eloquent(IcraDosya::query()->where('kategori', '19')->where('durum', 'infaz'))
            ->editColumn('dosya_no', function ($icra) {
                return '<a href="/admin/icra/infaz/3.icra/show/'.$icra->id.'">' . $icra->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($icra)
            {
                 if($icra->durum == 'Derdest')
                 {
                    if(isset($icra->icra_derdest_foy_no)){
                        return $icra->icra_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($icra->icra_infaz_foy_no)){
                        return $icra->icra_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->addColumn('action',function ($icra) {
                return '<a class="btn btn-twitter" href="/admin/icra/infaz/3.icra/show/'.$icra->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/infaz/3.icra/'.$icra->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('icra.destroy', $icra->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function dorduncu_icra_data_infaz(Datatables $datatables)
    {
        return $datatables->eloquent(IcraDosya::query()->where('kategori', '20')->where('durum', 'infaz'))
            ->editColumn('dosya_no', function ($icra) {
                return '<a href="/admin/icra/infaz/4.icra/show/'.$icra->id.'">' . $icra->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($icra)
            {
                 if($icra->durum == 'Derdest')
                 {
                    if(isset($icra->icra_derdest_foy_no)){
                        return $icra->icra_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($icra->icra_infaz_foy_no)){
                        return $icra->icra_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->addColumn('action',function ($icra) {
                return '<a class="btn btn-twitter" href="/admin/icra/infaz/4.icra/show/'.$icra->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/infaz/4.icra/'.$icra->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('icra.destroy', $icra->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function dis_icra_data_infaz(Datatables $datatables)
    {
        return $datatables->eloquent(IcraDosya::query()->where('kategori', '21')->where('durum', 'infaz'))
            ->editColumn('dosya_no', function ($icra) {
                return '<a href="/admin/icra/infaz/dis/icra/show/'.$icra->id.'">' . $icra->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($icra)
            {
                 if($icra->durum == 'Derdest')
                 {
                    if(isset($icra->icra_derdest_foy_no)){
                        return $icra->icra_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($icra->icra_infaz_foy_no)){
                        return $icra->icra_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->addColumn('action',function ($icra) {
                return '<a class="btn btn-twitter" href="/admin/icra/infaz/dis/icra/show/'.$icra->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/infaz/dis/icra/'.$icra->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('icra.destroy', $icra->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function gapel_birinci_icra_data_infaz(Datatables $datatables)
    {
        return $datatables->eloquent(IcraDosya::query()->where('kategori', '22')->where('durum', 'infaz'))
            ->editColumn('dosya_no', function ($icra) {
                return '<a href="/admin/icra/infaz/gapel_1.icra/show/'.$icra->id.'">' . $icra->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($icra)
            {
                 if($icra->durum == 'Derdest')
                 {
                    if(isset($icra->icra_derdest_foy_no)){
                        return $icra->icra_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($icra->icra_infaz_foy_no)){
                        return $icra->icra_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->addColumn('action',function ($icra) {
                return '<a class="btn btn-twitter" href="/admin/icra/infaz/gapel_1.icra/show/'.$icra->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/infaz/gapel_1.icra/'.$icra->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('icra.destroy', $icra->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function gapel_ikinci_icra_data_infaz(Datatables $datatables)
    {
        return $datatables->eloquent(IcraDosya::query()->where('kategori', '23')->where('durum', 'infaz'))
            ->editColumn('dosya_no', function ($icra) {
                return '<a href="/admin/icra/infaz/gapel_2.icra/show/'.$icra->id.'">' . $icra->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($icra)
            {
                 if($icra->durum == 'Derdest')
                 {
                    if(isset($icra->icra_derdest_foy_no)){
                        return $icra->icra_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($icra->icra_infaz_foy_no)){
                        return $icra->icra_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->addColumn('action',function ($icra) {
                return '<a class="btn btn-twitter" href="/admin/icra/infaz/gapel_2.icra/show/'.$icra->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/infaz/gapel_2.icra/'.$icra->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('icra.destroy', $icra->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function gapel_ucuncu_icra_data_infaz(Datatables $datatables)
    {
        return $datatables->eloquent(IcraDosya::query()->where('kategori', '24')->where('durum', 'infaz'))
            ->editColumn('dosya_no', function ($icra) {
                return '<a href="/admin/icra/infaz/gapel_3.icra/show/'.$icra->id.'">' . $icra->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($icra)
            {
                 if($icra->durum == 'Derdest')
                 {
                    if(isset($icra->icra_derdest_foy_no)){
                        return $icra->icra_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($icra->icra_infaz_foy_no)){
                        return $icra->icra_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->addColumn('action',function ($icra) {
                return '<a class="btn btn-twitter" href="/admin/icra/infaz/gapel_3.icra/show/'.$icra->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/infaz/gapel_3.icra/'.$icra->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('icra.destroy', $icra->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
    }
    public function gapel_dorduncu_icra_data_infaz(Datatables $datatables)
    {
        
        return $datatables->eloquent(IcraDosya::query()->where('kategori', '25')->where('durum', 'infaz'))
            ->editColumn('dosya_no', function ($icra) {
                return '<a href="/admin/icra/infaz/gapel_4.icra/show/'.$icra->id.'">' . $icra->dosya_no . '</a>';
            })
            ->editColumn('foy_no', function ($icra)
            {
                 if($icra->durum == 'Derdest')
                 {
                    if(isset($icra->icra_derdest_foy_no)){
                        return $icra->icra_derdest_foy_no->foy_no;
                    }else
                    {
                        return 'Boş';
                    }
                    
                 }else
                 {
                    if(isset($icra->icra_infaz_foy_no)){

                        return $icra->icra_infaz_foy_no->foy_no;
                    }
                    else
                    {
                        return 'Boş';
                    }
                                    
                 }
            })
            ->addColumn('action',function ($icra) {
                return '<a class="btn btn-twitter" href="/admin/icra/infaz/gapel_4.icra/show/'.$icra->id.'"><i class="fa fa-eye"></i> </a>
        <a class="btn btn-primary" href="/admin/icra/infaz/gapel_4.icra/'.$icra->id.'/edit"><i class="fa fa-edit"></i> </a>
        <form onsubmit="return confirm(\'Bu dosyayı silmek istediğinize eminmisiniz?\');"  action="'.route('icra.destroy', $icra->id).'" method="POST">
            '.csrf_field().'
            <input type="hidden" name="_method" value="DELETE">
            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        
        ';})
            ->rawColumns(['dosya_no', 'action'])
            ->make(true);
            


        /*

        $model = IcraDosya::with('icra_infaz_foy_no');

        return DataTables::eloquent($model)
                    ->addColumn('foy_no', function (IcraDosya $icralar) {
                        return $icralar->icra_infaz_foy_no->map(function($icra_infaz_foy_no) {
                            return $icra_infaz_foy_no->foy_no;
                        });
                    })
                    ->toJson();
                    
        */
    }
}

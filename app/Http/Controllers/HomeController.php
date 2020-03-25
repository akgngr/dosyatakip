<?php

namespace App\Http\Controllers;

use phpDocumentor\Reflection\Types\Compound;
use Illuminate\Http\Request;
use App\User;
use App\IcraDosya;
use App\InfazDosya;
use PDF;


class HomeController extends Controller
{
    public function home()
    {
        return redirect()->route('backpack.dashboard');
    }
    public function index(){
        $icra = IcraDosya::all();
        $infaz = InfazDosya::all();
        return view('icra.index', compact('icra' ,'infaz'));
    }

    public function print_pdf()
    {
        $data = ['bootstrap'=>'asset("/vendor/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css")','data2'=>'merhaba data 2'];
        $pdf = PDF::loadView('pdf.invoice', $data);
        return $pdf->stream('invoice.pdf');
    }
    public function tahsilat(){
        $data = ['data2'=>'merhaba data 2'];
        $bootstrap = asset('/vendor/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css');
        return view('pdf.invoice')->with('bootstrap', $bootstrap);
    }
}

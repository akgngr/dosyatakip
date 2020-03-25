<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InfazDosya;
use App\IcraDosya;


class PrintController extends Controller
{
    public function icra_alinan_print($id)
    {
    	$icra = IcraDosya::where('id', $id)->first();
    	return view('print.makbuz')->with('icra', $icra);
    }

    public function mahkeme_alinan_print($id)
    {
    	$icra = InfazDosya::where('id', $id)->first();
    	return view('print.makbuz')->with('icra', $icra);
    }
}

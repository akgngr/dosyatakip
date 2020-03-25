<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;

class KategoriController extends Controller
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
        $kategoriler = Kategori::where('ust_kategori', '0')->get();
        return view('icra.kategori.index')->with('kategoriler', $kategoriler);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoriler = Kategori::where('ust_kategori', '0')->get();
        return view('icra.kategori.create')->with('kategoriler', $kategoriler);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'         => 'required|string|max:255',

        ]);

        $kategori = new Kategori();
        $kategori->title         = $request->title;
        $kategori->ust_kategori  = $request->ust_kategori;
        $kategori->save();

        if ($kategori->save()) {
            return redirect()->route('kategori.show', $kategori->id);
        }
        else{
            Session::flash('denger', 'Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz.');
            return redirect()->route('kategori.create');
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
        $kategori = Kategori::where('id', $id)->first();
        return view('icra.kategori.show')->with('kategori', $kategori);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategoriler = Kategori::where('ust_kategori', '0')->get();
        $kategori = Kategori::where('id', $id)->first();
        return view('icra.kategori.edit')->with('kategori', $kategori)->with('kategoriler', $kategoriler);
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
        $this->validate($request, ['title' => 'required|string|max:255']);

        $kategori = Kategori::findorFail($id);

        $kategori->title = $request->title;
        $kategori->save();

        if ($kategori->save()) {
            return redirect()->route('kategori.show', $kategori->id);
        }
        else{
            Session::flash('denger', 'Üzgünüm bir sorunla karşılaşıldı. Lütfen tekrar deneyiniz.');
            return redirect()->route('kategori.create');
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
        $kategori = Kategori::findorFail($id)->delete();
        return redirect()->route('kategori.index');
    }

}

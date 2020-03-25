<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfazDosya extends Model
{
	protected $table = 'infaz_dosyasi_table';
    protected $filelable = ['dosya_no, ili, mahkeme, davali, davaci, kategori', 'durum'];

    public function parent()
    {
        return $this->belongsTo('App\Kategori', 'kategori', 'id');
    }

    public function yorumlar()
    {
        return $this->hasMany('App\Yorum', 'infaz', 'id');
    }

    public function tahsilat_ana()
    {
        return $this->hasMany('App\Tahsilat_ana', 'infaz_id', 'id');
    }

    public function alinanlar()
    {
        return $this->hasMany('App\Tahsilat', 'infaz_id', 'id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function mahkeme_derdest_foy_no()
    {
        return $this->hasOne('App\MahkemeFoyNo', 'mahkeme_id', 'id');
    }

    public function mahkeme_infaz_foy_no()
    {
        return $this->hasOne('App\MahkemeInfazFoyNo', 'mahkeme_id', 'id');
    }

}

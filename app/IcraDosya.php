<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IcraDosya extends Model
{
	  protected $table = 'icra_dosyasi';
	  protected $filelable = ['dosya_no, ili, mahkeme, alacakli, borclu, kategori, yargituru'];

	  public function parent()
      {
			return $this->belongsTo('App\Kategori', 'kategori', 'id');
      }

      public function yorumlar()
      {
          return $this->hasMany('App\Yorum', 'icra', 'id');
      }

      public function tahsilat_ana()
      {
          return $this->hasMany('App\Tahsilat_ana', 'icra_id', 'id');
      }

      public function alinanlar()
      {
          return $this->hasMany('App\Tahsilat', 'icra_id', 'id');
      }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function icra_derdest_foy_no()
    {
        return $this->hasOne('App\IcraDerdestFoyNo', 'icra_id', 'id');
    }

    public function icra_infaz_foy_no()
    {
        return $this->hasOne('App\IcraInfazFoyNo', 'icra_id', 'id');
    }
}

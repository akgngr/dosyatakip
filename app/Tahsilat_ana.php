<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tahsilat_ana extends Model
{
    protected $table = 'tahsilat_anas';

    protected $filelable = ['icra_id', 'infaz_id', 'anlasilan_kisi', 'ucret', 'iletisim', 'alan_kisi'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'alan_kisi');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tahsilat extends Model
{
    protected $table = 'tahsilats';

    protected $filelable = ['icra_id', 'infaz_id', 'veren_kisi', 'ucret', 'veren_kisi_iletisim', 'alan_kisi'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'alan_kisi');
    }

}

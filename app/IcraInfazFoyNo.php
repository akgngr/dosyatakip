<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IcraInfazFoyNo extends Model
{
    protected $table = "icra_infaz_foy_no";

    protected $fillable = ['icra_id', 'kategori', 'foy_no'];

}

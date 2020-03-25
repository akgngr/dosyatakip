<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IcraDerdestFoyNo extends Model
{
    protected $table = "icra_derdest_foy_no";

    protected $fillable = ['icra_id', 'kategori', 'foy_no'];


}

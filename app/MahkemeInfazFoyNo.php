<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MahkemeInfazFoyNo extends Model
{
    protected $table = "mahkeme_infaz_foy_no";

    protected $fillable = ['mahkeme_id', 'kategori', 'foy_no'];
}

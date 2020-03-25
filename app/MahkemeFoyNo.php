<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MahkemeFoyNo extends Model
{
    protected $table = "mahkeme_derdest_foy_no";

    protected $fillable = ['mahkeme_id', 'kategori', 'foy_no'];
}

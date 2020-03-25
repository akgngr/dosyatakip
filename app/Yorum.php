<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Yorum extends Model
{
    protected $table = 'yorums';

    protected $fillable = ['name', 'user_id', 'up_yorum', 'govde', 'icra', 'infaz', 'kategori'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function children()
    {
        return $this->hasMany('App\Yorum', 'up_yorum');
    }
}

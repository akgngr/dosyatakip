<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
	protected $table = 'kategori_table';
    protected $filelable = ['title, icon, url'];

	public function parent()
	{
		return $this->belongsTo('App\Kategori', 'ust_kategori');
	}

	public function chidren()
	{
		return $this->hasMany('App\Kategori', 'ust_kategori');
	}
}

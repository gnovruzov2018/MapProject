<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{

	protected $fillable = [
        'place_id', 'name','discount', 'city_id', 'category_id'
    ];

    public function category(){
        return $this->belongsTo('App\Category');
    }
    public function city(){
        return $this->belongsTo('App\City');
    }
}

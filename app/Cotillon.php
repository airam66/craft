<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotillon extends Model
{
    protected $table="cotillones";

    protected $fillable= ['name','description_AboutUs','image_AboutUs','address','position','phones','email','facebook','bussines_hours','image_Contact'];
}

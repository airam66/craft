<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Provider extends Model
{
    protected $table="providers";

    protected $fillable= ['name','cuit','address','location','province','phone','email','bill','status'];

    public function products(){
        return $this->belongsToMany('App\Product');

    }

    public static function providerByCuit($term){
        return static::select('id', 'name','cuit','address' ,'phone','email','province')
            ->where('cuit','LIKE',"%$term%")
            ->where('status','=','activo')
            ->get();

    }   

    public static function productByCodeProvider($term,$provider_id){
        return $products= DB::table('providers_products as pp')
              ->join('products as p','pp.product_id','=','p.id')
              ->join('brands as b','p.brand_id','=','b.id')
              ->select('code','p.id as product_id','p.name as product_name','purchase_price','b.name as brand_name','stock','p.status')
              ->where('code','LIKE',"%$term%")
               ->where('p.status','=','activo')
              ->where('b.name',"<>","CREATÚ")
              ->where('pp.provider_id','=',$provider_id)->get();
    }

    public function scopeSearchProvider($query,$name){

        return $query->where('name','LIKE',"%" . $name . "%");
    }
}
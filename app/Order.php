<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table="orders";
    protected $fillable= ['client_id','discount','delivery_date','total','status'];

  
    
     public function client(){
        return $this->belongsTo ('App\Client');
    }

    public function scopeSearchOrder($query,$fecha1,$fecha2){
        $fecha1 = str_replace("/","-",$fecha1);
        $fecha2 = str_replace("/","-",$fecha2);
       return $query->whereDate('created_at','>=',date('Y-m-d',strtotime($fecha1)))->whereDate('created_at','<=',date('Y-m-d',strtotime($fecha2)));   

    }

      public function products(){
        return $this->belongsToMany('App\Product')->withTimestamps();

    }
   

    public function payments(){

        return $this->hasMany('App\Payment');
        
    }

    public function totalPayments(){
    return $this->payments()->sum('amount_paid');
  }

}

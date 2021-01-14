<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    protected $table="invoices";
    protected $fillable= ['client_id','discount','total','status'];
    public function products(){
    	return $this->belongsToMany('App\Product')->withTimestamps();

    }
     public function clients(){

        return $this->belongsTo('App\Client');
    }

    
    public function scopeSearchInvoice($query,$fecha1,$fecha2){
        
        $fecha1 = str_replace("/","-",$fecha1);
        $fecha2 = str_replace("/","-",$fecha2);
        
        return $query->whereDate('created_at','>=',date('Y-m-d',strtotime($fecha1)))->whereDate('created_at','<=',date('Y-m-d',strtotime($fecha2)));

    }

    public function scopeSearchInvoiceClient($query,$client){
    
        return $query->join('clients', 'clients.id', '=' ,'invoices.client_id')
            ->select('invoices.*')
            ->where('clients.name','LIKE',"%$client%");
    }

    public function client(){

        return $this->belongsTo	('App\Client');
    }

    public function getDesableAttribute(){

      return route('invoices.desable',$this->id);
    }



}
	


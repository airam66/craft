<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Purchase;
use App\PurchaseProduct;

class PurchaseTest extends DuskTestCase
{   //use DatabaseTransactions;
   
    public function test_delete_purchaseOrder()
    {

        $user=factory(User::class)->create(['email'=>'fairam139@gmail.com',]);
       
        $purchaseDetail=factory(PurchaseProduct::class)->create();
        $purchaseRemove=Purchase::all()->last();
        $number=$purchaseRemove->id;
        $provider= $purchaseRemove->provider->name;


        $this->browse(function (Browser $browser) use ($user,$purchaseRemove,$number,$provider){
            $browser->visit('comercio/public/admin/purchases')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Entrar')
                    ->assertPathIs('/comercio/public/admin/purchases')
                    ->with('.table', function ($table) use($purchaseRemove)
                    {
                      $table->press('delete')
                            ->acceptDialog();    
                    })
                    ->assertDontSeeIn('.box-body',$number)
                    ->assertDontSeeIn('.box-body',$provider); 
                                            
    });
}

}
<?php

namespace Tests\Browser;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class updateStockTest extends DuskTestCase
{
 
    public function test_update_stock()
    {
        $user=factory(User::class)->create(['email'=>'gaby333@gmail.com',]);
        $this->browse(function (Browser $browser) {
            $browser->visit('http://localhost/comercio/public/admin/updateStockCreate')
                    ->type('email',$user->email)
                    ->press('Entrar')
                    ->assertPathIs('http://localhost/comercio/public/admin/updateStockCreate')
                    ->click('#search')
                    ->assertVisible('#modalProduct')
                    ->type('email',$product->name)
                    ->press('Agregar')
                    ->assertValue('#name', $value);



        });
    }
}

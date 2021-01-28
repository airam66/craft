<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class mainTest extends DuskTestCase
{


    public function test_main_direct_access()
    {
        $user=factory(User::class)->create(['email'=>'example@gmail.com',]);

        $this->browse(function (Browser $browser) use ($user){
            $browser->visit('craft/public/admin')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Iniciar sesión')
                    ->assertPathIs('/craft/public/admin')
                    ->press('.Lista_productos')
                    ->assertPathIs('/craft/public/admin/products')
                    ->visit('craft/public/admin')
                    ->press('.Nueva_venta')
                    ->assertPathIs('/craft/public/admin/invoices/create')
                    ->visit('craft/public/admin')
                    ->press('.Nuevo_pedido')
                    ->assertPathIs('/craft/public/admin/orders/create')
                    ->visit('craft/public/admin')
                    ->press('.Calendario')
                    ->assertPathIs('/craft/public/admin/calendar')
                    ;
        });

    }
}

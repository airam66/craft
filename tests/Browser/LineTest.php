<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class LineTest extends DuskTestCase
{
    protected $name='CHICAS SUPER PODEROSAS';

    public function test_create_a_line()
    {
        $user=factory(User::class)->create(['email'=>'example@gmail.com',]);

        $this->browse(function (Browser $browser) use ($user){
            $browser->visit('craft/public/admin/lines/create')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Iniciar sesión')
                    ->assertPathIs('/craft/public/admin/lines/create')
                    ->type('name',$this->name)
                    ->press('Guardar')
                    ->assertPathIs('/craft/public/admin/lines');
        });

        $this->assertDatabaseHas('lines',[
                   'name'=>$this->name,
                   'status'=>'activo',
                ]);


    }
}

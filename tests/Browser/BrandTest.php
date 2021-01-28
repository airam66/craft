<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Brand;
use App\User;

class BrandsTest extends DuskTestCase
{
   use DatabaseMigrations;

   protected $name='CREATU';
  

    public function test_create_a_brand()
    {
        $user=factory(User::class)->create(['email'=>'maria@gmail.com',]);

        $this->browse(function (Browser $browser) use ($user){

                     //When
            $browser->visit('craft/public/admin/brands/create')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Iniciar sesión')
                    ->assertPathIs('/craft/public/admin/brands/create')
                    ->type('name',$this->name)
                    ->press('Guardar')
                    ->assertPathIs('/craft/public/admin/brands')
                    ;
           });

              $this->assertDatabaseHas('brands',[
                   
                   'name'=>$this->name,
                   'status'=>'activo',
                    
                ]);       
       
    }

}

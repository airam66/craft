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

   protected $name='CreaTu';
  

    public function test_create_a_brand()
    {
        $user=factory(User::class)->create(['email'=>'maria@gmail.com',]);

        $this->browse(function (Browser $browser) use ($user){

                     //When
            $browser->visit('comercio/public/admin/brands/create')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Entrar')
                    ->assertPathIs('/comercio/public/admin/brands/create')
                    ->type('name',$this->name)
                    ->press('Registrar')
                    ->assertPathIs('/comercio/public/admin/brands')
                    ;
           });

              $this->assertDatabaseHas('brands',[
                   
                   'name'=>$this->name,
                   'status'=>'active',
                    
                ]);       
       
    }

}

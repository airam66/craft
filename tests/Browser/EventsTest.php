<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Event;
use App\User;

class EventsTest extends DuskTestCase
{
  use DatabaseMigrations;

  protected $name='BAUTISMO';
  
  public function test_create_a_event()
  {
      $user=factory(User::class)->create(['email'=>'maria@gmail.com',]);

      $this->browse(function (Browser $browser) use ($user){

                   //When
          $browser->visit('craft/public/admin/events/create')
                  ->type('email',$user->email)
                  ->type('password','secret')
                  ->press('Iniciar sesión')
                  ->assertPathIs('/craft/public/admin/events/create')
                  ->type('name',$this->name)
                  ->press('Guardar')
                  ->assertPathIs('/craft/public/admin/events')
                  ;
         });

      $this->assertDatabaseHas('events',[
           
           'name'=>$this->name,
           'status'=>'activo',
            
        ]);       
     
  }

}

<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Category;
use App\User;

class CategoriesTest extends DuskTestCase
{
   use DatabaseMigrations;

   protected $name='Souvenirs';
   protected $description='Diferentes diseños, realizados con varios materiales';
  

    public function test_create_a_category()
    {
        $user=factory(User::class)->create(['email'=>'maria@gmail.com',]);

        $this->browse(function (Browser $browser) use ($user){

                     //When
            $browser->visit('craft/public/admin/categories/create')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Iniciar sesión')
                    ->assertPathIs('/craft/public/admin/categories/create')
                    ->type('name',$this->name)
                    ->type('description',$this->description)
                    ->attach('image','D:\tar\001.png')
                    ->press('Guardar')
                    ->assertPathIs('/craft/public/admin/categories')
                    ;
           });

              $this->assertDatabaseHas('categories',[
                   
                   'name'=>$this->name,
                   'description'=>$this->description,
                   'status'=>'activo',
                   'extension'=>'001.png',
                    
                ]);       
       
    }

}


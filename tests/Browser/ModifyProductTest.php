<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Category;
use App\Event;
use App\Brand;
use App\Line;
use App\Porcentage;
use App\User;
use App\Product;
class ModifyProductTest extends DuskTestCase
{
   use DatabaseMigrations;

   protected $description='osito color morado';
   protected $stock=123;
   protected $ws=10;
  

    public function test_modify_a_product()
    {
        $user=factory(User::class)->create(['email'=>'gabriel@gmail.com',]);
        $category= factory(\App\Category::class)->create(['name'=>'Tarjetas',]); 
        $brand= factory(\App\Brand::class)->create(['name'=>'Sprit',]);
        $line= factory(\App\Line::class)->create(['name'=>'Princesas',]);
        $event= factory(\App\Event::class)->create(['name'=>'Cumpleaños',]);
        $product=factory(Product::class)->create(['name'=>'Bolsittas Frozen','code'=>'001001',]);
        $porcentage= factory(\App\Porcentage::class)->create();

        $this->browse(function (Browser $browser) use ($user,$category,$event,$brand,$line,$product){

                     //When
            $browser->visit('/craft/public/admin/products')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Iniciar sesión')
                    ->assertPathIs('/craft/public/admin/products')
                    ->press('.Editar')
                    ->assertPathIs('/craft/public/admin/products/'.$product->id.'/edit')
                    ->attach('image','D:\tar\001.png')
                    ->select('events[]',(string)$event->name)
                    ->select('line_id',(string)$line->id)
                    ->select('brand_id',(string)$brand->id)
                    ->type('description',$this->description)
                    ->type('stock',$this->stock)
                    ->type('wholesale_cant',$this->ws)
                    ->press('Guardar');
           });

                    

                $this->assertDatabaseHas('products',[
                   
                   'description'=>$this->description,
                   'stock'=>$this->stock,
                   'status'=>'activo',
                   'extension'=>'001.png',
                    
                ]);

               

             
       
    }


    public function test_create_product_form_validation(){
      $user=factory(\App\User::class)->create(['email'=>'fairam66@gmail.com',]);
      $porcentage= factory(\App\Porcentage::class)->create();
      //$category= factory(\App\Category::class)->create(['name'=>'Tarjetas',]);

       $this->browse(function (Browser $browser) use ($user){
            $browser->visit('craft/public/admin/products/create')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Iniciar sesión')
                    ->assertPathIs('/craft/public/admin/products/create')
                    ->press('Guardar')
                    ->assertSeeErrors([
                      'name'=>'El campo nombre es obligatorio',
                      'code'=>'El campo codigo debe contener al menos 3 caracteres.',
                      //'price'=> 'El campo precio es obligatorio',
                      'stock'=>'El campo stock es obligatorio'  
                  ]);
        });
    }
}


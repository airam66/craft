<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Category;
use App\Event;
use App\Brand;
use App\Line;
use App\Porcentage;
use App\User;
use App\Product;

class DeleteProductTest extends DuskTestCase
{
   protected $code= 12345;
   protected $name='oso';
  // protected $category='souvenirs';
   protected $description='osito color morado';
   protected $purchase_price=12;
   protected $stock=123;
   protected $ws=10;
  
    public function test_delete_products()
    {

     $user=factory(User::class)->create(['email'=>'gaby333@gmail.com',]);
        $category= factory(\App\Category::class)->create(['name'=>'Tarjetas',]); 
        $brand= factory(\App\Brand::class)->create(['name'=>'Sprit',]);
        $line= factory(\App\Line::class)->create(['name'=>'Princesas',]);
        $event= factory(\App\Event::class)->create(['name'=>'Cumpleaños',]);
        $product=factory(Product::class)->create(['name'=>'Bolsittas Frozen',]);
        $porcentage= factory(\App\Porcentage::class)->create();

        $this->browse(function (Browser $browser) use ($user,$category,$event,$brand,$line){
            $browser->visit('/craft/public/admin/products')
                    ->type('email',$user->email)
                    ->type('password','secret')
                    ->press('Iniciar sesión')
                    ->assertPathIs('/craft/public/admin/products')
                    ->press('.Eliminar')
                    ->acceptDialog()
                    ->assertPathIs('/craft/public/admin/products')
                    ->assertVisible('.btn-success')
                    ->assertMissing('.btn-danger')                    
                    ;
        });
    }
}

<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PageWebTest extends DuskTestCase
{
    
    public function test_index()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('craft/public/index')
                    ->assertSee('Bienvenido');
        });
    }

     public function test_about_us()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('craft/public/aboutUs')
                    ->assertSee('Sobre Nosotros');
        });
    }
}
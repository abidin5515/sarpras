<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->value('#username','admin')
                    ->value("#pass",'admin')
                    ->click('button[type="submit"]') //Click the submit button on the page
                    ->pause(5000)
                    ->assertPathIs('/');//Make sure you are in the home page
        });
    }
}

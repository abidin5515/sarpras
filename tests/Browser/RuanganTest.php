<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class RuanganTest extends DuskTestCase
{
        use WithoutMiddleware;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreate()
    {

                    // $this->session(['userid'=>1]);

        // $this->withoutMiddleware('AuthUser');

        // $this-

           $this->browse(function (Browser $browser) {
            // session('userid',1);
            // session()->put('userid', 1);
             $browser
                    ->visit('autoLogin')
                    // ->loginAs(\App\User::find(1))
                    ->pause(500)
                    ->visit('/ruangan')
                    ->click('.create-btn')
                    ->pause(500)
                    ->type('nama','test')
                    ->type('awalan','TES')
                    ->click('.save-btn')
                    ->pause(500)
                    ->assertSee('Data Berhasil Disimpan');  
                });
    }

    public function testEdit(){
         $this->browse(function (Browser $browser) {
             $browser
                    ->visit('autoLogin')
                    ->visit('/ruangan')
                    ->pause(500)

                    ->click('.edit-btn')
                    ->pause(500)

                    ->type('nama','test')
                    ->type('awalan','TES')
                    ->click('.save-btn')
                    ->pause(500)
                    ->assertSee('Data Berhasil Diubah');  
                });
    }

    public function testDelete(){
         $this->browse(function (Browser $browser) {

             $browser
                    ->visit('autoLogin')
                    ->visit('/ruangan')
                    ->pause(500)
                    ->click('.delete-btn')
                    ->pause(500)

                    ->click('.swal2-confirm')
                    ->pause(500)
                    ->assertSee('Data Berhasil Dihapus');  
                });
    }
}

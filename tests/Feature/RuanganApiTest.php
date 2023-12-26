<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RuanganApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreate()
    {   



        // $this->withSession(['userid'=>'1']);
        // $response  = $this->json("POST",'ruangan',['nama'=>
        //     'Ruangan Test','awalan'=>'RUT']);

        // $response->assertStatus(200);

          $this->visit('login');
                    // ->withSession(['userid' => '1'])
                    // ->pause(3000)
                    // ->visit('/ruangan')
                    // ->click('.create-btn')
                    // ->pause(5000)

                    // ->type('nama','test')
                    // ->type('awalan','TES')
                    // ->click('.save-btn')
                    // ->pause(5000)
                    // ->assertSee('Data Berhasil Disimpan'); 
    }

    public function testUpdate(){

    }
}

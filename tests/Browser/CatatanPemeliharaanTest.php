<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CatatanPemeliharaanTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateInspection()
    {
        $this->browse(function (Browser $browser) {
             $browser
                    ->visit('autoLogin')
                    // ->loginAs(\App\User::find(1))
                    // ->pause(500)

                    ->visit('catatan-pemeliharaan/create')
                    ->pause(1000)

                    ->select2('.alat','tes1',500)
                    ->pause(1000)

                    ->type('masa_kalibrasi',date('d-m-Y'))
                    ->type('interval_pemeliharaan','1 Tahun')
                    ->pause(1000)
                    ->select2('.jenis_pekerjaan','Inspection Alat',1000)
                    ->pause(1000)

                    ->select('tahun','2020')
                    ->type('masa_kalibrasi',date('d-m-Y'))
                    ->select('pelaksana','2')
                    ->pause(1000)
                    ->type('bengkel_rujukan','Rumah Sakit')
                    ->type('mulai',date('d-m-Y'))
                    ->type('selesai',date('d-m-Y'))
                    ->type('keluhan',"Ini Keluhannya")
                    ->type('tindakan',"Ini Keluhannya")
                    ->type('jumlah_biaya',"10000")
                    ->type('keterangan',"Ini adalah keterangan")
                    ->pause(10000)
                    ->click("label[for='3_0_1']")
                    ->pause(10000);

                    // ->type("nama_checklist[1][value][0][0]")



        });
    }
}

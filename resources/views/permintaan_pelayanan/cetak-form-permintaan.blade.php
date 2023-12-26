<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">

        body{
            font-size:14px;
        }
		ul {
			margin: 0px;
			padding: 0px;
		}
		ul li {
			list-style: none;
		}
		ol li {
			padding: 3px;
		}
	</style>
</head>
<body >
	<center>
		<h2 style="margin: 0; padding: 0">RSUD RAA SOEWONDO KABUPATEN PATI <br/> FORMULIR PERMINTAAN PELAYANAN PERBAIKAN ALKES</h2>

    <table style="margin:auto; font-size:1.5em">
    <tr>
    <td>NOMER</td>
    <td>:</td>
    <td>.................</td>
    </tr>
    <tr>
    <td>TANGGAL</td>
    <td>:</td>
    <td>.................</td>
    </tr>
    </table>
    <br>
    </center>

	<table border="1" class="" style="width: 100%;font-size: 15px;" cellpadding="2" cellspacing="0">
    <tbody>
        <tr>
            <td style="width:50%">
                <table>
                    <tr>
                    <td>1.</td>
                    <td>Unit / Ruang / Instalasi</td>
                    <td>:</td>
                    <td>{{$table->ruangan->nama}}</td>
                    </tr>
                    <tr>
                    <td></td>
                    <td> No. Telpon intern </td>
                    <td>:</td>
                    <td></td></tr>
                </table>
            </td>
            <td style="width:50%">
                <table>
                    <tr>
                    <td>6. Hasil Tinjauan</td>

                    </tr>

                </table>
            </td>
        </tr>
        <tr>
            <td style="width:50%">
            <table style="float:top">
                    <tr>
                    <td>Kerusakan Alat</td>
                    <td>{{ $table->kerusakan_alat }}</td>

                    </tr>
                    <tr>
                    <td></td>
                    <td></td>

                    </tr>
                    <tr>
                    <td></td>
                    <td></td>

                    </tr>
                    <tr>
                    <td></td>
                    <td></td>

                    </tr>
                </table>
            </td>
            <td style="width:50%">
                <table>
                    <tr>
                    <td>A.</td>
                    <td>Oleh Instalasi Alkes :</td>

                    </tr>
                    <tr>
                    <td></td>
                    <td>{{@$hasilPeninjauan->oleh_instalasi_alkes}}</td>

                    </tr>
                   

                </table>
            </td>
        </tr>
        <tr>
            <td style="width:50%">
                <table>
                    <tr>
                    <td>2.</td>
                    <td>Deskripsi Alat</td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>Nama Alat  </td>
                    <td>:</td>
                    <td>{{$table->data_alkes->alat->nama}}</td></tr>
                    <tr>
                    <td></td>
                    <td>Merk / Type</td>
                    <td>:</td>
                    <td>{{$table->merk}}</td></tr>
                      <tr>
                    <td></td>
                    <td>No. Seri</td>
                    <td>:</td>
                    <td>{{$table->no_seri}}</td></tr>
                   <tr>
                    <td></td>
                    <td>Lain-lain </td>
                    <td>:</td>
                    <td>{{$table->lain_lain}}</td></tr>
                   </tr>
                </table>
            </td>
            <td style="width:50%">
                <table>
                    <tr>
                    <td>B.</td>
                    <td>Oleh Seksi Penunjang Non Medik  :</td>

                    </tr>
                    <tr>
                    <td></td>
                    <td>{{@$hasilPeninjauan->oleh_seksi_penunjang_non_medik}}</td>

                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="width:50%">
                <table>
                    <tr>
                    <td>3.</td>
                    <td>Kegagalan / Kerusakan awal / Keperluan pelayanan :</td>
                    <td></td>
                    <td></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>{{$table->kerusakan_awal}}</td>

                    </tr>
                    <tr>
                    <td></td>
                    <td></td>

                    </tr> <tr>
                    <td></td>
                    <td></td>

                    </tr>
                </table>
            </td>
            <td style="width:50%">
                <table>
                    <tr>
                    <td>C.</td>
                    <td>Kesimpulan  :</td>
                    <td></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>1. Alat bisa diperbaiki</td>
                   <td></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>2. Alat tidak bisa diperbaiki *)</td>
                   <td></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>Alasannya : {{@$hasilPeninjauan->alasan_kesimpulan}}</td>
                   <td></td>
                    </tr>

                </table>
            </td>
        </tr>
        <tr>
            <td style="width:50%">
                <table  style="float:top">
                    <tr>
                    <td>4.</td>
                    <td>Tanggal ajuan : {{ tgl_indo($table->tanggal_ajuan) }}</td>
                    <td></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td> Batas waktu perbaikan yang diminta : {{tgl_indo($table->batas_waktu_perbaikan)}}</td>

                    <td></td></tr>

                </table>
            </td>
            <td style="width:50%">
                <table >
                    <tr >
                    <td>7. </td>
                    <td>Alat diperbaiki oleh  : </td>
                    <td></td>
                    </tr>

                    <tr>
                    <td></td>
                    <td>A. Instalasi Alkes</td>
                     <td></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td> 1. Di Tempat / Ruang / Inst </td>
                    <td>  
                   
                   </td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>2. Instalasi Alkes</td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>Diambil oleh petugas</td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>Tanggal : {{@tgl_indo($hasilPeninjauan->tanggal)}}</td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>Nama : {{empty(@$hasilPeninjauan->petugas->nama)?'-':@$hasilPeninjauan->petugas->nama}}</td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>B. Pihak Ketiga</td>
                     <td></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>Nama Perusahaan : {{empty(@$hasilPeninjauan->supplier->nama)?'-': @$hasilPeninjauan->supplier->nama}}</td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>Alamat :{{empty(@$hasilPeninjauan->supplier->nama)?'-': @$hasilPeninjauan->supplier->alamat}}</td>
                    </tr>                  

                </table>
            </td>
        </tr>
        <tr>
        <td style="width:50%">
                <table >
                    <tr>
                    <td>5.</td>
                    <td>Data kerusakan terakhir tanggal : {{tgl_indo($table->data_kerusakan_tanggal)}}</td>
                    <td></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>  {!!$table->opsi_kerusakan!='Perbaikan' ? '<del>Perbaikan</del>':'Perbaikan'!!}</td>
                    <td></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>  {!!$table->opsi_kerusakan!='Pergantian' ? '<del>Pergantian</del>':'Pergantian'!!} </td>
                    <td></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td> Catatan tambahan : {{$table->catatan_tambahan}}</td>
                    <td></td>
                    </tr>
                 
                </table>
            </td>
          
            <td style="width:50%;padding:0px;margin:0px">
                <table style="width:100%;padding:0px" cellpadding="0px" cellspacing="0px">
                    <tr style="height:100%">
                    <td style="width:50%;border-right:1px solid #000">
                    <center>
                        Kasi Penunjang Non <br>
                        Medik
                    </center>
                    <br>
                    <br>
                    <br>
                    <center>
                    Agus Sutopo, SKM
                    </center>
                    </td>
                    <td style="width:50%;">
                    <center>
                        Ka. Inst. Alkes
                    </center>
                    <center>
                        <img src="{{url(App\PengaturanJabatan::first()->kepala_teknisi->ttd)}}" style="widows: 50px;height:50px;">
                    </center>
                    <center>
                      {{App\PengaturanJabatan::first()->kepala_teknisi->nama}}
                    </center>
                    </td>
            
                    </tr>
                </table>
            </td>
           
        </tr>
        <tr>
        <td style="width:50%;padding:0px;margin:0px">
                <table style="width:100%;padding:0px" cellpadding="0px" cellspacing="0px">
                    <tr style="height:100%">
                    <td style="width:50%;border-right:1px solid #000">
                    <br>
                   
                    <center>
                        Koordinator <br>
                        Pemeliharaan Alat
                    </center>
                  
                    <br>
                    <br>
                    <br>
                    <br>
                    <center>
                    ..................................................
                    </center>
                    <br>
                    </td>
                    <td style="width:50%;">
                    <br>
                   
                    <center>
                        Mengetahui <br>
                        Ka. Unit/Ruang
                    </center>
                  
                    <br>
                    <br>
                    <br>
                    <br>
                    <center>
                    ..................................................
                    </center>
                    <br>
                    </td>
            
                    </tr>
                </table>
            </td>
            <td style="width:50%">
                <table >
                    <tr >
                    <td>8. </td>
                    <td>Proses perbaikan  : </td>
                    <td></td>
                    </tr>

                    <tr>
                    <td></td>
                    <td>a. RAB</td>
                     <td>{{@$hasilPeninjauan->rab}}</td>
                    </tr>
                    <tr>
                    <td></td>
                    <td> b. Tanggal </td>
                    <td>  
                        @if (!empty($hasilPeninjauan->tanggal))
                            {{-- expr --}}
                        {{tgl_indo(@$hasilPeninjauan->tanggal)}}

                        @endif
                   
                   </td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>c. Mulai dikerjakan : </td>
                    <td>
                        
                        @if (!empty(@$hasilPeninjauan))
                            {{-- expr --}}
                            {{tgl_indo($hasilPeninjauan->mulai_dikerjakan)}}
                        @endif
                    </td>
                    </tr>
                    <tr>
                    <td></td>
                    <td></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>d. Perkiraan selesai :</td>
                    <td> 
                        @if (!empty(@$hasilPeninjauan))
                            {{-- expr --}}
                            {{tgl_indo(@$hasilPeninjauan->perkiraan_selesai)}}
                        @endif

                    </td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>e. Pelaksanaan Swakelola / Pihak Ketiga</td>
                    </tr>
                                   

                </table>
            </td>
        </tr>
        <tr>
        <td style="width:50%">
                <table>
                    <tr>
                    
                    <td>Catatan </td>
                    </tr>
                    <tr>
                    <td><p style=""> - Setiap permintaan pelayanan harus menggunakan formulir </p></td>
                   </tr>
                   <tr>
                    <td><p style=""> - Permintaan lewat telepon hanya untuk keadaan darurat </p></td>
                   </tr>
                   <tr>
                    <td><p style=""> - Permintaan pelayanan pemeliharaan ke instalasi Alke dengan tembusan ke seksi penunjang Non Medik  </p></td>
                   </tr>
                   <tr>
                    <td><p style=""> - Konfirmasi permintaan lewat telpon 167 </p></td>
                   </tr>
                   <tr>
                    <td><p style=""> - *) coret yang tidak perlu </p></td>
                   </tr>
                   
                </table>
            </td>
            <td style="width:50%">
                <table style="width:100%">
                    <tr>
                    <td width="10px">9.</td>
                    <td>Hasil Akhir  : </td>
                    <td></td>
                    </tr>

                  
                    <tr>
                    <td></td>
                    <td>a. Uji Fungsi / Coba : {{@$hasilPeninjauan->uji_coba}}</td>
                    </tr>
                    <tr>
                    <td></td>
                    <td></td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>b. Kondisi Akhir : {{@$hasilPeninjauan->kondisi_akhir}}</td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>b. Waktu jaminan : {{@$hasilPeninjauan->waktu_jaminan}}</td>
                    </tr>
                    <tr>
                    <td></td>
                    <td>b. Catatan tambahan : {{@$hasilPeninjauan->catatan_tambahan}}</td>
                    </tr>
                    <tr >
                    <td colspan="3">
                    <br>
                   
                   <center>
                      Kepala Instalasi Alkes
                   </center>
                 
                   <center>
{{-- q --}}

                    <center>
                        <img src="{{url(App\PengaturanJabatan::first()->kepala_teknisi->ttd)}}" style="widows: 50px;height:50px;">
                    </center>
        {{App\PengaturanJabatan::first()->kepala_teknisi->nama}}
                   {{-- SUDIHARTO, SKM --}}
                   </center>
                   <br>
                    </td>
                    
                    </tr>

                                   

                </table>
            </td>
        </tr>
    </tbody>
</table>

</body>
</html>

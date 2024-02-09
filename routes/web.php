<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::any('/login', function () { 
    return view('layouts.login');
});

Route::get("/","PermintaanController@create");
Route::get("/minta","PermintaanController@create");
Route::post("/minta/store","PermintaanController@store");

Route::any('/masuk','AuthController@login');
Route::any('/keluar','AuthController@logout');

Route::get('autoLogin', function() {
    //
    session()->put('userid',1);
});

Route::get("/show_jadwal_ipsrs/","UploadJadwalController@show_jadwal_ipsrs");	

Route::group(['middleware' => 'AuthUser'], function () {

	Route::get("/pengadaan-excel","PengadaanController@excel");
	Route::get("/pengadaan/json","PengadaanController@json")->name("pengadaan.json");
	Route::resource("/pengadaan","PengadaanController");

	

	Route::get("/jadwal_ipsrs/json","UploadJadwalController@json")->name("jadwal_ipsrs.json");
	Route::get("/aktifkan-jadwal/{id}","UploadJadwalController@aktifkan_jadwal");
	Route::resource("/jadwal_ipsrs","UploadJadwalController");

	

	// Route::get("/master_shift/json","MasterShiftController@json")->name("master_shift.json");
	// Route::resource("/master_shift","MasterShiftController");

	Route::get("/permintaan_selesai","PermintaanController@permintaan_selesai");	
	Route::get("/permintaan_selesai/json","PermintaanController@selesai_json")->name('permintaan_selesai.json');
	Route::get("/excel-permintaan-selesai","PermintaanController@excel_selesai");

	Route::get("/permintaan/view_gambar","PermintaanController@view_gambar");
	Route::get("/permintaan/json","PermintaanController@json")->name('permintaan.json');
	Route::resource("/permintaan","PermintaanController");

    Route::get('/', 'HomeController@index');
    Route::get('/perbaikan_hariini', 'HomeController@perbaikan_hariini');
    Route::get('/permintaan-pending', 'HomeController@permintaan_pending');
    Route::get("filter-type/{tipe}","DataAlkesController@filter");


    Route::get("ruangan/select2f","RuanganController@select2f")->name("ruangan.select2f");
    Route::get("ruangan/select2","RuanganController@select2")->name("ruangan.select2");
	Route::get("supplier/select2","SupplierController@select2")->name("supplier.select2");
	Route::get("sumber_dana/select2","SumberDanaController@select2")->name("sumber_dana.select2");
	Route::get("kepemilikan/select2","KepemilikanController@select2")->name("kepemilikan.select2");
	Route::get("alat/select2","AlatController@select2")->name("alat.select2");
	
	Route::post("alat/getChecklist","AlatController@getChecklist")->name("alat.getChecklist");


    Route::get("/supplier/json","SupplierController@json")->name("supplier.json");
	Route::resource("/supplier","SupplierController");

	Route::get("/ruangan/json","RuanganController@json")->name("ruangan.json");
	Route::resource("/ruangan","RuanganController");
	Route::get("/kepemilikan/json","KepemilikanController@json")->name("kepemilikan.json");
	Route::resource("/kepemilikan","KepemilikanController");
	Route::get("/sumber-dana/json","SumberDanaController@json")->name("sumber_dana.json");
	Route::resource("/sumber-dana","SumberDanaController");



	Route::get('checklist-alat', 'ChecklistAlatController@index');
	Route::get('checklist-alat/detail', 'ChecklistAlatController@detail');
	Route::post('checklist-alat', 'ChecklistAlatController@store');



	Route::get("/data-alkes/select2","DataAlkesController@select2")->name("data-alkes.select2");

	Route::get("/data-alkes/json/{tipe}/{id}","DataAlkesController@json")->name("data-alkes.json");
	Route::get("cetak-alkes","DataAlkesController@cetak");
	Route::get("cetak-alkes-custom/{tipe}/{id}","DataAlkesController@cetakCustom");
	Route::resource("/data-alkes","DataAlkesController");

	
	Route::get("/inventaris/select2","InventarisController@select2")->name("inventaris.select2");
	Route::get("/inventaris/json","InventarisController@json")->name("inventaris.json");
	Route::get("/inventaris/export","InventarisController@export");
	Route::post("/inventaris/updateKepala","InventarisController@updateKepala");
	Route::resource("/inventaris","InventarisController");

	Route::get("/master-merk/select2f","MasterMerkController@select2f")->name("master-merk.select2f");
	Route::get("/master-merk/select2","MasterMerkController@select2")->name("master-merk.select2");
	Route::get("/master-merk/json","MasterMerkController@json")->name("master-merk.json");
	Route::post("/master-merk/updateKepala","MasterMerkController@updateKepala");
	Route::resource("/master-merk","MasterMerkController");

	Route::get("/master-barang/select2f","MasterBarangController@select2f")->name("master-barang.select2f");
	Route::get("/master-barang/select2","MasterBarangController@select2")->name("master-barang.select2");
	Route::get("/master-barang/json","MasterBarangController@json")->name("master-barang.json");
	Route::resource("/master-barang","MasterBarangController");

	Route::get("/teknisi/select2","TeknisiController@select2")->name("teknisi.select2");
	Route::get("/teknisi/json","TeknisiController@json")->name("teknisi.json");
	Route::post("/teknisi/updateKepala","TeknisiController@updateKepala");
	Route::resource("/teknisi","TeknisiController");

	Route::post("data-alkes/store","DataAlkesController@store");
	Route::get("data-alkes/{id}/edit","DataAlkesController@edit");
	Route::post("data-alkes/{id}/update","DataAlkesController@update");
	// Route::post("data-alkes/{id}/destroy","DataAlkesController@destroy");
	Route::get("data-alkes/{id}/show","DataAlkesController@show");
	Route::get("data-alkes/history/{id}","DataAlkesController@history");
	// Route::get("data-alkes/{id}/show","DataAlkesController@show");
	

	Route::get("/alat/json","AlatController@json")->name("alat.json");
	Route::resource("/alat","AlatController");

	Route::post("alat/store","AlatController@store");

	
	Route::get("/kategori-checklist/json","KategoriChecklistController@json")->name("kategori_checklist.json");
	Route::resource("/kategori-checklist","KategoriChecklistController");




	Route::get("alat/{id}/edit","AlatController@edit");
	Route::post("alat/{id}/update","AlatController@update");
	Route::get("alat/{id}/show","AlatController@show");
	Route::get("alat/history/{id}","AlatController@history");

	
	Route::get("/jadwal-kalibrasi/json","JadwalKalibrasiController@json")->name("jadwal_kalibrasi.json");
	Route::get("/reminder-kalibrasi","JadwalKalibrasiController@reminder");
	Route::post("/jadwal-kalibrasi/store","JadwalKalibrasiController@store");
	Route::resource("/jadwal-kalibrasi","JadwalKalibrasiController");

	Route::resource("/jadwal-pemeliharaan","JadwalPemeliharaanController");

	Route::post("cetak-label/json","CetakLabelController@json")->name("cetak-label.json");
	Route::get("cetak-label/","CetakLabelController@index")->name("cetak-label.index");
	Route::get("cetak-label/semua","CetakLabelController@semua");
	Route::post("cetak-label/custom","CetakLabelController@custom");
	Route::post("cetak-label/customNew","CetakLabelController@customNew");

	Route::post("cetak-label/getData","CetakLabelController@getData");

	Route::get("/catatan-pemeliharaan/getChecklist","CatatanPemeliharaanController@getChecklist")->name('catatan-pemeliharaan.getChecklist');

	Route::get("catatan-pemeliharaan/form","CatatanPemeliharaanController@form");






	Route::get("/catatan-pemeliharaan/{id}/print","CatatanPemeliharaanController@print")->name('catatan-pemeliharaan.print');

	Route::get("/catatan-pemeliharaan/{id}/print-kalibrasi","CatatanPemeliharaanController@printKalibrasi")->name('catatan-pemeliharaan.printKalibrasi');

	Route::get("/catatan-pemeliharaan/json","CatatanPemeliharaanController@json")->name('catatan-pemeliharaan.json');
	
	Route::get("/catatan-pemeliharaan/print-filter","CatatanPemeliharaanController@printFilter")->name('catatan-pemeliharaan.print-filter');
	Route::get("/catatan-pemeliharaan/print","CatatanPemeliharaanController@printFilter")->name('catatan-pemeliharaan.print-filter');



	Route::get("/catatan-pemeliharaan/{id}/print-surat-tugas","CatatanPemeliharaanController@printSuratTugas")->name('catatan-pemeliharaan.printSuratTugas');




	Route::resource("/catatan-pemeliharaan","CatatanPemeliharaanController");

	Route::get("/jenis-pekerjaan/select2","JenisPekerjaanController@select2")->name("jenis_pekerjaan.select2");

	Route::get("/jenis-pekerjaan/json","JenisPekerjaanController@json")->name("jenis_pekerjaan.json");
	Route::resource("/jenis-pekerjaan","JenisPekerjaanController");


	Route::get("record-pekerjaan/{id_alkes}/{id_pekerjaan}","DataAlkesController@record_pekerjaan");


	Route::get("jadwal","JadwalController@index")->name('jadwal.index');
	Route::get("jadwal/create","JadwalController@create")->name('jadwal.create');
	Route::post("jadwal/store","JadwalController@store")->name('jadwal.store');
	Route::delete("jadwal/{id}/destroy","JadwalController@destory")->name('jadwal.destroy');
	Route::get("jadwal/{id}/edit","JadwalController@edit")->name('jadwal.edit');
	Route::post("jadwal/{id}/update","JadwalController@update")->name('jadwal.update');
	Route::get("jadwal/cetak","JadwalController@cetak")->name('jadwal.cetak');

	Route::get("akun","AuthController@edit");
	Route::post("akun/update","AuthController@update");


	Route::get("/permintaan-pelayanan/json","PermintaanPelayananController@json")->name("permintaan_pelayanan.json");

		Route::get("permintaan-pelayanan/{id}/cetak","PermintaanPelayananController@cetak");

	
	Route::get("/permintaan-pelayanan/{id}/tinjauan","PermintaanPelayananController@tinjauan");
	Route::post("/permintaan-pelayanan/storeTinjauan","PermintaanPelayananController@storeTinjauan");
	Route::get("/permintaan-pelayanan/{id}/editTinjauan","PermintaanPelayananController@editTinjauan");
	Route::post("/permintaan-pelayanan/updateTinjauan","PermintaanPelayananController@updateTinjauan");
	Route::get("get-form/{id}", "PermintaanPelayananController@getForm");

		Route::get("permintaan-pelayanan/cetak","PermintaanPelayananController@cetak");


	Route::resource("/permintaan-pelayanan","PermintaanPelayananController");

	
	Route::resource("pengaturan_jabatan","PengaturanJabatanController");


Route::get("/roles/json","RolesController@json")->name("roles.json");
Route::resource("/roles","RolesController");

Route::get("/rekap/data","RekapController@data")->name("rekap.data");


Route::get("/rekap/perbaikanData","RekapController@perbaikanData")->name("rekap.perbaikanData");

Route::get("/rekap/{type}","RekapController@rekap")->name("rekap.rekap");
Route::get("/rekap/kalibrasi/pdf","RekapController@pdfKalibrasi")->name("rekap.kalibrasi");
Route::get("/rekap/perbaikan/pdf","RekapController@pdfPerbaikan")->name("rekap.perbaikan");





Route::get("/user/json","UserController@json")->name("user.json");
Route::resource("/user","UserController");

Route::get('setting', 'SettingController@setting');
Route::delete('setting/reset', 'SettingController@reset');

Route::post("/data_ceklis/store_update","DataCeklisController@store_update");
Route::get("/data_ceklis/json","DataCeklisController@json")->name("data_ceklis.json");
Route::resource("/data_ceklis","DataCeklisController");



	Route::get("/master_ceklis/json","MasterCeklisController@json")->name("master_ceklis.json");
	Route::resource("/master_ceklis","MasterCeklisController");

});




Route::get('bouncer', function() {
    //


$array = [
    'teknisi',
    'ruangan',
    'supplier',
    'sumber-dana',
    'kepemilikan',
    'alat',
    'kategori-checklist',
    'jenis-pekerjaan',
    'data-alkes',
    'jadwal-pemeliharaan',
    'catatan-pemeliharaan',
    'jadwal',
    'cetak-label',
    'permintaan-pelayanan',
    'pengaturan_jabatan'
];

// $actions = ['index','create','edit','info','delete'];
$arrays = [];
foreach ($array as $key => $value) {



        $arrays = [
            'name'=>$value,
            'title'=>$value
        ]   ;

    Bouncer::ability()->firstOrCreate($arrays);

}


});





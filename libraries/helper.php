<?php 

function setting(){

	return App\Pengaturan::find(1);
}


function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function user($userid=null){

	if ($userid!=null) {
		# userid...
		return App\User::find($userid);
	}
		return App\User::find(session('userid'));

}

function sidebar_active($menu){

	return ($menu == Request::segment(1) ? 'active':'');
}


function sub_sidebar_active($menu){

	return ($menu == Request::segment(2) ? 'active':'');
}

function sidebar_parent_active($menu){


	return [
		'menu_open'=>(in_array(Request::segment(1),$menu) ? 'menu-open':''),
		'active'=>(in_array(Request::segment(1),$menu) ? 'active':'')
	];

}


function can($route,$withDB=false){
	// echo ;
		// echo session('role_id');
		// echo "string";
	// echo $route;
	if ($withDB) {
		# code...
// echo "string";
		$bouncer = \Bouncer::ability()->where('name',$route);
// echo $bouncer->count();
		// echo "string";
		if ($bouncer->count()) {
			# code...

  $role = \Bouncer::role()->find(session('userid'));
  // print_r($role);
  // exit();
  // echo "string";
// $abilities = $role->getAbilities();
// print_r($abilities);
// exit();
  if (!empty($role)) {
  	# code...
  	$can =$role->can($route);
// echo "string";
// var_dump($can);
return $can;
  }
  return true;
		}
		else{
// echo "string";

		return true;

		}

	}
	else{
// echo "string";
  $role = \Bouncer::role()->find(session('userid'));
  // print_r($role);
  // exit();

  if (!empty($role)) {
  	# code...
  	// echo "string";

// $abilities = $role->getAbilities();
// print_r($abilities);
// exit();
$can =$role->can($route);

// var_dump($can);
// var_dump($can);
return $can;
  }
  return true;

	}

}



function KonDecRomawi($angka)
{
    $hsl = "";
    if ($angka < 1 || $angka > 5000) { 
        // Statement di atas buat nentuin angka ngga boleh dibawah 1 atau di atas 5000
        $hsl = "Batas Angka 1 s/d 5000";
    } else {
        while ($angka >= 1000) {
            // While itu termasuk kedalam statement perulangan
            // Jadi misal variable angka lebih dari sama dengan 1000
            // Kondisi ini akan di jalankan
            $hsl .= "M"; 
            // jadi pas di jalanin , kondisi ini akan menambahkan M ke dalam
            // Varible hsl
            $angka -= 1000;
            // Lalu setelah itu varible angka di kurangi 1000 ,
            // Kenapa di kurangi
            // Karena statment ini mengambil 1000 untuk di konversi menjadi M
        }
    }


    if ($angka >= 500) {
        // statement di atas akan bernilai true / benar
        // Jika var angka lebih dari sama dengan 500
        if ($angka > 500) {
            if ($angka >= 900) {
                $hsl .= "CM";
                $angka -= 900;
            } else {
                $hsl .= "D";
                $angka-=500;
            }
        }
    }
    while ($angka>=100) {
        if ($angka>=400) {
            $hsl .= "CD";
            $angka -= 400;
        } else {
            $angka -= 100;
        }
    }
    if ($angka>=50) {
        if ($angka>=90) {
            $hsl .= "XC";
            $angka -= 90;
        } else {
            $hsl .= "L";
            $angka-=50;
        }
    }
    while ($angka >= 10) {
        if ($angka >= 40) {
            $hsl .= "XL";
            $angka -= 40;
        } else {
            $hsl .= "X";
            $angka -= 10;
        }
    }
    if ($angka >= 5) {
        if ($angka == 9) {
            $hsl .= "IX";
            $angka-=9;
        } else {
            $hsl .= "V";
            $angka -= 5;
        }
    }
    while ($angka >= 1) {
        if ($angka == 4) {
            $hsl .= "IV"; 
            $angka -= 4;
        } else {
            $hsl .= "I";
            $angka -= 1;
        }
    }

    return ($hsl);
}


function ambil_teknisi($id){
    // return $id;
    // exit();
    return $nama = App\Teknisi::find($id)->nama;
}

function makekode($master_barang_id){
    $kode = App\MasterBarang::find($master_barang_id)->kode;
    $tahun_ini = date('Y');
    $data = App\Inventaris::where('master_barang_id', $master_barang_id)->whereYear('created_at', $tahun_ini)->orderBy('created_at', 'desc')->first();
    if ($data) {
        $nomor_seri = $data->nomor_seri;
        $nomor_terakhir = substr($nomor_seri, 13, 3);
        $nomor_terakhir = (int)$nomor_terakhir;
    }else {
        $nomor_terakhir = 0;
    }
    
    $angka = $nomor_terakhir + 1;
    $angka = sprintf("%03d", $angka);
    $kode = 'RSPKUM/IPSRS-'.$angka.'/'.$kode.'/'.$tahun_ini;
    return $kode;
}



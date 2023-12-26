<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
class AuthController extends Controller
{
    //
    public function login(Request $request){
    		# code...
            $username = $request->username;
            $password = $request->password;
            

            $user = User::where('username',$username);

            if ($user->count()) {
                # code...
                $pass_db = $user->first()->password;
                if (Hash::check($password, $pass_db)) {
                    $success = true;
                    $msg = "Berhasil Login";


                    // $roles = $user->first()->getAbilities();
                    // print_r($roles);
                    // exit();
                    $request->session()->put('userid',$user->first()->id);
                    // $request->session()->put('roleid',);
                }else{

                    $success = false;
                    $msg = "Username/Password Yang Anda Masukan Salah";
                }
            }
            else{
                $success = false;
                $msg = "User Tidak Ditemukan";
            }

            return [
                'success'=>$success,
                'msg'=>$msg
            ];
    	

    }

    public function logout(Request $request){

        $request->session()->flush();

        return redirect('/minta');

    }

    public function edit(){
        $id = session('userid');
        // echo $id;
        // return;
        $data = User::find($id);
        return view('akun.index', compact('data'));
    }

    public function update(Request $req){
        // print_r($req->all());
        $pass = $req->password;
        $user = $req->username;
        $id = $req->id_user;
        $update = User::find($id);
        $update->username = $user;
        if($pass != ''){
            $passDB = bcrypt($pass);
            $update->password = $passDB;     
        }
        $save = $update->save();
        if($save){
            $msg = "data saved successfully";
            $success = true;
        }else {
            $msg = "data failed to save";
            $success = false;
        }

        return [
          'success'=>$success,
          'msg'=>$msg
        ];

    }
}

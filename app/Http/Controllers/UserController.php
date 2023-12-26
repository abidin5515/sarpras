<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\User; 
use Bouncer;







class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $dir = "user";
    protected $url = "user";


  



    public function json(){
          $data = User::select([
'user.id',
'user.username',
'user.password',
'roles.name as role_name'
]);

          $data->leftJoin('assigned_roles','user.id','assigned_roles.entity_id');
          $data->leftJoin('roles','assigned_roles.role_id','roles.id');

            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($d){
               return '<button data-title="Ubah" class="btn btn-sm btn-warning create-btn edit-btn" data-src="'.url($this->url.'/'.$d->id.'/edit').'"><i class="fas fa-edit"></i></button>
<button class="btn btn-sm btn-danger delete-btn" href="'.url($this->url.'/'.$d->id).'"><i class="fas fa-trash"></i></button>';


            })->make(true);

    }





    public function index(Request $request)
    {
        //

        $title = "List";


          // $data = @Table::all();
        return view($this->dir.'/index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $roles = Bouncer::role();

        // print_r($bouncer->get());
        // exit();

        $title = "Create";
        
        
        return view($this->dir.'/create',compact('title','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // UNTUK DUMP NAMA FORM

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request, $type untuk save/update,$table untuk Class nama tabel

     */


    public function store(Request $request)
    {




    $validatedData = $request->validate([
"username" => "required" ,
"password" => "required" ,
'role'=>'required'

]);


    $role = $request->role;
    $bouncerRole = Bouncer::role()->find($role);

    // print_r($bouncerRole);
    // exit();
    $bouncerRoleName = $bouncerRole->name;
    // print_r($bouncerRoleName);
    // exit();

    $user = new User;

    $user->username = $request->username;
$user->password = bcrypt($request->password);

if (!empty($request->ruangan)) {
    # code...

    $user->id_ruangan = $request->ruangan;

}
$save = $user->save();



Bouncer::assign($bouncerRoleName)->to($user);

  # code...

#store





        if ($save) {
            $msg = "data saved successfully";
            $success = true;


        }
        else {

            $msg = "data failed to save";
            $success = false;

        }
    
        return [
          'success'=>$success,
          'msg'=>$msg
        ];

}

      

        // $table = new Table;
        // print_r($request->all());


    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $data = $this->fields();
        $table = User::find($id);
        $title = "";
        $subtitle = "";
        return view($this->dir.'/info',compact('data','table','title','subtitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        // $data = $this->fields();
        $data = User::find($id);

        $title = "Edit Data";
        $subtitle = "";
        

        $roles = Bouncer::role();
        

        return view($this->dir.'/edit',compact('data','title','subtitle','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     

    $validatedData = $request->validate([
"username" => "required" ,
// "password" => "required" ,

]);



    $role = $request->role;
    $bouncerRole = Bouncer::role()->find($role);

    // print_r($bouncerRole);
    // exit();
    $bouncerRoleName = $bouncerRole->name;

    @$user =  User::find($id);

    $user->username = $request->username;
    if (!empty($request->password)) {
        # code...
$user->password = bcrypt($request->password);

    }

$save = $user->save();


Bouncer::assign($bouncerRoleName)->to($user);




       if ($save) {
        //Do Your Something
          $status = 1;
            // return redirect($this->url);
            $msg = "Data Successfully Updated";
          $success = true;
        }
        else {
        //Do Your Something 
          $status =0;
          $success = false;
            $msg = "Data Failed to Update";

        }

        return [
          'success'=>$success,
          'msg'=>$msg
        ];


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        //
        $table = User::find($id);
        $delete = $table->delete();
         if ($delete) {
        $success= true;
          $msg = 'Data Deleted successfully';

        }
        else {

          $msg = 'Failed to delete ';
            $success = false;
        }

        return [
          'success'=>$success,
          'msg'=>$msg
        ];
    }

    

    

    

}

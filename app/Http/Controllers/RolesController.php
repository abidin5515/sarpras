<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Roles; 
use Bouncer;

use Str;
use DB;



class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $dir = "roles";
    protected $url = "roles";


  



    public function json(){
          $data = Roles::select([
'roles.id',
'roles.name',
'roles.title',
'roles.level',
'roles.scope',
]);

            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($d){
                return '<a data-title="Ubah" class="btn btn-sm btn-warning edit-btn" href="'.url($this->url.'/'.$d->id.'/edit').'"><i class="fas fa-edit"></i></a>
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


        $title = "Create";
        
        
        $abilities = Bouncer::ability();


        return view($this->dir.'/create',compact('title','abilities'));
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




    // print_r($reque)

$save = Bouncer::role()->firstOrCreate([
    'name' => Str::slug($request->title),
    'title' => $request->title,
]);

$role = $request->role;



if (!empty($role)) {
  # code...
  foreach ($role as $key => $r) {
    # code...
    Bouncer::allow($save)->to($r);

  }
}

//  exit();
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
        $table = Roles::find($id);
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
        $data = Roles::find($id);

        $title = "Edit Data";
        $subtitle = "";
        
       @$roleId = Bouncer::role()->where('name',Str::slug($data->name))->first()->id;


        // print_r($roleId);
        // exit();
        $abilities = Bouncer::ability();
        


        $user = Bouncer::role()->where('name',Str::slug($data->name))->first()->getAbilities();

        // print_r($user);
        $userArr = [];

        if (!empty($user)) {
            # code...
            foreach ($user as $u) {
                # code...
                $userArr[] = $u->id;
            }
        }



        // print_r($userArr);
        // exit();

        return view($this->dir.'/edit',compact('data','title','subtitle','abilities','userArr','roleId'));
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
     

    
    @$roles =  Roles::find($id);

    $roles->name = $request->title;
$roles->title = $request->title;
// $roles->level = $request->level;
// $roles->scope = $request->scope;
$save = $roles->save();





$bouncer = Bouncer::role()->firstOrCreate([
    'name' => Str::slug($request->title),
    'title' => $request->title,
]);


$role = $request->role;

// print_r($request->role);
// exit();
if (!empty($role)) {
  # code...

  DB::table('permissions')->where('entity_id',$request->roleId)->delete();
  foreach ($role as $key => $r) {
    # code...
    // Bouncer::disallow($bouncer)->to($r);

    Bouncer::allow($bouncer)->to($r);
    // echo $r;
  }
}




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
        $table = Roles::find($id);
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

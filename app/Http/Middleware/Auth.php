<?php

namespace App\Http\Middleware;

use Closure;

class Auth
{
    public function handle($request, Closure $next)
    {

                    // $roles = $user->first()->getAbilities();

        if(empty(session('userid'))){
        	return redirect('/minta');
        }else {
        	// echo "string";
        	$abilities = user()->getAbilities();
        	// print_r($abilities);
        	// exit();
        	$abilitiesData = [];

        	foreach ($abilities as $ab) {
        		# code...
                $explode = explode('/', $ab->name);
                if (count($explode)>1) {
                    # code...
                $abilitiesData[] = $ab->name.'.indexxx';

                }
                else{
                $abilitiesData[] = $ab->name.'.index';

                }
        	}


            // print_r($abilitiesData);


		$routeName = \Request::route()->getName();

		$method = \Route::getCurrentRoute()->getActionMethod();

        // print_r($routeName);
        // exit();


        	if (!empty($request->segment(1))) {
        		# code...


        		if ($method=='index') {
        			# code...
        	           if (!in_array($routeName, $abilitiesData)) {
        	           	# code...
        	           	return abort(401);
        	           }

        		}
               
                // exit();

                // exit();

        	}

        	// print_r($abilitiesData);
        	// exit();
        	 return $next($request);
        }
    }
}
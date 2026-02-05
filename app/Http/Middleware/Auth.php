<?php

namespace App\Http\Middleware;

use Closure;

class Auth
{
	public function handle($request, Closure $next)
	{

		// $roles = $user->first()->getAbilities();

		if (empty(session('userid'))) {
			return redirect('/minta');
		} else {

			// $abilities = user()->getAbilities();

			// $abilitiesData = [];

			// foreach ($abilities as $ab) {
			// 	$explode = explode('/', $ab->name);
			// 	if (count($explode) > 1) {
			// 		$abilitiesData[] = $ab->name . '.indexxx';
			// 	} else {
			// 		$abilitiesData[] = $ab->name . '.index';
			// 	}
			// }


			// $routeName = \Request::route()->getName();

			// $method = \Route::getCurrentRoute()->getActionMethod();


			// if (!empty($request->segment(1))) {


			// 	if ($method == 'index') {
			// 		if (!in_array($routeName, $abilitiesData)) {

			// 			return abort(401);
			// 		}
			// 	}
			// }

			// print_r($abilitiesData);
			// exit();
			return $next($request);
		}
	}
}

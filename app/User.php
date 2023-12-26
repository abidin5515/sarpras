<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;


class User extends Authenticatable
{

	    use HasRolesAndAbilities;

	protected $table = "user";
    protected $fillable = [
        'username', 'password',
    ];

    public function ruangan(){
    	return $this->belongsTo('App\Ruangan','id_ruangan','id');
    }
}

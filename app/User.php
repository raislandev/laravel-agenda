<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class User extends Authenticatable
{
    use Notifiable;
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected static $logAttributes = ['name', 'email','password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function sendPasswordResetNotification($token)
    {
        // Não esquece: use App\Notifications\ResetPassword;
        $this->notify(new ResetPassword($token));
    }

    public function Clients()
    {
        return $this->hasMany('App\Client');
    }


    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function hasRoles($roles){
        $userRoles = $this->roles;
        return $roles->intersect($userRoles)->count();

    }

    public function isAdmin(){
        return $this->hasRole("Admin");
    }

    public function hasRole($role){
        if(is_string($role)){
            $role = Role::where('name','=',$role)->firstOrFail();
        }
        
        return (boolean) $this->roles()->find($role->id);

    }

   


    

}

<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function get_users()
    {
        return static::orderBy('id', 'asc')->get();
    }
/*    public static function get_user($id)
    {
        return static::where('id', $id)->get();
    }
*/
    public static function get_developer($id)
    {
        return static::find($id);
    }

    public static function get_users_shift_current($id)
    {
        return static::where('id', '!=', $id)->where('id', '>', '1')->orderBy('koefficient', 'desc')->get();
    }

    public static function get_users_hall()
    {
        return static::join('bonuses', 'users.id', '=', 'bonuses.user_id') -> whereNotNull('bonuses.bonus')->distinct('users.id')->get();
    }


}

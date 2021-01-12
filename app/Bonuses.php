<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bonuses extends Model
{
    public static function get_bonuses($user_id)
	{
		return static::leftjoin('users', 'users.id', '=', 'user_id') -> whereNotNull('bonus')-> where('user_id', $user_id)->pluck( 'place', 'tour');
	}

	 public static function get_bonuses_by_user($user_id, $tour)
    {
        return static:: where('user_id', $user_id)-> where('tour', $tour)-> whereNotNull('bonus')->get();
    }
}

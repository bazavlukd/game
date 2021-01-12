<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    public static function get_21besttime($tour)
	{
		return static::join('users', 'users.id', '=', 'times.user_id')->where('tour', $tour)->orderBy('trackingtime', 'desc')->orderBy('times.id', 'asc')->take(21)->get();
	}

	public static function get_timebyid($user_id, $tour)
	{
		return static::where('user_id', $user_id)->where('tour', $tour)->value('trackingtime');
		//return static::table('times')->find()
	}

	public static function get_alltime($tour)
	{
		return static::join('users', 'users.id', '=', 'times.user_id')->where('tour', $tour)->orderBy('trackingtime', 'desc')->get();
	}
}

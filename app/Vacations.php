<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacations extends Model
{
    protected $table = 'vacations';
    protected $fillable = ['period', 'location', 'user_id', 'start', 'end'];
	
    
   	public static function get_vacations($year)
	{
		return static:: rightjoin('users', 'users.id', '=', 'vacations.user_id')->get();
	}

	public static function get_last_vacations_by_user($user_id)
	{
		return static::select('start', 'end', 'location')->where('user_id', $user_id)->where('end', '<', NOW())->first();
	}

	public static function get_next_vacations_by_user($user_id)
	{
		return static::select('start', 'end', 'location')->where('user_id', $user_id)->where('start', '>', NOW())->first();
	}

	public static function save_vacation($user_id, $period, $location, $start, $end)
	{
		return static::insert(['user_id' => $user_id, 'period' => $period, 'location' => $location,  'start' => $start, 'end' => $end]);
	}
}

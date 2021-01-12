<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    public static function get_currentcontracts()
	{
		return static::leftjoin('users', 'users.id', '=', 'user_id') -> where('status', 1)->get();
	}

	public static function get_completedcontracts()
	{
		return static:: where('status', 0)->where('hours', '>', 0)->whereNull('user_id')->get();
	}

	public static function get_contract_by_id($id)
	{
		return static:: where('id', '=', $id)->get();
	}

	public static function get_contracts_by_user($user_id)
	{
		return static:: where('user_id', '=', $user_id)->get();
	}

}

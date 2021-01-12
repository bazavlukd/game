<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    public static function get_accounts()
	{

	return static:: select('accounts.account', 'accounts.firstname', 'accounts.lastname', 'accounts.skype', 'users.username', 'contracts.limit', 'contracts.point', 'contracts.contact')->leftjoin('contracts', 'contracts.account_id', '=', 'accounts.id')->join('users', 'users.id', '=', 'contracts.user_id')->where('status', 1)->orderBy('accounts.id', 'asc')->get();
	}

	public static function get_allaccounts()
	{
		//return static:: get();
		return static:: leftjoin('users', 'users.id', '=', 'accounts.user_id')->leftjoin('contracts', 'contracts.id', '=', 'accounts.contract_id')->get();
	}

}

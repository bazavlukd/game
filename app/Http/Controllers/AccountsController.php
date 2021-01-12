<?php

namespace App\Http\Controllers;

use Session;
use App\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class AccountsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     * Display a listing of the prducts.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->username;
        $accounts = \App\Accounts::get_accounts();

        return view('accounts', ['user_name' => $user_name, 'accounts' => $accounts ]);
    }

    public function oldindex(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->username;
        $allaccounts = \App\Accounts::get_allaccounts();
foreach ($allaccounts as $key => $value) {
    $accounts[$key]['account'] = $value->account;
    $accounts[$key]['name'] = $value->firstname.' '.$value->lastname;
    $accounts[$key]['skype'] = $value->skype;
    $accounts[$key]['occupied'] = $value->occupied;

    if(!empty($value->contract_id)){
        $temp = \App\Contracts::get_contract_by_id($value->contract_id);
        $accounts[$key]['contract1']['client'] = $temp[0];
        $temp = \App\User::get_developer($value->user_id);
        $accounts[$key]['contract1']['developer'] = $temp;
    }
    if(!empty($value->contract2_id)){
        $temp = \App\Contracts::get_contract_by_id($value->contract2_id);
        $accounts[$key]['contract2']['client'] = $temp[0];
        $temp = \App\User::get_developer($value->user2_id);
        $accounts[$key]['contract2']['developer'] = $temp;
    }
       
}
        //$accounts = \App\Contracts::get_currentcontracts();
        return view('accounts_temp', ['user_name' => $user_name, 'accounts' => $accounts ]);
    }
}
<?php

namespace App\Http\Controllers;

use Session;
use App\Link;
use App\Constants\TimeConstants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class ContractsController extends Controller
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

    

     public function index()
    {
       
        $contracts = \App\Contracts::get_completedcontracts();
 
        return view('contracts', ['contracts' => $contracts ]);
    }

    public function editContract(Request $request)
    {
        $data = $request->all();
        $contract = \App\Contracts::get_contract_by_id($data['id']);
        return view('contract', ['contract' => $contract ]);
            
        return redirect()->action('ContractsController@index');
    }

    public function saveContract(Request $request)
    {
        $token = $request->input('_token');
        $data = $request->all();
        foreach ($data['contract'] as $key => $value ) 
            DB::table('contracts')->where('id', $key)->update(['user_id' => Auth::user()->id]);
            
        return redirect()->action('ContractsController@index');
    }

}
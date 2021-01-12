<?php

namespace App\Http\Controllers;

use Session;
use App\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Constants\TimeConstants;


class HallController extends Controller
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
    $date = Carbon::parse(TimeConstants::STARTDATE);
    $now = Carbon::now();
    $tour = $date->diffInMonths($now);
    $developers = \App\User::get_users_hall();
    foreach ($developers as $key => $value)
        $bonuses[$value->username] = \App\Bonuses::get_bonuses($value->user_id);
    
    return view('hall', ['bonuses' => $bonuses,
                        'tour' => $tour]);
    
    }
}
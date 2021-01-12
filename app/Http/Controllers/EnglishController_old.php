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


class EnglishController extends Controller
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
        $colors = \App\English::get_colors();
        foreach($colors as $value){
            $groups[$value->name]['time'] = \App\English::get_time($value->name);
            $groups[$value->name]['users'] = \App\English::get_users($value->name);
        }
   
        return view('english', ['groups' => $groups]);
    }
}
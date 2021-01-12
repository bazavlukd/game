<?php

namespace App\Http\Controllers;

use Session;
use App\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoopController extends Controller
{
        
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->username;
        return view('loop', 
            ['user_name' => $user_name ]);
    }

}
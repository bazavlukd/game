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


class VotesController extends Controller
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
        $date = Carbon::parse(TimeConstants::VOTEDATE);
        $now = Carbon::now();
        $votetour = $date->diffInMonths($now);

        $userachievements = \App\Usersachievements::get_result($user_id);
        $achievementslist = \App\Achievement::get_achievenents();
        $codestyle = \App\Points::get_result($votetour, 'codestyle', $user_id);
        $mentoring = \App\Points::get_result($votetour, 'mentoring', $user_id);
        $responsibility = \App\Points::get_result($votetour, 'responsibility', $user_id);
        $date = Carbon::parse(TimeConstants::STARTDATE);
        $timetour = $date->diffInMonths($now);
        $time = \App\Time::get_timebyid($user_id, $timetour);
 
        if(($votetour - $timetour) && empty($codestyle[0]) && empty($mentoring[0]) && empty($responsibility[0])){
            $users = \App\User::get_users_shift_current($user_id);
            return view('votes', ['user_name' => $user_name, 
                                    'user_id' => $user_id,
                                    'users' => $users
                                    ]);
        }
        
        $users = \App\User::get_users();
      
        return view('result', ['user_name' => $user_name, 
                                    'user_id' => $user_id,
                                    'users' => $users,
                                    'codestyle' => $codestyle,
                                    'mentoring' => $mentoring,
                                    'responsibility' => $responsibility
                                    ]);
   }

   public function saveValues(Request $request)
    {
        $date = Carbon::parse(TimeConstants::VOTEDATE);
        $now = Carbon::now();
        $tour = $date->diffInMonths($now);
        $token = $request->input('_token');
        $data = $request->all();

        $voute_numbers = 0;
        if(!empty($data['responsibility'])) $voute_numbers += count($data['responsibility']);
        if(!empty($data['mentoring'])) $voute_numbers += count($data['mentoring']);
        if(!empty($data['codestyle'])) $voute_numbers += count($data['codestyle']);

        if ($voute_numbers == 0) return redirect()->action('DashboardController@index');
        $point = 12/$voute_numbers;
        $point = $point>2.5 ? 2.5 : $point;

        if(!empty($data['responsibility']))
        foreach ($data['responsibility'] as $key => $value ) {
            $developer = \App\User::get_developer($key);
            \App\Points::create([
                'token' => $token, 
                'skill' => 'responsibility', 
                'point' => $point, 
                'tester_id' => Auth::user()->id,
                'tour' => $tour,
                'koefficient' => $developer->koefficient,
                'user_id' => $key ]);
        }

        if(!empty($data['mentoring']))
        foreach ($data['mentoring'] as $key => $value ) {
            $developer = \App\User::get_developer($key);
            \App\Points::create([
                'token' => $token, 
                'skill' => 'mentoring', 
                'point' => $point, 
                'tester_id' => Auth::user()->id,
                'tour' => $tour,
                'koefficient' => $developer->koefficient,
                'user_id' => $key ]);
        }

        if(!empty($data['codestyle']))
        foreach ($data['codestyle'] as $key => $value ) {
            $developer = \App\User::get_developer($key);
            \App\Points::create([
                'token' => $token, 
                'skill' => 'codestyle', 
                'point' => $point, 
                'tester_id' => Auth::user()->id,
                'tour' => $tour,
                'koefficient' => $developer->koefficient,
                'user_id' => $key ]);
        }
    return redirect()->action('VotesController@index');

   }

}
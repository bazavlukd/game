<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Constants\TimeConstants;
use Carbon\Carbon;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
   
    $date = Carbon::parse(TimeConstants::STARTDATE);
    $now = Carbon::now();
    $tour = $date->diffInMonths($now);
    $tour = $request->get('tour', $tour);
    $users = \App\User::get_users();
    $time = \App\Time::get_21besttime($tour);
    $avatars = \App\Avatar::get_allavatars();
   
    foreach ($time as $key => $value) {
        $devresult[$value->user_id] = [ 'username' => $value->username,
                                'trackingtime' => $value->trackingtime,
                                'mentoring' => \App\Points::get_result_by_user($tour, $value->user_id, 'mentoring'),
                                'responsibility' => \App\Points::get_result_by_user($tour, $value->user_id, 'responsibility'),
                                'codestyle' => \App\Points::get_result_by_user($tour, $value->user_id, 'codestyle'),
                                'koefficient' => $value->koefficient,
                            ];
    }

    return view('dashboard', ['users' => $devresult, 'avatars' => $avatars ]);
    
    }

    public function saveTourResults()
    {
        $date = Carbon::parse(TimeConstants::STARTDATE);
        $now = Carbon::now();
        $tour = $date->diffInMonths($now);
        $developers = \App\Time::get_21besttime($tour);
        foreach ($developers as $value) {
            $user_id = $value->user_id;
            $mentoring = \App\Points::get_result_by_user($tour, $user_id, 'mentoring');
            $responsibility = \App\Points::get_result_by_user($tour, $user_id, 'responsibility');
            $codestyle = \App\Points::get_result_by_user($tour, $user_id, 'codestyle');
            $result = $value->trackingtime + $mentoring + $responsibility + $codestyle;
            DB::table('bonuses')->insert(['user_id' => $user_id, 'tour' => $tour, 'result' => $result, 'place' => 0 ]);
        }    
        
        return redirect()->action('DashboardController@index');
    }
}
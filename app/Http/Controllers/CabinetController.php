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


class CabinetController extends Controller
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
        $date = Carbon::parse(TimeConstants::STARTDATE);
        $now = Carbon::now();
        $tour = $date->diffInMonths($now);
        $tour = $request->get('tour', $tour);

        $userachievements = \App\Usersachievements::get_join_result($user_id);
        $bonuses = \App\Bonuses::get_bonuses($user_id);
        $codestyle = \App\Points::get_result_by_user($tour, $user_id, 'codestyle');
        $mentoring = \App\Points::get_result_by_user($tour, $user_id, 'mentoring');
        $responsibility = \App\Points::get_result_by_user($tour, $user_id, 'responsibility');
        $contracts = \App\Contracts::get_contracts_by_user($user_id);
        $time = \App\Time::get_timebyid($user_id, $tour);
        $lastvacations = \App\Vacations::get_last_vacations_by_user($user_id);
        $nextvacations = \App\Vacations::get_next_vacations_by_user($user_id);
       // $weeks_vacation = intdiv(Carbon::parse($lastvacations['end'])->diffInMonths($now), 4);
        
    if (empty($lastvacations)) $weeks_vacation = 1;
    if (empty($lastvacations)) {
        $developer = \App\User::get_developer($user_id);
        $days = Carbon::parse($developer->start_date)->diffInDays($now);
    }else
        $days = Carbon::parse($lastvacations['end'])->diffInDays($now);
        $days = Carbon::parse('2022-01-01')->diffInDays($now);
      
        return view('cabinet', ['user_id' => $user_id, 
                                'bonuses' => $bonuses,
                                'user_name' => $user_name, 
                                'achievements' => $userachievements,
                                'ranking' => count($userachievements) * 0.02 + 1,
                                'codestyle' => $codestyle,
                                'mentoring' => $mentoring,
                                'responsibility' => $responsibility,
                                'lastvacations' => $lastvacations,
                                'nextvacations' => $nextvacations, 
                                'contracts' => $contracts,
                                'time' => $time,
                                'days' => $days
                            ]);
    }

    public function saveDescription(Request $request)
    {
        $token = $request->input('_token');
        $data = $request->all();

        foreach ($data['description'] as $key => $value ) {
            DB::table('usersachievements')->where('achievement_id', $key)->where('user_id', Auth::user()->id)->update(['proof' => $value]);
            }
        return redirect()->action('CabinetController@index');
    }

    public function saveTime(Request $request)
    {
        $token = $request->input('_token');
        $data = $request->all();
        $user_id = Auth::user()->id;
        $date = Carbon::parse(TimeConstants::STARTDATE);
        $now = Carbon::now();
        $tour = $date->diffInMonths($now);
        $date = Carbon::parse(TimeConstants::VOTEDATE);
        $votetour = $date->diffInMonths($now);

        if($votetour - $tour){
             \App\Hour::create([
                        'user_id' => $user_id, 
                        'tour' => $votetour, 
                        'overtimehours' => $data['overtimeHours'],
                        'standarthours' => $data['standartHours'],
                        'internalhours' => $data['internalHours'],
                        'url' => $data['url']
                         ]);
        }
    return redirect()->action('CabinetController@index');        
    }
}
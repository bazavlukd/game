<?php

namespace App\Http\Controllers;

use Session;
use App\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class AchievementsController extends Controller
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
        $userachievements = \App\Usersachievements::get_result($user_id);
        $achievementslist = \App\Achievement::get_achievenents();
  
        foreach ($userachievements as $key => $value) {
            $achievements[$value->achievement_id] = $value->created_at;
        }
        
        if(empty($achievements))
            return view('achievementsempty', ['user_name' => $user_name, 'list' => $achievementslist ]);

        return view('achievements', ['user_name' => $user_name, 'achievements' => $achievements, 'list' => $achievementslist ]);

    }

    public function saveAchievements(Request $request)
    {
        $token = $request->input('_token');
        $data = $request->all();
        if(!empty($data['achievement'])) {
            $counter = 0;
            foreach ($data['achievement'] as $key => $value ) {
                $counter += 0.02;
                \App\Usersachievements::create([
                    'token' => $token, 
                    'achievement_id' => $key, 
                    'confirmed' => $value, 
                    'proof' => $data['description'][$key],
                    'user_id' => Auth::user()->id ]);
            }
        DB::table('users')->where('id', Auth::User()->id)->increment('koefficient', $counter);

        }
    return redirect()->action('AchievementsController@index');
   }
}
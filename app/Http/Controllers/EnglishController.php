<?php

namespace App\Http\Controllers;

use Session;
use App\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\TestEnglish;
use App\TestResults;


class EnglishController extends Controller
{
        
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the prducts.
     *
     * @return \Illuminate\Http\Response
     */

    public function schedule()
    {
        $colors = \App\English::get_colors();
        foreach($colors as $value){
            $groups[$value->name]['time'] = \App\English::get_time($value->name);
            $groups[$value->name]['users'] = \App\English::get_users($value->name);
        }
   
        return view('schedule', ['groups' => $groups]);
    }

    public function get_result($user_id, $type)
    {
        $attempt = TestResults::get_max($user_id, $type);
        $res = TestResults::get_result(31, $type, $attempt);
        $max = $res['result']*5-($res['all']-$res['result'])*2;
        for( $i=$attempt; $i>0; $i--){
            $res = TestResults::get_result(31, $type, $i);
            $new = $res['result']*5-($res['all']-$res['result'])*2;
        
            if($new > $max) $max = $new;
        }
        return $max;
    }

    public function indexXXX()
    {
        $tasks = TestEnglish::tasks_answers_free('logic');
        return view('tests/comp',  ['tasks' => $tasks ]);
    }

    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $result = [0];
        $attempt_completions = TestResults::get_max($user_id, 'completions');
        for( $i = $attempt_completions; $i > 0; $i--)
            $result['completions'][$i] = 
        TestResults::get_result($user_id, 'completions', $i);
        $attempt_restatements = TestResults::get_max($user_id, 'restatements');
        for( $i = $attempt_restatements; $i > 0; $i--)
            $result['restatements'][$i] = 
        TestResults::get_result($user_id, 'restatements', $i);
        $attempt_reading = TestResults::get_max($user_id, 'reading');
        for( $i = $attempt_reading; $i > 0; $i--)
            $result['reading'][$i] = 
        TestResults::get_result($user_id, 'reading', $i);
         $attempt_logic = TestResults::get_max($user_id, 'logic');
        for( $i = $attempt_logic; $i > 0; $i--)
            $result['logic'][$i] = 
        TestResults::get_result($user_id, 'logic', $i);
       
        return view('test', 
            ['user_id' => $user_id,
            'results' => $result,
            'attempt_completions' => $attempt_completions,
            'attempt_restatements' => $attempt_restatements,
            'attempt_reading' => $attempt_reading, 
            'attempt_logic' => $attempt_logic, ]);
    }

    public function testReading()
    {
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->username;
        $attempt = TestResults::get_max($user_id, 'reading');
        if ($attempt > 2)
             return redirect()->action('EnglishController@index');
        $all = TestEnglish::get_tasks_numbers('reading');
        $rand_key = array_rand($all, 1);
       
        $commontext = TestEnglish::get_text($all[$rand_key]);
        $text = $commontext->text_en;
        $tasks = TestEnglish::get_task_reading($all[$rand_key]);

        return view('tests/reading', 
            ['user_name' => $user_name, 
            'text' => $text,
            'tasks' => $tasks ]);
    }

    public function testRestatements()
    {
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->username;
         $attempt = TestResults::get_max($user_id, 'restatements');
        if ($attempt > 2)
             return redirect()->action('EnglishController@index');
        $all = TestEnglish::get_tasks_numbers('restatements');
        $rand_keys = array_rand($all, 5);
        foreach ($rand_keys as $key) 
            $tasks[$all[$key]['id']] = 
                TestEnglish::get_task($all[$key]['id']);
        return view('tests/restatements', 
            ['user_name' => $user_name, 
             'tasks' => $tasks ]);
    }

    public function testCompletions()
    {
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->username;
        $attempt = TestResults::get_max($user_id, 'completions');
        if ($attempt > 2)
             return redirect()->action('EnglishController@index');
        $all = TestEnglish::get_tasks_numbers('completions');
        $rand_keys = array_rand($all, 5);
        foreach ($rand_keys as $key) 
            $tasks[$all[$key]['id']] = 
                TestEnglish::get_task($all[$key]['id']);
        return view('tests/completions', 
            ['user_name' => $user_name, 
             'tasks' => $tasks ]);
    }

    public function testLogic()
    {
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->username;
        $attempt = TestResults::get_max($user_id, 'logic');
        if ($attempt > 2)
             return redirect()->action('EnglishController@index');
        $all = TestEnglish::get_tasks_numbers('logic');
        $rand_keys = array_rand($all, 3);
        foreach ($rand_keys as $key) 
            $tasks[$all[$key]['id']] = 
                TestEnglish::get_task($all[$key]['id']);
        return view('tests/logic', 
            ['user_name' => $user_name, 
             'tasks' => $tasks ]);
    }

     public function analiz(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->all();
        $attempt1 = 
        TestResults::english_analiz($user_id, $data['type'], 1);
        $attempt2 = 
        TestResults::english_analiz($user_id, $data['type'], 2);
        $attempt3 = 
        TestResults::english_analiz($user_id, $data['type'], 3);
    for($i=1; $i<4; $i++) 
    $res[$i]=TestResults::get_result($user_id, $data['type'], $i);
     
//var_dump($res); die();
 if($data['type'] == 'reading'){
    $text1=TestEnglish::get_text($attempt1[0]['text_id']);
    $text2=TestEnglish::get_text($attempt2[0]['text_id']);
    $text3=TestEnglish::get_text($attempt3[0]['text_id']);
        return view('tests/analiz', 
            ['user_id' => $user_id,
            'type' =>  $data['type'],
            'results' => $res,
            'texts' => [$text1, $text2, $text3 ],
            'attempts' => [$attempt1, $attempt2, $attempt3 ]
         ]);
    }

        return view('tests/analiz', 
            ['user_id' => $user_id,
            'results' => $res,
            'type' =>  $data['type'],
            'attempts' => [$attempt1, $attempt2, $attempt3 ]
         ]);
    }


    public function saveAnswers(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->username;
        $data = $request->all();
        $attempt = TestResults::get_max($user_id, $data['type']);
        $attempt++;
        foreach ($data as $key => $value ) {
            if (($key != '_token')&&($key != 'type')&&(!is_null($value))){
        
            $res = TestEnglish::get_task($key);
        
            \App\TestResults::create([
                'user_id' => $user_id, 
                'attempt' => $attempt, 
                'type' => $data['type'],
                'test_id' => $key,
                'answer' => $value,
                'right_answer' => $res->answer ]);
        }
            }
    return redirect()->action('EnglishController@index');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TestResults extends Model
{
    protected $fillable = [ 'user_id', 'type', 'attempt', 'answer', 'right_answer', 'test_id'];
    protected $table = 'test_results';
    
    public static function get_max($user_id, $type){
        $max = static::where('type', $type)->where('user_id', $user_id)->max('attempt');
        return $max;
    }

    public static function get_result($user_id, $type, $attempt){
        $right = static:: whereRaw('answer = right_answer')->
        where('user_id', $user_id)->
        where('type', $type)->
        where('attempt', $attempt)->count();
        $all = static:: where('user_id', $user_id)->
        where('type', $type)->
        where('attempt', $attempt)->count();
        $result = $right*5-($all-$right)*2;
        return ['all'=>$all, 'right'=>$right, 'result'=>$result];
    }

    public static function english_analiz($user_id, $type, $attempt){
        $result = static:: select('test_english.text_id', 'text', 'var1', 'var2', 'var3', 'var4', 'var5', 'test_english.answer AS right_answer', 'test_results.answer')->join('test_english', 'test_english.id', '=', 'test_results.test_id')->where('attempt', $attempt)->where('test_results.user_id', $user_id)->where('test_results.type', $type)->get();
        
        return $result;
    }
        
}

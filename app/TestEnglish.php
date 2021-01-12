<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestEnglish extends Model
{
   protected $table = 'test_english';
   
   public static function get_task($id)
	{
	return static:: where('id', $id)->first();
	}

	public static function get_tasks_numbers($type)
	{
		if ($type == 'reading') 
		$x = static::select('text_id')->where('type', $type)->where('id', '<', 2352)->get();
		else
		$x = static::select('id')->where('type', $type)->where('id', '<', 2352)->get();
	return  $x->toArray();
	}

	public static function get_task_reading($id)
	{
	return static:: where('text_id', $id)->get();
	}

	public static function get_text($id)
	{
	return static:: select('text_en')->join('test_commontext', 'test_commontext.id', '=', 'text_id')->where('text_id', $id)->first();
	}

	public static function tasks_answers_free($type)
	{
	$x = static::where('type', $type)->where('id', '>', 2)->get();
		
	return  $x->toArray();
	}
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class English extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'english';
    
   
    public function getColors()
    {
        return $this->select('name')->distinct()->get();
    }

    public static function get_colors()
    {
        return static::select('name')->distinct()->get();
    }

    public static function get_time($color)
    {
        return static::where('name', $color)->get();
    }

    public static function get_users($color)
    {
        return DB::table('englishusers')->join('users', 'users.id', '=', 'user_id')->where('name', $color)->get();
    }
}

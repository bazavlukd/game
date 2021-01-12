<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Hour extends Model
{
     
    protected $fillable = [ 'user_id', 'tour', 'standarthours',       'overtimehours', 'internalhours', 'url', 'time'];

   

}

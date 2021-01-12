<?php
if (!function_exists('dateFormat')) {
    function dateFormat($date)
    {
        return date('H:i', strtotime($date));
    }
}


function questionFormat($name, $question, $var1, $var2, $var3, $var4)
    {
    $variants = '<select class="custom-select my-1 mr-sm-2" name="'.$name.'">
    <option value="" selected>Choose...</option>
    <option value="1">'.$var1.'</option>
    <option value="2">'.$var2.'</option>
    <option value="3">'.$var3.'</option>
    <option value="4">'.$var4.'</option>
  	</select>';
        
        return str_replace("_______", $variants , $question);
    }

function analizFormatTrue($question, $var)
    {
    if(!is_null($var))
    return
       str_replace("_______", "<strong>".$var."</strong>", $question);
    else return $question;
    }

function analizFormatFalse($question, $var, $right)
    {
    if(!is_null($var))
    return str_replace("_______", "<i style='text-decoration: line-through;'>".$var."</i>"." <strong>".$right."</strong>",  $question);
    else return $question;
    }

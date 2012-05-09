<?php

function get_relative_date($date = 0)
{
    if ( ! $date) 
        return 'never';
	
    $current_day = date("d");
    $current_year = date("Y");
    
    if (date("d", $date) == $current_day)
        return date("g:i a", $date);
        
    elseif(date("Y", $date) == $current_year)
        return date("M d", $date);
        
    else
        return date("m/d/y", $date);

}
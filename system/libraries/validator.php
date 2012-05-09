<?php

class validator
{
    public function validate($text, $type)
    {
        if ( ! trim($text))
        {
            return true;
        }
        
        switch ($type)
        {
            case 'username':
                if ( ! preg_match("/^[A-Z]+[A-Za-z0-9_\-]+$/i", $text))
                   return false;
                else
                    return true;
                break;
                
            case 'url':
                if ( ! preg_match("/^[A-Za-z0-9_\-]+$/i", $text))
                   return false;
                else
                    return true;
                break;
            
            case 'email':
                if ( ! preg_match("/^[A-Z0-9._%-]+@[A-Z0-9][A-Z0-9.-]{0,61}[A-Z0-9]\.[A-Z]{2,6}$/i", $text))
                    return false;
                else
                    return true;
                break;
                
            default:
                return true;
                break;
        }
    }

}
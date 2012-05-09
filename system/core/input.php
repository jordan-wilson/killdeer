<?php

class input
{
    private $_post;
    private $_get;
    private $_cookie;
    private $_request;
    private $_session;

public function __construct()
    {
        // DISABLE MAGIC QUOTES
        if (get_magic_quotes_gpc())
            $this->_strip();
        
        // INTERNALIZE GLOBAL REQUEST VARS
        $this->_post    = $_POST;
        $this->_get     = $_GET;
        $this->_cookie  = $_COOKIE;
        $this->_request = $_REQUEST;
        $this->_session = $_SESSION;
        
        // CLEAR OUT GLOBAL REQUEST VARS
        $_POST    = array();
        $_GET     = array();
        $_COOKIE  = array();
        $_REQUEST = array();
        
    }
    
public function get($var_name = FALSE)
    {
        if ( ! $var_name)
            return $this->_get;
            
        elseif (isset($this->_get[$var_name]))
            return $this->_get[$var_name];
            
        else
            return false;
    }
    
public function post($var_name = FALSE)
    {
        if ( ! $var_name)
            return $this->_post;
            
        elseif (isset($this->_post[$var_name]))
            return $this->_post[$var_name];
            
        else
            return false;
    }
    
public function cookie($var_name = FALSE)
    {
        if ( ! $var_name)
            return $this->_cookie;
            
        elseif (isset($this->_cookie[$var_name]))
            return $this->_cookie[$var_name];
            
        else
            return false;
    }
    
public function request($var_name = FALSE)
    {
        if ( ! $var_name)
            return $this->_request;
            
        elseif (isset($this->_request[$var_name]))
            return $this->_request[$var_name];
            
        else
            return false;
    }
    
    
public function session($var_name = FALSE)
    {
        if ( ! $var_name)
            return $this->_session;
            
        elseif (isset($this->_session[$var_name]))
            return $this->_session[$var_name];
            
        else
            return false;
    }
    
    
private function _strip($array = array())
    {
        $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
        while (list($key, $val) = each($process)) 
        {
            foreach ($val as $k => $v) 
            {
                unset($process[$key][$k]);
                if (is_array($v)) 
                {
                    $process[$key][stripslashes($k)] = $v;
                    $process[] = &$process[$key][stripslashes($k)];
                } 
                else 
                {
                    $process[$key][stripslashes($k)] = stripslashes($v);
                }
            }
        }
        unset($process);
    }

}
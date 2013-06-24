<?php
session_start();

class CI_Session
{
    
    var $CI;
    var $DB;
    
    function CI_Session()
    {
        $this->CI =& get_instance();
        $this->DB = $this->CI->load->database();
    }
    
    function set_userdata($name, $value = NULL)
    {
        if( ! is_array($name))
        {
            if($value === NULL)
            {
                show_error("Second parameter for set_userdata missing.");
            } // if
            else
            {
                if(isset($_SESSION[$name]))
                {
                    unset($_SESSION[$name]);
                } // if
                $_SESSION[$name] = $value;
            } // else
        } // if
        else
        {
            foreach($name as $names => $key)
            {
                if(isset($_SESSION[$names]))
                {
                    unset($_SESSION[$names]);
                }
                $_SESSION[$names] = $key;
            } // forech
        } //  else
    } // set_userdata
    
    function userdata($item, $string = NULL)
    {
        if( ! $string === NULL)
        {
            if(!isset($_SESSION[$item]))
            {
                return FALSE;
            } // if
            else
            {
                return TRUE;
            } // else
        } // if
        else
        {
            if(!isset($_SESSION[$item]))
            {
                return FALSE;
            } // if
            else
            {
                return $_SESSION[$item];
            } // else
        } // else
    } // userdata
    
    function unset_userdata($userdata)
    {
        if(!is_array($userdata))
        {
            unset($_SESSION[$userdata]);
        } // if
        else
        {
            foreach($userdata as $item)
            {
                unset($_SESSION[$item]);
            } // foreach
        } // else
    } // unset_userdata
    function all_userdata(){
        return $_SESSION;
    }
    function sess_destroy()
    {
        session_destroy();
    } // session_destroy
    
}
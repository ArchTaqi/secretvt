<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  
class Event_logout_index extends CI_Controller
{
  
    private $CI;
    protected $xmlhttp;
    function __construct()
    {
        $this->CI = & get_instance();
        
        Events::register('after_logout', array($this, 'after_logout'));
        
    }
     
    public function after_logout() {
         
        $result = array();
        
        
        echo '
        <script>
            
            Gitple("shutdown");
        </script>
        ';

        
        $result['result'] = 1;
        
        return $result;
    }

    
}
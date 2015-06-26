<?php

class BitMemCache {

	private $memcache;
	private $logger;
	
	function __construct() {
		
	}
    
    function init($port=11211){
        
        if( !class_exists("Memcache") ){
            return false;
        }
        
        $this->memcache = new Memcache;
        if($this->memcache->connect('localhost', $port)){
            return true;
        }
        return false;
		
	}
    
	function set($key,$value){
		$this->memcache->set($key,$value);
		
	}
	
	function get($key){
		return $this->memcache->get($key);
	}
	
}
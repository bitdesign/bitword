<?

class BitTimer{

	
	function updateMemcache(){
	    
	   // ignore_user_abort();
	    //set_time_limit(0);
	    //$interval=3600; //(seconds)
		
		require_once('model/Feed.php');
		require_once('lib/BitMemCache.php');
		require_once('lib/RssReader.php');

		$feed = new Feed();
		$feeds = $feed->getFeeds();
	    
	    
	    $logger = LogUtil::getLogger();
	    //do{
	        include "config/site.php";
	        
	        foreach ($feeds as $feed){
	       
	            $url = $feed['url'];
    	        $mem = new BitMemCache();
                $reader = new RssReader();
                $rss = $reader ->fetch($url);
	
    		    if( !$rss){
    		        
    		    }else{
    		        if($mem->init()){
    		            
            		    $mem->set($url,json_encode($rss) );
            		    $logger->info("update memcache $url");
            	    }
    		    }
    		    
                
    	    }
	      //  sleep($interval);
	        
	    //}while($memcache);
	    
	    
	    
	}


	
}
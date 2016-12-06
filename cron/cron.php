<?php
		require_once "config.php";
	  	
	  	$results    = $db->get_results("SELECT * FROM domain_list Where domain_status = '1' and domain_tracking = 'Yes' ");
	  	if ( $db->num_rows >= '1'){
                        foreach ( $results as $db_rows ){

                        	$link = $db_rows->domain_link;
                        	echo Link_Control($link);
                        	
                        }
        }
    
?>
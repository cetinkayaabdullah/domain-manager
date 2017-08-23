<?php
 		
 		require_once "config.php";
 		login();
 		if ( isset($_GET['id']) and !empty($_GET['id']) ){ 

			$domain_id	=	strip_tags($_GET['id']);
 			$row        =   $db->get_row("DELETE FROM domain_list WHERE domain_id = '$domain_id' LIMIT 1");
 			
 			header("Location:table.php?alert=6");
            die; 			

 		}
?>
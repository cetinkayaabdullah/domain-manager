<?php
		
		require_once "config.php";
		login();

		if ( isset($_POST['domain_id']) AND !empty($_POST['domain_id'])){


			$domain_ns1					=		strip_tags( $_POST['domain_ns1']);
			$domain_ns2					=		strip_tags( $_POST['domain_ns2']);
			$domain_ns3					=		strip_tags( $_POST['domain_ns3']);
			
			$domain_ip1					=		Name_Server_IP ( strip_tags( $_POST['domain_ns1']) );
			$domain_ip2					=		Name_Server_IP ( strip_tags( $_POST['domain_ns2']) );
			$domain_ip3					=		Name_Server_IP ( strip_tags( $_POST['domain_ns3']) );

			$domain_company				=		strip_tags( $_POST['domain_company']);
			$domain_update_time			=		time();
			$domain_expiration_date		=		strtotime ( $_POST['domain_expiration_date']);
			$domain_creation_date		=		strtotime ( $_POST['domain_creation_date']);

			$content					=		strip_tags( $_POST['content'] );

			$domain_id 					=		strip_tags( $_POST['domain_id']);
			$result						=		$db->query("UPDATE domain_list SET

																					domain_ns1				=		'$domain_ns1',
																					domain_ns2				=		'$domain_ns2',
																					domain_ns3				=		'$domain_ns3',
																					domain_ip1				=		'$domain_ip1',
																					domain_ip2				=		'$domain_ip2',
																					domain_ip3				=		'$domain_ip3',
																					domain_company			=		'$domain_company',
																					domain_update_date 		= 		'$domain_update_time',
																					domain_expiration_date	=		'$domain_expiration_date',
																					domain_creation_date	=		'$domain_creation_date',
																					domain_content			=		 '$content'

																				WHERE domain_id = '$domain_id' ");
			echo $value	=	"Location:view.php?id=".$domain_id;
			header($value);
			die;


		}else{

 				header("Location:table.php?alert=6");
				die;

		}
?>
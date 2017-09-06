<?php
		require_once "../config.php";

		$row		=	$db->get_row("SELECT * FROM domain_list WHERE domain_ext != 'other' ORDER BY domain_update_date ASC LIMIT 1");
		$domain_id 	= 	$row->domain_id;
		echo "Domain :  ".$domain_link 	= 	$row->domain_link;
		echo "<br>";
		

		if (isset ($domain_id) and !empty($domain_id)){

			 	
			$row		=	$db->get_row("SELECT * FROM domain_list Where domain_id = '$domain_id' LIMIT 1");
            
			if ( $db->num_rows == '1'){
				
				$uzanti = $row->domain_ext;
		
		if ( $uzanti == '.com' or $uzanti == '.net' ){
					
				/* Name Server Bulmak İçin*/
				$link		=	trim ( 'http://whois.hosting.info.tr/'.$row->domain_link);
				$baglan 	=	Connect ($link);
				$regex		=	"/Name Server: ([a-zA-ZÇŞĞÜÖİçşğüöı.0-9]+)/";
				preg_match_all($regex, $baglan, $new);
				
				$domain_ns1 = strip_tags($new[1][0]);
				$domain_ns2 = strip_tags($new[1][1]);
				
				if (isset ($new[1][2])){ $domain_ns3 = strip_tags($new[1][2]); }else{ $domain_ns3 = ""; }
				/* Name Server Bulmak İçin*/

                $regex		= "/(Registry Expiry Date:)( )(?<Y>[0-9][0-9][0-9][0-9])-(?<A>[0-9][0-9])-(?<G>[0-9][0-9])/";
                preg_match_all($regex, $baglan, $value);

                $Expiration_Date			=	$value[5][0].'-'.$value[4][0].'-'.$value[3][0];
                $domain_expiration_date		=	strtotime($Expiration_Date);

				/* Domain Bitiş Süresini Bulmak İçin */

                /* Domain Başlangıç Süresini Bulmak İçin */
                $regex		= "/(Creation Date:)( )(?<Y>[0-9][0-9][0-9][0-9])-(?<A>[0-9][0-9])-(?<G>[0-9][0-9])/";
                preg_match_all($regex, $baglan, $value);

                $Creation_Date				=	$value[5][0].'-'.$value[4][0].'-'.$value[3][0];
                $domain_creation_date		=	strtotime($Creation_Date);
				

				/* Domain Başlangıç Süresini Bulmak İçin */
				
				/* Name Serverların IP Bulmak İçin */
				$domain_ip1		=	Name_Server_IP($domain_ns1);
				$domain_ip2		=	Name_Server_IP($domain_ns2);
				
				if ($domain_ns3 != ""){
										$domain_ip3		=	Name_Server_IP($domain_ns3);
				}else{
					$domain_ip3	= '';
				}
				/* Name Serverların IP Bulmak İçin */
				
				$domain_update_date		=	time();
				$result					=	$db->query("UPDATE domain_list SET

																			domain_ns1				=		'$domain_ns1',
																			domain_ns2				=		'$domain_ns2',
																			domain_ns3				=		'$domain_ns3',
																			domain_ip1				=		'$domain_ip1',
																			domain_ip2				=		'$domain_ip2',
																			domain_ip3				=		'$domain_ip3',
																			domain_update_date 		= 		'$domain_update_date',
																			domain_expiration_date	=		'$domain_expiration_date',
																			domain_creation_date	=		'$domain_creation_date'

																		 WHERE domain_id = '$domain_id' ");
				
		}

		

		if ( $uzanti == '.org' ){
					
				/* Name Server Bulmak İçin*/
				$link		=	trim ( 'http://whois.hosting.info.tr/'.$row->domain_link);
				$baglan 	=	Connect ($link);
				$regex		=	"/Name Server: ([a-zA-ZÇŞĞÜÖİçşğüöı.0-9]+)/";
				preg_match_all($regex, $baglan, $new);
				
				$domain_ns1 = strip_tags($new[1][0]);
				$domain_ns2 = strip_tags($new[1][1]);
				
				
				if (isset ($new[1][2])){ $domain_ns3 = strip_tags($new[1][2]); }else{ $domain_ns3 = ""; }
				/* Name Server Bulmak İçin*/
				
				
				/* Domain Bitiş Süresini Bulmak İçin */
				$regex						=	"/(Registry Expiry Date:)( )(?<Y>[0-9][0-9][0-9][0-9])-(?<A>[0-9][0-9])-(?<G>[0-9][0-9])/";
				preg_match_all($regex, $baglan, $value);

				$Expiration_Date			=	$value[5][0].'.'.$value[4][0].'.'.$value[3][0];
				$domain_expiration_date		=	strtotime($Expiration_Date);
				/* Domain Bitiş Süresini Bulmak İçin */

				/* Domain Başlangıç Süresini Bulmak İçin */
				$regex						=	"/(Creation Date:)( )(?<Y>[0-9][0-9][0-9][0-9])-(?<A>[0-9][0-9])-(?<G>[0-9][0-9])/";
				preg_match_all($regex, $baglan, $value);

				$Creation_Date				=	$value[5][0].'.'.$value[4][0].'.'.$value[3][0];
				$domain_creation_date		=	strtotime($Creation_Date);
				/* Domain Başlangıç Süresini Bulmak İçin */
				
				/* Name Serverların IP Bulmak İçin */
				$domain_ip1		=	Name_Server_IP($domain_ns1);
				$domain_ip2		=	Name_Server_IP($domain_ns2);
				
				if ($domain_ns3 != ""){
										$domain_ip3		=	Name_Server_IP($domain_ns3);
				}else{
					$domain_ip3	= '';
				}
				/* Name Serverların IP Bulmak İçin */
				
				$domain_update_date		=	time();
				$result					=	$db->query("UPDATE domain_list SET

																			domain_ns1				=		'$domain_ns1',
																			domain_ns2				=		'$domain_ns2',
																			domain_ns3				=		'$domain_ns3',
																			domain_ip1				=		'$domain_ip1',
																			domain_ip2				=		'$domain_ip2',
																			domain_ip3				=		'$domain_ip3',
																			domain_update_date 		= 		'$domain_update_date',
																			domain_expiration_date	=		'$domain_expiration_date',
																			domain_creation_date	=		'$domain_creation_date'

																		 WHERE domain_id = '$domain_id' ");
				
		}

		

		if ( $uzanti == '.biz' ){
					
				/* Name Server Bulmak İçin*/
				$link		=	trim ( 'http://whois.hosting.info.tr/'.$row->domain_link);
				$baglan 	=	Connect ($link);
				$regex		=	"/Name Server:(.*?)([a-zA-ZÇŞĞÜÖİçşğüöı.0-9]+)/";
				preg_match_all($regex, $baglan, $new);
				
				$domain_ns1 = strip_tags($new[2][0]);
				$domain_ns2 = strip_tags($new[2][1]);
				
				
				if (isset ($new[2][2])){ $domain_ns3 = strip_tags($new[2][2]); }else{ $domain_ns3 = ""; }
				/* Name Server Bulmak İçin*/
				
				
				/* Domain Bitiş Süresini Bulmak İçin */
				$regex						=	"/(Domain Expiration Date:)(.*?)([A-Za-z]*)( )([A-Za-z]*) ([0-9][0-9])(.*?)([0-9][0-9][0-9][0-9])/";
				preg_match_all($regex, $baglan, $value);

				$Expiration_Date			=	$value[6][0].'.'.$value[5][0].'.'.$value[8][0];
				$domain_expiration_date		=	strtotime($Expiration_Date);
				/* Domain Bitiş Süresini Bulmak İçin */

				

				/* Domain Başlangıç Süresini Bulmak İçin */
				$regex						=	"/(Domain Registration Date:)(.*?)([A-Za-z]*)( )([A-Za-z]*) ([0-9][0-9])(.*?)([0-9][0-9][0-9][0-9])/";
				preg_match_all($regex, $baglan, $value);

				$Creation_Date				=	$value[6][0].'.'.$value[5][0].'.'.$value[8][0];
				$domain_creation_date		=	strtotime($Creation_Date);

				/* Domain Başlangıç Süresini Bulmak İçin */
				
				/* Name Serverların IP Bulmak İçin */
				$domain_ip1		=	Name_Server_IP($domain_ns1);
				$domain_ip2		=	Name_Server_IP($domain_ns2);
				
				if ($domain_ns3 != ""){
										$domain_ip3		=	Name_Server_IP($domain_ns3);
				}else{
					$domain_ip3	= '';
				}
				/* Name Serverların IP Bulmak İçin */
				
				$domain_update_date		=	time();
				$result					=	$db->query("UPDATE domain_list SET

																			domain_ns1				=		'$domain_ns1',
																			domain_ns2				=		'$domain_ns2',
																			domain_ns3				=		'$domain_ns3',
																			domain_ip1				=		'$domain_ip1',
																			domain_ip2				=		'$domain_ip2',
																			domain_ip3				=		'$domain_ip3',
																			domain_update_date 		= 		'$domain_update_date',
																			domain_expiration_date	=		'$domain_expiration_date',
																			domain_creation_date	=		'$domain_creation_date'

																		 WHERE domain_id = '$domain_id' ");
				
		}


		if ( $uzanti == '.info' ){
					
				/* Name Server Bulmak İçin*/
				$link		=	trim ( 'http://whois.hosting.info.tr/'.$row->domain_link);
				$baglan 	=	Connect ($link);
				$regex		=	"/Name Server: ([a-zA-ZÇŞĞÜÖİçşğüöı.0-9]+)/";
				preg_match_all($regex, $baglan, $new);
				
				$domain_ns1 = strip_tags($new[1][0]);
				$domain_ns2 = strip_tags($new[1][1]);
				
				if (isset ($new[1][2])){ $domain_ns3 = strip_tags($new[1][2]); }else{ $domain_ns3 = ""; }
				/* Name Server Bulmak İçin*/
				
				/* Domain Bitiş Süresini Bulmak İçin */
				$regex		= "/(Registry Expiry Date:)(.*?)([0-9][0-9][0-9][0-9])-([0-9][0-9])-([0-9][0-9])/";
				preg_match_all($regex, $baglan, $value);

				$Expiration_Date			=	$value[5][0].'.'.$value[4][0].'.'.$value[3][0];
				$domain_expiration_date		=	strtotime($Expiration_Date);
				/* Domain Bitiş Süresini Bulmak İçin */
				

				/* Domain Başlangıç Süresini Bulmak İçin */
				$regex		= "/(Creation Date:)(.*?)([0-9][0-9][0-9][0-9])-([0-9][0-9])-([0-9][0-9])/";
				preg_match_all($regex, $baglan, $value);

				$Creation_Date				=	$value[5][0].'.'.$value[4][0].'.'.$value[3][0];
				$domain_creation_date		=	strtotime($Creation_Date);
				
				
				/* Domain Başlangıç Süresini Bulmak İçin */
				
				/* Name Serverların IP Bulmak İçin */
				$domain_ip1		=	Name_Server_IP($domain_ns1);
				$domain_ip2		=	Name_Server_IP($domain_ns2);
				
				if ($domain_ns3 != ""){
										$domain_ip3		=	Name_Server_IP($domain_ns3);
				}else{
					$domain_ip3	= '';
				}
				/* Name Serverların IP Bulmak İçin */
				
				$domain_update_date		=	time();
				$result					=	$db->query("UPDATE domain_list SET

																			domain_ns1				=		'$domain_ns1',
																			domain_ns2				=		'$domain_ns2',
																			domain_ns3				=		'$domain_ns3',
																			domain_ip1				=		'$domain_ip1',
																			domain_ip2				=		'$domain_ip2',
																			domain_ip3				=		'$domain_ip3',
																			domain_update_date 		= 		'$domain_update_date',
																			domain_expiration_date	=		'$domain_expiration_date',
																			domain_creation_date	=		'$domain_creation_date'

																		 WHERE domain_id = '$domain_id' ");
				
		}

		if ( $uzanti == '.com.tr' or $uzanti == '.net.tr' or $uzanti == '.org.tr' ){
					
				/* Name Server Bulmak İçin*/
				$link		=	trim ( 'http://whois.hosting.info.tr/'.$row->domain_link);
				$baglan 	=	Connect ($link);
				$regex 		=	"/([>])([A-Za-z0-9-]+[\.][A-Za-z0-9-]+[\.][A-Za-z0-9-\.]+)/";
				
				preg_match_all($regex, $baglan, $new);
				
				$domain_ns1 = strip_tags($new[2][1]);
				$domain_ns2 = strip_tags($new[2][2]);
				
				if (isset ($new[2][3])){ $domain_ns3 = strip_tags($new[2][3]); }else{ $domain_ns3 = ""; }
				/* Name Server Bulmak İçin*/
				
				/* Domain Bitiş Süresini Bulmak İçin */
				$regex		= "/(Expires on..............:) ([0-9]{4})-([a-zA-Z]{3})-([0-9]{2})/";
				preg_match_all($regex, $baglan, $value);

				$Expiration_Date			=	$value[4][0].'.'.$value[3][0].'.'.$value[2][0];
				$domain_expiration_date		=	strtotime($Expiration_Date);
				/* Domain Bitiş Süresini Bulmak İçin */
				
				/* Domain Başlangıç Süresini Bulmak İçin */
				$regex		= "/(Created on..............:) ([0-9]{4})-([a-zA-Z]{3})-([0-9]{2})/";
				preg_match_all($regex, $baglan, $value);

				if (isset($value[5][0]) and !empty($value[5][0] and isset($value[4][0]) and !empty($value[4][0]) and isset($value[3][0]) and !empty($value[3][0]))){
                    $Creation_Date				=	$value[5][0].'.'.$value[4][0].'.'.$value[3][0];
                    $domain_creation_date		=	strtotime($Creation_Date);
                }else{
                    $domain_creation_date       =   '';
                }


				
				
				/* Domain Başlangıç Süresini Bulmak İçin */
				
				/* Name Serverların IP Bulmak İçin */
				$domain_ip1		=	Name_Server_IP($domain_ns1);
				$domain_ip2		=	Name_Server_IP($domain_ns2);
				
				if ($domain_ns3 != ""){
										$domain_ip3		=	Name_Server_IP($domain_ns3);
				}else{
					$domain_ip3	= '';
				}
				/* Name Serverların IP Bulmak İçin */
				
				$domain_update_date		=	time();
				$result					=	$db->query("UPDATE domain_list SET

																			domain_ns1				=		'$domain_ns1',
																			domain_ns2				=		'$domain_ns2',
																			domain_ns3				=		'$domain_ns3',
																			domain_ip1				=		'$domain_ip1',
																			domain_ip2				=		'$domain_ip2',
																			domain_ip3				=		'$domain_ip3',
																			domain_update_date 		= 		'$domain_update_date',
																			domain_expiration_date	=		'$domain_expiration_date',
																			domain_creation_date	=		'$domain_creation_date'

																		 WHERE domain_id = '$domain_id' ");
				
		}
	
				
						
				
			}


		}

		echo "Days Remaining : ".Days_Remaining($domain_id);
		echo "<br><br><b>A domain every 10 seconds. Leave the browser open</b>";
		header( "refresh:10;url=autoupload.php" );//Yenileme Süresi 10 Saniye

?>
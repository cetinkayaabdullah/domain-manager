<?php
		/* Veri Tabanı Bağlantısı */
		require_once "db/db.php";
		
		function Connect($url){
												$curl = curl_init();
												curl_setopt($curl, CURLOPT_URL, $url);
												curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
												curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
												$cikti = curl_exec($curl);
												curl_close($curl);
												return str_replace(array("\n","\t","\r"), null, $cikti);
		}

		function Days_Remaining($value){
				
				global $db;

				$$value 	=	strip_tags($value);
				$row		=	$db->get_row("SELECT * FROM domain_list Where domain_status = '1' and domain_id = '$value' LIMIT 1");

				$domain_expiration_date		=	 	$row->domain_expiration_date;
				$today_date					=		time();
				
				$fark 	      	=	abs($domain_expiration_date-$today_date);
				$toplantiSure	=	round($fark/60/60/24);

				return $toplantiSure ;

							}

		function Days_Update($value){
				
				$today_date					=		time();
				
				$fark 	      	=	abs($value-$today_date);
				$toplantiSure	=	round($fark/60/60/24);

				return $toplantiSure ;

							}
		
		function Name_Server_IP($value){

				/* Name Serverların IP Bulmak İçin */
				$nsv1			= 	"http://www.ipsorgu.com/site_ip_adresi_sorgulama.php?site=".$value."#sorgu";
				$ns1baglanti	=	Connect ($nsv1);
				preg_match_all('#<span style="(.*?)">(.*?)</span>#', $ns1baglanti, $kontrol);
				$Domain_IP		=	$kontrol[2][2];

				return $Domain_IP;
		}

		function login (){


				if (!isset($_SESSION['ok']) ){
								header("Location:login.php");
								die;
				}

				

				if ((isset($_SESSION['ok'])) and ($_SESSION['ok'] != '998574') or (empty($_SESSION['ok'])) ){

				header("Location:logout.php");
				die;
				
				}


		}

		function Registered ($value){
			global $db;
			$row  = $db->get_row("SELECT * FROM registered_list WHERE reg_id = '$value'");
			echo $row->reg_title;
			return; 
		}

		/*R10.net @Justian0 */
		function Link_Control($link) {	

			$time = time();
								        $main	= array();
								        $ch 	= curl_init();
								        curl_setopt ($ch, CURLOPT_URL, $link);
								        curl_setopt ($ch, CURLOPT_HEADER, 1);
								        curl_setopt ($ch, CURLOPT_NOBODY, 1);
								        @curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
								        curl_setopt ($ch, CURLOPT_NETRC, 1);
								        curl_setopt ($ch, CURLOPT_TIMEOUT, 10);
								        ob_start();
								        curl_exec ($ch);
								        $stuff = ob_get_contents();
								        ob_end_clean();
								        curl_close ($ch);

								        $parts = split("\n",$stuff,2);
								        $main = split(" ",$parts[0],3);
								        if(@$don =  ($main[2])){
								            echo "Açık Siteler : ".$link.' <br>';
								            global $db;
								            $register = $db->query("INSERT INTO domain_logs (
								                                                        logs_link,
								                                                        logs_time,
								                                                        logs_type
								                                                      
								                                                      ) VALUES (
								                                                      
								                                                        '$link',
								                                                        '$time',
								                                                        'Open' )");
								        }else{
								            echo "Kapalı Siteler : ".$link.' <br>';
								            global $db;
								            $register = $db->query("INSERT INTO domain_logs (
								                                                        logs_link,
								                                                        logs_time,
								                                                        logs_type
								                                                      
								                                                      ) VALUES (
								                                                      
								                                                        '$link',
								                                                        '$time',
								                                                        'Closed' )");
								        }
    	}
    	/*R10.net @Justian0 */

        function MoneyTotal($value){
            global $db;
            $total = 0;
            $get_results   =   $db->get_results("SELECT * FROM domain_money WHERE money_domain_id = '$value' ");
            if ( $db->num_rows >= '1'){
                foreach ( $get_results as $db_rows ){
                    $total = $total+$db_rows->money_value;
                }
                echo $total." TL";
                return;
            }else{

                $total = "0 TL";
                echo $total;
                return;

            }

        };

        function MoneyTotalGeneral(){
            global $db;
            $total = 0;
            $get_results   =   $db->get_results("SELECT * FROM domain_money ");
            if ( $db->num_rows >= '1'){
                foreach ( $get_results as $db_rows ){
                    $total = $total+$db_rows->money_value;
                }
                echo $total." TL";
                return;
            }else{

                $total = "0 TL";
                echo $total;
                return;

            }

        };
?>
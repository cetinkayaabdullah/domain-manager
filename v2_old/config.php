<?php


			/*****************************************************
			*
			*  Author....: Abdullah Çetinkaya (mail@abdullahcetinkaya.com.tr)
			*  Web.......: http://www.abdullahcetinkaya.com.tr
			*  Register..: 2016, Eylül
			*
			*****************************************************/
			session_start();
			ob_start();
			
			/* Veri Tabanı Bağlantısı */
			require_once "db/db.php";

			/* Function */
			require_once "function.php";

			$_title = "Domain Manager";
			$_link  = "http://localhost/domain-manager/v2_old/";

?>
<?php
		/* ezSQL Çekirdek */
		@include_once "ezsql/ez_sql_core.php";
		@include_once "ezsql/ez_sql_mysql.php";
		
		// Veri Tabanı Bilgileri		
		$db_kullanici		=	"root";
		$db_parola		=	"";
		$db_isim		=	"domain_manager";
		$db_sunucu		=	"localhost";
		
		// Veri Tabanına Bağlanmak
		$db = new ezSQL_mysql($db_kullanici,$db_parola,$db_isim,$db_sunucu);
		
		// Set Ayarları
		$db->query("SET NAMES UTF8");
		$db->query("SET CHARACTER SET utf8");
		$db->query("SET COLLATION_CONNECTION = 'utf8_general_ci' "); 

?>

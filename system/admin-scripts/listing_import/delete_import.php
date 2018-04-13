<?php

if (isset ( $_GET ['id'] ) && intval ( $_GET ['id'] ) > 0) {
	
	SJB_DB::query ( "DELETE FROM parsers WHERE id= ?s", intval ( $_GET ['id'] ) );
	SJB_DB::query ( "DELETE FROM parsers_url WHERE id_parser= ?s", intval ( $_GET ['id'] ) );
}

$site_url = SJB_System::getSystemSettings ( "SITE_URL" );
SJB_HelperFunctions::redirect ( $site_url . "/show-import/" );


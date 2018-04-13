<?php
$configArr	=	array(
"DBHOST" => "localhost",
"DBNAME" => "nabjcar_sjb",
"DBUSER" => "nabjcar_sjb",
"DBPASSWORD" => "c36vs4uv9n",
"SITE_URL" => "http://{$_SERVER['HTTP_HOST']}",
"MYSQL_CHARSET" => "utf8",
"ADMIN_SITE_URL" => "https://{$_SERVER['HTTP_HOST']}/admin",
"USER_SITE_URL" => "http://{$_SERVER['HTTP_HOST']}",
);


if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') { 
	$configArr['SITE_URL']	=	"https://{$_SERVER['HTTP_HOST']}";
} 

return $configArr;
?>
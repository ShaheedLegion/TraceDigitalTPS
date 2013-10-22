<?php

	// Database credentials
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_TYPE', 'sqlite');
	define('DB_NAME', 'C:\tracedigital_db.sq3');
	define('WEBSITE', $_SERVER['SERVER_ADDR']);
	define('MAIL_NAME', 'trace.production.system@gmail.com');
	define('MAIL_PASS', 'tdomg42system');
	
	//comment out once site goes "live" to avoid displaying debug traces to end users
	//define('DEBUG_MSG', 'On');
	define('DEBUG_MSG', 'Off');

?>

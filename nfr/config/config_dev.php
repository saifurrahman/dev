<?php
// Always provide a TRAILING SLASH (/) AFTER A PATH
//define('URL', 'http://www.example.com/');
date_default_timezone_set('Asia/Calcutta');
if(!empty($_SERVER['HTTPS'])) {
 	define('protocol', 'https');
}
else{
	define('protocol', 'http');
}
define('URL', protocol.'://localhost:8888/dev/nfr/');
define('LIBS', 'libs/');
//database connection
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost:8889');
define('DB_NAME', 'nfr_new');
define('DB_USER', 'root');
define('DB_PASS', 'root');
// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', 'GlomindzSoftwarePrivateLimited');
// This is for database passwords only
define('HASH_PASSWORD_KEY', 'catsFLYhigh2000miles');
//tables

define('TABLE_USER_MASTER', 'nfr_user_master');
define('TABLE_ROLE_MASTER','nfr_role_master');
define('TABLE_STATION_MASTER', 'nfr_station_master');
define('TABLE_DISTRICT_MASTER', 'nfr_district_master');
define('TABLE_SCHEDULE_CODE_MASTER', 'nfr_schedule_code_master');
define('TABLE_STATION_GEAR_MASTER', 'nfr_station_gear_master');
define('TABLE_GEAR_TYPE_MASTER', 'nfr_gear_type_master');
define('TABLE_MAINTAINANCE_SCHEDULE_LEDGER', 'nfr_maintenance_schedule_ledger');

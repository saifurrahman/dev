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
define('URL', protocol.'://nfr-glomindz.rhcloud.com/');
define('LIBS', 'libs/');
//database connection
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.7.68.2');
define('DB_NAME', 'nfr');
define('DB_USER', 'adminTSd4ygg');
define('DB_PASS', 'IxTiqcTHNtVY');
// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', 'GlomindzSoftwarePrivateLimited');
// This is for database passwords only
define('HASH_PASSWORD_KEY', 'catsFLYhigh2000miles');
//tables
define('TABLE_USER_MASTER', 'nfr_user_master');
define('TABLE_STATION_MASTER', 'nfr_station_master');
define('TABLE_GEAR_MASTER', 'nfr_gear_master');
define('TABLE_DISTRICT_MASTER', 'nfr_district_master');
define('TABLE_TRACK_MASTER', 'nfr_track_master');
define('TABLE_STATION_GEAR_MASTER', 'nfr_station_gear_master');
define('TABLE_MAINTAINANCE_SCHEDULE_LEDGER', 'nfr_mainainace_schedule_ledger');
define('TABLE_ROLE_MASTER','nfr_role_master');
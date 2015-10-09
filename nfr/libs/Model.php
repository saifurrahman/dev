<?php

class Model {

    function __construct() {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    }

    public function clear_input_string($str) {
        $search = array('@<script[^>]*?>.*?</script>@si', //Strip out javascript
            '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags
            '@<style[^>]*?>.*?</style>@siU', // Strip style tags properly
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
        );
        $str = preg_replace($search, '', $str);
        $str = str_replace(array("'", "'", "'", '"'), array("&#39;", "&quot;", "&#39;", "&quot;"), $str);
        return $str;
    }
    public function generate_password(){
        $chars = "0123456789ABCDEabcde";
        return substr(str_shuffle($chars), 0, 6);
    }
    public function convert_to_mysqlDateFormate($getdate){
        //to yyyy-mm-dd
    	$date = DateTime::createFromFormat('d-m-Y', $getdate);
    	$date = $date->format('Y-m-d');
    	return $date;
    }
    public function closeConnection(){
    	$this->db=null;
    }
    
    function getToken(){
    	$length=48;
    	$key = '';
    	$keys = array_merge(range(0, 9), range('a', 'z'));
    	for ($i = 0; $i < $length; $i++) {
    		$key .= $keys[array_rand($keys)];
    	}
    	return $key;
    }
}
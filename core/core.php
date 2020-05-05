<?php
    define('__ROOT__',dirname(__FILE__).'/../');

    require_once __ROOT__.'./config/global.config.php';
    require_once  __ROOT__.'./config/db.config.php';

    function mtime()
    {
        $t = explode(' ',microtime());
        $t = $t[0] * 1000;
        return round($t,0);
    }

    function udate($format)
    {
        return date(preg_replace('`(?<!\\\\)u`',mtime(),$format));
    }

    function guid() {
        if (function_exists('com_create_guid')){
            $uuid = com_create_guid();
        }else{
            mt_srand();//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = "-";
            $uuid = "{"
                .substr($charid,0,8 ).$hyphen
                .substr($charid, 8,4 ).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20)
                ."}";
        }
        return $uuid;
    }

    $blacklist = ['order by','or','and','rpad','concat',' ','union','%a0',',','if','xor','join','rand','floor','outfile','mid','#','\|\|','--+','0[xX][0-9a-fA-F]+'];
    foreach ($_POST as $key => $value)
    {
        foreach ($blacklist as $blackItem){
            if (preg_match('/\b' . $blackItem . '\b/im', $value)) {
                die('非法参数');
            }
        }
    }

?>
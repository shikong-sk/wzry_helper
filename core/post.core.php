<?php
    set_time_limit(0);
    header('Content-Type:application/json; charset=utf-8');
    function getHero($hero)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/../hero.php');
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1 )");      //伪装浏览器UA
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);                                                 //HTTPS
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);                                                             //是否显示HTTP请求头
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '英雄=' . $hero);                                           //POST参数
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    if(isset($_POST['sub']) && isset($_POST['英雄']))
    {
//        $hero = json_decode(getHero($_POST['英雄']),true);
        exit(getHero($_POST['英雄']));
    }
?>
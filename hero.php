<?php
    require_once './core/core.php';
    header('Content-Type:application/json; charset=utf-8');
    $hero_table = '英雄属性';
    $hero_sql = 'select * from '.$dbname.'.'.$tbname.$hero_table.' where 英雄 = "'.$_POST['英雄'].'"';
    $res = $database->query($hero_sql);
    while ($r = $res->fetch_assoc())
    {
        $json = json_encode($r,JSON_UNESCAPED_UNICODE);
        exit($json);
    }
?>
<?php
    require_once './core.php';

    $percent = Array('攻速成长','基础暴击率','基础暴击效果');
    $hero_table = '英雄属性';

    function showHero(){
        global $database,$dbname,$tbname;
        global $percent;
        global $hero_table;
        $hero_sql = 'select * from '.$dbname.'.'.$tbname.$hero_table .' order by 英雄 desc';
        $res = $database->query($hero_sql);
        $r = $res->fetch_assoc();
        mysqli_data_seek($res,0);
        foreach (array_keys($r) as $key)
        {
            echo '<p style="display: inline-block;width: 50px;font-size: 12px;text-align: center;margin-bottom: 5px;">'.$key.' </p>';
        }
        while ($r = $res->fetch_assoc())
        {
            foreach ($r as $key => $value)
            {
                if(in_array($key,$percent))
                {
                    $value = $value * 100 .'%';
                }
                echo '<p style="display: inline-block;width: 50px;font-size: 12px;text-align: center;margin-bottom: 5px;">'.$value.' </p>';
            }
            echo '<br>';
        }
    }

    function addHero(){
        global $database,$dbname,$tbname;
        global $percent;
        global $hero_table;
        $hero_sql = 'select * from '.$dbname.'.'.$tbname.$hero_table .' order by 英雄 desc limit 0,1';
        $res = $database->query($hero_sql);
        $r = array_keys($res->fetch_assoc());
        echo '<script>window.onload = function (){document.getElementsByTagName("body")[0].addEventListener("keydown",function(event) {if(event.keyCode == 13){document.getElementById("add").click();}})}</script>';
        foreach ($r as $key)
        {
            echo '<p style="display: inline-block;width: 50px;font-size: 12px;text-align: center;margin-bottom: 5px;">'.$key.' </p>';
        }
        echo '<form action="" method="post">';
        foreach ($r as $key)
        {
            echo '<input name="'.$key.'" style="display: inline-block;width: 50px;font-size: 12px;text-align: center;margin-bottom: 5px;" '.($key == "英雄"?"autofocus='autofocus'":'').'>';
        }
        echo '<input id="add" type="submit" value="提交" style="width: 100%" name="add">';
        echo '</form>';
    }

    addHero();
    showHero();
    if(isset($_POST['add']))
    {
        $key = array('英雄','主定位','副定位','皮肤加成','基础生命值','生命值成长','满级生命值','基础能量值','能量值成长','满级能量值','基础物理攻击','物理攻击成长','满级物理攻击','基础物理防御','物理防御成长','满级物理防御','基础法术防御','法术防御成长','满级法术防御','基础移速','攻速成长','基础暴击率','基础暴击效果','攻击范围','基础回血','回血成长','满级回血','基础回蓝','回蓝成长','满级回蓝');
        $null = array('副定位','皮肤加成','基础能量值','能量值成长','满级能量值','基础回蓝','回蓝成长','满级回蓝');
        foreach ($key as $x)
        {
            if(isset($_POST[$x]))
            {
                if($_POST[$x] == '')
                {
                    if(in_array($x,$null))
                    {
                        $_POST[$x] = 'NULL';
                    }
                    else
                    {
//                        $error = '';
//                        foreach(array_diff($key,$null) as $e)
//                            $error .= $e.',';
//                        $error = rtrim($error,',');
//                        die('参数有误：<br>'.$error.'<br>不能为空');
                        die('参数有误：<span style="color: red">'.$x.'属性</span> 不能为空');
                    }
                }
            }
            else
            {
                die('参数有误');
            }
        }
        $hero_insert = "
        INSERT INTO ".$dbname.".".$tbname.$hero_table." (英雄,主定位,副定位,皮肤加成,基础生命值,生命值成长,满级生命值,基础能量值,能量值成长,满级能量值,基础物理攻击,物理攻击成长,满级物理攻击,基础物理防御,物理防御成长,满级物理防御,基础法术防御,法术防御成长,满级法术防御,基础移速,攻速成长,基础暴击率,基础暴击效果,攻击范围,基础回血,回血成长,满级回血,基础回蓝,回蓝成长,满级回蓝) 
        VALUES ('".$_POST['英雄']."','".$_POST['主定位']."',".(($_POST['副定位'] == 'NULL')?"NULL":("'".$_POST['副定位']."'")).",'".$_POST['皮肤加成']."',".$_POST['基础生命值'].",".$_POST['生命值成长'].",".$_POST['满级生命值'].",".$_POST['基础能量值'].",".$_POST['能量值成长'].",".$_POST['满级能量值'].",".$_POST['基础物理攻击'].",".$_POST['物理攻击成长'].",".$_POST['满级物理攻击'].",".$_POST['基础物理防御'].",".$_POST['物理防御成长'].",".$_POST['满级物理防御'].",".$_POST['基础法术防御'].",".$_POST['法术防御成长'].",".
            $_POST['满级法术防御'].",".$_POST['基础移速'].",".$_POST['攻速成长'].",".$_POST['基础暴击率'].",".$_POST['基础暴击效果'].",'".$_POST['攻击范围']."',".$_POST['基础回血'].",".$_POST['回血成长'].",".$_POST['满级回血'].",".$_POST['基础回蓝'].",".$_POST['回蓝成长'].",".$_POST['满级回蓝'].");";
        echo $hero_insert;
        if($database->query($hero_insert) === FALSE)
        {
            echo '<br>数据添加失败，请检查参数是否有误<br>';
            die($database->error);
        }
        else
        {
            echo '<br>数据添加成功<br>';
        }
    }
?>
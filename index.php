<?php
    require_once './core/core.php';
?>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./template/global/css/bootstrap.css">
    <link rel="stylesheet" href="./template/global/css/animate.css">
    <link href="./template/global/css/font-awesome.min.css" rel="stylesheet">

    <script src="./template/global/js/jquery-1.12.4.min.js"></script>
    <script src="./template/global/js/jquery.color.js"></script>
    <script src="./template/global/js/jquery.immersive-slider.js"></script>
    <script src="./template/global/js/bootstrap.min.js"></script>
    <script src="./template/global/js/wow.min.js"></script>
    <link href="./template/global/css/portfolio.css" type="text/css" rel="stylesheet" media="all">

    <script src="./core/core.js"></script>
    <script src="./core/hero.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="input-group" style="margin-top: 10px;">
            <div class="input-group-prepend">
                <span class="input-group-text">英雄</span>
            </div>
            <input style="text-align: center" type="text" name="hero" class="form-control" placeholder="输入要查询的英雄的名称" autofocus="autofocus">
            <button type="submit" name="sub" class="btn btn-primary">查询</button>
        </div>
        <div id="data"></div>
    </div>
</body>

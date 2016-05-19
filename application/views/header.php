<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>餐库</title>
    <link href="<?php echo base_url();?>static/css/style.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url();?>static/js/jquery.js" type="text/javascript"></script>
</head>
<body>
<header id="head">
    <div class="nav">
        <div class="wap">
            <div title="餐库" class="logo"><a href="/home"><span>餐库</span></a></div>
            <ul>
                <li><a href="/today">今日订单</a></li>

                <li class="nav_item_my">
                    <a href='#'><?php echo isset($userinfo['username']) ? $userinfo['username'] : "";?></a>
                    <ul id="nav_my">
                        <li><a href="/user/order">历史订单</a></li>
                        <li><a href="/user/account">帐号设置</a></li>
                        <li><a href="/user/logout">退出</a></li>
                    </ul>
                </li>
                <?php if(isset($userinfo['is_admin']) && $userinfo['is_admin'] > 0){ ?>
                <li><a href="/admin/">后台</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</header>
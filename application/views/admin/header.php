<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>canku.me admin</title>
    <script type="text/javascript" src="<?php echo base_url();?>static/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>static/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>static/css/admin.css">
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="">
                        <a href="/home">首页</a>
                    </li>
                    <li class="">
                        <a href="/admin/">用户</a>
                    </li>
                    <?php if(isset($userinfo['canOperateShop']) && $userinfo['canOperateShop']){ ?>
                    <li>
                        <a href="/admin/shop">店铺</a>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="/user/logout">注销</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container">
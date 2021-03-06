<!DOCTYPE HTML>
<html lang="zh-cn" style="background: url('<?php echo base_url();?>/static/img/a4.jpg') repeat center 0 fixed;">
<head>
    <meta charset="UTF-8">
    <title>餐库 › 重置密码</title>
    <link href="<?php echo base_url();?>static/css/style.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo base_url();?>static/js/jquery.js" type="text/javascript"></script>
</head>
<body>
<div class="auth_form">
    <form class="session_form" method="post">
        <h1>餐库 › 重置密码</h1>
        <div class="item">
            <input type="text" id="email" name="email" class="input" placeholder="帐户邮箱" title="你的帐户邮箱" required=""/>
        </div>
        <div class="item cleafix">
            <span><a href="<?php echo site_url('/user/login');?>" title="已有餐库帐号？"> › 登录</a></span>&nbsp;&nbsp;
            <span><a href="<?php echo site_url('/user/register');?>" title="注册一个"> › 注册 </a></span>
            <button type="submit" class="btn">重置密码</button>
        </div>
        <?php if(isset($tip)){ ?>
        <p class="tip"><?php echo $tip;?></p>
        <script type="text/javascript">
        $(".tip").delay(2000).slideUp();
        </script>
        <?php } ?>
    </form>
</div>
</body>
</html>
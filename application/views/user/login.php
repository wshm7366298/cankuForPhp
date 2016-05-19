<!DOCTYPE HTML>
<html lang="zh-cn" style="background: url('<?php echo base_url();?>/static/img/a4.jpg') repeat center 0 fixed;">
<head>
  <meta charset="UTF-8">
  <title>餐库 › 请先登录</title>
  <link href="<?php echo base_url();?>static/css/style.css" rel="stylesheet" type="text/css"/>
  <script src="<?php echo base_url();?>static/js/jquery.js" type="text/javascript"></script>
</head>
<body>
  <div class="auth_form">
      <form method="post" class="session_form" action="/user/do_login">
          <h1>餐库 › 登录</h1>
          <div class="item">
            <input type="text" id="username" name="username" class="input" placeholder="姓名" title="你的姓名" required=""/>
          </div>
          <div class="item">
            <input type="password" id="password" name="password" class="input" placeholder="密码" title="你的帐号密码" required=""/>
          </div>
          <div class="item clearfix login_btn">
            <span><a href="<?php echo site_url('/user/register');?>" title="还没有餐库帐号？"> › 注册</a></span>&nbsp;&nbsp;
            <span><a href="<?php echo site_url('/user/forgetPassword');?>" title="忘记密码？"> › 忘记密码</a></span>
            <button type="submit" id="sub" class="btn">登录</button>
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
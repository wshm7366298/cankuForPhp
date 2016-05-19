<?php load_view("header");?>
<div class="wap columns clearfix">
  <?php if(isset($tip)){ ?>
  <p class="tip"><?php echo $tip;?></p>
  <script type="text/javascript">
    $(".tip").delay(3000).slideUp();
  </script>
  <?php } ?>
  <div class="left">
    <h1 class="page-title">帐号设置</h1>
    <div class="main clearfix inner">
      <form class="session_form" action="/user/update_account" method="POST" id="account">
        <div class="item">
          <label for="setting-email">邮箱</label>
          <input name="email" id="setting-email" type="text" maxlength="32" readonly="true" placeholder="邮箱，用于登录、找回密码" class="text-32"
                 value="<?php echo isset($userinfo['email']) ? $userinfo['email'] : "";?>" required="" />
        </div>
        <div class="item">
          <label for="setting-name">姓名</label>
          <input name="name" id="setting-name" type="text" readonly="true" maxlength="32" placeholder="真实姓名" class="text-32"
                 value="<?php echo isset($userinfo['username']) ? $userinfo['username'] : "";?>" required="" />
        </div>
        <div class="item">
          <label for="setting-name">余额</label>
          <input name="money" id="money" readonly="true" type="text" maxlength="32" placeholder="账户余额" class="text-32"
                 value="<?php echo isset($userinfo['money']) ? $userinfo['money'] : 0;?>" required="" />
        </div>
        <div class="item">
          <label for="setting-pwd">旧密码</label>
          <input name="pwd" id="setting-pwd" type="password" maxlength="32" class="text-32" />
          <em>不修改密码请留空</em>
        </div>
        <div class="item">
          <label for="setting-pwd2">新密码</label>
          <input name="new_pwd" id="setting-pwd2" type="password" maxlength="32" class="text-32" />
        </div>
        <div class="item">
          <label for="setting-submit"></label>
          <button class="btn" id="setting-submit" type="submit">提交</button>
        </div>
      </form>
    </div>
  </div>
  <div class="right">
    <div class="block">
      <ul class="setting">
        <li><a href="/user/order">› 历史订单</a></li>
		  <li><a href="/user/account">› 帐户设置</a></li>
      </ul>
    </div>
  </div>
</div>
<?php load_view("footer");?>
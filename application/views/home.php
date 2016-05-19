<?php load_view("header");?>
<div class="wap">
    <!-- <div class="tip">即将推出帐号冲值功能，为了确保你的帐号安全，请填写邮箱地址，用于找回密码、重要安全功能。<a href="/user/account">马上去补全吧！</a></div> -->
    <div class="main clearfix" style="background: none;">
        <div class="fav clearfix">
        <?php if(isset($shops) && $shops){?>
            <?php foreach($shops as $shop){ ?>
            <div class="food-item">
            <h3>
                <a href="/shop/show/<?php echo $shop['shop_id'];?>" title="<?php echo $shop['name'];?>">
                    <?php echo mb_substr($shop['name'], 0, 12);?>
                </a>
            </h3>
            <p>
                <em>运费：</em><?php echo isset($shop['shippingfee']) ? $shop['shippingfee']."元" : "";?><br/>
                <em>地址：</em><?php echo $shop['address'];?><br/>
                <em>电话：</em><?php echo $shop['tel'];?><br/>
                <em>最低消费：</em><?php echo isset($shop['minprice']) ? $shop['minprice']."元" : "";?><br/>
            </p>
            <a href="/shop/show/<?php echo $shop['shop_id'];?>">
                <img src="<?php if($shop['logo']):echo $shop['logo']; else:?>/static/images/shop/1.png<?php endif;?>"/>
            </a>
            </div>
        <?php }} ?>
        </div>
    </div>
</div>
<?php load_view("footer");?>
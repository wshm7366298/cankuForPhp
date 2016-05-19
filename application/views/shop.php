<?php load_view("header");?>
<div class="wap columns clearfix">
    <div class="left">
        <h1 class="page-title">
            <strong><?php echo $shop['name'];?></strong>
            <span>运费：<?php echo $shop['shippingfee'];?>元</span>
            <span>电话：<?php echo $shop['tel'];?></span>
            <span>地址：<?php echo $shop['address'];?></span>
            <span>最低消费：<?php echo $shop['minprice'];?>元</span>
            <input type="hidden" id="shop_id" value="<?php echo $shop['shop_id'];?>">
            <input type="hidden" id="shop_name" value="<?php echo $shop['name'];?>">
        </h1>
        <div class="main clearfix">
            <div class="food-list inner clearfix">
            <?php if(isset($list)):?>
                <?php foreach($list as $item):?>
                    <?php if(isset($item['food']) && !empty($item['food'])):?>
                        <div>
                            <div class="cat-title"><span><?php echo $item['name'];?></span></div>
                            <ul>
                            <?php foreach($item['food'] as $val):?>
                                <li title="<?php echo $val['name'];?>" id="food-<?php echo $val['id'];?>" data-id="<?php echo $val['id'];?>" data-name="<?php echo $val['name'];?>"
                                data-price="<?php echo $val['price'];?>">
                                <?php echo $val['name'];?><em><?php echo $val['price'];?> 元</em>
                                </li>
                            <?php endforeach; ?>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                    <?php endif; ?>
                    <?php if(!isset($list)): ?>
                    <p>还未添加美食</p>
                    <?php endif; ?>
                <?php endforeach;?>
            <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="right">
        <div id="cart">
        <h3>我的餐盒</h3>

        <div class="r_mycart">
        <table cellpadding="0" cellspacing="0">
        <tbody>
        <tr>
        <th class="ttl">名称</th>
        <th width="40">份数</th>
        <th width="30">单价</th>
        <th class="del" width="30">删除</th>
        </tr>
        </tbody>
        </table>
        <p id="noItemTips" class="ptt pbb" style="text-align: center; display: none; ">您还没有添加菜品哦~</p>
        <table id="cartTable">
        <tbody>
        </tbody>
        </table>
        </div>
        <div class="buy"><span class="buy-btn">去结帐</span><strong class="buy-price">总价：<span
          id="cart_zongjia">0</span></strong>
          <input type="hidden" id="hidden_total" value="0"/>
          <input type="hidden" id="hidden_money" value="0"/>
        </div>
        </div>
    </div>
    <div id="car-confirm" class="reveal-modal">
        <h3>订单详情</h3>
        <div id="notice" style="padding-bottom: 10px; color: red;"></div>
        <div id="confirm-list"></div>
        <a class="close-reveal-modal">&#215;</a>
    </div>
</div>
<script src="<?php echo base_url();?>static/js/jquery.reveal.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url();?>static/js/cart.js"></script>
<?php load_view("footer");?>
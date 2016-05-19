<?php load_view("header");?>
<div class="wap columns clearfix">
  <div class="left">
    <div class="fav clearfix">
      <?php if(isset($orders)){
            foreach($orders as $order){
       ?>
      <table class="myorder" cellpadding="0" cellspacing="0">
        <tbody>
        <tr class="hd-row">
          <td colspan="6"><?php echo date($order['add_time']);?> 在<a href="/shop/<?php echo $order['shop_id'];?>"> <?php echo $order['shop_name'];?> </a>购买的清单
          </td>
        </tr>
        <?php if(isset($order['goods'])){ 
              foreach($order['goods'] as $index => $good){
          ?>
        <tr>
          <td class="shop_name-td"><?php echo $good['name'];?></td>
          <td class="price-td"><?php echo $good['price'];?>元</td>
          <td class="num-td"><?php echo $good['num'];?>份</td>
          <?php if($index == 0 && count($order['goods']) == 1){ ?>
          <td class="total-td">共计 <?php echo $order['total'];?> 元</td>
          <td class="meta-td"><?php if($order['canceled']){ ?>已作废<?php }?></td>
          <?php }else if($index == 0 && count($order['goods']) > 1){ ?>
          <td rowspan="<?php echo count($order['goods']);?>" class="total-td">共计 <?php echo $order['total'];?> 元</td>
          <td rowspan="<?php echo count($order['goods']);?>" class="meta-td"><?php if($order['canceled']){ ?>已作废<?php }?></td>
          <?php } ?>
        </tr>
        <?php }} ?>
        </tbody>
      </table>
      <?php }} ?>
      <?php if(isset($bottom_pager) && $bottom_pager){ ?>
      <div class="page">
        <?php echo $bottom_pager;?>
      </div>
      <?php } ?>
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
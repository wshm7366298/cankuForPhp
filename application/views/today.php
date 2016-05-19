<?php load_view("header");?>
<div class="wap">
  <?php if(isset($all_orders) && $all_orders){ ?>
  <input type="hidden" id="TTTT" value="<?php echo time();?>" />
  <?php foreach($all_orders as $index => $order){ ?>
  <div id="shop-<?php echo $order['shop']['shop_id'];?>">
  <h1 class="page-title">
    <strong><?php echo $order['shop']['shop_name'];?></strong>
    <span class="shop_tel">电话：<?php echo $order['shop']['tel'];?></span>
    <span class="shop_address">地址：<?php echo $order['shop']['address'];?></span>
    <?php if(isset($order['min'])){ ?>
    <span style="float: right;">目测，由 <strong><?php echo $order['min']['username'];?></strong>喂人民服务</span>
    <?php } ?>
  </h1>
  <div class="main clearfix" style="margin-bottom: 20px">
    <div class="inner">
      <table id="today-list" class="today-tb" cellpadding="0" cellspacing="0">
        <thead>
        <tr>
          <th class="name">用户名</th>
          <th class="food">订单内容</th>
          <th class="random">运气值</th>
          <th class="total">共计</th>
          <th class="cancel"></th>
        </tr>
        </thead>
        <?php 
          foreach($order as $i => $item){
          if($i === "min" || $i === "shop"){
            continue;
          }
        ?>
        <tbody>
        <tr data-id="<?php echo $item['id'];?>" class="owner">
          <td class="name user-"><?php echo $item['username'];?></td>
          <td class="food">
            <ul>
              <?php foreach($item['goods'] as $goods){ ?>
                <li data-is="<?php if($item['canceled']){ ?>1<?php }else{ ?>0<?php } ?>" data-id="<?php echo $goods['id'];?>" data-price="<?php echo $goods['price'];?>" data-name="<?php echo $goods['name'];?>" data-num="<?php echo $goods['num'];?>">
                <?php echo $goods['name'];?> - <?php echo $goods['price'];?> 元 - <?php echo $goods['num'];?> 份
                </li>
              <?php } ?>
            </ul>
          </td>
          <td class="luck" data-luck="<?php echo $item['luck'];?>">
            <div class="bar" style="width:<?php echo $item['luck']*0.9;?>px"><?php echo $item['luck'];?></div>
          </td>
          <td class="total" data-is="<?php if($item['canceled']){ ?>1<?php }else{ ?>0<?php } ?>">
            ￥<?php echo isset($item['total']) ? $item['total'] : "";?>
          </td>
          <td>
            <?php if($item['canceled']){ ?>
            <div class="text-error">已取消</div>
            <?php }else{ ?>
            <?php if($item['user_id'] == $user_id || $is_admin == true){ ?>
                <a href="/user/order/delete?id=<?php echo $item['id'];?>" class="buy-btn cancel-order">取消</a>
            <?php } ?>
            <?php } ?>
          </td>
        </tr>
        </tbody>
        <?php } ?>
        <tfoot>
        <tr style="text-align: right;background: #f9f9f9;">
          <td class="shop_total" colspan="5">
            
          </td>
        </tr>
        </tfoot>
      </table>
      <table id="today-analytics" class="today-tb right_tb">
        <thead>
        <tr>
          <th>订餐统计清单</th>
        </tr>
        </thead>
        <tbody>
        
        <tr>
          <td> - 份</td>
        </tr>
        </tbody>
        <tfoot>
        <tr style="text-align: right;background: #f9f9f9;">
          <td class="right_total" colspan="3">
            
          </td>
        </tr>
        </tfoot>
      </table>
      <div class="clearfix"></div>
    </div>
  </div>
  </div>
  <?php }}else{ ?>
  <div class="main inner today_null">
    <div class="txt">
      <h3>大家还没点餐</h3>
      <p>可能大伙太忙了，赶紧去群里吼一声，大家快来餐库<a href="/home">点餐</a>啊！</p>
    </div>
  </div>
  <?php } ?>
</div>
<script>
(function(){
$(".owner").hover(function(){
    $(".cancel-order").css({"visibility": "visible"});
},function(){
    $(".cancel-order").css({"visibility": "hidden"});
});
$("div[id^='shop-']").each(function(){
    var id = $(this).attr("id");
    var _price = 0;
    $("div#"+id+" td.total").each(function(){
        if($(this).attr("data-is") < 1){
          var _tmp = $(this).text();
          _tmp = _tmp.replace(/￥/, "");
          _tmp = _tmp.replace(/元/, "");
          _price += parseFloat(_tmp);
        }
    });
    $("div#"+id+" td.shop_total").html("共计：<b>" +_price + "</b> 元");
});

$("div[id^='shop-']").each(function(){
    var id = $(this).attr("id");
    // 循环食品列表
    var res = [];
    var arr = [];
    var total = numbers = 0;
    $("div#"+id+" td.food li").each(function(){
        var arr = [];
        if($(this).attr("data-is") < 1){
          arr.id = $(this).attr("data-id");
          arr.name = $(this).attr("data-name");
          arr.num = $(this).attr("data-num");
          arr.price = $(this).attr("data-price");
          res.push(arr);
        }
    });
    for(var i in res){
        var index = res[i].id;
        if(arr.hasOwnProperty(index) == true)
        {
            arr[index].num = parseFloat(res[i].num) + parseFloat(arr[index].num);
        }else{
            arr[index] = res[i];
        }
        total += parseFloat(res[i].price) * parseFloat(res[i].num);
        numbers += parseFloat(res[i].num);
    }
    var _html_1 = _html_2 = "";
    for(var key in arr){
        _html_1 += arr[key].name + " - " + arr[key].num + "份</br>";
    }
    _html_2 = "<p>共计 <b>" + numbers + "</b> 份， <b>" + total + "</b> 元</p>";
    $("div#"+id+" table.right_tb tbody tr td").html(_html_1);
    $("div#"+id+" td.right_total").html(_html_2);
})
function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}
})()
</script>
<?php load_view("footer");?>
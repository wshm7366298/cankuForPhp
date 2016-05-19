<?php load_view("admin/header");?>
<form method="POST" class="form-horizontal well" action="/admin/shop_save">
  <div class="control-group">
    <label class="control-label" for="name">名称</label>
    <div class="controls">
      <input type="text" name="name" id="name" value="<?php echo $shop['name'];?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="address">地址</label>
    <div class="controls">
      <input type="text" name="address" id="address" value="<?php echo $shop['address'];?>">
    </div>
  </div>
  <div class="control-group">
      <label class="control-label" for="address">最低消费</label>
      <div class="controls">
        <input type="text" name="minprice" id="minprice" value="<?php echo $shop['minprice'];?>">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="address">运费</label>

      <div class="controls">
        <input type="text" name="shipping_fee" id="shipping_fee">
      </div>
    </div>
  <div class="control-group">
    <label class="control-label" for="tel">电话</label>
    <div class="controls">
      <input type="text" name="tel" id="tel" value="<?php echo $shop['tel'];?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="tel">分类</label>
    <div class="controls">
      <textarea name="categories" id="categories" cols="30" rows="3"><?php foreach($categories as $val){ echo $val['cid']."#".$val['name']."|";};?></textarea>
    </div>
  </div>
  <div class="control-group">
    <input type="hidden" name="id" id="id" value="<?php echo $shop['shop_id'];?>">
  </div>
  <div class="control-group">
    <div class="controls ">
      <button class="btn btn-primary" type="submit">编辑店铺</button>
    </div>
  </div>
</form>
<?php load_view("admin/footer");?>
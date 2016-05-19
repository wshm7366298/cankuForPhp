<?php load_view("admin/header");?>
<div class="well">
  <form method="POST" action="/admin/shop_save" class="form-horizontal" enctype="multipart/form-data">
    <div class="control-group">
      <label class="control-label" for="name">名称</label>

      <div class="controls">
        <input type="text" name="name" id="name">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="address">地址</label>

      <div class="controls">
        <input type="text" name="address" id="address">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="address">最低消费</label>

      <div class="controls">
        <input type="text" name="minprice" id="minprice">
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
        <input type="tel" name="tel" id="tel">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" class="control-label" for="categories">分类</label>

      <div class="controls">
        <textarea name="categories" id="categories" cols="30" rows="3"></textarea>
      </div>
    </div>
    <div class="control-group">
      <div class="controls">
        <button class="btn btn-primary" type="submit">添加店铺</button>
      </div>
    </div>
  </form>
</div>
<?php load_view("admin/footer");?>
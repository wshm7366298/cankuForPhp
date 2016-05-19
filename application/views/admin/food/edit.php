<?php load_view("admin/header");?>
<h2>修改美食</h2>
<div class="well">
  <form method="POST" action="/admin/food_save">
    <div class="item">
      <label for="name">名称</label>
      <input type="text" name="name" id="name" value="<?php echo $food['name'];?>">
    </div>
    <div class="item">
      <label for="price">价格</label>
      <input type="text" name="price" id="price" value="<?php echo $food['price'];?>">
    </div>
    <div class="item">
      <label for="categories">分类</label>
      <select name="categories" id="categories">
        <?php 
        if(isset($categories)){
        foreach($categories as $val){
        ?>
        <option <?php if($food['cid'] == $val['cid']){?>selected<?php } ?> value="<?php echo $val['cid'];?>"><?php echo $val['name'];?></option>
        <?php }} ?>
      </select>
    </div>
    <div class="item">
      <label>&nbsp;</label>
      <button type="submit" class="btn btn-primary">修改美食</button>
    </div>
    <div class="item">
      <input type="hidden" name="id" value="<?php echo $food['id'];?>">
      <input type="hidden" name="shop_id" value="<?php echo $food['shop_id'];?>">
    </div>
  </form>
  </ul>
</div>
<?php load_view("admin/footer");?>
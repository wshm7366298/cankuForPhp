<?php load_view("admin/header");?>
<h2>在【<a href="/shop/<?php echo $shop['shop_id'];?>" target="_blank"><?php echo $shop['name'];?></a>】中添加美食</h2>
<div class="">
  <div class="row">
    <div class="span5">
      <table class="table table-bordered">
        <thead>
        <tr>
          <th>分类</th>
          <th>菜名儿</th>
          <th>价格</th>
          <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(isset($foods)){
              foreach($foods as $food){
          ?>
        <tr>
          <td><a href="/admin/food/add?shop_id=<?php echo $shop['shop_id'];?>&cid=<?php echo $food['cid'];?>"><?php echo $food['cate_name'];?></a></td>
          <td><?php echo $food['name'];?></td>
          <td><?php echo $food['price'];?> 元</td>
          <td><a href="/admin/food/edit?id=<?php echo $food['id'];?>" target="_blank">编辑</a>|<a food-id="<?php echo $food['id'];?>" id="deleteFood" href="javascript:void(0)" >删除</a></td>
        </tr>
        <?php  }} ?>
        </tbody>
      </table>
    </div>
    <div class="span5 well">
      <form method="POST" action="/admin/food_save">
        <div class="item">
          <label for="name">名称</label>
          <input type="text" name="name" id="name">
        </div>
        <div class="item">
          <label for="price">价格</label>
          <input type="text" name="price" id="price">
        </div>
        <div class="item">
          <label for="categories">分类</label>
          <select name="categories" id="categories">
            <?php 
            if(isset($categories)){
            foreach($categories as $val){
            ?>
            <option value="<?php echo $val['cid'];?>"><?php echo $val['name'];?></option>
            <?php }} ?>
          </select>
        </div>
        <div class="item">
          <label>&nbsp;</label>
          <button type="submit" class="btn btn-primary">添加美食</button>
        </div>
        <div class="item">
          <input type="hidden" name="shop_id" value="<?php echo $shop['shop_id'];?>">
          <input type="hidden" name="cid" value="<?php echo $cid;?>"/>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal -->
  <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close cancel" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">删除菜谱</h3>
    </div>
    <div class="modal-body">
      <p>确定删除这盘菜？</p>
    </div>
    <div class="modal-footer">
      <button class="btn btn-primary sure">确定</button>
      <button class="btn btn-danger cancel" data-dismiss="modal" aria-hidden="true">取消</button>
      
    </div>
  </div>
  <script>
  //监听删除食谱的按钮
  $("#deleteFood").live('click', function() {
    var id = $(this).attr("food-id");
    var that = $(this);
    //弹出选择是否删除窗口
    $('#myModal').modal({
          keyboard: true,
          show: true,
          backdrop: true
        });
    //管理员取消
    $(".cancel").live('click',function() {
        return ;
    })
    //管理员确定则执行删除操作
    $(".sure").live('click',function() {
      $("#myModal").hide();
      $.ajax({
        url: '/admin/food/delete?id=' + id,
        type: 'GET',
        data: { timeStamp:new Date().getTime() },
        error: function(){
          alert('网络错误，请联系管理员');
        },
        success: function(data){
          that.closest("tr").remove();
          $("div.modal-backdrop").removeClass('in');
        }
      })
    })     
  })
  </script>
<?php load_view("admin/footer");?>
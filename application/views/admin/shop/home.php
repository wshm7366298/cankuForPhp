<?php load_view("admin/header");?>
  <h2>店铺列表</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>名称</th>
        <th>电话</th>
        <th>地址</th>
        <th>操作店铺</th>
        <th>管理美食</th>
      </tr>
    </thead>
    <tbody>
      <?php if(isset($shops)){
            foreach($shops as $shop){
        ?>
      <tr>
        <td><?php echo $shop['name'];?></td>
        <td><?php echo $shop['tel'];?></td>
        <td><?php echo $shop['address'];?></td>
        <td>
          <a class="btn btn-primary btn-small" href="/admin/shop/edit?shop_id=<?php echo $shop['shop_id'];?>">编辑店铺</a>
          <a class="btn btn-primary btn-small" id="deleteShop" shop-id="<?php echo $shop['shop_id'];?>">删除店铺</a>
        </td>
        <td>
          <a class="btn btn-primary btn-small" href="/admin/food/add?shop_id=<?php echo $shop['shop_id'];?>">管理美食</a>
        </td>
      </tr>
      <?php }} ?>
    </tbody>
  </table>
  <div class="actions">
    <a class="btn btn-primary" href="/admin/shop/add">添加店铺</a>
  </div>
  <!-- Modal -->
  <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close cancel" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">删除店铺</h3>
    </div>
    <div class="modal-body">
      <p>确定删除此店铺？</p>
    </div>
    <div class="modal-footer">
      <button class="btn btn-primary sure">确定</button>
      <button class="btn btn-danger cancel" data-dismiss="modal" aria-hidden="true">取消</button>
      
    </div>
  </div>
  <script>
  //监听删除用户的按钮
  $("#deleteShop").live('click', function(){
    var id = $(this).attr("shop-id");
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
        url: '/admin/shop/delete?shop_id=' + id,
        type: 'GET',
        data: { timeStamp:new Date().getTime() },
        error: function() {
          alert('网络错误，请联系管理员');
        },
        success: function(data) {
          that.closest("tr").remove();
          $("div.modal-backdrop").removeClass('in');
        }
      });
    });    
  });
  </script>

<?php load_view("admin/footer");?>
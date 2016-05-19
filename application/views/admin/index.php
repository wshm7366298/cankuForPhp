<?php load_view("admin/header");?>
<div>
    <p>今天是<?php echo $week;?>，<?php echo $nowtime;?></p>
</div>
<?php if($userinfo['is_admin']) {?>
<h2>用户列表</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>昵称</th>
        <th>邮箱</th>
        <th>超级管理员</th>
        <th>店铺管理员</th>
        <th>注册时间</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
    <?php if(isset($user_list) && $user_list){ 
            foreach($user_list as $user){
        ?>
      <tr id="<?php echo $user['user_id'];?>">
        <td><?php echo $user['username'];?></td>
        <td><?php echo $user['email'];?></td>
        <td>
        	<span><?php echo $user['is_admin'] ? "是" : "否";?></span>
        	<?php if($user['is_admin']) {?>
        	<a class="btn btn-primary btn-small Admin">撤销</a>
        	<?php }else{ ?>
        	<a class="btn btn-primary btn-small Admin">升级</a>
          <?php } ?>
        </td>
        <td>
        	<span><?php echo $user['canOperateShop'] ? "是" : "否"; ?></span>
        	<?php if($user['canOperateShop']) {?>
          <a class="btn btn-primary btn-small Shoper">撤销</a>
          <?php }else{?>
          <a class="btn btn-primary btn-small Shoper">升级</a>
        	<?php } ?>
        </td>
        <td>
          <?php echo date("Y-m-d H:i:s", $user['reg_time']); ?>
        </td>
        <td>          
          <a class="btn btn-primary btn-small" id = "addMoney" >充值</a>
          <a class="btn btn-primary btn-small" id = "deleteUser" >删除用户</a>
        </td>
      </tr>
    <?php }} ?>
    </tbody>
  </table>
 <!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close cancel" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <p>确定删除此用户？</p>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary sure">确定</button>
    <button class="btn btn-danger cancel" data-dismiss="modal" aria-hidden="true">取消</button>
    
  </div>
</div>
<script type="text/javascript">
$(function(){
  //监听超级管理员按钮
  $(".Admin").live('click',function(){
    var id = $(this).closest("tr").attr("id");
    var that = $(this);
    $.ajax({
      url: '/admin/user/isAdmin?id=' + id,
      type: 'GET',
      dataType: 'json',
      data: { timeStamp:new Date().getTime() },//解决ie不能兼容问题
      error: function(){
        alert('网络错误，请联系管理员');
      },
      success: function(data){
        if(data){
            if(data.is_admin == "1"){
                that.prev().text("是");
                that.text("撤销")
            }else{
                that.prev().text("否");
                that.text("升级");
            }
        }else{
            alert("网络错误，请联系管理员");
        }
      }
    })
  })
  //监听店铺管理员按钮
  $(".Shoper").live('click',function(){
    var id = $(this).closest("tr").attr("id");
    var that = $(this);
    $.ajax({
      url: '/admin/user/canOperateShop?id=' + id,
      type: 'GET',
      dataType: 'json',
      data: {timeStamp:new Date().getTime()},//解决ie不能兼容问题
      error: function(){
        alert('网络错误，请联系管理员');
      },
      success: function(data){
        if(data){
            if(data.canOperateShop == "1"){
                that.prev().text("是");
                that.text("撤销")
            }else{
                that.prev().text("否");
                that.text("升级");
            }
        }else{
            alert("网络错误，请联系管理员");
        }
      }
    })
  });
  //监听删除用户的按钮
  $("#deleteUser").live('click', function(){
    var id = $(this).closest("tr").attr("id");
    var that = $(this);
    //弹出选择是否删除窗口
    $('#myModal').modal({
          keyboard: true,
          show: true,
          backdrop: true
        });
    //管理员取消
    $(".cancel").live('click',function(){
        return ;
    })
    //管理员确定则执行删除操作
    $(".sure").live('click',function(){
      $("#myModal").hide();
      $.ajax({
        url: '/admin/user/delete?id=' + id,
        type: 'GET',
        data: {timeStamp:new Date().getTime()},
        error: function(){
          alert('网络错误，请联系管理员');
        },
        success: function(data){
            if(data == "1"){
                that.closest("tr").remove();
                $("div.modal-backdrop").removeClass('in');
            }else{
                alert('网络错误，请联系管理员');
            }
        }
      })
    })     
  })

})
</script>
<?php } ?>
<?php load_view("admin/footer");?>
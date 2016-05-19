<?php


class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model("shop_model");
		$this->load->model("food_model");
		$this->uid = $this->session->userdata("user_id");
		if(!$this->uid)
			redirect("/user/login");
		else
			$this->userinfo = $this->session->all_userdata();
		$this->data['userinfo'] = $this->userinfo;
		if(!$this->data['userinfo']['is_admin'])
			redirect("/home");
	}

	function index()
	{
		$weeks = array('星期日','星期一','星期二','星期三','星期四','星期五','星期六');
		$this->data['week'] = $weeks[date("w")];
		$this->data['nowtime'] = date("Y-m-d H:i:s");
		$this->data['user_list'] = $this->user_model->get_user_list($this->uid);
		$this->load->view("admin/index", $this->data);
	}

	function food()
	{
		$shop_id = isset($_REQUEST['shop_id']) && intval($_REQUEST['shop_id']) ? intval($_REQUEST['shop_id']) : 0;
		$action = $this->uri->rsegment(3);
		if($action == "add"){
			$this->food_add($shop_id);
		}elseif($action == "edit"){
			$id = isset($_REQUEST['id']) && intval($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
			if(!$id)
				show_error("参数错误.");
			$this->food_edit($id);
		}elseif($action == "delete"){
			$id = isset($_REQUEST['id']) && intval($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
			if(!$id)
				show_error("参数错误.");
			$this->food_delete($id);
		}
	}

	function food_add($shop_id)
	{
		$cid = isset($_REQUEST['cid']) && intval($_REQUEST['cid']) > 0 ? intval($_REQUEST['cid']) : 0;
		$this->data['categories'] = $this->shop_model->get_categories($shop_id, $cid);
		$this->data['shop'] = $this->shop_model->get_shop_info($shop_id);
		$this->data['foods'] = $this->food_model->get_foods_by_shopid($shop_id, $cid);
		$this->data['cid'] = $cid;
		$this->load->view("admin/food/add", $this->data);
	}

	function food_edit($id)
	{
		$food = $this->food_model->get_food_by_id($id);
		$this->data['food'] = $food;
		$this->data['categories'] = $this->shop_model->get_categories($food['shop_id']);
		$this->load->view("admin/food/edit", $this->data);
	}

	function food_delete($id)
	{
		$this->food_model->food_delete($id);
		die("1");
	}

	function food_save()
	{
		$id = isset($_REQUEST['id']) && trim($_REQUEST['id']) ? $_REQUEST['id'] : 0;
		$shop_id = isset($_REQUEST['shop_id']) && trim($_REQUEST['shop_id']) ? $_REQUEST['shop_id'] : 0;
		$name = isset($_REQUEST['name']) && trim($_REQUEST['name']) ? $_REQUEST['name'] : "";
		$price = isset($_REQUEST['price']) && $_REQUEST['price'] ? $_REQUEST['price'] : 0;
		$categories = isset($_REQUEST['categories']) && trim($_REQUEST['categories']) ? $_REQUEST['categories'] : "";
		$cid = isset($_REQUEST['cid']) && trim($_REQUEST['cid']) ? $_REQUEST['cid'] : 0;
		if(!$name)
		{
			show_error("菜名不允许为空.");
		}
		if($id > 0)
		{
			$data = array('cid' => $categories,
						  'name' => $name,
						  'price' => $price,
						  'shop_id' => $shop_id);
			$this->food_model->food_update($id, $data);
		}else{
			if(strpos($name, "|") != false){
				$tmps = explode("|", $name);
				if(count($tmps) > 0){
					foreach($tmps as $tmp){
						if($tmp == "")
							continue;
						$data = array('cid' => $categories,
									  'name' => $tmp,
									  'price' => $price,
									  'shop_id' => $shop_id);
						$this->food_model->food_insert($data);
					}
				}
			}else{
				$data = array('cid' => $categories,
							  'name' => $name,
							  'price' => $price,
							  'shop_id' => $shop_id);
				$this->food_model->food_insert($data);
			}
		}
		if($cid > 0)
			redirect("/admin/food/add?shop_id=".$shop_id."&cid=".$cid);
		else
			redirect("/admin/food/add?shop_id=".$shop_id);
	}

	function shop()
	{
		$action = $this->uri->rsegment(3);
		$shop_id = isset($_REQUEST['shop_id']) && intval($_REQUEST['shop_id']) ? intval($_REQUEST['shop_id']) : 0;
		switch($action) {
			case 'edit':
				$this->shop_edit($shop_id);
				break;
			case 'add':
				$this->shop_add();
				break;
			case 'delete':
				$this->shop_delete($shop_id);
				break;
			default:
				$this->data['shops'] = $this->shop_model->get_shops();
				$this->load->view("admin/shop/home", $this->data);
				break;
		}
	}

	function shop_delete($shop_id)
	{
		if(!$shop_id)
			exit();
		$this->shop_model->shop_delete($shop_id);
		die("1");
	}

	function shop_add()
	{
		$this->load->view("admin/shop/add", $this->data);
	}

	function shop_edit($shop_id)
	{
		if(!$shop_id)
			exit();
		$this->data['categories'] = $this->shop_model->get_categories($shop_id);
		$this->data['shop'] = $this->shop_model->get_shop_info($shop_id);
		$this->load->view("admin/shop/edit", $this->data);
	}

	function shop_save()
	{
		$name = isset($_REQUEST['name']) && trim($_REQUEST['name']) ? $_REQUEST['name'] : "";
		$address = isset($_REQUEST['address']) && trim($_REQUEST['address']) ? $_REQUEST['address'] : "";
		$tel = isset($_REQUEST['tel']) && trim($_REQUEST['tel']) ? $_REQUEST['tel'] : "";
		$categories = isset($_REQUEST['categories']) && trim($_REQUEST['categories']) ? $_REQUEST['categories'] : "";
		$id = isset($_REQUEST['id']) && intval($_REQUEST['id']) > 0 ? intval($_REQUEST['id']) : 0;
		$minprice = isset($_REQUEST['minprice']) && $_REQUEST['minprice'] > 0 ? $_REQUEST['minprice'] : 0;
		$shipping_fee = isset($_REQUEST['shipping_fee']) && $_REQUEST['shipping_fee'] > 0 ? $_REQUEST['shipping_fee'] : 0;

		if(!$name)
			show_error("店铺名称和电话不允许为空.");

		if($categories && strpos($categories, "|") !== false){
			$tmps = explode("|", $categories);
		}else{
			show_error("分类格式为: 1#炒菜|2#小菜");
		}

		$data = array("name" => $name,
					  "address" => $address,
					  "minprice"  => $minprice,
					  "shippingfee" => $shipping_fee,
					  "tel" => $tel);
		if($id > 0)
		{
			$this->shop_model->shop_update($id, $data);
			$this->shop_model->category_delete('shop_id', $id);
		}else{
			$id = $this->shop_model->shop_insert($data);
		}
		if(count($tmps) > 0){
			foreach($tmps as $tmp){
				if($tmp){
					$tmp = explode("#", $tmp);
					$cid = $tmp[0];
					$name = $tmp[1];
					$data = array('cid' => $cid, 'name' => $name, 'shop_id' => $id);
					$this->shop_model->category_insert($data);
				}
			}
		}
		redirect("admin/shop");
	}

	function user()
	{
		$action = $this->uri->rsegment(3);
		$id = $_REQUEST['id'];
		$actions = array('isAdmin', 'canOperateShop', 'delete');
		if(in_array($action, $actions))
		{
			if($id)
				$this->$action($id);
			else
				die("0");
		}
	}

	function isAdmin($id)
	{
		$row = $this->user_model->get_userinfo($id);
		if($row['is_admin'])
		{
			$arr = array('is_admin' => 0);
			$this->user_model->update($id, $arr);
		}else{
			$arr = array('is_admin' => 1);
			$this->user_model->update($id, $arr);
		}
		die(json_encode($arr));
	}

	function canOperateShop($id)
	{
		$row = $this->user_model->get_userinfo($id);

		$arr = array('canOperateShop' => $row['canOperateShop'] ? 0 : 1);
		$this->user_model->update($id, $arr);
		die(json_encode($arr));
	}

	function delete($id)
	{
		$userinfo = $this->user_model->get_userinfo($id);
		if($userinfo){

		}
		die("1");
	}

}
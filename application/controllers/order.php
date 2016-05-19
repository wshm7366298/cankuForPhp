<?php


class Order extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model("order_model");
		$this->uid = $this->session->userdata("user_id");
		if(!$this->uid)
			redirect("/user/login");
		else
			$this->userinfo = $this->session->all_userdata();
		$this->data['userinfo'] = $this->userinfo;
	}

	function submit_order()
	{
		$shop_id = isset($_REQUEST['shop_id']) && intval($_REQUEST['shop_id']) ? intval($_REQUEST['shop_id']) : 0;
		$shop_name = isset($_REQUEST['shop_name']) && trim($_REQUEST['shop_name']) ? trim($_REQUEST['shop_name']) : "";
		$list = isset($_REQUEST['list']) && trim($_REQUEST['list']) ? trim($_REQUEST['list']) : "";
		if($shop_id && $shop_name && $list){
			$obj = json_decode($list, true);
			$total = 0;
			$luck = rand(0, 100);
			foreach($obj as $val){
				$total += $val['price'] * $val['num'];
			}
			$data = array('shop_id' => $shop_id,
						  'shop_name' => $shop_name, 
						  'content' => serialize($obj), 
						  'add_time' => time(),
						  'total' => $total, 
						  'canceled' => 0,
						  'user_id' => $this->uid,
						  'luck' => $luck);
			$id = $this->order_model->order_insert($data);
			if($id){
				$err = array('result' => 'success', 'luck' => $luck);
				die(json_encode($err));
			}
		}
	}

}
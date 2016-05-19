<?php


class Today extends CI_Controller
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

	function index()
	{
		$res = array();
		$h = date("H");
		if($h < 13){
			$start_t = date("Y-m-d")." 00:00:00";
			$end_t = date("Y-m-d")." 13:00:00";
		}else{
			$start_t = date("Y-m-d")." 13:00:00";
			$end_t = date("Y-m-d")." 23:59:59";
		}
		$all_orders = $this->order_model->get_all_order(strtotime($start_t), strtotime($end_t));
		if($all_orders){
			foreach($all_orders as $index => $order){
				$all_orders[$index]['goods'] = unserialize($order['content']);
				$res[$order['shop_id']][] = $all_orders[$index];
				$res[$order['shop_id']]['min'] = $this->order_model->get_min_luck_order(strtotime($start_t), strtotime($end_t), $order['shop_id']);
				$res[$order['shop_id']]['shop'] = array('shop_id' => $order['shop_id'],
														'shop_name' => $order['shop_name'],
														'address' => $order['address'],
														'tel' => $order['tel']);
			}
		}
		$this->data['all_orders'] = $res;
		$this->data['user_id'] = $this->uid;
		$this->data['is_admin'] = $this->session->userdata("is_admin");
		$this->load->view("today", $this->data);
	}


}
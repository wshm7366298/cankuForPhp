<?php


class Shop extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model("shop_model");
		$this->load->model("food_model");
		$this->uid = $this->session->userdata("user_id");
		if(!$this->uid)
			redirect("/user/login");
		else
			$this->userinfo = $this->session->all_userdata();
		$this->data['userinfo'] = $this->userinfo;
	}

	function show()
	{
		$shop_id = $this->uri->rsegment(3) > 0 ? $this->uri->rsegment(3) : 0;
		if(!$shop_id)
			redirect("/home");
		$this->data['shop'] = $this->shop_model->get_shop_info($shop_id);
		$this->data['list'] = $this->all_list($shop_id);
		$this->load->view("shop", $this->data);
	}

	private function all_list($shop_id)
	{
		$categories = $this->shop_model->get_categories($shop_id);
		if($categories){
			foreach($categories as $index => $cate){
				$categories[$index]['food'] = $this->food_model->get_foods_by_cid_and_shopid($cate['cid'], $shop_id);
			}
		}
		return $categories;
	}



}
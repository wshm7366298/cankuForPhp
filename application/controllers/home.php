<?php


class Home extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model("shop_model");
		$this->uid = $this->session->userdata("user_id");
		if(!$this->uid)
			redirect("/user/login");
		else
			$this->userinfo = $this->session->all_userdata();
		$this->data['userinfo'] = $this->userinfo;
	}

	function index()
	{
		$this->data['shops'] = $this->shop_model->get_shops();
		$this->load->view("home", $this->data);
	}

}
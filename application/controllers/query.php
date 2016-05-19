<?php


class Query extends CI_Controller
{

	public $url;

	function __construct()
	{
		parent::__construct();
		include APPPATH . 'libraries/phpQuery.php';
		$this->url = "http://r.ele.me/zb-hggssl";
		$this->load->model("shop_model");
		$this->load->model("food_model");
	}

	function index()
	{

		$json = "";
		$result = array();
		
		phpQuery::newDocumentFilePHP($this->url);
		$temp_data = $this->get_ajax_data();
		$result['title'] = pq("div.restaurant-header")->find("header.rst-header-info")->find("a.rst-name")->text();
		$result['minprice'] = pq("aside#rst_aside")->find("p.rst-deliver-detail")->find("span.rst_deliver_amount")->text();
		$result['address'] = pq("div.restaurant-header")->find("ul.rst-header-list")->find("li")->find("span:eq(2)")->text();
		$result['minprice'] = $temp_data['deliverAmount'];
		$result['logo_src'] = $this->get_logo();

		//print_r($result);die;

		$json = $this->get_jsondata($this->url);

		if(empty($json)){
			exit("get json fail!");
		}
		
		// print_r($json);die;

		foreach($json as $key => $value)
		{
			$result['list'][$key]['category'] = $value['categ'];
			foreach ($value['foods']['without_image'] as $index => $item) 
			{
				$result['list'][$key]['food'][$index]['name'] = $item['name'];
				$result['list'][$key]['food'][$index]['price'] = $item['price'];
			}
		}
		//print_r($result);die;
		$this->save_data($result);
		exit("get json finish!");
	}

	function get_logo()
	{
		$logo_srcset = pq("div.restaurant-header")->find("a.rst-logo")->find("img.rst-logo-img")->attr("srcset");
		$temp_data = explode(" ", $logo_srcset);
		$logo = $temp_data[2];
		$temp_data = explode("?", $logo);
		return $temp_data[0]."?w=66&h=66";
	}

	function get_jsondata($url)
	{
		$json = array();
		$html = file_get_contents($url);
		preg_match_all("/var\smenu\s=\s(.*?)var\smenuRenderIndex\s=\s(\d);/is", $html, $matches);
		if(empty($matches)){
			exit("empty!");
		}
		$json = $matches[1][0];
		if(strpos($json, ";") !== false)
		{
			$json = substr($json, 0, strpos($json, ";"));
			$json = json_decode($json, true);
		}
		return $json;
	}

	function save_data($data)
	{
		$shop_data = array(
			'name' => $data['title'],
			'address' => $data['address'] ? $data['address'] : "",
			'minprice' => $data['minprice'] ? $data['minprice'] : 0,
			'shippingfee' => 0,
			'tel' => '',
			'logo' => $data['logo_src']
		);
		$shop_id = $this->shop_model->shop_insert($shop_data);	
		$food_data = array();
		foreach($data['list'] as $key => $val){
			if(!isset($val['food']) || count($val['food']) <= 0){
				continue;
			}
			$category_data = array(
				'cid' => $key + 1,
				'name' => $val['category'],
				'shop_id' => $shop_id
			);
			$cid = $this->shop_model->category_insert($category_data);
			foreach($val['food'] as $food){
				if(floatval($food['price']) <= 0){
					continue;
				}
				$food_data = array(
					'cid' => $key + 1,
					'name' => $food['name'],
					'price' => $food['price'],
					'shop_id' => $shop_id
				);
				$this->food_model->food_insert($food_data);
			}
		}
	}


	function get_ajax_data()
	{
		$ch = curl_init($this->url."/userinfo?_=".time());
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		$output = curl_exec($ch);
		if($output){
			$res = json_decode($output, true);
			if($res['status'] == "ok"){
				return $res['data'];
			}
		}
	}




}
<?php


class Order_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_all_order($start_time, $end_time)
	{
		$sql = "SELECT *,(select username from user where user_id = oi.user_id) as username 
				FROM order_info AS oi
				LEFT JOIN shop AS s ON s.shop_id = oi.shop_id
				WHERE oi.add_time > '{$start_time}' AND oi.add_time < '{$end_time}' ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function get_min_luck_order($start_time, $end_time, $shop_id)
	{
		$sql = "SELECT *,(select username from user where user_id = oi.user_id) as username 
				FROM order_info AS oi
				LEFT JOIN shop AS s ON s.shop_id = oi.shop_id
				WHERE oi.add_time > '{$start_time}' AND oi.add_time < '{$end_time}' 
				AND oi.shop_id = $shop_id
				ORDER BY oi.luck ASC limit 1";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	function get_my_orders($user_id, $curr_page, $page_size)
	{	
		$start = ($curr_page - 1) * $page_size;
		$sql = "SELECT * FROM order_info 
				WHERE user_id = $user_id 
				ORDER BY add_time DESC";
		$query = $this->db->query($sql);
		$count = $query->num_rows();

		$sql.= " LIMIT $start, $page_size";
		$query = $query = $this->db->query($sql);
		$res = $query->result_array();
		return array('data' => $res,
					 'total_page' => ceil($count/$page_size),
					 'count' => $count);
	}

	function order_insert($data)
	{
		$this->db->insert("order_info", $data);
		return $this->db->insert_id();
	}

	function order_update($id, $data)
	{
		$this->db->where("id", $id);
		$this->db->update("order_info", $data);
	}

}
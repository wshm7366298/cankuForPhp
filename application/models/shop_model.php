<?php


class Shop_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_shops()
	{
		$sql = "SELECT * FROM shop";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function get_shop_info($shop_id)
	{
		$sql = "SELECT * FROM shop WHERE shop_id = $shop_id";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	function shop_insert($data)
	{
		$this->db->insert("shop", $data);
		return $this->db->insert_id();
	}

	function shop_update($id, $data)
	{
		$this->db->where("shop_id", $id);
		$this->db->update("shop", $data);
	}

	function shop_delete($shop_id)
	{
		$this->db->where("shop_id", $shop_id);
		$this->db->delete("shop");
		$this->db->where("shop_id", $shop_id);
		$this->db->delete("category");
		$this->db->where("shop_id", $shop_id);
		$this->db->delete("food");
	}

	function get_categories($shop_id, $cid = 0)
	{
		$sql = "SELECT * FROM category WHERE shop_id = $shop_id ";
		if($cid > 0)
			$sql.="AND cid = $cid";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function category_insert($data)
	{
		$this->db->insert("category", $data);
		return $this->db->insert_id();
	}

	function category_delete($key, $val)
	{
		$this->db->where($key, $val);
		$this->db->delete("category");
	}

}
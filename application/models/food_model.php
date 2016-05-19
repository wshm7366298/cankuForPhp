<?php


class Food_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_foods_by_shopid($shop_id, $cid)
	{
		$sql = "SELECT f.*,
				(SELECT name FROM category 
					WHERE cid = f.cid AND shop_id = f.shop_id) AS cate_name FROM food AS f
				LEFT JOIN shop AS s ON f.shop_id = s.shop_id WHERE f.shop_id = $shop_id ";
		if($cid > 0)
			$sql.="AND f.cid = $cid";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function food_insert($data)
	{
		$this->db->insert("food", $data);
	}

	function food_update($id, $data)
	{
		$this->db->where("id", $id);
		$this->db->update("food", $data);
	}

	function food_delete($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("food");
	}

	function get_foods_by_cid_and_shopid($cid, $shop_id)
	{
		$sql = "SELECT * FROM food WHERE cid = $cid AND shop_id = $shop_id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function get_food_by_id($id)
	{
		$sql = "SELECT * FROM food WHERE id = $id ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

}
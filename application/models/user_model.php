<?php


class User_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function user_login($username, $password)
	{
		$sql = "SELECT * FROM user WHERE username = '{$username}' AND password = '{$password}'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	function check_user($username, $email)
	{
		$sql = "SELECT * FROM user WHERE username = '{$username}' OR email = '{$email}'";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	function save($data)
	{
		$this->db->insert('user', $data);
		return $this->db->insert_id();
	}

	function get_userinfo($user_id)
	{
		$sql = "SELECT * FROM user WHERE user_id = $user_id ";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	function get_user_list($user_id)
	{
		$sql = "SELECT * FROM user WHERE user_id <> $user_id ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function update($user_id, $data)
	{
		$this->db->where("user_id", $user_id);
		$this->db->update("user", $data);
		return $this->db->affected_rows();
	}

	function delete_user($id)
	{
		$this->db->where("user_id", $id);
		$this->db->delete("user");
	}

}
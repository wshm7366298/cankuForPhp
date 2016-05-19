<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model("order_model");
		
	}

	function check_login()
	{
		$this->uid = $this->session->userdata("user_id");
		if(!$this->uid)
			redirect("/user/login");
		else
			$this->userinfo = $this->session->all_userdata();
		$this->data['userinfo'] = $this->userinfo;
	}

	public function index()
	{
		$this->login();
	}

	public function login()
	{
		$tip = isset($_REQUEST['tip']) && trim($_REQUEST['tip']) ? trim($_REQUEST['tip']) : "";
		switch($tip){
			case 'error':
				$msg = "帐号或密码错误.";
				break;
			case 'miss':
				$msg = "帐号密码不能为空.";
				break;
			default:
				$msg = null;
				break;
		}
		$this->load->view('user/login', array('tip' => $msg));
	}

	public function do_login()
	{
		$username = isset($_REQUEST['username']) && trim($_REQUEST['username']) ? trim($_REQUEST['username']) : "";
		$password = isset($_REQUEST['password']) && trim($_REQUEST['password']) ? trim($_REQUEST['password']) : "";
		if(!$username || !$password)
			redirect('/user/login?tip=miss');
		$row = $this->user_model->user_login($username, md5($password));
		if($row){
			$this->session->set_userdata($row);
			redirect('/home');
		}else{
			redirect('/user/login?tip=error');
		}
	}

	public function register()
	{
		$tip = isset($_REQUEST['tip']) && trim($_REQUEST['tip']) ? trim($_REQUEST['tip']) : "";
		switch($tip) {
			case 'error':
				$msg = "帐号或密码错误.";
				break;
			case 'miss':
				$msg = "帐号密码不能为空.";
				break;
			default:
				$msg = null;
				break;
		}
		$this->load->view('user/register', array('tip' => $msg));
	}

	public function do_register()
	{
		$username = isset($_REQUEST['username']) && trim($_REQUEST['username']) ? trim($_REQUEST['username']) : "";
		$password = isset($_REQUEST['password']) && trim($_REQUEST['password']) ? trim($_REQUEST['password']) : "";
		$email = isset($_REQUEST['email']) && trim($_REQUEST['email']) ? trim($_REQUEST['email']) : "";
		if(!$username || !$password || !$email)
			redirect('/user/register?tip=miss');
		$row = $this->user_model->check_user($username, $email);
		if($row){
			redirect('/user/register?tip=error');
		}else{
			$data = array('username' => $username, 
						  'email' => $email,
						  'password' => md5($password),
						  'reg_time' => time());
			$user_id = $this->user_model->save($data);
			if($user_id){
				$row = $this->user_model->get_userinfo($user_id);
				$this->session->set_userdata($row);
				redirect('/home');
			}
		}
	}

	public function forgetPassword()
	{
		$this->load->view('user/forgetpassword');
	}

	public function account()
	{
		$this->check_login();
		$this->load->view('user/account', $this->data);
	}

	function update_account()
	{
		$this->check_login();
		$pwd = isset($_REQUEST['pwd']) && trim($_REQUEST['pwd']) ? trim($_REQUEST['pwd']) : "";
		$new_pwd = isset($_REQUEST['new_pwd']) && trim($_REQUEST['new_pwd']) ? trim($_REQUEST['new_pwd']) : "";
		if($pwd && $new_pwd){
			$row = $this->user_model->get_userinfo($this->uid);
			if(md5($pwd) == $row['password']){
				$data = array('password' => md5($new_pwd));
				$rid = $this->user_model->update($this->uid, $data);
				if($rid){
					redirect("/user/account");
				}
			}
		}
	}

	public function order()
	{
		$this->check_login();
		$action = $this->uri->rsegment(3);
		if($action == "delete"){
			$id = isset($_REQUEST['id']) && intval($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
			if($id > 0){
				$this->order_delete($id);
				redirect("/user/order");
			}
		}
		$curr_page = isset($_REQUEST['curr_page']) && intval($_REQUEST['curr_page']) > 0 ? intval($_REQUEST['curr_page']) : 1;
		$page_size = isset($_REQUEST['page_size']) && intval($_REQUEST['page_size']) > 0 ? intval($_REQUEST['page_size']) : 5;
		$res = $this->order_model->get_my_orders($this->uid, $curr_page, $page_size);
		if(isset($res['data']) && $res['data']){
			foreach($res['data'] as $index => $item){
				$res['data'][$index]['goods'] = unserialize($item['content']);
			}
		}
		$this->data['orders'] = $res['data'];
		/* 分页开始 */
		$params = array(
			'total_rows'	=> $res['count'],
			'method'    	=> 'default',
			'parameter' 	=> '', 
			'now_page'  	=> $curr_page,
			'list_rows' 	=> $page_size,
		);
		include "./application/libraries/Pager.php";
		$page = new Pager($params);
		$this->data['bottom_pager'] = $page->show(1);
		$this->load->view('user/order', $this->data);
	}

	public function order_delete($id)
	{
		$data = array('canceled' => 1);
		$this->order_model->order_update($id, $data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect("/user/login");
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
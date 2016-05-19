<?php


if(!function_exists("load_view"))
{
	function load_view($part)
	{
		$ci = &get_instance();
		$ci->load->view($part);
	}
}

?>
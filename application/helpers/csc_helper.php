<?php

function is_logged_in()
{
	$ci = get_instance();
	if (!$ci->session->userdata('email')) {
		redirect('auth');
	} else {
		$role_id = $ci->session->userdata('role_id');
		$access = $ci->session->userdata('access');
		// var_dump($role_id, $access);
		// die();

		if ($role_id > $access) {

			redirect('auth/blocked');
		}
	}
}

function check_access($role_id, $menu_id)
{
	$ci = get_instance();

	$ci->db->WHERE('role_id', $role_id);
	$ci->db->WHERE('menu_id', $menu_id);
	$result = $ci->db->get('user_access_menu');

	if ($result->num_rows() > 0) {
		return "checked='checked'";
	}
}

<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $uri = $ci->uri->segment(1);
        // if ($ci->uri->segment(2)) {
        //     if ($ci->uri->segment(2) == 'roleaccess') {
        //         $uri = $ci->uri->segment(1);
        //     } else {
        //         $uri = $ci->uri->segment(1) . '/' . $ci->uri->segment(2);
        //     }
        // } else {
        //     $uri = $ci->uri->segment(1);
        // }



        $queryMenu = $ci->db->get_where('user_menu', ['uri' => $uri])->row_array();
        // $queryMenu = $ci->db->get_where('user_sub_menu', ['url' => $uri])->row_array();
        $menu_id = $queryMenu['id'];

        // var_dump($uri);
        // var_dump($role_id); //debug 403 blocked
        // var_dump($menu_id); //debug 403 blocked
        // die;
        // echo $uri . ' ini ' . $menu_id . ' role ' . $role_id;

        $userAccess = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);

        if ($userAccess->num_rows() < 1) {

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

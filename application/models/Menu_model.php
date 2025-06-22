<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Menu_model extends CI_Model
{

    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                    FROM `user_sub_menu` Join `user_menu`
                    on `user_sub_menu`.`menu_id` = `user_menu`.`id`
                    ORDER BY `user_sub_menu`.`id` ASC
        ";
        return  $this->db->query($query)->result_array();
    }
    public function getAltSubMenu()
    {
        $query = "SELECT `user_alt_submenu`.*, `user_sub_menu`.`title`
                    FROM `user_alt_submenu` Join `user_sub_menu`
                    on `user_alt_submenu`.`submenu_id` = `user_sub_menu`.`id`
        ";
        return  $this->db->query($query)->result_array();
    }
}

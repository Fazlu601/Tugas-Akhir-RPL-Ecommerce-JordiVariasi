<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                    FROM `user_sub_menu` JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                    ";

        return $this->db->query($query)->result_array();
    }

    public function getUser()
    {
        $query = "SELECT `user`.*, `user_role`.`role`
        FROM `user` JOIN `user_role`
        ON `user`.`role_id` = `user_role`.`id` GROUP BY `user`.`role_id` ASC , `user`.`id_user`
        ";

        return $this->db->query($query)->result_array();
    }

    public function editRole($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
}

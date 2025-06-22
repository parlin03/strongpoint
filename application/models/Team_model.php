<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Team_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }
    public function getAdam21()
    {
        $query = "SELECT username, 
        COUNT(IF(program = 'Beasiswa PIP',1,NULL)) AS 'pip',
        COUNT(IF(program = 'Beasiswa KIP',1,NULL)) AS 'kip',
        COUNT(IF(program = 'BPUM',1,NULL)) AS 'bpum',
        COUNT(IF(program = 'Bedah Rumah',1,NULL)) AS 'br'
        FROM (select user_id,username, program from lks_vjp  join user on lks_vjp.user_id=user.id ) 
         as dummy_table GROUP by user_id ORDER BY `user_id` ASC
        ";
        //  return  $this->db->query($query)->result_array();
        //  return $query->result();

        return  $this->db->query($query)->result_array();
    }
}

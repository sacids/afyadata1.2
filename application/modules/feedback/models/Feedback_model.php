<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 16/12/2018
 * Time: 22:22
 */

class Feedback_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    /**
     * @param $where_perm
     * @param $where_array
     * @param $created_on
     * @return mixed
     */
    function find_all($where_perm, $where_array, $created_on = NULL)
    {
        //        if (is_array($where_perm)) {
//            $this->db->group_start();
//            foreach ($where_perm as $key => $value) {
//                $this->db->or_like("table_name", $value);
//            }
//            $this->db->group_end();
//        } else {
//            $this->db->where("table_name", $where_perm);
//        }



        if ($created_on != NULL)
            $this->db->where('created_on >', $created_on);


        return $this->db
            ->where_in('created_by', $where_array)->get('feedback')->result();
    }
}
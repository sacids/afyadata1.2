<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 06/01/2018
 * Time: 23:42
 */

class User_model extends CI_Model
{
    private static $table_name = "users";

    function __construct()
    {
        parent::__construct();
    }

    /**
     * @param type
     * @return int
     */
    function count_users()
    {
        return $this->db->count_all_results(self::$table_name);
    }

    /**
     * @param $num
     * @param $start
     * @return array
     */
    function get_users_list($num, $start)
    {
        return $this->db
            ->limit($num, $start)
            ->get(self::$table_name)->result();
    }

    /**
     * @param $user_id
     * @return mixed
     */
    function get_user_by_id($user_id)
    {
        return $this->db
            ->get_where(self::$table_name, array('id' => $user_id))->row();
    }

    /**
     * @param type
     * @return mixed
     */

    function get_user_by_email($email)
    {
        return $this->db
            ->get_where(self::$table_name, array('email' => $email))->row();
    }


    /**
     * @param $username
     * @return mixed
     */
    function get_user_by_username($username)
    {
        return $this->db
            ->get_where(self::$table_name, array('username' => $username))->row();
    }

    /**
     * @return array
     */
    function get_user_groups()
    {
        return $this->db->get('groups')->result();
    }
}
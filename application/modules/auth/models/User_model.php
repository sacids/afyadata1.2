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
     * @return array
     */
    function find_all()
    {
        return $this->db
            ->order_by('first_name', 'ASC')
            ->get(self::$table_name)->result();
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
     * @param null $group_id
     * @param null $keyword
     * @return array
     */
    function search_users_list($group_id = null, $keyword = null)
    {
        if ($group_id != null)
            $this->db->where('users_groups.group_id', $group_id);

        if ($keyword != NULL) {
            $this->db->group_start();
            $this->db->like('users.first_name', $keyword);
            $this->db->or_like('users.last_name', $keyword);
            $this->db->or_like('users.username', $keyword);
            $this->db->group_end();
        }

        return $this->db
            ->select('users.id, users.first_name, users.last_name, users.username, users.email,users.phone, users.active')
            ->group_by('users.id')
            ->join('users_groups', 'users_groups.user_id = users.id')
            ->get('users')->result();
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

    /**
     * @param $user_id
     * @return array
     */
    public function get_user_groups_by_id($user_id)
    {
        $this->db->select("ug.*,g.*");
        $this->db->from("users_groups ug");
        $this->db->join("users u", "u.id = ug.user_id");
        $this->db->join("groups g", "g.id = ug.group_id");
        $this->db->where("ug.user_id", $user_id);
        return $this->db->get()->result();
    }

    public function get_my_perms($my_id = false)
    {
        if (!$my_id) {
            $my_id = $this->session->userdata('user_id');
        }

        $my_perms = array('X' . $my_id . 'X' => 'X' . $my_id . 'X');
        $my_perms = array('P' . $my_id . 'P' => 'P' . $my_id . 'P');


        // set group perms
        $this->db->where('user_id', $my_id);
        $query = $this->db->get('users_groups');

        foreach ($query->result() as $row) {
            $key = 'G' . $row->group_id . 'G';
            $val = 'G' . $row->group_id . 'G';
            $my_perms[$key] = $val;
        }

        return $my_perms;
    }

    /**
     * @return int
     */
    function count_groups()
    {
        return $this->db->get('groups')->num_rows();
    }

    /**
     * @param $num
     * @param $start
     * @return array
     */
    function get_group_list($num = 30, $start = 0)
    {
        return $this->db
            ->order_by('name', 'ASC')
            ->limit($num, $start)
            ->get('groups')->result();
    }

    /**
     * @param $id
     * @return mixed
     */
    function get_group_by_id($id)
    {
        return $this->db->get_where('groups', array('id' => $id))->row();
    }
}
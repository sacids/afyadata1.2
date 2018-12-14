<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 13/08/2018
 * Time: 13:00
 */

class Project_model extends CI_Model
{
    private $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->user_id = $this->session->userdata('user_id');
    }

    /**
     * @param $data
     * @return int
     */
    function create_project($data)
    {
        $result = $this->db->insert('projects', $data);

        if ($result)
            return $this->db->insert_id();
        else
            return null;
    }

    /**
     * @param $data
     * @param $project_id
     * @return bool
     */
    function update_project($data, $project_id)
    {
        return $this->db->update('projects', $data, array('id' => $project_id));
    }

    /**
     * @param $project_id
     * @return mixed
     */
    function delete_project($project_id)
    {
        return $this->db->delete('projects', array('id' => $project_id));
    }

    /**
     * @return mixed
     */
    function count_projects()
    {
        return $this->db
            ->get('projects')->num_rows();
    }

    /**
     * @return array
     */
    function find_all()
    {
        return $this->db->get('projects')->result();
    }

    /**
     * @param $num
     * @param $start
     * @return array
     */
    function get_projects_list($num, $start)
    {
        return $this->db
            ->order_by('created_at', 'DESC')
            ->limit($num, $start)
            ->get('projects')->result();
    }

    /**
     * @param $id
     * @return mixed
     */
    function get_project_by_id($id)
    {
        return $this->db
            ->get_where('projects', array('id' => $id))->row();
    }
}
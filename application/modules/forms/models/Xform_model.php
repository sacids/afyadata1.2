<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 11/01/2018
 * Time: 18:12
 */

class Xform_model extends CI_Model
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
    function create_form($data)
    {
        $result = $this->db->insert('xforms', $data);

        if ($result)
            return $this->db->insert_id();
    }

    /**
     * @param $data
     * @param $form_id
     * @return bool
     */
    function update_form($data, $form_id)
    {
        return $this->db->update('xforms', $data, array('id' => $form_id));
    }

    /**
     * @param $id
     * @return mixed
     */
    function delete_form($id)
    {
        return $this->db->delete('xforms', array('id' => $id));
    }

    /**
     * @param $submission_id
     * @return mixed
     */
    public function delete_submission($submission_id)
    {
        return $this->db->delete('xform_submission', array('id' => $submission_id));
    }

    /**
     * @param $statement
     * @return bool
     */
    public function create_table($statement)
    {
        if ($this->db->simple_query($statement)) {
            log_message("debug", "Success!");
            return TRUE;
        } else {
            $error = $this->db->error(); // Has keys 'code' and 'message'
            log_message("debug", $statement . ", error " . json_encode($error));
            return FALSE;
        }
    }

    /**
     * @param $statement
     * @return bool
     */
    public function insert_data($statement)
    {
        if ($this->db->simple_query($statement)) {
            log_message("debug", "Data insert success!");
            return $this->db->insert_id();
        } else {
            $error = $this->db->error(); // Has keys 'code' and 'message'
            log_message("debug", $statement . ", error " . json_encode($error));
            return FALSE;
        }
    }

    /**
     * @param $project_id
     * @return int
     */
    function count_forms($project_id = null)
    {
        if ($project_id != null)
            $this->db->where('project_id', $project_id);

        return $this->db
            ->get('xforms')->num_rows();
    }

    /**
     * @param $project_id
     * @param $num
     * @param $start
     * @return array
     */
    function get_forms_list($project_id = null, $num, $start)
    {
        if ($project_id != null)
            $this->db->where('project_id', $project_id);

        return $this->db
            ->order_by('created_at', 'DESC')
            ->limit($num, $start)
            ->get('xforms')->result();
    }

    function get_form_by_id($id)
    {
        return $this->db
            ->get_where('xforms', array('id' => $id))->row();
    }

    /**
     * @param $form_id
     * @return mixed
     */
    function find_by_form_id($form_id)
    {
        return $this->db
            ->get_where('xforms', array('form_id' => $form_id))->row();
    }

    /**
     * @param array $perms
     * @param null $status
     * @return mixed
     */
    public function get_form_list_by_perms($perms, $status = NULL)
    {
        if (is_array($perms)) {
            $this->db->group_start();
            foreach ($perms as $key => $value) {
                $this->db->or_like("perms", $value);
            }
            $this->db->group_end();
        } else {
            $this->db->where("perms", $perms);
        }

        if ($status != NULL)
            $this->db->where("status", $status);

        return $this->db->get('xforms')->result();
    }


    /**
     * @param $data
     * @return mixed
     */
    public function add_to_field_name_map($data)
    {
        $q = $this->db->insert_string('xform_field_map', $data);
        $q = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $q);
        return $this->db->query($q);
    }

    /**
     * @param $table_name
     * @param $hide_show_status
     * @return mixed
     */
    public function get_fieldname_map($table_name, $hide_show_status = null)
    {
        if ($hide_show_status != NULL)
            $this->db->where("hide", $hide_show_status);

        return $this->db->get_where('xform_field_map', array('table_name' => $table_name))
            ->result_array();
    }

    /**
     * @param $form_id
     * @return mixed
     */
    public function get_form_definition_filename($form_id)
    {
        $this->db->select('attachment')->where('form_id', $form_id)->from('xforms');
        return $this->db->get()->row(1)->attachment;
    }


    /**
     * @param $table_name
     * @return mixed return an object of fields of the specified table
     */
    function find_table_columns($table_name)
    {
        return $this->db->list_fields($table_name);
    }

    /**
     * @param $table_name
     * @return mixed returns table fields/columns with metadata object
     */
    function find_table_columns_data($table_name)
    {
        return $this->db->field_data($table_name);
    }

    /**
     * @param $table_name
     * @return int
     */
    function count_all_records($table_name)
    {
        return $this->db->count_all_results($table_name);
    }

    /**
     * @param $table_name
     * @param $num
     * @param $start
     * @return array
     */
    public function find_form_data($table_name, $num, $start)
    {
        return $this->db
            ->order_by("id", "DESC")
            ->limit($num, $start)
            ->get($table_name)->result();
    }

    /**
     * @param $details
     * @return mixed
     */
    public function create_field_name_map($details)
    {
        return $this->db->insert('xform_field_map', $details);
    }

    /**
     * @param $table_name
     * @param $column_name
     * @return bool
     */
    public function xform_table_column_exists($table_name, $column_name)
    {
        $this->db->where("table_name", $table_name);
        $this->db->where("col_name", $column_name);
        //$this->db->limit(1);
        return ($this->db->get('xform_field_map')->num_rows() > 0) ? TRUE : FALSE;
    }

    /**
     * Updates multiple field maps
     *
     * @param $details
     * @return mixed
     */
    public function update_field_name_maps($details)
    {
        return $this->db->update_batch('xform_field_map', $details, "id");
    }

    /**
     * @param $number
     * @return string
     */
    function get_column_letter($number)
    {
        $numeric = $number % 26;
        $suffix = chr(65 + $numeric);
        $prefNum = intval($number / 26);
        if ($prefNum > 0) {
            $prefix = $this->get_column_letter($prefNum - 1) . $suffix;
        } else {
            $prefix = $suffix;
        }
        return $prefix;
    }


}
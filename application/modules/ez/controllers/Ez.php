<?php
//defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Ez extends CI_Controller {
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * http://sacids.com/index.php/start
	 * - or -
	 * http://example.com/index.php/welcome/index
	 * - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/dashboard/<method_name>
	 */
	var $module_id;
	var $perm_id;
	var $render_tbl_id;
	var $limit = 10;
	var $offset = 10;
	var $perm_cond;
	var $u_data;
	var $perm_act;
	var $perm_item;
	var $perm_tree;
    var $my_perm;
    var $project_tree;
    var $project_id;
	

	public function __construct() {

		parent::__construct();

		$this->load->model(array('model','Perm_model'));
		$this->load->library(array('db_exp','ion_auth'));

		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$this->init();


	}
	function _remap($method_name = 'index') {
		if (! method_exists ( $this, $method_name )) {
			$this->index ();
		} else {
			$this->{$method_name} ();
		}
	}
	public function login(){
		$this->load->view('plus/head');
		$this->load->view('plus/login');
		$this->load->view('plus/foot');
	}

	public function index(){

        $this->u_data = $this->session->userdata;
        //print_r($this->u_data);


        $this->view_start();

        switch($this->perm_act){

            case 'l':
                //echo 'list'; exit();
                $this->list_content();
                break;
            case 'a':
                //echo 'add';
                $this->add_content();
                break;
            case 'd':
                //echo 'delete';
                break;
            case 'w':
                //edit
                $this->do_controller();
                break;
            case 'm':
                //echo 'manage'; exit();
                $this->manage_content();
                break;
            case 'p':
                echo 'projects';
                break;
            default:
                //echo 'default'; exit();
                $this->welcome();
                break;
        }

        $this->view_end();

	}

    private function init(){
        //$this->session->set_userdata('user_id',1);
        $this->user_id = $this->ion_auth->get_user_id();
        $this->current_user = $this->user_id;
        $this->current_date = date('Y-m-d H:i:s');
        $this->perm_decode();
        $this->set_perms();
        $this->set_perm_tree();
        $this->set_project_tree();

        $this->my_perm = 'P'.$this->user_id.'P';
    }

	private function perm_decode(){

        $args   = $this->uri->segment_array();


        if($this->uri->total_segments() < 3){
            $this->module_id    = false;
            $this->perm_id      = false;
            $this->perm_act     = false;
            return;
        }

        $this->module_id    = $args[2];
        $this->perm_id      = $args[3];
        $this->perm_act     = $args[4];

        if($this->uri->total_segments() == 5){
            $this->perm_item    = $args[5];
        }


    }
	private function view_start(){

        $this->load->view('ez/head');
        $this->load->view('ez/page_start');
        $this->load->view('ez/top_nav', $this->u_data);
        if($this->ion_auth->is_admin()) $this->load->view('ez/side_nav',$this->u_data);
    }
    private function view_end(){

        $this->load->view('ez/page_end');
        $this->load->view('ez/foot');
    }
    private function list_content(){

        $data	= $this->get_list() + array('title' => $this->perm_tree[$this->module_id]['tasks'][$this->perm_id]->title);

        $this->session->set_userdata('perm_id',$this->perm_id);

	    $this->load->view('ez/list',$data);
    }
    private function do_controller(){

        $data   = $this->perm_tree[$this->module_id]['tasks'][$this->perm_id];
        $this->session->set_userdata('perm_id',$this->perm_id);
        $this->load->view('ez/cntr', $data);
    }

    private function add_content(){

        $data	= array('title' => $this->perm_tree[$this->module_id]['tasks'][$this->perm_id]->title);

        $this->session->set_userdata('perm_id',$this->perm_id);

        $this->load->view('ez/add',$data);
    }


    private function manage_content(){

        $data	= $this->get_page($this->perm_item);

        $this->session->set_userdata('perm_id',$this->perm_id);

        $this->load->view('ez/page',$data);
    }

	private function welcome(){

        $this->load->view('ez/project_main');
    }
	

	
	public function edit(){
	   
	    $nav['module_name'] = ucwords(strtolower($this->uri->segments[2] . ' ' . $this->uri->segments[3]));
	    $this->load->view('plus/head');
	    $this->load->view('plus/nav', $nav);
	    $this->load->view('plus/edit');
	    $this->load->view('plus/foot');
	    
	    
	    
	}



	private function set_perms(){


        $cond   = " (0 OR ( perms like '%P".$this->user_id."P%' ";

        $this->model->set_table('users_groups');
        foreach ($this->model->as_array()->get_many_by('user_id', $this->user_id) as $row) {
            $cond    .= " OR perms like '%G".$row['group_id']."G%'";
        }

        $cond .= ') )';
        $this->perm_cond = $cond;
    }


	private function set_perm_tree(){

        $this->model->set_table('perm_module');

        $this->db->where($this->perm_cond);
        $modules = $this->model->get_all();

        foreach ($modules as $row) {

            $row->active = 0;
            $this->perm_tree[$row->id]['module'] = $row;
        }

        $available_modules  = array_keys($this->perm_tree);
        $this->model->set_table('perm_tree');
        $this->db->where($this->perm_cond);
        $this->db->where_in('module_id',$available_modules);
        $tasks = $this->model->get_all();
        $flag  = 0;

        foreach ($tasks as $row) {

            $row->active = 0;
            if($this->perm_id == $row->id){

                $this->perm_tree[$row->module_id]['module']->active = 1;
                $row->active = 1;
            }
            if(!$this->perm_id && !$flag ){
                $this->perm_tree[$row->module_id]['module']->active = 1;
                $row->active = 1;
                $flag = 1;
            }

            $this->perm_tree[$row->module_id]['tasks'][$row->id] = $row;

        }
    }

    private function set_project_tree(){

        $this->model->set_table('projects');

        $this->db->where($this->perm_cond);
        $projects = $this->model->get_all();

        foreach ($projects as $row) {

            $row->active = 0;
            $this->project_tree[$row->id]['project'] = $row;
        }

        if(empty($this->project_tree)) return; $available_projects  = array_keys($this->project_tree);
        $this->model->set_table('xforms');
        $this->db->where($this->perm_cond);
        $this->db->where_in('project_id',$available_projects);
        $xforms = $this->model->get_all();
        $flag  = 0;

        foreach ($xforms as $row) {

            $row->active = 0;
            if($this->project_id == $row->id){

                $this->project_tree[$row->project_id]['project']->active = 1;
                $row->active = 1;
            }
            if(!$this->project_id && !$flag ){
                $this->project_tree[$row->project_id]['project']->active = 1;
                $row->active = 1;
                $flag = 1;
            }

            $this->project_tree[$row->project_id]['xform'][$row->id] = $row;
        }
    }

	private function array_filter($arr)
	{

		foreach ($arr as $key => $value) {
			if (empty($value)) {
				unset($arr[$key]);
			}
		}
		return $arr;
	}
	private function check_perm($cat = 'add') {

		if ($this->session->userdata ( 'user_id' ) < 3) {
			// super user
			return true;
		}

		$cond = $this->perm_cond . " AND `perm_tree_id` = '" . $this->perm_id . "' AND `category` = '" . $cat . "'";

		$this->model->set_table('perm_config');
		$res = $this->model->as_array()->get_many_by($cond);

		if (! $res) {
			return false;
		} else {
			return $res;
		}
	}
	private function get_tab_cond(){
	    $holder    = array();
	    $cond   = ' 1 = 1 ';
	    if ($this->session->userdata ( 'user_id' ) == 1) {
	        $cond = '1 = 1';
	    }else{
	        
	        $res   = $this->check_perm('tab');
	        if(is_array($res)) {
                foreach ($res as $row) {
                    $holder += explode(',', $row['filters']);
                }

                $cond = " id IN (".implode(",", $holder).")";
            }

	        return $cond;
	        
	    }
	    
	}
	private function get_list_cond() {
		if ($this->session->userdata ( 'user_id' ) == 1) {
			$cond = '1 = 1';
		}else {

			$filters = $this->get_filters ();
            $cond   = ($filters ? $this->filter2condition ( $filters ) : '1 = 1');

		}

		return $cond;
	}
	private function get_filters($cat = 'list') {

		$cond = $this->perm_cond . " AND `perm_tree_id` = '$this->perm_id' AND `category` = '" . $cat . "'";
		$this->model->set_table('perm_config');
		$this->db->where($cond);
		$filters    = $this->model->as_array()->get_all();

		//$filters = $this->Perm_model->get_data_from_table ( 'perm_config', $cond );

		if (empty($filters)) {
			return false;
		}

		$holder = array ();
		foreach ( $filters as $val ) {
			// print_r($val);
			array_push ( $holder, $val ['filters'] );
		}

		// print_r($holder);

		return $holder;
	}
	private function filter2condition($filters) {
		$holder = array ();
		foreach ( $filters as $filter ) {
			$tmp = $this->get_condition ( $filter );
			array_push ( $holder, $tmp );
		}
		$cond = " FALSE OR ( " . implode ( " OR ", $holder ) . " )";
		return $cond;
	}
	private function get_table_config() {

		$holder = array ();
		$this->model->set_table('perm_tables_conf');
		$res    = $this->model->as_array()->get_many_by('table_id',$this->render_tbl_id);

		foreach($res as $val){
			$index = $val ['field_name'];
			foreach ( $val as $k => $v ) {
				$holder [$index] [$k] = $v;
			}
		}

		return $holder;
	}
	private function get_condition($filter_list) {
		$filter_ids = explode ( ',', $filter_list );
        //print_r($filter_ids);
		$holder = array ();
		foreach ( $filter_ids as $filter_id ) {

			$filter_id = trim ( $filter_id );

			$tmp_a1 = array ();
			$this->model->set_table('perm_filter_config');
			$results = $this->model->as_array()->get_many_by('perm_filter_id',$filter_id);
			//print_r($results);

			foreach ( $results as $val ) {
				$field_name = $val ['field_name'];
				$oper = $val ['oper'];
				$field_value = $val ['field_value'];

				if(substr($field_value,0,2) == "--"){

					// field value is obox  (PERM controller) function
					$tmp			= substr($field_value,2);
					$field_value	= $this->{$tmp};
				}
				if(substr($field_value,0,2) == "__"){
					// field value is an obox (PERM controller) constant
					$tmp			= substr($field_value,2);
					$field_value	= strtoupper($tmp);

				}
                if(substr($field_value,0,6) == "select"){

				    $sel    = explode(":",$field_value);
				    $field_value	= "( select ".$sel[1]." from ".$sel[2]." where ".$sel[3]." )";

                }

				$tmp = " ( a." . $field_name . " " . $oper . " " . $field_value . " ) ";
				array_push ( $tmp_a1, $tmp );
			}

			$tmp2 = "( " . implode ( ' AND ', $tmp_a1 ) . " )";
			array_push ( $holder, $tmp2 );
		}

		$cond = "( " . implode ( ' OR ', $holder ) . " )";

		//echo $cond;

		return $cond;
	}

	
	private function get_list($page = 0){
	    
	    $ret    = array();

	    if($this->perm_id){

            $tmp        = $this->perm_tree[$this->module_id]['tasks'][$this->perm_id]->perm_data;
	        $perm_data  = json_decode($tmp, true);
	        
	        //echo 'sema'; print_r($conf);
	        
	        $this->render_tbl_id = $perm_data['table_id'];
	        
	        $this->model->set_table('perm_tables');

	        $table_name = $this->model->get($this->render_tbl_id)->table_name;
	        
	        $ret['table_name']      = $table_name;
	        $ret['perm']['add']     = $this->check_perm('add');
	        $ret['perm']['del']     = $this->check_perm('del');
	        $ret['perm']['data']	= $perm_data;
	        $ret['table_id']		= $this->render_tbl_id;
	        $ret['perm_id']         = $this->perm_id;
	        //$ret['post']         = $post;
	        
	    }else{
	        return false;
	    }
	        
	    // set filters
	    $this->model->set_table($table_name);
	    $ret['field_data'] = $this->db->field_data($table_name);
	    $ret['cond']       = $this->get_list_cond();
	    $ret['conf']       = $this->get_table_config();
	    $ret['perm_id']    = $this->perm_id;
	    return $ret;
	    
	}

	
	private function get_page($row_id){

        $tmp        = $this->perm_tree[$this->module_id]['tasks'][$this->perm_id]->perm_data;
        $perm_data  = json_decode($tmp, true);
	    $this->render_tbl_id = $perm_data['table_id'];
	    
	    $this->model->set_table('perm_tables');
	    $table_name = $this->model->get($this->render_tbl_id)->table_name;
	    
	    $this->model->set_table($table_name);

	    $tbl_data       = $this->model->as_array()->get($row_id);
	    
	    $cond = $this->get_tab_cond();
	    $tmp   = array();
	    $tmp['id'] = $row_id;
	    $tmp['table_name'] = $table_name;
	    $tmp['table_id']    = $this->render_tbl_id;
	    
	    $ret['tabs']   = $this->Perm_model->get_tabs ( $tmp, $cond );
	    $ret['data']   = $tbl_data;
	    $ret['conf']   = $this->get_table_config();
	    $ret['perm_id']          = $this->perm_id;

	    return $ret;
	    
	}
	
	
	private function display_field($field_name, $field_val){

		if(!$map	= $this->get_field_value_map($this->render_tbl_id)){
			return $field_val;
		};
		//echo '<pre>'; print_r($map);
		if(array_key_exists($field_name,$map) && array_key_exists($field_val,$map[$field_name])){
			return $map[$field_name][$field_val];
		}else{
			return $field_val;
		}


	}
	private function get_field_value_map($table_id = 14){

		unset($this->session->userdata['table_map'][$table_id]);
		if(isset($this->session->userdata['table_map'][$table_id])){
			return $this->session->userdata['table_map'][$table_id];
		}

		// set the array
		$holder	= array();
		if(!$table_conf	= $this->Perm_model->get_table_data('perm_tables_conf','table_id',$table_id)){
			return false;
		}

		foreach($table_conf as $row){
			$field_property	= $row['field_property'];
			$field_name		= $row['field_name'];
			if($field_property == 'db_dropdown'){


				$tmp	= explode(":",$row['field_value']);
				$tbl	= $tmp[0];
				$key	= $tmp[1];
				$lbl	= $tmp[2];

				// get all results
				$res	= $this->Perm_model->get_data_from_table($tbl);
				foreach($res as $v){
					$k	= $v[$key];
					$l	= $v[$lbl];
					$holder[$field_name][$k]	= $l;
				}
			}else{
				$holder[$field_name]	= array();
			}
		}

		//print_r($holder);
		$this->session->userdata['table_map'][$table_id]	= $holder;

		return $this->session->userdata['table_map'][$table_id];

	}
	public function db_table_render($table_id) {

	    
	    $this->model->set_table('perm_tables');

		$table_name = $this->model->get($table_id)->table_name;
		$this->model->set_table('perm_tables_conf');
		$fields = $this->array_filter($this->model->as_array()->get_many_by('table_id',$table_id));

		//echo '<pre>'; print_r($fields);

		$this->db_exp->set_table ( $table_name );
		if (! sizeof($fields)) {
			log_message ( 'debug', 'in db_table_render: table has no configs' );
			return;
		}

		foreach ( $fields as $field ) {

			parse_str ( $field ['field_value'], $args );

			$validation = $field['validation'];
			if($validation != ''){
				$this->db_exp->set_validation($field['field_name'],$validation);
			}

			switch ($field ['field_property']) {

				case 'date' :
					$this->db_exp->set_date ( $field ['field_name'] );
					break;
				case 'time' :
					$this->db_exp->set_time ( $field ['field_name'] );
					break;
				case 'CI db_func' :
					$func_name = $args ['name'];
					if ($func_name == 'list_tables') {
						$options = $this->db->list_tables ();
						$this->db_exp->set_list ( $field ['field_name'], $options,TRUE );
					}
					if ($func_name == 'select_tables') {
						$options = $this->db->list_tables ();
						$this->db_exp->set_select ( $field ['field_name'], $options, TRUE );
					}

					break;
				case 'password' :
					$this->db_exp->set_password ( $field ['field_name'] );
					break;
				case 'password_dblcheck' :
					$this->db_exp->set_password_dblcheck ( $field ['field_name'] );
					break;
				case 'label' :
					$this->db_exp->set_label( $field ['field_name'], $field ['field_value']);
					break;
				case 'view' :
					$this->db_exp->set_readonly( $field ['field_name']);
					break;
				case 'upload' :
					$this->db_exp->set_upload( $field ['field_name']);
					break;
				case 'dropdown' :
					$options = explode ( ",", $field ['field_value'] );
					$this->db_exp->set_select ( $field ['field_name'], $options, true );
					break;
				case 'db_dropdown' :
				    echo 'sema';
					$options = explode ( ":", $field ['field_value'] );
					$cond = false;
					if (array_key_exists ( 3, $options ))
						$cond = $options [3];
					$this->db_exp->set_db_select ( $field ['field_name'], $options [0], $options [1], $options [2], $cond );
					break;
				case 'q_dropdown' :
				    $q      = $field ['field_value'];
				    $s      = $this->db->query($q);
				    $o      = array();
				    foreach ($s->result() as $row){
				        $o[$row->id]    = $row->label;
				    }
				    $this->db_exp->set_select ( $field ['field_name'], $o );
				    break;
                case 'multiselect':
                    $options = explode ( ",", $field ['field_value'] );
                    $this->db_exp->set_list ( $field ['field_name'], $options, true );
                    break;
                case 'db_multiselect':
                    $options = explode ( ":", $field ['field_value'] );
                    $cond = array_key_exists ( 3, $options ) ? $options [3] : false;
                    $this->db_exp->set_db_list ( $field ['field_name'], $options [0], $options [1], $options [2], $cond );
                    break;
				case 'textarea' :
					$this->db_exp->set_textarea ( $field ['field_name'], $field ['field_value'] );
					break;

				case 'hidden' :
                    log_message('debug', 'in hidden '.$field ['field_property']);
					$value = $field ['field_value'];
					if(substr($value,0,2) == "##"){
						// session value
						$value			= $this->session->userdata(substr($value,2));
					}
					if(substr($value,0,2) == "__"){
					    // class variable
					    $value			= $this->{substr($value,2)};
					}
					$this->db_exp->set_hidden ( $field ['field_name'], $value );
					break;
				case 'formula' :
					$this->db_exp->set_formula ( $field ['field_name'], $field ['field_value'] );
					break;
				case 'service' :
					$this->db_exp->set_service ( $field ['field_name'], $field ['field_value'] );
					break;
				case 'Perm':
					$available_perms = $this->Perm_model->get_all_perms ();
					$this->db_exp->set_list ( $field ['field_name'], $available_perms );
					break;
			}
		}
	}

	public function load(){
	    
	    $this->perm_id = $this->input->post('perm_id');
	    $ret   = $this->get_list($this->input->post('page'));
	    $this->load->view('plus/list_load',$ret);
	    
	}
	private function save_dbexp_vars() {
		$post = $this->input->post ();
		$get  = $this->input->get ();

		$db_exp_submit = $this->input->post ( 'db_exp_submit_engaged' );
		if (! empty ( $db_exp_submit ) || @$post ['action'] == 'insert' || @$post ['action'] == 'edit' || @$post ['action'] == 'delete') {
		} else {
			$this->session->set_userdata ( 'post', $post );
			$this->session->set_userdata ( 'get', $post );
		}
	}
	
	public function data_table_processing(){


	    $columns   = json_decode($this->input->get('column'),true);
	    $cond      = $this->input->get('cond');
        $table     = $this->input->get('tn');
        $q1        = $this->input->get('q1');


	    //echo '<pre>';
	    //echo $table;
	    //print_r($_GET);
	    
	    // Table's primary key
	    $primaryKey = 'id';
	    //
	    $tmp = array(
	        'db' => 'id',
	        'dt' => 'DT_RowId',
	        'formatter' => function( $d, $row ) {return 'row_'.$d;}
	        );
	    array_push($columns, $tmp);
	    
	    
	    
	    //print_r($tmp);
	    
	    $sql_details = array(
	        'user' => $this->db->username,
	        'pass' => $this->db->password,
	        'db'   => $this->db->database,
	        'host' => $this->db->hostname
	    );
	    
	    require( 'vendors/limitless/global_assets/php/datatables/ssp.class.php' );
	    
	    echo json_encode(
	        SSP:: complex( $_GET, $sql_details, $table, $primaryKey, $columns, '','', $q1 )
	        );
	    
	}
	
	public function show_print(){
	    
	    $this->load->view('obox/print/imp1');
	}


}

/* End of file start.php */
/* Location: ./application/controllers/start.php */
<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

//$this->output .= '<script src="'.base_url().'assets/public/ckeditor/ckeditor.js"></script>';

class Db_exp
{
    public $table;
    public $default_action;
    public $pri_id;
    public $fields = array();
    public $actions = array();
    public $search_condition;
    public $form_action;
    public $form_attributes;
    public $form_id;
    public $output = '';
    var $insert_id;
    public $form_hidden = array();

    public function __construct()
    {

        //$this->load->library('form_validation');
        $this->pri_id = 0;
        $this->form_action = uri_string().'?'.$_SERVER['QUERY_STRING'];;
        $this->default_action = 'edit';
        $this->search_condition = false;
        $this->actions['link'] = array();
        $this->fields = array();

        $this->form_hidden['db_exp_submit_engaged'] = 1;
        $this->show_form_after_submit = true ;
        $this->show_submit_button = true;
        $this->show_insert_button = true;
        $this->show_delete_button = true;
        $this->show_edit_button = true;
        $this->is_posted    = false;
        $this->output = '';

        $this->ci   = &get_instance();
        $this->ci->load->library('upload');
        $this->ci->load->library('EvalMath');
        $this->ci->load->library('form_validation');

        $this->EvalMath = new EvalMath();

        //echo '<pre>'; print_r($this->ci->input->get());echo '</pre>';

        $form_id    = array_key_exists('form_id', $_REQUEST) ? $this->ci->input->post_get('form_id') : '';
        $this->form_target = $form_id;
        if(empty($form_id)) $form_id = uniqid();

        $this->form_id = 'form_'.$form_id;
        $this->form_attributes = array('id' => $this->form_id, 'target' => $this->form_target);
        //echo $this->form_action;

    }

    public function render($action = "default")
    {
        //$CI = &get_instance();

        // $this->output .= 'render ' . $action . ' ' . $this->table;
        // check if it is a ajax submit
        $post = $this->ci->input->post() + $this->ci->input->get();

        if (array_key_exists('action', $post)) {
            $action = $post['action'];
        }
        if ($action == "default") {
            $action = $this->default_action;
        }


        $ret = 2;
        if (array_key_exists('db_exp_submit_engaged', $post)) {
            // Execute submit
            $this->is_posted = true;
            
            //$ret = $this->_process_submit($CI->input->post());
            $ret = $this->_process_submit($this->ci->input->post());
            // what to do after submit
            if ($this->show_form_after_submit) {
                return $ret;
            }
        }


        switch (strtolower($action)) {

            case 'edit':
            case 'insert':
                $this->_render_edit();
                break;
            case 'delete':
                $ret = $this->_render_delete();
                break;
            case 'view':
                $this->_set_readonly();
                $this->_render_edit();
                break;
            case 'col_list':
                $this->_render_list_col();
                break;
            case 'row_list':
                $this->_render_listo();
                break;
        }

        return $ret;

    }

    public function set_table($table)
    {
        $this->table = $table;
    }

    public function set_form_action($uri)
    {
        $this->form_action = $uri;
    }

    public function set_form_attribute($option, $value = '')
    {
        if (is_array($option)) {
            foreach ($option as $key => $val) {
                $this->form_attributes[$key] = $val;
            }
        } else {
            $this->form_attributes[$option] = $value;
        }
    }

    public function set_form_hidden_values($option, $value = 0)
    {
        if (is_array($option)) {
            foreach ($option as $key => $val) {
                $this->form_hidden[$key] = $val;
            }

            return;
        }
        if ($value) {
            $this->form_hidden[$option] = $value;
        }


    }

    public function set_upload($index, $config = array()){

        $default['upload_path']     = FCPATH.'assets/uploads/';
        $default['allowed_types']   = 'gif|jpg|png|pdf|xlsx|avi|mp4';
        $default['max_size']        = 50000;
        $default['max_width']       = 102400;
        $default['max_height']      = 76800;

        $config = array_merge($default,$config);
        $this->fields[$index]['upload'] = $config;
    }

    public function set_pri_id($id)
    {
        $this->pri_id = $id;
    }

    public function set_search_condition($where)
    {

        $this->search_condition = $where;
    }

    public function set_hidden($index, $value = '')
    {

        if (is_array($index)) {
            foreach ($index as $key => $val) {

                if (is_int($key)) {
                    // value not set
                    $this->fields[$val]['hidden'] = NULL;
                } else {
                    $this->fields[$key]['hidden'] = $val;
                }
            }
        } else {
            $this->fields[$index]['hidden'] = $value;
        }
    }

    public function set_button($icon,$controller){
        $this->fields['button'][$icon] = $controller;
    }

    public function set_validation($index,$options){
        $this->fields[$index]['validation'] = $options;
    }

    public function set_json_field($index, $options)
    {
        $this->fields[$index]['json'] = $options;
    }

    public function set_readonly($index)
    {
        $this->fields[$index]['view'] = true;
    }

    public function set_db_select($index, $table, $val, $label, $condition = false)
    {
        if ($condition) $this->ci->db->where($condition);
        $this->ci->db->select($val . ',' . $label);
        $query = $this->ci->db->get($table);
        $arr = array();
        foreach ($query->result_array() as $row) {
            $key = $row[$val];
            $lab = $row[$label];
            $arr[$key] = $lab;
        }

        $this->fields[$index]['db_select'] = $arr;
    }

    public function set_db_list($index, $table, $val, $label, $condition = false)
    {
        if ($condition) $this->ci->db->where($condition);
        $this->ci->db->select($val . ',' . $label);
        $query = $this->ci->db->get($table);
        $arr = array();

        foreach ($query->result_array() as $row) {
            $key = $row[$val];
            $lab = $row[$label];
            $arr[$key] = $lab;
        }
        $this->fields[$index]['list'] = $arr;
    }

    public function set_select($index, $options, $values_as_keys = false)
    {


        if ($values_as_keys) {
            $opt = array();
            foreach ($options as $val) {
                $opt[$val] = $val;
            }
            $options = $opt;
        }
        $this->fields[$index]['select'] = $options;
    }

    public function set_date($index)
    {
        $this->fields[$index]['date'] = 1;
    }

    public function set_time($index)
    {
        $this->fields[$index]['time'] = 1;
    }

    public function set_input($index, $options = '')
    {
        $this->fields[$index]['input'] = $options;
    }

    public function set_password($index, $validation = 'md5')
    {
        $this->fields[$index]['password'] = 1;
    }

    public function set_password_dblcheck($index, $validation = 'md5')
    {
        $this->fields[$index]['password_dblcheck'] = 1;
    }

    public function set_textarea($index, $options = '')
    {
        $this->fields[$index]['textarea'] = $options;
    }

    public function set_list($index, $options, $values_as_keys = false)
    {
        if ($values_as_keys) {
            $opt = array();
            foreach ($options as $val) {
                $opt[$val] = $val;
            }
            $options = $opt;
        }
        $this->fields[$index]['list'] = $options;
    }



    public function set_label($index, $options)
    {
        $this->fields[$index]['label'] = $options;
    }

    public function set_row_link($link)
    {
        array_push($this->actions['link'], $link);
    }

    public function set_default_action($act)
    {
        $this->default_action = $act;
    }

    public function set_view($index)
    {
        $this->fields[$index]['view'] = true;
    }

    public function set_formula($index,$formula){
        $this->fields[$index]['formula']    = $formula;
    }

    public function set_service($index,$service){
        $this->fields[$index]['service']    = $service;
    }


    public function get_field($field, $id)
    {

        $this->ci->db->where('id', $id);
        $query = $this->db->get($this->table);
        $row = $query->result_array();
        return $row[$field];
    }

    private function _process_submit($posts)
    {
        //$this->output .= '<pre>';print_r($this->fields);$this->output .= '</pre>';
        $post_to_db = array();
        log_message('DEBUG',json_encode($posts));
        // loop through table fields
        $q = 'describe ' . $this->table;
        $query = $this->ci->db->query($q);
        $upload_err = false;
        $validation = false;
        foreach ($query->result_array() as $row) {

            $key = $row['Field'];
            if (array_key_exists($key, $posts)) {
                $val = $posts[$key];
            } else {
                $val = 'CONTINUE_ON';
            }

            if ($key == 'db_exp_submit_engaged') {
                continue;
            }

            if(array_key_exists($key,$this->fields) && array_key_exists('upload',$this->fields[$key]) ){
                $this->ci->upload->initialize($this->fields[$key]['upload']);
               
                if( ! $this->ci->upload->do_upload($key)){

                    //  check if value was previously set
                    if(array_key_exists($key.'_orig',$posts) && !empty($posts[$key.'_orig'])){
                        $post_to_db[$key]   = $posts[$key.'_orig'];

                    }else{
                        $upload_err = $this->ci->upload->display_errors();
                    }
                }else{
                    // success
                    $post_to_db[$key]   = $this->ci->upload->data('file_name');
                }
            }

            if(array_key_exists($key,$this->fields) && array_key_exists('date',$this->fields[$key]) ){

                 $val = date('Y-m-d',strtotime($val));

            }


            if (array_key_exists($key, $this->fields) && array_key_exists('json', $this->fields[$key])) {
                // json variable
                $catch = $this->fields[$key]['json'];
                $tmp = array();

                foreach ($catch as $check) {

                    // check if check is upload value
                    if(array_key_exists($check,$this->fields) && array_key_exists('upload',$this->fields[$check]) ){

                        $this->ci->upload->initialize($this->fields[$check]['upload']);

                        if( ! $this->ci->upload->do_upload($check)){
                            //  check if value was previously set
                            if(array_key_exists($check.'_orig',$posts) && !empty($posts[$check.'_orig'])){
                                $tmp[$check]    = $posts[$check.'_orig'];
                            }else{
                                $upload_err = $this->ci->upload->display_errors();
                            }
                        }else{
                            // success
                            $tmp[$check]= $this->ci->upload->data('file_name');
                        }
                    }else{

                        $tmp[$check] = $posts[$check];
                    }
                }

                //$this->output .= 'tuliingia <pre>'; print_r($tmp);
                $json = json_encode($tmp);
                $post_to_db[$key] = $json;

                $val = 'CONTINUE_ON';
            }

            //print_r($post_to_db);
            // check service
            if (array_key_exists($key, $this->fields) && array_key_exists('service', $this->fields[$key])){

                parse_str ( $this->fields[$key]['service'], $service );
                $get_args   = array();
                foreach($service as $k2 => $v2){

                    if($k2 == 'url'){
                        $url    = $v2;
                        continue;
                    }

                    if($v2[0] == '$'){
                        $get_args[$k2]  = $posts[substr($v2,1)];
                    }else{
                        $get_args[$k2]  = $v2;
                    }
                }

                $web_service_url    = $url.'?'.http_build_query($get_args);
                $result     = file_get_contents($web_service_url);
                $m       = json_decode(utf8_encode($result));
         
                $result     = $m->result;
                $post_to_db[$key]   = $result;
                continue;
            }

            // check password
            if (array_key_exists($key, $this->fields) && array_key_exists('password_dblcheck', $this->fields[$key])){

                $this->output .= 'we have a password';
                $result = md5($val);
                $post_to_db[$key]   = $result;

                $val = 'CONTINUE_ON';
            }

            // check formulas
            if (array_key_exists($key, $this->fields) && array_key_exists('formula', $this->fields[$key])){

                $formula    = ' ';
                $tmp        = explode(" ",$this->fields[$key]['formula']);
                //print_r($tmp);
                foreach($tmp as $ee){
                    if($ee[0] == '$'){
                        $formula .= $posts[substr($ee,1)];
                    }else{
                        $formula .= ' '.$ee;
                    }
                }

                //$this->output .= "hii ni formula ".$formula;

                $res = $this->EvalMath->evaluate($formula);
                $_POST[$key]        = $res;
                $post_to_db[$key]   = $res;

                $val = 'CONTINUE_ON';
            }


            // check validation
            if (array_key_exists($key, $this->fields) && array_key_exists('validation', $this->fields[$key])){
                //$this->output .= $key.' to validate <br>';
                $validation = true;
                $this->ci->form_validation->set_rules($key, $key, $this->fields[$key]['validation']);
            }

            if($val == 'CONTINUE_ON'){
                continue;
            }
            if (is_array($val)) {
                $post_to_db[$key] = implode(",", $val);
            } else {
                $post_to_db[$key] = $val;
            }


        }

        //print_r($_POST);

        // check validation
       if ($validation AND $this->ci->form_validation->run() === FALSE) {
            $this->output .= validation_errors();
            $this->show_form_after_submit = true;
            //$this->render();
            return 0;
        }

        if (array_key_exists('id', $post_to_db)) {
            $where = "id = " . $post_to_db['id'];
            $str = $this->ci->db->update_string($this->table, $post_to_db, $where);
            $post_to_db['_action'] = 'edit';
        } else {
            $str = $this->ci->db->insert_string($this->table, $post_to_db);
            $post_to_db['_action'] = 'insert';
        }
        //$this->output .= $str;


        if (!$upload_err && $this->ci->db->simple_query($str)) {
            $this->output .= '<div class="alert alert-success alert-dismissible col-md-6 col-sm-12"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Success !</span></div>';

            $this->insert_id = $this->ci->db->insert_id();
            return $post_to_db;
        } else {
            echo $str;
            $this->output .= '<div class="alert alert-danger alert-dismissible  col-md-6 col-sm-12"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Oh snap!</span> Failed, Please try again later</div>';

                log_message("DEBUG","Query failed! " . $str . " " . $upload_err);
            return 0;
        }


    }

    private function _render_delete(){


        $CI     = $this->ci;
        $id = ( $CI->input->post('id') ? $CI->input->post('id') : $CI->input->get('id') );
        
       // $res    = $CI->db->where('id',$id)->get($this->table)->result_array()[0];
        $CI->model->set_table($this->table);
        $res = $CI->model->as_array()->get($id);
        $sql = "Delete from $this->table where id = '".$id."'";
             
        if ($CI->db->simple_query ( $sql )) {
            $this->output .= "Delete Success!";
            $res['_action'] = 'delete';
            return $res;
        } else {
            $this->output .= "Delete failed!";
            return 0;
        }
    }
    private function _render_edit()
    {
        $CI = $this->ci;

        $hidden = array();


        $id = ( $CI->input->post('id') ? $CI->input->post('id') : $CI->input->get('id') );
        
        if (!empty($id)) {
            $this->set_pri_id($id);
            $hidden['id'] = $id;
        }

        $vals = '';
        if ($this->pri_id) {
            // get values
            $hidden['id'] = $this->pri_id;
            $query = $CI->db->get_where($this->table, array(
                'id' => $this->pri_id
            ));
            $vals = $query->row_array();
        }

        $q = 'describe ' . $this->table;

        //echo $q;
        $query = $CI->db->query($q);

        $uri = $this->form_action;
        $attributes = $this->form_attributes;
        if (empty($attributes)) $attributes = '';

        $hidden += $this->form_hidden;

        $this->output .= form_open_multipart($uri, $attributes, $hidden);
        $this->output .= '<div class="db_exp_table">';
        foreach ($query->result_array() as $row) {

            $fn = $row ['Field'];

            //$this->output .= '<pre>';print_r($this->fields);
            //print_r($vals);

            if (is_array($vals) && array_key_exists($fn, $vals)) {

                // check if its a multiselct field
                if (array_key_exists($fn, $this->fields) && array_key_exists('list', $this->fields[$fn])) {
                    if (trim($vals[$fn]) != '') {
                        $val = explode(",", $vals [$fn]);
                    } else {
                        $val = array();
                    }
                } else {
                    $val = $vals [$fn];
                }


            } else {
                $val = '';
            }
            //$this->output .= $fn; print_r($val); $this->output .= "\n";

            $this->_edit_field($row, $val);

        }

        if ($this->show_submit_button) {

            $submit = array('name' => 'submit', 'type' => 'submit', 'class' => "dbx_submit btn btn-primary legitRipple mb-2");
            $this->output .= '<div>' . form_button($submit,'Insert<i class="icon-paperplane ml-2"></i>') . '</div>';

        }

        $this->output .= '</div>';
        $this->output .= form_close();
    }

    private function _edit_field($field, $value)
    {

        $type = $field ['Type'];
        $name = $field ['Field'];
        $label = ucfirst(str_replace("_", " ", str_ireplace("_id", "", $name)));

        // check if its primary key
        //if ($field ['Key'] === 'PRI' && $value == '') {
        if ($field ['Key'] === 'PRI') {
            $this->set_validation('id','required');
            
            return;
        }

        $data = array();
        $data['name'] = $name;
        $data['id'] = $name;
        $data['class'] = 'validate form-control ';

        // check validation
        if(array_key_exists($name,$this->fields) && array_key_exists('validation',$this->fields[$name])){
            // explode validation
            //echo $this->fields[$name]['validation'];
            $tmp    = explode('|',$this->fields[$name]['validation']);
            foreach($tmp as $v1){
                $v1 = trim($v1);
                if(substr($v1,0,10) == 'max_length'){
                    $datalength = substr($v1,11,-1);
                    $data['data-length']    = $datalength;
                    $data['class']  .= ' data-length ';
                }
            }
        };

        $options = false;

        if (array_key_exists($name, $this->fields)) {

            foreach ($this->fields[$name] as $key => $val) {
                switch ($key) {
                    case 'db_select':
                        $type = 'db_select';
                        $options = $val;
                        break;
                    case 'select':
                        $type = 'select';
                        $options = $val;
                        break;
                    case 'upload':
                        $type = 'upload';
                        $options = $val;
                        break;
                    case 'json':
                        //$this->output .= $value;
                        $type = 'json';
                        $json_data = json_decode($value, true);
                        $json_keys = $this->fields[$name]['json'];
                        //print_r($json_keys);
                        foreach ($json_keys as $fk) {

                            $fn = array('Field' => $fk, 'Type' => '', 'Key' => '');
                            $fv = '';
                            if (is_array($json_data) && array_key_exists($fk, $json_data)) $fv = $json_data[$fk];
                            $this->_edit_field($fn, $fv);
                        }
                        break;
                    case 'list':
                        $type = 'list';
                        $options = $val;
                        break;
                    case 'textarea':
                        $type = 'textarea';
                        break;
                    case 'password':
                        $type = 'password';
                        break;
                    case 'password_dblcheck':
                        $type = 'password_dblcheck';
                        break;
                    case 'hidden':
                        $type = 'hidden';
                        if ($val != '') $value = $val;
                        break;
                    case 'date':
                        $type = 'date';
                        //$data['data-inputmask'] = "'mask': '99/99/9999'";
                        break;
                    case 'time':
                        $type = 'time';
                        break;
                    case 'label':
                        //$type	= 'label';
                        $label = $val;
                        break;
                    case 'view';
                        $type = 'view';
                        break;
                    case 'formula':
                        $type = 'formula';
                        break;
                    case 'service':
                        $type = 'service';
                        break;
                }

                //$data['class'] = ' db_exp_' . $type;
            }
        }
        // print_r ( $field );

        $label_class    = '';
        if(!is_array($value)){
            if($value != '') $label_class = 'active';
        }
        $pre = '<div class="form-group"><label>'.$label.'</label>';
        $end =  '</div>';

        switch ($type) {


            case 'int' :
                $this->output .= $pre . form_input($data, $value) . $end;
                break;
            case 'upload':
                //print_r($data);$this->output .= 'upload';
                if(!empty($value)){
                    $replace = '<span class="db_exp_replace_upload_str"> Replace '.$value.'</span>';
                }else{
                    $replace = '';
                }
                $this->output .= $pre . form_upload($data,$value) .$replace. $end;
                $this->output .= form_hidden($name.'_orig', $value);
                break;
            case 'password' :
                $this->output .= $pre . form_password($data, $value) . $end;
                break;
            case 'password_dblcheck' :
                $this->output .= $pre . form_password($data, $value) . $end;
                $data['name'] = $data['name'] . '_repeat';
                $pre = '<div class="element">Repeat ' . $label . '</div>';
                $this->output .= $pre . form_password($data, $value) . $end;
                break;
            case 'textarea':
                $data['cols'] = 80;
                $data['rows'] = 4;
                $data['class'] .= " materialize-textarea ";
                $this->output .= $pre . form_textarea($data, $value) . $end;
                //$this->output .= '<script> CKEDITOR.replace('.$data['id'].')</script>';
                break;
            case 'date':
                $data['type']   = 'text';
                $data['class']  .= ' pickadate ';
                $this->output .= $pre. form_input($data) . $end;
                break;
            case 'time':
                $data['type']   = 'text';
                $data['class']  .= ' timepicker ';
                $this->output .= $pre. form_input($data) . $end;
                break;
            case 'db_select':
            case 'select':
                $this->output .= $pre.'<div class="multiselect-native-select"><select class="form-control multiselect" ';
                foreach($data as $k1 => $v1){
                    $this->output .= $k1.'="'.$v1.'"';
                }
                $this->output .= '>';
                foreach($options as $k1 => $v1){
                    $selected   = (($k1 == $value) ? 'selected' : '');
                    $this->output .= '<option value="'.$k1.'" '.$selected.'>'.$v1.'</option>';
                }
                $this->output .= '</select></div>'.$end;
                break;
            case 'list':
            case 'multiselect':
                $data['name'] = $name . '[]';
                $this->output .= $pre.'<div class="multiselect-native-select"><select class="form-control multiselect" multiple="multiple" ';
                foreach($data as $k1 => $v1){
                    $this->output .= $k1.'="'.$v1.'" ';
                }
                
                $this->output .= '>';
                foreach($options as $k1 => $v1){
                    $selected   = ((is_array($value) && in_array($k1,$value)) ? 'selected' : '');
                    $this->output .= '<option value="'.$k1.'" '.$selected.'>'.$v1.'</option>';
                }
                $this->output .= '</select></div>'.$end;
                break;
            case 'json':
            case 'hidden':
                $this->output .= form_hidden($name, $value);
                break;
            case 'view':
                if (array_key_exists('hidden', $this->fields[$name])) {
                    $this->output .= form_hidden($name, $value);
                } else {
                    $s = '';

                    if (is_array($options)) {
                        if (is_array($value)) {
                            $v = $value;
                        } else {
                            $v = explode(',', $value);
                        }

                        foreach ($v as $kk) {
                            if($kk == '') $s .= '';
                            else $s .= $options[trim($kk)] . ',';
                        }
                    } else {
                        $s = $value;
                    }
                    //$this->output .= $pre_view . $s . $end;
                    $this->output .= $pre.'<input disabled value="'.$s.'" id="'.$name.'" type="text" class="validate">'.$end;
                }
                break;
            case 'formula':
                $this->output .= $pre . $value . $end;
                break;
            case 'service':
                //$this->output .= $pre . $value . $end;
                $this->output .= $pre.'<input disabled value="'.$value.'" id="'.$name.'" type="text" class="validate">'.$end;
                break;
            default :
                $data['placeholder']    = $value;
                $this->output .= $pre . form_input($data,$value) . $end;
                break;
        }
    }

    private function _render_listo(){

        $CI = &get_instance();
        //$uri = uri_string().'?'.$_SERVER['QUERY_STRING'];


        $fields = $CI->db->list_fields($this->table);
        $show = array();
        foreach ($fields as $field) {
            if (array_key_exists($field, $this->fields) && is_array($this->fields[$field]) && array_key_exists('hidden', $this->fields[$field])) {

            } else {
                array_push($show, $field);
            }
        }
        if (sizeof($show) != 0) {
            $CI->db->select(implode(",", $show));
        }

        if ($this->search_condition) {
            // get values
            $query = $CI->db->get_where($this->table, $this->search_condition);
        } else {
            $query = $CI->db->get($this->table);
        }

        $this->output   = '<div class="table-responsive"><table class="table table-bordered dbx_table" action="'.$this->form_action.'">';

        // set the header
        $this->output   .= '<thead><tr class="">';
        $this->output   .= '<th>#</th><th>Actions</th>';
        foreach ($query->list_fields() as $field){

            if ($field === 'id') continue;
            $label = ucfirst(str_replace("_", " ", str_ireplace("_id", "", $field)));
            $this->output   .= '<th>'.$label.'</th>';
        }
        $this->output   .= '</tr></thead>';

        $this->output   .= '<tbody>';


        // set the body
        foreach ($query->result_array() as $row) {

            $this->output   .=  '<tr><td>'.$row['id'].'</td>';
            $this->output   .=  '<td><div class="list-icons"><div class="dropdown"><a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu9"></i></a><div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">';


            if($this->show_edit_button){
                $this->output   .= '<a class="dbx_act_link dropdown-item"  act="edit" id="'.$row['id'].'"><i class="icon-file-text"> Edit</i></a>';
            }
            if($this->show_delete_button){
                $this->output   .= '<a class="dbx_act_link dropdown-item" act="delete" id="'.$row['id'].'"><i class="icon-trash"> Delete</i></a>';
            }
            $this->output   .=  '</div></div></div></td>';

            foreach ($row as $key => $val) {

                if ($key === 'id') continue;
                $this->output   .= '<td>'.$this->display_field($key, $val).'</td>';

            }
            $this->output   .= '</tr>';

        }
        $this->output   .= '</tbody></table></div>';

        if($this->show_insert_button){

            //$this->output   .= '<span class="dbx_insert" action="'.site_url($uri).'&action=insert"><i class="material-icons right">send</i> Insert</span>';
            $this->output   .= '<button type="submit" class="dbx_insert mt-2 btn btn-primary legitRipple" action="'.site_url($this->form_action).'&action=insert">Insert <i class="icon-paperplane ml-2"></i></button>';


        }

    }

    private function _render_list_col()
    {
        $CI = &get_instance();

        $fields = $CI->db->list_fields($this->table);
        $show = array();
        foreach ($fields as $field) {
            if (array_key_exists($field, $this->fields) && is_array($this->fields[$field]) && array_key_exists('hidden', $this->fields[$field])) {

            } else {
                array_push($show, $field);
            }
        }
        if (sizeof($show) != 0) {
            $CI->db->select(implode(",", $show));
        }

        if ($this->search_condition) {
            // get values
            $query = $CI->db->get_where($this->table, $this->search_condition);
        } else {
            $query = $CI->db->get($this->table);
        }


        $this->output .= '<table width="100%" cellpadding="2" cellspacing="2">';
        foreach ($query->result_array() as $row) {
            //print_r($row);
            $this->output .= '<tr class="perm_list">';

            foreach ($this->actions['link'] as $v1) {

                $opts = '';
                $link_label = false;
                foreach ($v1 as $opt_key => $opt_val) {

                    switch ($opt_key) {

                        case 'args':
                            $arguments = explode(",", $opt_val);
                            $tmp = array();
                            foreach ($arguments as $v2) {
                                if (array_key_exists($v2, $row)) {
                                    array_push($tmp, $v2 . "=" . $row[$v2]);
                                }
                            }
                            $opts .= ' args="' . implode("&", $tmp) . '"';
                            break;
                        case 'target':
                            $opts .= ' target="' . $opt_val . '"';
                            break;
                        case 'action':
                            $opts .= ' action ="' . site_url($opt_val) . '"';
                            break;
                        case 'label':
                            $link_label = $opt_val;
                            break;

                    }

                }

                if ($link_label) {
                    $this->output .= '<td class="perm_list_link" ' . $opts . '>' . $link_label . '</td>';
                }
            }


            $this->output .= '<td class="perm_list_link" action="' . site_url('perm/delete_row') . '" args="table=' . $this->table . '&id=' . $row['id'] . '">Delete</td>';

            foreach ($row as $key => $val) {

                $label = ucfirst(str_replace("_", " ", str_ireplace("_id", "", $key)));

                if ($key === 'id') continue;
                //$this->output .= '<td>' . $label . '</td>';
                $this->output .= '<td> | </td>';
                $this->output .= '<td>' . $val . '</td>';

            }


            $this->output .= '</tr>';
        }
        $this->output .= '</table>';
    }



    private function display_field($key, $val)
    {

        if (array_key_exists($key, $this->fields)) {

            $tmp = $this->fields[$key];
            //print_r($tmp);
            foreach ($tmp as $k => $v) {

                if ($k == 'db_select' || $k == 'db_multiselect' || $k == 'select' || $k == 'multiselect') {
                    $options = $this->fields[$key][$k];
                  //echo $val;
                    $val = $options[$val];
                    break;
                }

                if ($k == 'password') {
                    $val = '*************';
                    break;
                }
            }

        }

        return $val;
    }

    public function _set_readonly()
    {

        $this->show_submit_button = false;
        $this->show_insert_button = false;
        $this->show_delete_button = false;
        $this->show_edit_button   = false;

        $CI = &get_instance();

        $q = 'describe ' . $this->table;
        $query = $CI->db->query($q);

        foreach ($query->result_array() as $row) {

            $fn = $row ['Field'];
            if (array_key_exists($fn, $this->fields)) {
                $this->fields[$fn]['view'] = true;
            } else {
                $this->fields[$fn] = array('view' => true);
            }
        }
    }
}

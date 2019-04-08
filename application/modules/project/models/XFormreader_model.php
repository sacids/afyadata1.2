<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 11/01/2018
 * Time: 18:14
 */

class XmlElement
{
    var $name;
    var $attributes;
    var $content;
    var $children;
}

class XFormreader_model extends CI_Model
{
    public $form_defn;
    public $form_data;
    public $xml_defn_filename;
    public $xml_data_filename;
    public $table_name;
    public $jr_form_id;
    public $xarray;
    private $file_definition;


    public function __construct()
    {
        parent::__construct();
        $this->file_definition = $this->config->item('form_definition_upload_dir');

    }

    /**
     * @return mixed
     */
    public function get_definition_file()
    {
        return $this->xml_defn_filename;
    }

    /**
     * @param $filename
     */
    public function set_definition_file($filename)
    {
        $this->xml_defn_filename = $filename;
    }

    /**
     * @param $table_name
     */
    public function set_table_name($table_name)
    {
        $this->table_name = $table_name;
    }

    /**
     * @return mixed
     */
    public function get_table_name()
    {
        return $this->table_name;
    }

    /**
     * @param $filename
     */
    public function set_data_file($filename)
    {
        $this->xml_data_filename = $filename;
    }

    /**
     * @return mixed
     */
    public function get_form_data()
    {
        return $this->form_data;
    }

    /**
     * @return mixed
     */
    public function get_jr_form_id()
    {
        return $this->jr_form_id;
    }

    /**
     * @return mixed
     */
    public function get_definition()
    {
        return $this->xarray;
    }

    //get data file
    function get_data_file()
    {
        return $this->xml_data_filename;
    }

    //initialize form defn
    public function initialize($file_name)
    {
        log_message("debug", "File to load " . $file_name);

        // create table structure
        $this->set_definition_file($this->file_definition . $file_name);

        $this->load_xml_definition();

        // TODO: change function name to get_something suggested get_form_table_definition
        return $this->get_create_table_sql_query();
    }

    //load xml definition
    function load_xml_definition()
    {
        $xml = file_get_contents($this->get_definition_file());
        $rxml = $this->xml_to_object($xml);

        // TODO reference by names instead of integer keys
        $instance = $rxml->children [0]->children [1]->children [0]->children [0];

        $prefix = $this->config->item("xform_tables_prefix");

        //jr form_id and table_name
        $jr_form_id = $instance->attributes ['id'];
        $table_name = $prefix . str_replace("-", "_", $jr_form_id);

        // get array rep of xform
        $this->form_defn = $this->get_form_definition();

        //log_message("debug", "Table name " . $table_name);
        $this->table_name = $table_name;
        $this->jr_form_id = $jr_form_id;
    }

    //load xml data
    function load_xml_data()
    {
        // get submitted file
        $file_name = $this->get_data_file();

        // load file into a string
        $xml = file_get_contents($file_name);

        // convert string into an object
        $rxml = $this->xml_to_object($xml);

        // array to hold values and field names;
        $this->form_data = array(); // TODO move to constructor
        $prefix = $this->config->item("xform_tables_prefix");

        // set table name
        $this->table_name = $prefix . str_replace("-", "_", $rxml->attributes ['id']);

        // set form definition structure
        $file_name = $this->xform_model->get_form_definition_filename($this->table_name);
        $this->set_definition_file($this->config->item("form_definition_upload_dir") . $file_name);
        $this->load_xml_definition();

        // set form data
        foreach ($rxml->children as $val) {
            $this->get_path('', $val);
        }
    }

    /**
     * @param $xml
     * @return mixed
     */
    function xml_to_object($xml)
    {
        $parser = xml_parser_create();
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parse_into_struct($parser, $xml, $tags);
        xml_parser_free($parser);

        $elements = array(); // the currently filling [child] XmlElement array
        $stack = array();
        foreach ($tags as $tag) {

            $index = count($elements);
            if ($tag ['type'] == "complete" || $tag ['type'] == "open") {
                $elements [$index] = new XmlElement ();
                $elements [$index]->name = $tag ['tag'];

                if (!empty ($tag ['attributes'])) {
                    $elements [$index]->attributes = $tag ['attributes'];
                }

                if (!empty ($tag ['value'])) {
                    $elements [$index]->content = $tag ['value'];
                }

                if ($tag ['type'] == "open") { // push
                    $elements [$index]->children = array();
                    $stack [count($stack)] = &$elements;
                    $elements = &$elements [$index]->children;
                }
            }

            if ($tag ['type'] == "close") { // pop
                $elements = &$stack [count($stack) - 1];
                unset ($stack [count($stack) - 1]);
            }
        }

        return $elements [0];
    }

    /**
     * @param string $name
     * @param object $obj
     */
    function get_path($name, $obj)
    {
        $name .= "_" . $obj->name;

        if (is_array($obj->children)) {
            foreach ($obj->children as $val) {
                $this->get_path($name, $val);
            }
        } else {
            $column_name = substr($name, 1);
            //shorten long column names
            if (strlen($column_name) > 64) {
                $column_name = shorten_column_name($column_name);
            }
            $this->form_data [$column_name] = $obj->content;
        }
    }

    //get form definition
    function get_form_definition()
    {
        // retrieve object describing definition file
        $rxml = $this->xml_to_object(file_get_contents($this->get_definition_file()));

        // get the binds compononent of xform
        $binds = $rxml->children [0]->children [1]->children;
        $tmp2 = $rxml->children [0]->children [1]->children [1]->children [0]->children;
        $tmp2 = $rxml->children [1]->children;

        // container
        $xarray = array();

        foreach ($binds as $key => $val) {

            if ($val->name == 'bind') {

                $attributes = $val->attributes;
                $nodeset = $attributes ['nodeset'];

                $xarray [$nodeset] = array();
                $xarray [$nodeset] ['field_name'] = str_replace("/", "_", substr($nodeset, 6));

                // set each attribute key and corresponding value
                foreach ($attributes as $k2 => $v2) {
                    $xarray [$nodeset] [$k2] = $v2;
                }
            }
        }
        $this->xarray = $xarray;
        $this->_iterate_defn_file($tmp2, FALSE);
        return $this->xarray;
    }

    //iterate defn file
    function _iterate_defn_file($arr, $ref = FALSE)
    {

        $i = 0;
        foreach ($arr as $val) {

            switch ($val->name) {

                case 'group':
                    $this->_iterate_defn_file($val->children);
                    break;
                case 'input':
                    $nodeset = $val->attributes['ref'];
                    $this->xarray[$nodeset]['label'] = '0';
                    break;
                case 'select':
                case 'select1':
                    $nodeset = $val->attributes['ref'];
                    $this->_iterate_defn_file($val->children, $nodeset);
                    break;
                case 'item':
                    $l = $val->children[0]->content;
                    $v = $val->children[1]->content;
                    $this->xarray[$ref]['option'][$v] = $l;
                    break;
            }
        }
    }

    //create insert query
    public function get_create_table_sql_query()
    {
        $structure = $this->form_defn;
        $tbl_name = $this->table_name;

        // initiate statement, set id as primary key, autoincrement
        $statement = "CREATE TABLE $tbl_name ( id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY ";

        // loop through xform definition array
        $counter = 0;
        //echo '<pre>'; print_r($structure); exit();
        foreach ($structure as $key => $val) {

            // check if type is empty
            if (empty ($val ['type']))
                continue;

            $field_name = $val['field_name'];
            $col_name = $this->_map_field($field_name);

            if (array_key_exists('label', $val)) {
                $field_label = $val['label'];
            } else {
                $tmp = explode('/', $val['nodeset']);
                $field_label = array_pop($tmp);
            }
            $type = $val ['type'];

            // check if field is required
            if (!empty ($val ['required'])) {
                $required = 'NOT NULL';
            } else {
                $required = '';
            }

            if ($type == 'string' || $type == 'binary' || $type == 'barcode') {
                $statement .= ", $col_name VARCHAR(300) $required";
            }

            if ($type == 'select1') {
                // Mysql recommended way of handling single quotes for queries is by using two single quotes at once.
                if (!$val['option']) {
                    // itemset
                    $statement .= ", $col_name  VARCHAR(300) $required";
                } else {
                    $tmp3 = array_keys($val ['option']);
                    $statement .= ", $col_name ENUM('" . implode("','", str_replace("'", "''", $tmp3)) . "') $required";
                }
            }

            if ($type == 'select') {
                $statement .= ", $col_name TEXT $required ";


                foreach ($val['option'] as $key => $select_opts) {

                    $key = $this->_map_field($col_name . '_' . $key);
                    if (!$key) {
                        // failed need to exit
                    }
                    $statement .= ", " . $key . " ENUM('1','0') DEFAULT '0' NOT NULL ";
                }
            }

            if ($type == 'text') {
                $statement .= ", $col_name TEXT $required ";
            }

            if ($type == 'date') {
                $statement .= ", $col_name DATE $required ";
            }

            if ($type == 'dateTime') {
                $statement .= ", $col_name datetime $required";
            }

            if ($type == 'time') {
                $statement .= ", $col_name TIME $required";
            }

            if ($type == 'int') {
                $statement .= ", $col_name INT(20) $required ";
            }

            if ($type == 'decimal') {
                $statement .= ", $col_name DECIMAL $required ";
            }

            if ($type == 'geopoint') {

                $statement .= "," . $col_name . " VARCHAR(150) $required ";
                $statement .= "," . $col_name . "_point POINT $required ";
                $statement .= "," . $col_name . "_lat DECIMAL(38,10) $required ";
                $statement .= "," . $col_name . "_lng DECIMAL(38,10) $required ";
                $statement .= "," . $col_name . "_acc DECIMAL(38,10) $required ";
                $statement .= "," . $col_name . "_alt DECIMAL(38,10) $required ";
            }

            $statement .= "\n";
        }
        $statement .= "," . "status VARCHAR(30) DEFAULT 'NEW'";
        $statement .= "," . "submitted_at DATETIME DEFAULT CURRENT_TIMESTAMP";

        $statement .= ")";
        return $statement;
    }

    /**
     * @return array of shortened field names mapped to xform xml file labels
     */
    function get_field_map()
    {
        $arr = $this->xform_model->get_fieldname_map($this->table_name);
        $map = array();
        foreach ($arr as $val) {
            $key = $val['field_name'];
            $label = $val['col_name'];
            $map[$key] = $label;
        }
        return $map;
    }

    //map field
    function _map_field($field_name,$label = false)
    {

        if (substr($field_name, 0, 5) == 'meta_')
            return $field_name;

        $fn = '_xf_' . md5($field_name);

        $data = array();
        $data['table_name'] = $this->table_name;
        $data['col_name'] = $fn;
        $data['field_name'] = $field_name;

        $fl     = $field_name;
        if($label){
            $fl = $label;
        }
        if(substr($fl,0,4) == '_xf_'){
           $tmp = explode("_",$fl,3);
           $fl  = $tmp[2];
        }
        $data['field_label']  = str_replace("_"," ",$fl);


        if ($this->xform_model->add_to_field_name_map($data)) {
            return $fn;
        }

        return FALSE;
    }


    //insert form data
    function get_insert_form_data_query()
    {

        $table_name = $this->table_name;
        $form_data = $this->form_data;
        $map = $this->get_field_map();

        $has_geopoint = FALSE;
        $col_names = array();
        $col_values = array();
        $points_v = array();
        $points_n = array();

        foreach ($this->form_defn as $str) {

            // check if type is empty
            if (empty ($str ['type']))
                continue;

            $type = $str['type'];
            $cn = $str['field_name'];

            if (isset($this->form_data[$cn]))
                $cv = $this->form_data[$cn];
            else
                $cv = '';

            if ($cv == '' || $cn == '') continue;

            // check if column name was mapped to fieldmap table
            if (array_key_exists($cn, $map)) {
                $cn = $map[$cn];
            }

            array_push($col_names, $cn);
            array_push($col_values, $cv);

            if ($type == 'select') {
                $options = explode(' ', $cv);
                foreach ($options as $opt) {
                    $opt = trim($opt);

                    if (array_key_exists($cn . '_' . $opt, $map)) {
                        $opt = $map[$cn . '_' . $opt];
                    }

                    array_push($col_values, 1);
                    array_push($col_names, $opt);

                }
            }

            if ($type == 'geopoint') {

                $has_geopoint = TRUE;
                $geopoints = explode(" ", $cv);

                $lat = $geopoints [0];
                array_push($col_values, $lat);
                array_push($col_names, $cn . '_lat');

                $lng = $geopoints [1];
                array_push($col_values, $lng);
                array_push($col_names, $cn . '_lng');

                $alt = $geopoints [2];
                array_push($col_values, $alt);
                array_push($col_names, $cn . '_alt');

                $acc = $geopoints [3];
                array_push($col_values, $acc);
                array_push($col_names, $cn . '_acc');

                $point = "GeomFromText('POINT($lat $lng)')";
                array_push($points_v, $point);
                array_push($points_n, $cn . '_point');
            }
        }

        if ($has_geopoint) {
            $field_names = "(`" . implode("`,`", $col_names) . "`,`" . implode("`,`", $points_n) . "`)";
            $field_values = "('" . implode("','", $col_values) . "'," . implode("`,`", $points_v) . ")";
        } else {
            $field_names = "(`" . implode("`,`", $col_names) . "`)";
            $field_values = "('" . implode("','", $col_values) . "')";
        }

        $query = "INSERT INTO {$table_name} {$field_names} VALUES {$field_values}";

        return $query;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 11/01/2018
 * Time: 18:26
 */


class Forms extends MX_Controller
{
    private $baseURL;
    private $controller;
    private $user_id;
    private $data;
    private $xFormReader;
    private $file_definition;

    function __construct()
    {
        parent::__construct();
        $this->load->dbforge();

        $this->xFormReader = new Formreader_model();
        $this->file_definition = $this->config->item('form_definition_upload_dir');

        $this->controller = $this->router->class;
        $this->user_id = $this->session->userdata('user_id');
        $this->baseURL = base_url();
    }

    //check if user logged in
    function is_logged_in()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    //add new form
    function add_new($project_id = null)
    {
        $this->data['title'] = "Upload New Form";
        $this->is_logged_in();

        $project = $this->project_model->get_project_by_id($project_id);
        if (count($project) == 0) {
            show_error('Project not found');
        }
        $this->data['project'] = $project;

        //form validation
        $this->form_validation->set_rules('name', 'Form Title', 'required|trim');
        $this->form_validation->set_rules('access', 'Access', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_rules('attachment', 'Form XML', 'callback_upload_attachment|trim');
        $this->form_validation->set_rules('description', 'Description', 'trim');
        $this->form_validation->set_rules('push', 'Push', 'trim');
        $this->form_validation->set_rules('has_feedback', 'Has Feedback', 'trim');
        $this->form_validation->set_rules('allow_dhis', 'Allow DHIS2', 'trim');

        if ($this->form_validation->run($this) == TRUE) {
            $attachment = $_POST['attachment'];

            //create sql statement
            $create_table_statement = $this->xFormReader->initialize($attachment);

            if ($this->xform_model->find_by_form_id($this->xFormReader->get_table_name())) {
                @unlink($this->file_definition . $attachment);

                $this->session->set_flashdata("message", display_message("Form ID is already used, try a different one", "danger"));
                redirect("forms/add_new/" . $project_id, 'refresh');
            } else {
                $create_table_result = $this->xform_model->create_table($create_table_statement);

                if ($create_table_result) {
                    //table_name
                    $table_name = $this->xFormReader->get_table_name();

                    //create
                    $id = $this->xform_model->create_form(
                        array(
                            'title' => $this->input->post('name'),
                            'description' => $this->input->post('description'),
                            'project_id' => $project_id,
                            'form_id' => $table_name,
                            'attachment' => $_POST['attachment'],
                            'access' => $this->input->post('access'),
                            'status' => $this->input->post('status'),
                            'created_at' => date('Y-m-d H:i:s'),
                            'created_by' => $this->user_id,
                        )
                    );

                    if ($id) {
                        //insert form config
                        $this->model->set_table('xform_config');
                        $this->model->insert(
                            array(
                                'push' => $this->input->post('status'),
                                'has_feedback' => $this->input->post('has_feedback'),
                                'allow_dhis' => $this->input->post('allow_dhis')
                            )
                        );

                        $this->session->set_flashdata('message', display_message('Form added'));
                    } else {
                        $this->session->set_flashdata('message', display_message('Failed to add form', 'danger'));
                    }
                    redirect('projects/details/' . $project_id, 'refresh');
                } else {
                    $this->session->set_flashdata("message", display_message($create_table_statement, "danger"));
                }
            }
        }

        //populate data
        $this->data['name'] = array(
            'name' => 'name',
            'id' => 'name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('name'),
            'class' => 'form-control',
            'placeholder' => 'Write form title...'
        );

        $this->data['attachment'] = array(
            'name' => 'attachment',
            'id' => 'attachment',
            'type' => 'file',
            'value' => $this->form_validation->set_value('attachment'),
            'class' => 'form-control'
        );

        $this->data['description'] = array(
            'name' => 'description',
            'id' => 'description',
            'type' => 'text area',
            'rows' => '5',
            'value' => $this->form_validation->set_value('description'),
            'class' => 'form-control',
            'placeholder' => 'Write form description...'
        );

        //render view
        $this->load->view('header', $this->data);
        $this->load->view('sidebar');
        $this->load->view('add_new');
        $this->load->view('footer');
    }

    //add new form
    function edit($project_id, $form_id)
    {
        $this->data['title'] = "Edit Form";
        $this->is_logged_in();

        $project = $this->project_model->get_project_by_id($project_id);
        if (count($project) == 0) {
            show_error('Project not found');
        }
        $this->data['project'] = $project;

        $form = $this->xform_model->get_form_by_id($form_id);
        if (count($form) == 0) {
            show_error('Form not found');
        }
        $this->data['form'] = $form;


        //form validation
        $this->form_validation->set_rules('name', 'Form Title', 'required|trim');
        $this->form_validation->set_rules('project_id', 'Project', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');

        if ($this->form_validation->run($this) == TRUE) {
            //update form
            $result = $this->xform_model->update_form(
                array(
                    "title" => $this->input->post("name"),
                    "description" => $this->input->post("description"),
                    'status' => $this->input->post('status'),
                    "project_id" => $project_id
                ), $form_id
            );

            if ($result)
                $this->session->set_flashdata('message', display_message('Form updated'));
            else
                $this->session->set_flashdata('message', display_message('Failed to update form', 'danger'));

            redirect('projects/details/' . $project_id, 'refresh');
        }

        //populate data
        $this->data['name'] = array(
            'name' => 'name',
            'id' => 'name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('name', $form->title),
            'class' => 'form-control',
            'placeholder' => 'Write form title...'
        );

        $this->data['description'] = array(
            'name' => 'description',
            'id' => 'description',
            'type' => 'text area',
            'rows' => '5',
            'value' => $this->form_validation->set_value('description', $form->description),
            'class' => 'form-control',
            'placeholder' => 'Write form description...'
        );

        $this->data['projects_list'] = $this->project_model->find_all();

        //render view
        $this->load->view('header', $this->data);
        $this->load->view('sidebar');
        $this->load->view('edit');
        $this->load->view('footer');
    }

    //delete form
    function delete($project_id, $form_id)
    {
        $this->data['title'] = "Delete Form";
        $this->is_logged_in();

        $form = $this->xform_model->get_form_by_id($form_id);
        if (count($form) == 0) {
            show_error('Form not found');
        }

        //drop table
        $this->dbforge->drop_table($form->form_id);

        //delete xform field mapping
        $this->db->delete('xform_field_map', array('table_name' => $form->form_id));

        //delete xform
        $result = $this->db->delete('xforms', array('id' => $form_id));

        if ($result) {
            //unlink file
            @unlink($this->file_definition . $form->attachment);

            //redirect
            $this->session->set_flashdata("message", display_message('Form deleted'));
            redirect('projects/details/' . $project_id, 'refresh');
        }
    }

    //view form data
    function data_view($project_id, $form_id)
    {
        $this->data['title'] = "Form Data";
        $this->is_logged_in();

        $project = $this->project_model->get_project_by_id($project_id);
        if (count($project) == 0) {
            show_error('Project not found');
        }
        $this->data['project'] = $project;

        $form = $this->xform_model->get_form_by_id($form_id);
        if (count($form) == 0) {
            show_error('Form not found');
        }
        $this->data['form'] = $form;

//        echo "<pre>";
//        print_r($form);
//        exit();

        //table columns
        $this->data['table_fields'] = $this->xform_model->find_table_columns($form->form_id);
        $this->data['field_maps'] = $this->get_mapped_table_column_name($form->form_id);

        $mapped_fields = array();
        foreach ($this->data['table_fields'] as $key => $column) {
            if (array_key_exists($column, $this->data['field_maps'])) {
                $mapped_fields[$column] = $this->data['field_maps'][$column];
            } else {
                $mapped_fields[$column] = $column;
            }
        }

        $custom_maps = $this->xform_model->get_fieldname_map($form->form_id);
        foreach ($custom_maps as $f_map) {
            if (array_key_exists($f_map['col_name'], $mapped_fields)) {
                $mapped_fields[$f_map['col_name']] = $f_map['field_label'];
            }
        }
        $this->data['mapped_fields'] = $mapped_fields;

        //table data
        $config = array(
            'base_url' => $this->config->base_url("forms/data_view/" . $form_id . '/'),
            'total_rows' => $this->xform_model->count_all_records($form->form_id),
            'uri_segment' => 5,
        );

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;

        $this->data['data_list'] = $this->xform_model->find_form_data($form->form_id, $this->pagination->per_page, $page);
        $this->data["links"] = $this->pagination->create_links();

        //render view
        $this->load->view('header', $this->data);
        $this->load->view('sidebar');
        $this->load->view('data_view');
        $this->load->view('footer');
    }

    //export excel
    function export_form_data($form_id)
    {
        $form = $this->xform_model->get_form_by_id($form_id);
        if (count($form) == 0) {
            show_error('Form not found');
        }

        //variable html1
        $html1 = '';

        // Set some content to print
        $html1 .= "Form : $form->title\r";
        $html1 .= "Collected data\r";

        // Set document properties
        $this->spreadsheet->getProperties()->setCreator('Renfrid Ngolongolo')
            ->setLastModifiedBy('Renfrid Ngolongolo')
            ->setTitle($form->title)
            ->setSubject($form->title)
            ->setDescription($form->description)
            ->setKeywords('form,data,jawabu')
            ->setCategory('Data');

        //activate worksheet number 1
        $this->spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', $html1);
        $this->spreadsheet->setActiveSheetIndex(0)->mergeCells('A1:Z1');
        $this->spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(50);

        $this->spreadsheet->getActiveSheet()->getStyle('A1')->applyFromArray(
            array('font' => array("bold" => true))
        );
        $this->spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);


        //table fields
        $table_fields = $this->xform_model->find_table_columns($form->form_id);
        $field_maps = $this->get_mapped_table_column_name($form->form_id);

        $mapped_fields = array();
        foreach ($table_fields as $key => $column) {
            if (array_key_exists($column, $field_maps)) {
                $mapped_fields[$column] = $field_maps[$column];
            } else {
                $mapped_fields[$column] = $column;
            }
        }

        $custom_maps = $this->xform_model->get_fieldname_map($form->form_id);
        foreach ($custom_maps as $f_map) {
            if (array_key_exists($f_map['col_name'], $mapped_fields)) {
                $mapped_fields[$f_map['col_name']] = $f_map['field_label'];
            }
        }

        $serial = 0;
        foreach ($mapped_fields as $key => $column) {
            $inc = 3;
            if (array_key_exists($column, $field_maps))
                $column_name = $field_maps[$column];
            else
                $column_name = $column;

            $this->spreadsheet->setActiveSheetIndex(0)->setCellValue($this->xform_model->get_column_letter($serial) . $inc, $column_name);
            $serial++;
        }


        //display data
        $form_data = $this->xform_model->find_form_data($form->form_id, 100000, 0);

        $inc = 4;
        foreach ($form_data as $data) {
            $serial = 0;
            foreach ($data as $key => $entry) {
                if (preg_match('/(\.jpg|\.png|\.bmp)$/', $entry))
                    $column_value = '';
                else
                    $column_value = $entry;

                $this->spreadsheet->setActiveSheetIndex(0)->setCellValue($this->xform_model->get_column_letter($serial) . $inc, $column_value);
                $serial++;
            }
            $inc++;
        }

        // Rename worksheet
        $this->spreadsheet->getActiveSheet()->setTitle($form->title);

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $this->spreadsheet->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Xls)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Simple.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($this->spreadsheet, 'Xls');
        $writer->save('php://output');
        exit;
    }

    //show data in map
    function map_view($project_id, $form_id)
    {
        $this->data['title'] = "Map View";
        $this->is_logged_in();

        $project = $this->project_model->get_project_by_id($project_id);
        if (count($project) == 0) {
            show_error('Project not found');
        }
        $this->data['project'] = $project;

        $form = $this->xform_model->get_form_by_id($form_id);
        if (count($form) == 0) {
            show_error('Form not found');
        }
        $this->data['form'] = $form;


        $lat = '-6.8281243000';
        $lng = '36.9878521000';
        $this->data['latlon'] = $lat . ', ' . $lng;


        //render view
        $this->load->view('layout/header', $this->data);
        $this->load->view('map_view');
        $this->load->view('layout/footer');
    }


    //get mapped table columns
    function get_mapped_table_column_name($form_id)
    {
        $this->xFormReader->set_table_name($form_id);
        $map = $this->xFormReader->get_field_map();

        $form_details = $this->xform_model->find_by_form_id($form_id);

        $file_name = $form_details->attachment;
        $this->xFormReader->set_definition_file($this->config->item("form_definition_upload_dir") . $file_name);
        $this->xFormReader->load_xml_definition();

        $form_definition = $this->xFormReader->get_definition();
        $table_field_names = array();

        foreach ($form_definition as $fdfn) {
            $kk = $fdfn['field_name'];
            // check if column name was mapped to fieldmap table
            if (array_key_exists($kk, $map)) {
                $kk = $map[$kk];
            }
            if (array_key_exists("label", $fdfn)) {
                if ($fdfn['type'] == "select") {
                    $options = $fdfn['option'];
                    foreach ($options as $key => $value) {
                        // check if column name was mapped to fieldmap table
                        if (array_key_exists($key, $map)) {
                            $key = $map[$key];
                        }
                        $table_field_names[$key] = $value;
                    }
                } elseif ($fdfn['type'] == "int") {
                    $group_name = str_replace("_", " ", $fdfn['field_name']);
                    $table_field_names[$kk] = $group_name . " " . $fdfn['label'];
                } else {
                    $table_field_names[$kk] = $fdfn['label'];
                }
            } else {
                $table_field_names[$kk] = $fdfn['field_name'];
            }
        }
        return $table_field_names;
    }

    /*=========================================================
     Callback function
    =========================================================*/
    function upload_attachment()
    {
        $config['upload_path'] = $this->file_definition;
        $config['allowed_types'] = 'xml';
        $config['max_size'] = '100000';
        $config['overwrite'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $config['encrypt_name'] = TRUE;

        //initialize config
        $this->upload->initialize($config);

        if (isset($_FILES['attachment']) && !empty($_FILES['attachment']['name'])) {
            if ($this->upload->do_upload('attachment')) {
                // set a $_POST value
                $upload_data = $this->upload->data();

                //POST variables
                $_POST['attachment'] = $upload_data['file_name'];

                return TRUE;
            } else {
                // possibly do some clean up ... then throw an error
                $this->form_validation->set_message('upload_attachment', $this->upload->display_errors());
                return FALSE;
            }
        } else {
            // throw an error because nothing was uploaded
            $this->form_validation->set_message('upload_attachment', "Please, attach xml file");
            return FALSE;
        }
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 13/08/2018
 * Time: 13:01
 */

class Projects extends MX_Controller
{
    private $data;
    private $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('project_model'));

        $this->user_id = $this->session->userdata('user_id');
    }

    //check if user logged in
    function is_logged_in()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    function lists()
    {
        $this->data['title'] = 'Projects Lists';
        $this->is_logged_in();

        $config = array(
            'base_url' => $this->config->base_url("projects/lists"),
            'total_rows' => $this->project_model->count_projects(),
            'uri_segment' => 3,
        );

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->data['projects_list'] = $this->project_model->get_projects_list($this->pagination->per_page, $page);
        $this->data["links"] = $this->pagination->create_links();

        //render view
        $this->load->view('header', $this->data);
        $this->load->view('lists');
        $this->load->view('sidebar');
        $this->load->view('footer');
    }

    //project details
    function details($id)
    {
        $this->data['title'] = "Project Details";
        $this->is_logged_in();

        $project = $this->project_model->get_project_by_id($id);
        if (count($project) == 0) {
            show_error('Project not found');
        }
        $this->data['project'] = $project;


        $this->data['forms_list'] = array();

        //render view
        $this->load->view('header', $this->data);
        $this->load->view('sidebar');
        $this->load->view('details');
        $this->load->view('footer');
    }

    //create project
    function create()
    {
        $this->data['title'] = "Create new project";
        $this->is_logged_in();

        //form validation
        $this->form_validation->set_rules('name', 'Project Title', 'required|trim');

        if ($this->form_validation->run() == TRUE) {
            //insert project
            $id = $this->project_model->create_project(
                array(
                    'title' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'created_at' => date('Y-m-d'),
                    'created_by' => $this->user_id,
                    'perms' => 'P1P, G1G' //todo : insert from interface
                ));

            if ($id)
                $this->session->set_flashdata('message', display_message('Project created'));
            else
                $this->session->set_flashdata('message', display_message('Failed to create project', 'danger'));

            redirect('projects/create', 'refresh');
        }

        //populate data
        $this->data['name'] = array(
            'name' => 'name',
            'id' => 'name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('name'),
            'class' => 'form-control',
            'placeholder' => 'Write project title...'
        );

        $this->data['description'] = array(
            'name' => 'description',
            'id' => 'description',
            'type' => 'text area',
            'rows' => '5',
            'value' => $this->form_validation->set_value('description'),
            'class' => 'form-control',
            'placeholder' => 'Write project description...'
        );

        //render view
        $this->load->view('header', $this->data);
        $this->load->view('sidebar');
        $this->load->view('create');
        $this->load->view('footer');
    }

    function edit($id)
    {
        $this->is_logged_in();

    }

    function delete($id)
    {
        $this->is_logged_in();

    }

}
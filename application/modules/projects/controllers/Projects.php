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

        foreach ($this->data['projects_list'] as $k => $v) {
            $this->data['projects_list'][$k]->user = $this->user_model->get_user_by_id($v->created_by);
        }

        //render view
        $this->load->view('header', $this->data);
        $this->load->view('sidebar');
        $this->load->view('lists');
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

        //project forms
        $config = array(
            'base_url' => $this->config->base_url("projects/details/" . $id . '/'),
            'total_rows' => $this->xform_model->count_forms(),
            'uri_segment' => 4,
        );

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $this->data['forms_list'] = $this->xform_model->get_forms_list($id, $this->pagination->per_page, $page);
        $this->data["links"] = $this->pagination->create_links();

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
                    'update_by' => $this->user_id,
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

    //edit project
    function edit($id)
    {
        $this->data['title'] = "Edit Project";
        $this->is_logged_in();

        $project = $this->project_model->get_project_by_id($id);
        if (count($project) == 0) {
            show_error('Project not found');
        }
        $this->data['project'] = $project;

        //form validation
        $this->form_validation->set_rules('name', 'Project Title', 'required|trim');

        if ($this->form_validation->run() == TRUE) {
            //update project
            $result = $this->project_model->update_project(
                array(
                    'title' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'update_by' => $this->user_id
                ), $id);

            if ($result)
                $this->session->set_flashdata('message', display_message('Project updated'));
            else
                $this->session->set_flashdata('message', display_message('Failed to update project', 'danger'));

            redirect('projects/details/' . $id, 'refresh');
        }

        //populate data
        $this->data['name'] = array(
            'name' => 'name',
            'id' => 'name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('name', $project->title),
            'class' => 'form-control',
            'placeholder' => 'Write project title...'
        );

        $this->data['description'] = array(
            'name' => 'description',
            'id' => 'description',
            'type' => 'text area',
            'rows' => '5',
            'value' => $this->form_validation->set_value('description', $project->description),
            'class' => 'form-control',
            'placeholder' => 'Write project description...'
        );

        //render view
        $this->load->view('header', $this->data);
        $this->load->view('sidebar');
        $this->load->view('edit');
        $this->load->view('footer');
    }

    //delete project
    function delete($project_id)
    {
        $this->data['title'] = "Delete Project";
        $this->is_logged_in();

        $project = $this->project_model->get_project_by_id($project_id);
        if (count($project) == 0) {
            show_error('Project not found');
        }

        //TODO: get forms with project_id

        //TODO: get tables with form_id


        //delete
        //$delete = $this->project_model->delete_project($project_id);

        //if ($delete) {
        //get fr
        //}

        //redirect
        redirect('projects/lists', 'refresh');
    }

}
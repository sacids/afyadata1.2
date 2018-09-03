<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 30/08/2018
 * Time: 08:17
 */

class Symptoms extends MX_Controller
{
    private $data;
    private $controller;
    private $user_id;

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('symptom_model'));
        log_message('debug', 'Symptoms controller initialized');

        $this->controller = $this->router->class;
        $this->user_id = $this->session->userdata('user_id');
    }

    //check if user login
    function is_logged_in()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    //diseases lists
    function lists()
    {
        $this->data['title'] = "Symptoms Lists";

        //check login
        $this->is_logged_in();

        //pagination config
        $config = array(
            'base_url' => $this->config->base_url("ohkr/symptoms/lists"),
            'total_rows' => $this->symptom_model->count_symptoms(),
            'uri_segment' => 4,
        );

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $this->data['symptoms_list'] = $this->symptom_model->get_symptoms_list($this->pagination->per_page, $page);
        $this->data["links"] = $this->pagination->create_links();

        //render view
        $this->load->view('header', $this->data);
        $this->load->view("sidebar");
        $this->load->view("symptoms/lists");
        $this->load->view('footer');
    }

    //add new symptom
    public function add_new()
    {
        $this->data['title'] = "Add new Symptom";

        //check login
        $this->is_logged_in();

        //form validation
        $this->form_validation->set_rules("name", 'Symptom', 'required|trim');
        $this->form_validation->set_rules("code", 'Code', 'required|trim');

        if ($this->form_validation->run() === TRUE) {

            //insert data
            $data = array(
                'title' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'description' => $this->input->post('description'),
                'created_by' => $this->user_id,
                'created_at' => date("Y-m-d H:i:s")
            );

            if ($this->symptom_model->create_symptom($data)) {
                $this->session->set_flashdata("message", display_message('Symptom added'));
            } else {
                $this->session->set_flashdata("message", display_message('Failed to add symptom', 'danger'));
            }
            redirect('ohkr/symptoms/lists', 'refresh');
        }

        $this->data['name'] = array(
            'name' => 'name',
            'id' => 'name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('name'),
            'class' => 'form-control',
            'placeholder' => 'Write symptom title ....'
        );

        $this->data['code'] = array(
            'name' => 'code',
            'id' => 'code',
            'type' => 'text',
            'value' => $this->form_validation->set_value('code'),
            'class' => 'form-control',
            'placeholder' => 'Write symptom code i.e A01,A02 ....'
        );

        $this->data['description'] = array(
            'name' => 'description',
            'id' => 'description',
            'type' => 'text area',
            'rows' => 3,
            'value' => $this->form_validation->set_value('description'),
            'class' => 'form-control',
            'placeholder' => 'Write disease description ....'
        );

        //render view
        $this->load->view('header', $this->data);
        $this->load->view("sidebar");
        $this->load->view("symptoms/add_new");
        $this->load->view('footer');
    }

    //edit disease
    public function edit($id)
    {
        $this->data['title'] = "Edit symptoms";

        //check login
        $this->is_logged_in();

        //symptom
        $symptom = $this->symptom_model->get_symptom_by_id($id);
        if (count($symptom) == 0) {
            show_error("Symptom not found", 500);
        }
        $this->data['symptom'] = $symptom;

        //form validation
        $this->form_validation->set_rules("name", 'Symptom', 'required|trim');
        $this->form_validation->set_rules("code", 'Code', 'required|trim');

        if ($this->form_validation->run() === TRUE) {
            //update data
            $data = array(
                'title' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'description' => $this->input->post('description')
            );

            if ($this->symptom_model->update_symptom($data, $id)) {
                $this->session->set_flashdata("message", display_message('Symptom updated'));
            } else {
                $this->session->set_flashdata("message", display_message('Failed to update symptom', 'danger'));
            }
            redirect('ohkr/symptoms/lists', 'refresh');
        }

        $this->data['name'] = array(
            'name' => 'name',
            'id' => 'name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('name', $symptom->title),
            'class' => 'form-control',
            'placeholder' => 'Write symptom title ....'
        );

        $this->data['code'] = array(
            'name' => 'code',
            'id' => 'code',
            'type' => 'text',
            'value' => $this->form_validation->set_value('code', $symptom->code),
            'class' => 'form-control',
            'placeholder' => 'Write symptom code i.e A01,A02 ....'
        );

        $this->data['description'] = array(
            'name' => 'description',
            'id' => 'description',
            'type' => 'text area',
            'rows' => 3,
            'value' => $this->form_validation->set_value('description', $symptom->description),
            'class' => 'form-control',
            'placeholder' => 'Write disease description ....'
        );

        //render view
        $this->load->view('header', $this->data);
        $this->load->view("sidebar");
        $this->load->view("symptoms/edit");
        $this->load->view('footer');
    }

    //delete disease
    function delete($id)
    {
        //check login
        $this->is_logged_in();

        //symptom
        $symptom = $this->symptom_model->get_symptom_by_id($id);
        if (count($symptom) == 0) {
            show_error("Symptom not found", 500);
        }
        $this->data['symptom'] = $symptom;

        if ($this->symptom_model->delete_symptom($id)) {
            $this->session->set_flashdata("message", display_message("Symptom deleted"));
        } else {
            $this->session->set_flashdata("message", display_message('Failed to delete symptom', 'danger'));
        }
        redirect("ohkr/symptoms/lists", "refresh");
    }

}
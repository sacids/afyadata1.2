<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 30/08/2018
 * Time: 08:17
 */

class Species extends MX_Controller
{
    private $data;
    private $controller;
    private $user_id;

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('specie_model'));
        log_message('debug', 'Species controller initialized');

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
        $this->data['title'] = "Species Lists";

        //check login
        $this->is_logged_in();

        //pagination config
        $config = array(
            'base_url' => $this->config->base_url("ohkr/species/lists"),
            'total_rows' => $this->specie_model->count_species(),
            'uri_segment' => 4,
        );

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $this->data['species_list'] = $this->specie_model->get_species_list($this->pagination->per_page, $page);
        $this->data["links"] = $this->pagination->create_links();

        //render view
        $this->load->view('header', $this->data);
        $this->load->view("sidebar");
        $this->load->view("species/lists");
        $this->load->view('footer');
    }

    //add new disease
    public function add_new()
    {
        $this->data['title'] = "Add new specie";

        //check login
        $this->is_logged_in();

        //form validation
        $this->form_validation->set_rules("name", 'Specie', 'required|trim');

        if ($this->form_validation->run() === TRUE) {

            //insert data
            $data = array(
                'title' => $this->input->post('name'),
                'created_by' => $this->user_id,
                'created_at' => date("Y-m-d H:i:s")
            );

            if ($this->specie_model->create_specie($data)) {
                $this->session->set_flashdata("message", display_message('Specie added'));
            } else {
                $this->session->set_flashdata("message", display_message('Failed to add specie', 'danger'));
            }
            redirect('ohkr/species/lists', 'refresh');
        }

        $this->data['name'] = array(
            'name' => 'name',
            'id' => 'name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('name'),
            'class' => 'form-control',
            'placeholder' => 'Write specie title ....'
        );

        //render view
        $this->load->view('header', $this->data);
        $this->load->view("sidebar");
        $this->load->view("species/add_new");
        $this->load->view('footer');
    }

    //edit disease
    public function edit($id)
    {
        $this->data['title'] = "Edit specie";

        //check login
        $this->is_logged_in();

        //specie
        $specie = $this->specie_model->get_specie_by_id($id);
        if (count($specie) == 0) {
            show_error("Specie not found", 500);
        }
        $this->data['specie'] = $specie;

        //form validation
        $this->form_validation->set_rules("name", 'Specie', 'required|trim');

        if ($this->form_validation->run() === TRUE) {
            //update data
            $data = array(
                'title' => $this->input->post('name'),
            );

            if ($this->specie_model->update_specie($data, $id)) {
                $this->session->set_flashdata("message", display_message('Specie updated'));
            } else {
                $this->session->set_flashdata("message", display_message('Failed to update specie', 'danger'));
            }
            redirect('ohkr/species/lists', 'refresh');
        }

        $this->data['name'] = array(
            'name' => 'name',
            'id' => 'name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('name', $specie->title),
            'class' => 'form-control',
            'placeholder' => 'Write disease title ....'
        );

        //render view
        $this->load->view('header', $this->data);
        $this->load->view("sidebar");
        $this->load->view("species/edit");
        $this->load->view('footer');
    }

    //delete disease
    function delete($id)
    {
        //check login
        $this->is_logged_in();

        //specie
        $specie = $this->specie_model->get_specie_by_id($id);
        if (count($specie) == 0) {
            show_error("Specie not found", 500);
        }
        $this->data['specie'] = $specie;

        if ($this->specie_model->delete_specie($id)) {
            $this->session->set_flashdata("message", display_message("Specie deleted"));
        } else {
            $this->session->set_flashdata("message", display_message('Failed to delete specie', 'danger'));
        }
        redirect("ohkr/species/lists", "refresh");
    }
}
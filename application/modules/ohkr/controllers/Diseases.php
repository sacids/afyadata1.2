<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 30/08/2018
 * Time: 08:16
 */

class Diseases extends MX_Controller
{
    private $data;
    private $controller;
    private $user_id;

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('disease_model', 'specie_model'));
        log_message('debug', 'Diseases controller initialized');

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


//    function update()
//    {
//        $this->model->set_table('xforms');
//        $xforms = $this->model->get_all();
//
//        foreach ($xforms as $v) {
//            $this->model->update_by(['id' => $v->id],
//                ['attachment' => $v->filename, 'created_at' => $v->date_created, 'created_by' => 1]);
//        }
//    }

    //diseases lists
    function lists()
    {
        $this->data['title'] = "Diseases Lists";

        //check login
        $this->is_logged_in();

        //pagination config
        $config = array(
            'base_url' => $this->config->base_url("ohkr/diseases/lists"),
            'total_rows' => $this->disease_model->count_diseases(),
            'uri_segment' => 4,
        );

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $this->data['diseases_list'] = $this->disease_model->get_diseases_list($this->pagination->per_page, $page);
        $this->data["links"] = $this->pagination->create_links();

        //render view
        $this->load->view('header', $this->data);
        $this->load->view("sidebar");
        $this->load->view("diseases/lists");
        $this->load->view('footer');
    }

    //add new disease
    public function add_new()
    {
        $this->data['title'] = "Add new disease";

        //check login
        $this->is_logged_in();

        //form validation
        $this->form_validation->set_rules("name", 'Disease', 'required|trim');
        $this->form_validation->set_rules("specie[]", 'Species', 'required|trim');
        $this->form_validation->set_rules("description", 'Description', 'trim');

        if ($this->form_validation->run() === TRUE) {
            $species = $this->input->post('specie');

            $all_species = "";
            if (count($species) > 0) {
                $all_species = join(",", $species);
            }

            //insert data
            $data = array(
                'title' => $this->input->post('name'),
                'specie' => $all_species,
                'description' => $this->input->post('description'),
                'created_by' => $this->user_id,
                'created_at' => date("Y-m-d H:i:s")
            );

            if ($this->disease_model->create_disease($data)) {
                //todo: process data for disease detection


                $this->session->set_flashdata("message", display_message('Disease added'));
            } else {
                $this->session->set_flashdata("message", display_message('Failed to add disease', 'danger'));
            }
            redirect('ohkr/diseases/lists', 'refresh');
        }

        $this->data['name'] = array(
            'name' => 'name',
            'id' => 'name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('name'),
            'class' => 'form-control',
            'placeholder' => 'Write disease title ....'
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

        $this->data['species_lists'] = $this->specie_model->get_species_list(100, 0);

        //render view
        $this->load->view('header', $this->data);
        $this->load->view("sidebar");
        $this->load->view("diseases/add_new");
        $this->load->view('footer');
    }

    //edit disease
    public function edit($id)
    {
        $this->data['title'] = "Edit disease";

        //check login
        $this->is_logged_in();

        //disease
        $disease = $this->disease_model->get_disease_by_id($id);
        if (count($disease) == 0) {
            show_error("Disease not found", 500);
        }
        $this->data['disease'] = $disease;

        //form validation
        $this->form_validation->set_rules("name", 'Disease', 'required|trim');
        $this->form_validation->set_rules("specie[]", 'Species', 'required|trim');
        $this->form_validation->set_rules("description", 'Description', 'trim');

        if ($this->form_validation->run() === TRUE) {
            $species = $this->input->post('specie');

            $all_species = "";
            if (count($species) > 0) {
                $all_species = join(",", $species);
            }

            //insert data
            $data = array(
                'title' => $this->input->post('name'),
                'specie' => $all_species,
                'description' => $this->input->post('description'),
            );

            if ($this->disease_model->update_disease($data, $id)) {
                //todo: process data for disease detection


                $this->session->set_flashdata("message", display_message('Disease updated'));
            } else {
                $this->session->set_flashdata("message", display_message('Failed to update disease', 'danger'));
            }
            redirect('ohkr/diseases/lists', 'refresh');
        }

        $this->data['name'] = array(
            'name' => 'name',
            'id' => 'name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('name', $disease->title),
            'class' => 'form-control',
            'placeholder' => 'Write disease title ....'
        );


        $this->data['description'] = array(
            'name' => 'description',
            'id' => 'description',
            'type' => 'text area',
            'rows' => 3,
            'value' => $this->form_validation->set_value('description', $disease->description),
            'class' => 'form-control',
            'placeholder' => 'Write disease description ....'
        );

        $this->data['species_lists'] = $this->specie_model->get_species_list(100, 0);

        //render view
        $this->load->view('header', $this->data);
        $this->load->view("sidebar");
        $this->load->view("diseases/edit");
        $this->load->view('footer');
    }

    //delete disease
    function delete($id)
    {
        //check login
        $this->is_logged_in();

        //check login
        $this->is_logged_in();

        //disease
        $disease = $this->disease_model->get_disease_by_id($id);
        if (count($disease) == 0) {
            show_error("Disease not found", 500);
        }
        $this->data['disease'] = $disease;

        if ($this->disease_model->delete_disease($id)) {
            //todo: process data for disease detection

            $this->session->set_flashdata("message", display_message("Disease deleted"));
        } else {
            $this->session->set_flashdata("message", display_message('Failed to delete disease', 'danger'));
        }
        redirect("ohkr/diseases/lists", "refresh");
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 14/01/2019
 * Time: 11:35
 */

class Diseases_symptoms extends MX_Controller
{
    private $data;
    private $controller;

    public function __construct()
    {
        parent::__construct();

        $this->load->model(array('disease_model', 'specie_model', 'symptom_model'));
        log_message('debug', 'Disease Symptoms controller initialized');

        $this->controller = $this->router->class;

        if (!$this->ion_auth->logged_in())
            redirect('auth/login', 'refresh');
    }

    //disease symptoms
    public function lists()
    {
        $data['title'] = "Disease Symptoms";

        $this->model->set_table('ohkr_disease_symptoms');
        $diseases_symptoms = $this->model->get_all();

        //disease symptoms
        $this->data['diseases_symptoms'] = $diseases_symptoms;

        foreach ($this->data['diseases_symptoms'] as $k => $v) {
            $this->data['diseases_symptoms'][$k]->disease = $this->disease_model->get_disease_by_id($v->disease_id);
            $this->data['diseases_symptoms'][$k]->symptom = $this->symptom_model->get_symptom_by_id($v->symptom_id);
            $this->data['diseases_symptoms'][$k]->specie = $this->specie_model->get_specie_by_id($v->specie_id);
        }

        //render view
        $this->load->view('header', $this->data);
        $this->load->view("sidebar");
        $this->load->view("diseases_symptoms/lists");
        $this->load->view('footer');
    }

    //add disease symptom
    public function add_new()
    {
        $data['title'] = "Add Disease Symptom";

        //form validation
        $this->form_validation->set_rules("disease_id", "Disease", "required");
        $this->form_validation->set_rules("symptom_id", "Symptom", "required");
        $this->form_validation->set_rules("specie_id[]", "Specie", "required");
        $this->form_validation->set_rules("importance", "Importance", "required|numeric");

        if ($this->form_validation->run() === TRUE) {
            //insert data
            $this->model->set_table('ohkr_disease_symptoms');

            foreach ($this->input->post('specie_id') as $specie_id) {
                $id = $this->model->insert(
                    [
                        "symptom_id" => $this->input->post("symptom_id"),
                        "disease_id" => $this->input->post("disease_id"),
                        "specie_id" => $specie_id,
                        "importance" => $this->input->post("importance"),
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => 1
                    ]
                );

                if ($id)
                    file_get_contents(base_url("api/v3/intel/set_epi_map"));
            }

            $this->session->set_flashdata("message", 'Disease symptom added');
            redirect('ohkr/diseases_symptoms/lists', "refresh");
        }

        //populate data
        $this->data['importance'] = array(
            'name' => 'importance',
            'id' => 'importance',
            'type' => 'text',
            'value' => $this->form_validation->set_value('importance'),
            'class' => 'form-control',
            'placeholder' => 'Write importance...'
        );

        $this->data['diseases'] = $this->disease_model->get_diseases_list(100, 0);
        $this->data['species'] = $this->specie_model->get_species_list(100, 0);

        //symptoms
        $this->model->set_table('ohkr_symptoms');
        $this->data['symptoms'] = $this->model->order_by('code', 'ASC')->get_all();

        //render view
        $this->load->view('header', $this->data);
        $this->load->view("sidebar");
        $this->load->view("diseases_symptoms/add_new");
        $this->load->view('footer');
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 18/01/2018
 * Time: 21:58
 */

class Forms extends CI_Controller
{
    private $default_email;
    private $realm;
    private $xFormReader;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model'));
        $this->load->library(array('form_auth'));
        $this->xFormReader = new Formreader_model();

        $this->realm = 'Authorized users of AfyaData';
        $this->default_email = 'afyadata@sacids.org';
    }

    //download forms
    function form_list()
    {
        // Get the digest from the http header

        if (isset($_SERVER['PHP_AUTH_DIGEST']))
            $digest = $_SERVER['PHP_AUTH_DIGEST'];

        $nonce = md5(uniqid());

        // If there was no digest, show login
        if (empty($digest)) {
            //populate login form if no digest authenticate
            $this->form_auth->require_login_prompt($this->realm, $nonce);
            exit;
        }

        //http_digest_parse
        $digest_parts = $this->form_auth->http_digest_parse($digest);

        //username from http digest obtained
        $username = $digest_parts['username'];

        //get user details from database
        $user = $this->user_model->get_user_by_username($username);
        $password = $user->digest_password; //digest password
        $db_user = $user->username; //username

        //show status header if user not available in database
        if (empty($db_user)) {
            //populate login form if no digest authenticate
            $this->form_auth->require_login_prompt($this->realm, $nonce);
            exit;
        }

        // Based on all the info we gathered we can figure out what the response should be
        $A1 = $password; //digest password
        $A2 = md5("{$_SERVER['REQUEST_METHOD']}:{$digest_parts['uri']}");
        $valid_response = md5("{$A1}:{$digest_parts['nonce']}:{$digest_parts['nc']}:{$digest_parts['cnonce']}:{$digest_parts['qop']}:{$A2}");

        // If digest fails, show login
        if ($digest_parts['response'] != $valid_response) {
            //populate login form if no digest authenticate
            $this->form_auth->require_login_prompt($this->realm, $nonce);
            exit;
        }

//        $user_groups = $this->user_model->get_user_groups_by_id($user->id);
//        $user_perms = array(0 => "P" . $user->id . "P");
//        $i = 1;
//        foreach ($user_groups as $ug) {
//            $user_perms[$i] = "G" . $ug->id . "G";
//            $i++;
//        }

        //$forms = $this->Xform_model->get_form_list_by_perms($user_perms);

        $this->model->set_table('xforms');
        $forms = $this->model->get_all();

        $xml = '<xforms xmlns="http://openrosa.org/xforms/xformsList">';

        foreach ($forms as $form) {

            // used to notify if anything has changed with the form, so that it may be updated on download
            $hash = md5($form->form_id . $form->created_at . $form->attachment . $form->id . $form->title);

            $xml .= '<xform>';
            $xml .= '<formID>' . $form->form_id . '</formID>';
            $xml .= '<name>' . $form->title . '</name>';
            $xml .= '<version>1.1</version>';
            $xml .= '<hash>md5:' . $hash . '</hash>';
            $xml .= '<descriptionText>' . $form->description . '</descriptionText>';
            $xml .= '<downloadUrl>' . base_url() . 'assets/uploads/forms/definition/' . $form->attachment . '</downloadUrl>';
            $xml .= '</xform>';
        }
        $xml .= '</xforms>';

        $content_length = sizeof($xml);
        //set header response
        header('Content-Type:text/xml; charset=utf-8');
        header('HTTP_X_OPENROSA_VERSION:1.0');
        header("X-OpenRosa-Accept-Content-Length:" . $content_length);
        header('X-OpenRosa-Version:1.0');
        header("Date:" . date('r'), FALSE);

        echo $xml;
    }


    //form submission
    public function submission()
    {
        // Form Received in openrosa server
        $http_response_code = 201;

        // Get the digest from the http header
        if (isset($_SERVER ['PHP_AUTH_DIGEST']))
            $digest = $_SERVER ['PHP_AUTH_DIGEST'];

        //unique id
        $nonce = md5(uniqid());

        // Check if there was no digest, show login
        if (empty ($digest)) {
            // populate login form if no digest authenticate
            $this->form_auth->require_login_prompt($this->realm, $nonce);
            exit();
        }

        // http_digest_parse
        $digest_parts = $this->form_auth->http_digest_parse($digest);

        // username obtained from http digest
        $username = $digest_parts ['username'];

        // get user details from database
        $user = $this->user_model->get_user_by_username($username);
        $password = $user->digest_password;
        $db_username = $user->username;
        $uploaded_filename = NULL;

        // show status header if user not available in database
        if (empty ($db_username)) {
            // populate login form if no digest authenticate
            $this->form_auth->require_login_prompt($this->realm, $nonce);
            exit();
        }

        // Based on all the info we gathered we can figure out what the response should be
        $A1 = $password; // digest password
        $A2 = md5("{$_SERVER['REQUEST_METHOD']}:{$digest_parts['uri']}");
        $calculated_response = md5("{$A1}:{$digest_parts['nonce']}:{$digest_parts['nc']}:{$digest_parts['cnonce']}:{$digest_parts['qop']}:{$A2}");

        // If digest fails, show login
        if ($digest_parts ['response'] != $calculated_response) {
            // populate login form if no digest authenticate
            $this->form_auth->require_login_prompt($this->realm, $nonce);
            exit();
        }

        // IF passes authentication
        if ($_SERVER ['REQUEST_METHOD'] === "HEAD") {
            $http_response_code = 204;
        } elseif ($_SERVER ['REQUEST_METHOD'] === "POST") {

            foreach ($_FILES as $file) {
                // File details
                $file_name = $file ['name'];

                // check file extension
                $value = explode('.', $file_name);
                $file_extension = end($value);

                $inserted_form_id = NULL;

                $path = ''; //path
                if ($file_extension === 'xml') {
                    // path to store xml
                    $uploaded_filename = $file_name;
                    $path = $this->config->item("form_data_upload_dir") . $file_name;
                    // insert form details in database
                    $this->db->insert('xform_submission',
                        array(
                            'filename' => $file_name,
                            'created_at' => date("Y-m-d h:i:s"),
                            'created_by' => $user->id
                        ));
                    $inserted_form_id = $this->db->insert_id();

                } elseif ($file_extension == 'jpg' or $file_extension == 'jpeg' or $file_extension == 'png') {
                    // path to store images
                    $path = $this->config->item("images_data_upload_dir") . $file_name;
                    //TODO Resize image here

                } elseif ($file_extension == '3gpp' or $file_extension == 'amr') {
                    // path to store audio
                    $path = $this->config->item("audio_data_upload_dir") . $file_name;

                } elseif ($file_extension == '3gp' or $file_extension == 'mp4') {
                    // path to store video
                    $path = $this->config->item("video_data_upload_dir") . $file_name;
                }

                // upload file to the server
                move_uploaded_file($file ['tmp_name'], $path);
            }
            // call function to insert xform data in a database
            if (!$this->insert($uploaded_filename)) {
                if ($this->form_model->delete_submission($inserted_form_id))
                    @unlink($path);
            }
        }

        // return response
        echo $this->get_response($http_response_code);
    }

    //insert form data
    public function insert($filename)
    {
        $datafile = $this->config->item("form_data_upload_dir") . $filename;

        $this->xFormReader->set_data_file($datafile);
        $this->xFormReader->load_xml_data();

        $statement = $this->xFormReader->get_insert_form_data_query();
        $insert_result = $this->form_model->insert_data($statement);

        return $insert_result;
    }


    /**
     * Header Response
     *
     * @param string $http_response_code
     *            Input string
     * @param string $response_message
     *            Input string
     * @return string response
     */
    function get_response($http_response_code, $response_message = "Thank you, Form has been received successfully")
    {
        // OpenRosa Success Response
        $response = '<OpenRosaResponse xmlns="http://openrosa.org/http/response">
                    <message nature="submit_success">' . $response_message . '</message>
                    </OpenRosaResponse>';

        $content_length = sizeof($response);
        // set header response
        header("X-OpenRosa-Version:1.0");
        header("X-OpenRosa-Accept-Content-Length:" . $content_length);
        header("Date:" . date('r'), FALSE, $http_response_code);
        return $response;
    }


}
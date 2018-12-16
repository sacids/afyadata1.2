<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 07/01/2018
 * Time: 00:40
 */

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Auth extends REST_Controller
{
    private $default_email;
    private $realm;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model'));

        $this->realm = 'Authorized users of AfyaData';
        $this->default_email = 'afyadata@sacids.org';
    }

    //App Version
    function version_get()
    {
        //get current app version
        $this->model->set_table('app_version');
        $app_version = $this->model->get_by('status', 'active');

        if ($app_version) {
            $this->response(array('status' => 'success', 'app_version' => $app_version), 200);

        } else {
            $this->response(array('status' => 'failed', 'message' => 'No app version available'), 204);
        }
    }

    //login
    function login_post()
    {
        if (!$this->post('code') || !$this->post('mobile') || !$this->post('password')) {
            $this->response(array('error' => TRUE, 'error_msg' => 'Required parameter are missing'), 202);
        }

        //post data
        $code = $this->post('code');
        $mobile = $this->post('mobile');
        $password = $this->post('password');

        //username
        $username = substr($code, 1) . $this->cast_mobile($mobile);

        if (!$this->ion_auth->login($username, $password)) {
            //return response for failure
            $this->response(array('error' => TRUE, 'error_msg' => 'Incorrect mobile or password'), 203);

        } else {
            //get user details after successfully
            $this->model->set_table('users');
            $user = $this->model->get_by('username', $username);

            //return response after successfully
            $response["error"] = FALSE;
            $response["uid"] = $user->id;
            $response["user"]["username"] = $user->username;
            $response["user"]["first_name"] = $user->first_name;
            $response["user"]["last_name"] = $user->last_name;

            //success response
            $this->response($response, 200);
        }
    }

    //register user details
    function register_post()
    {
        if (!$this->post('code') || !$this->post('mobile') || !$this->post('password') || !$this->post('password_confirm')) {
            $this->response(array('status' => TRUE, 'error_msg' => 'Required parameter are missing'), 202);
        }

        //post data
        $code = $this->post('code');
        $mobile = $this->post('mobile');
        $password = $this->post('password');
        $password_confirm = $this->post('password_confirm');

        //username
        $username = substr($code, 1) . $this->cast_mobile($mobile);

        //check mobile number existence
        if ($this->check_user_existence($username)) {
            //return error response
            $this->response(array('error' => TRUE, 'error_msg' => 'Mobile number used by another user'), 203);

        } else if ($password != $password_confirm) {
            //return error response
            $this->response(array('error' => TRUE, 'error_msg' => 'Password does not match'), 203);

        } else {
            //digest password
            $digest_password = md5("{$username}:{$this->realm}:{$password}");

            //additional data
            $additional_data = array(
                'first_name' => $this->post('first_name'),
                'last_name' => $this->post('last_name'),
                'phone' => $username,
                'digest_password' => $digest_password
            );

            if ($id = $this->ion_auth->register($username, $password, $this->default_email, $additional_data)) {
                //get user details after successfully
                $this->model->set_table('users');
                $user = $this->model->get_by('id', $id);

                //return response after successfully
                $response["error"] = FALSE;
                $response["uid"] = $user->id;
                $response["user"]["username"] = $user->username;
                $response["user"]["first_name"] = $user->first_name;
                $response["user"]["last_name"] = $user->last_name;

                //success response
                $this->response($response, 200);
            } else {
                $this->response(array('error' => TRUE, 'error_msg' => 'Failed to create account'), 204);
            }
        }
    }

    //change password
    function change_password_post()
    {
        if (!$this->post('user_id') || !$this->post('old_password') || !$this->post('new_password')) {
            $this->response(array('status' => TRUE, 'error_msg' => 'Required parameter are missing'), 202);
        }

        //post variable
        $user_id = $this->post('user_id');
        $old = $this->post('old_password');
        $new = $this->post('new_password');

        //user
        $user = $this->user_model->get_user_by_id($user_id);

        if ($user) {
            //digest password
            $digest_pwd = md5("{$user->username}:{$this->realm}:{$new}");

            //compare password
            if ($this->ion_auth->hash_password_db($user_id, $old) === true) {
                //user data
                $data = ['password' => $new, 'digest_password' => $digest_pwd];

                if ($this->ion_auth->update($user_id, $data)) {
                    $this->response(array('error' => FALSE, 'success_msg' => 'Password changed'), 200);
                } else {
                    $this->response(array('error' => TRUE, 'error_msg' => 'Failed to update password'), 203);
                }
            } else {
                $this->response(array('error' => TRUE, 'error_msg' => 'Wrong Password'), 203);
            }
        } else {
            $this->response(array('error' => TRUE, 'error_msg' => 'User not exist'), 203);
        }
    }

    //remove 0 on start of mobile
    function cast_mobile($mobile)
    {
        if (preg_match("~^0\d+$~", $mobile)) {
            return substr($mobile, 1);
        } else {
            return $mobile;
        }
    }

    //check existence of mobile
    function check_user_existence($username)
    {
        //count mobile existence
        $this->model->set_table('users');
        $user = $this->model->count_by('username', $username);

        if ($user > 0)
            return TRUE;
        else
            return FALSE;
    }
}

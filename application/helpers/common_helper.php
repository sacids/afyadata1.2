<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Renfrid-Sacids
 * Date: 2/1/2016
 * Time: 9:46 AM
 */

if (!function_exists("display_message")) {
    function display_message($message, $message_type = "success")
    {
        if ($message_type == "success") {
            return '<div class="alert alert-success">' . $message . '</div>';
        }
        if ($message_type == "info") {
            return '<div class="alert alert-info">' . $message . '</div>';
        }
        if ($message_type == "warning") {
            return '<div class="alert alert-warning">' . $message . '</div>';
        }
        if ($message_type == "danger") {
            return '<div class="alert alert-danger">' . $message . '</div>';
        }
    }
}


//display first name and last name
if (!function_exists('show_login_user_full_name')) {
    function show_login_user_full_name()
    {
        $CI = &get_instance();
        $user_id = $CI->session->userdata('user_id');

        //user details
        $user = $CI->user_model->get_user_by_id($user_id);
        echo ucfirst($user->first_name) . ' ' . ucfirst($user->last_name);
    }
}

//display last name
if (!function_exists('show_login_user_name')) {
    function show_login_user_name()
    {
        $CI = &get_instance();
        $user_id = $CI->session->userdata('user_id');

        //user details
        $user = $CI->user_model->get_user_by_id($user_id);
        echo ucfirst($user->last_name);
    }
}

//display organization
if (!function_exists('show_login_user_organization')) {
    function show_login_user_organization()
    {
        $CI = &get_instance();
        $user_id = $CI->session->userdata('user_id');

        //user details
        $user = $CI->user_model->get_user_by_id($user_id);

        if ($user) {
            if (!empty($user->company))
                echo $user->company;
            else
                echo 'No company';
        }
    }
}
<?php defined('BASEPATH') OR exit('No direct script access allowed');


if (!function_exists("show_projects")) {
    function show_projects()
    {
        $ci = &get_instance();

        $project_list = $ci->project_model->find_all();

        if ($project_list) {
            foreach ($project_list as $value) {
                return '<li class="nav-item">' . anchor('projects/details/' . $value->id, $value->title, 'class="nav-link"') . '</li>';
            }
        } else {
            return '';
        }
        return '';
    }
}
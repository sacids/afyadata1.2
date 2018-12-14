<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once FCPATH.'/vendors/ez/php/db_table_render.php';

?>

<div class="content">
    <div class="card">
        <div class="card-header bg-white header-elements-inline">
            <h6 class="card-title">Add New Form</h6>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php


            echo $output;



            ?>
        </div>
    </div>
</div>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->session->set_userdata('form_id',$this->form);
$this->session->set_userdata('project_id',$project->id);
$this->session->set_userdata('group_id',$project->group_id);


$this->model->set_table('xforms');
$form   = $this->model->get($this->form);
//print_r($form);
?>


<div class="content-wrapper" id="ez-detail">

    <!-- Content area -->
    <div class="content pt-0" id="ez_content" surl="<?php echo current_url(); ?>">

        <div class="card mt-3">
            <div class="card-header header-elements-inline">
                <h5 class="card-title"><?php echo $form->title; ?>
                    <span class="d-block font-size-base text-muted"><?php echo $form->description ?></span>
                </h5>

                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="fullscreen"></a>
                    </div>
                </div>
            </div>

            <?php

            //echo 'sema ';print_r($data);
            ?>

            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-bottom">

  <!--                  <li class="nav-item">
                        <a href="#bottom-tab1" class="nav-link active legitRipple" data-toggle="tab"><i class="icon-ipad mr-2"></i>View</a>
                    </li> !-->
                    <li class="nav-item">
                        <a href="#bottom-tab1" u="<?php echo base_url('project/view/form/data/'); ?>"  class="tab nav-link active legitRipple" data-toggle="tab"><i class="icon-stack2 mr-2"></i>Data</a>
                    </li>
                    <li class="nav-item">
                        <a href="#bottom-tab1" u="<?php echo base_url('project/view/form/map/'); ?>" class="tab nav-link legitRipple" data-toggle="tab"><i class="icon-map mr-2"></i>Map</a>
                    </li>
                    <li class="nav-item">
                        <a href="#bottom-tab1"  u="<?php echo base_url('project/view/form/chart/'); ?>" class="tab nav-link legitRipple" data-toggle="tab"><i class="icon-chart mr-2"></i>Charts</a>
                    </li>
                    <!--
                    <li class="nav-item">
                        <a href="#bottom-tab1" u="<?php echo base_url('project/view/form/feedback/'); ?>" class="tab nav-link legitRipple" data-toggle="tab"><i class="icon-bubbles6 mr-2"></i>Discussion</a>
                        -->
                    </li>
                    <li class="nav-item">
                        <a href="#bottom-tab1" u="<?php echo base_url('project/view/form/mapping/');?>" class="tab nav-link legitRipple" data-toggle="tab"><i class="icon-link2 mr-2"></i>Mapping</a>
                    </li>
                    <li class="nav-item">
                        <a href="#bottom-tab1" u="<?php echo base_url('project/view/form/filter/');?>" class="tab nav-link legitRipple" data-toggle="tab"><i class="icon-filter4 mr-2"></i>Filter</a>
                    </li>
                    <li class="nav-item">
                        <a href="#bottom-tab1" u="<?php echo base_url('project/view/form/perms/');?>" class="tab nav-link legitRipple" data-toggle="tab"><i class="icon-user-lock mr-2"></i>Permissions</a>
                    </li>
                    <li class="nav-item">
                        <a href="#bottom-tab1" u="<?php echo base_url('project/view/form/config/');?>"  class="tab nav-link legitRipple" data-toggle="tab"><i class="icon-cog3 mr-2"></i>Config</a>
                    </li>

                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade active show dbx_wrapper" id="bottom-tab1">

                        <?php
                            $this->load->view('project/form/data');
                            //print_r($project);
                        ?>
                    </div>

                </div>
            </div>
        </div>


    </div>
    <!-- /content area -->


    <!-- Footer -->
    <div class="navbar navbar-expand-lg navbar-light">
        <div class="text-center d-lg-none w-100">
            <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                <i class="icon-unfold mr-2"></i>
                Footer
            </button>
        </div>

        <div class="navbar-collapse collapse" id="navbar-footer">
                        <span class="navbar-text">
                            © 2015 - 2018. <a href="#">AfyaData Community Based Surveillance Kit</a> by <a href="www.sacids.org" target="_blank">SACIDS</a>
                        </span>

            <ul class="navbar-nav ml-lg-auto">
                <li class="nav-item"><a href="https://kopyov.ticksy.com/" class="navbar-nav-link legitRipple" target="_blank"><i class="icon-lifebuoy mr-2"></i> Support</a></li>
                <li class="nav-item"><a href="http://demo.interface.club/limitless/docs/" class="navbar-nav-link legitRipple" target="_blank"><i class="icon-file-text2 mr-2"></i> Docs</a></li>
            </ul>
        </div>
    </div>
    <!-- /footer -->

</div>



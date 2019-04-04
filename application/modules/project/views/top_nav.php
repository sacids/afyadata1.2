<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="navbar navbar-expand-md navbar-light fixed-top">

        <!-- Header with logos -->
        <div class="navbar-header navbar-dark d-none d-md-flex align-items-md-center">
            <div class="navbar-brand navbar-brand-md">
                <a href="index.html" class="d-inline-block">
                    <img src="<?php echo base_url(); ?>vendors/limitless/global_assets/images/logo_light.png" alt="">
                </a>
            </div>

        </div>
        <!-- /header with logos -->
    

        <!-- Mobile controls -->
        <div class="d-flex flex-1 d-md-none">
            <div class="navbar-brand mr-auto">
                <a href="index.html" class="d-inline-block">
                    <img src="<?php echo base_url(); ?>vendors/limitless/global_assets/images/logo_dark.png" alt="">
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
                <i class="icon-tree5"></i>
            </button>

            <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
                <i class="icon-paragraph-justify3"></i>
            </button>
        </div>
        <!-- /mobile controls -->


        <!-- Navbar content -->
        <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <img src="<?php echo base_url(); ?>vendors/ad/images/logo_default.png" alt="AfyaData" height="35" class="pt-2">
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
                        <i class="icon-cabinet"></i>
                        <span class="d-md-none ml-2">Users</span>
                        <span class="badge badge-mark border-pink-400 ml-auto ml-md-0"></span>
                    </a>

                    <div class="dropdown-menu dropdown-content wmin-md-300">
                        <div class="dropdown-content-header">
                            <span class="font-weight-semibold">My Projects</span>
                            <a href="#" class="text-default"><i class="icon-search4 font-size-base"></i></a>
                        </div>

                        <div class="dropdown-content-body dropdown-scrollable">
                            <ul class="media-list">
                                <?php
                                    foreach($this->project_tree as $project){

                                        ?>

                                        <li class="media">
                                            <div class="media-body">
                                                <a href="<?php echo base_url(str_replace(" ","_",strtolower($project['project']->title))); ?>" class="media-title font-weight-semibold"><?php echo $project['project']->title; ?></a>
                                                <span class="d-block text-muted font-size-sm"><?php echo $project['project']->description; ?></span>
                                            </div>
                                            <div class="ml-3 align-self-center"><span class="badge badge-mark border-success"></span></div>
                                        </li>
                                        <?php
                                    }
                                ?>
                            </ul>
                        </div>

                        <div class="dropdown-content-footer bg-light">
                            <a href="<?php echo base_url('project'); ?>" class="text-grey mr-auto">All Projects</a>
                            <a href="#" class="text-grey"><i class="icon-gear"></i></a>
                        </div>
                    </div>
                </li>
            </ul>

            <div class="breadcrumb ml-md-3 mr-md-auto">
                <a href="<?php echo base_url('project'); ?>" class="breadcrumb-item">My Projects</a>
                <?php

                if($this->project){
                    echo '<a href="'.base_url($this->project_tree[strtolower($this->project)]['project']->title).'" class="breadcrumb-item">'.$this->project_tree[strtolower($this->project)]['project']->title.'</a>';
                }

                ?>
            </div>

            <ul class="navbar-nav">
                


                <li class="nav-item dropdown dropdown-user">
                    <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url(); ?>vendors/limitless/global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" alt="">
                        <span><?php echo $first_name ?></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a>
                        <a href="<?php echo base_url('auth/logout'); ?>" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
        <!-- /navbar content -->
        
    </div>
    <!-- /main navbar -->


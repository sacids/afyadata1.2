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
            
            <div class="navbar-brand navbar-brand-xs">
                <a href="index.html" class="d-inline-block">
                    <img src=".<?php echo base_url(); ?>vendors/limitless/global_assets/images/logo_icon_light.png" alt="">
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
                    <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                        <i class="icon-paragraph-justify3"></i>
                    </a>
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
                                                <a href="<?php echo base_url('ez/10/25/m/'.$project['project']->id); ?>" class="media-title font-weight-semibold"><?php echo $project['project']->title; ?></a>
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
                            <a href="#" class="text-grey mr-auto">All Projects</a>
                            <a href="#" class="text-grey"><i class="icon-gear"></i></a>
                        </div>
                    </div>
                </li>
            </ul>

            <span class="navbar-text ml-md-3 mr-md-auto">
                <span class="badge bg-pink-400 badge-pill">16 orders</span>
            </span>

            <ul class="navbar-nav">
                

                <li class="nav-item dropdown">
                    <a href="#" class="navbar-nav-link dropdown-toggle caret-0" data-toggle="dropdown">
                        <i class="icon-bubbles4"></i>
                        <span class="d-md-none ml-2">Messages</span>
                        <span class="badge badge-mark border-pink-400 ml-auto ml-md-0"></span>
                    </a>
                    
                    <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-md-350">
                        <div class="dropdown-content-header">
                            <span class="font-weight-semibold">Messages</span>
                            <a href="#" class="text-default"><i class="icon-compose"></i></a>
                        </div>

                        <div class="dropdown-content-body dropdown-scrollable">
                            <ul class="media-list">
                                <li class="media">
                                    <div class="mr-3 position-relative">
                                        <img src="<?php echo base_url(); ?>vendors/limitless/global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">
                                    </div>

                                    <div class="media-body">
                                        <div class="media-title">
                                            <a href="#">
                                                <span class="font-weight-semibold">James Alexander</span>
                                                <span class="text-muted float-right font-size-sm">04:58</span>
                                            </a>
                                        </div>

                                        <span class="text-muted">who knows, maybe that would be the best thing for me...</span>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3 position-relative">
                                        <img src="<?php echo base_url(); ?>vendors/limitless/global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">
                                    </div>

                                    <div class="media-body">
                                        <div class="media-title">
                                            <a href="#">
                                                <span class="font-weight-semibold">Margo Baker</span>
                                                <span class="text-muted float-right font-size-sm">12:16</span>
                                            </a>
                                        </div>

                                        <span class="text-muted">That was something he was unable to do because...</span>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3">
                                        <img src="<?php echo base_url(); ?>vendors/limitless/global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">
                                    </div>
                                    <div class="media-body">
                                        <div class="media-title">
                                            <a href="#">
                                                <span class="font-weight-semibold">Jeremy Victorino</span>
                                                <span class="text-muted float-right font-size-sm">22:48</span>
                                            </a>
                                        </div>

                                        <span class="text-muted">But that would be extremely strained and suspicious...</span>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3">
                                        <img src="<?php echo base_url(); ?>vendors/limitless/global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">
                                    </div>
                                    <div class="media-body">
                                        <div class="media-title">
                                            <a href="#">
                                                <span class="font-weight-semibold">Beatrix Diaz</span>
                                                <span class="text-muted float-right font-size-sm">Tue</span>
                                            </a>
                                        </div>

                                        <span class="text-muted">What a strenuous career it is that I've chosen...</span>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3">
                                        <img src="<?php echo base_url(); ?>vendors/limitless/global_assets/images/placeholders/placeholder.jpg" width="36" height="36" class="rounded-circle" alt="">
                                    </div>
                                    <div class="media-body">
                                        <div class="media-title">
                                            <a href="#">
                                                <span class="font-weight-semibold">Richard Vango</span>
                                                <span class="text-muted float-right font-size-sm">Mon</span>
                                            </a>
                                        </div>
                                        
                                        <span class="text-muted">Other travelling salesmen live a life of luxury...</span>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="dropdown-content-footer bg-light">
                            <a href="#" class="text-grey mr-auto">All messages</a>
                            <div>
                                <a href="#" class="text-grey" data-popup="tooltip" title="Mark all as read"><i class="icon-radio-unchecked"></i></a>
                                <a href="#" class="text-grey ml-2" data-popup="tooltip" title="Settings"><i class="icon-cog3"></i></a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown dropdown-user">
                    <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url(); ?>vendors/limitless/global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" alt="">
                        <span><?php echo $first_name ?></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                        <a href="#" class="dropdown-item"><i class="icon-coins"></i> My balance</a>
                        <a href="#" class="dropdown-item"><i class="icon-comment-discussion"></i> Messages <span class="badge badge-pill bg-indigo-400 ml-auto">58</span></a>
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


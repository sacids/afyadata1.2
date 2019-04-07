<?php
defined('BASEPATH') OR exit('No direct script access allowed');


?>


<div class="content-wrapper" id="ez-detail">

    <!-- Content area -->
    <div class="content pt-0" id="ez_content" surl="<?php echo current_url(); ?>">

        <div class="row mt-3">

            <?php

            foreach ($this->project_tree as $project) { ?>
                <div class="col-md-2">
                    <!-- Text list group -->
                    <div class="card text-center" style="height: 250px !important;">
                        <div class="card-body">
                            <i class="icon-cross2 icon-2x text-success border-success border-3 rounded-round p-2 mb-2"></i>
                            <h6 class="card-title"><a
                                        href="<?php echo base_url(strtolower(str_replace(" ", "_", $project['project']->title))); ?>"><?php echo $project['project']->title; ?></a>
                            </h6>
                            <p class="card-text"
                               style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <?php echo $project['project']->description; ?></p>
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <span class="text-muted">Published Forms</span>
                            <span class="badge badge-dark badge-pill ml-auto">20</span>

                        </div>
                    </div>
                    <!-- /text list group -->
                </div><!--./md-2 -->
            <?php } ?>


            <div class="col-md-2">
                <!-- Text list group -->
                <div class="card text-center">
                    <div class="card-body">
                        <i class="icon-plus2 icon-2x text-success border-success border-3 rounded-round p-2 mb-2"></i>
                        <h6 class="card-title"><a href="<?php echo base_url('project/add'); ?>">Add</a></h6>
                        <p class="card-text">New Project</p>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <span class="text-muted">Add new Project</span>
                    </div>
                </div>
                <!-- /text list group -->

            </div><!--./md-2 -->
        </div>


    </div>
    <!-- /content area -->


    <!-- Footer -->
    <div class="navbar navbar-expand-lg navbar-light">
        <div class="text-center d-lg-none w-100">
            <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse"
                    data-target="#navbar-footer">
                <i class="icon-unfold mr-2"></i>
                Footer
            </button>
        </div>

        <div class="navbar-collapse collapse" id="navbar-footer">
                        <span class="navbar-text">
                            © 2015 - 2018. <a href="#">AfyaData Community Based Surveillance Kit</a> by <a
                                    href="www.sacids.org" target="_blank">SACIDS</a>
                        </span>

            <ul class="navbar-nav ml-lg-auto">
                <li class="nav-item"><a href="https://kopyov.ticksy.com/" class="navbar-nav-link legitRipple"
                                        target="_blank"><i class="icon-lifebuoy mr-2"></i> Support</a></li>
                <li class="nav-item"><a href="http://demo.interface.club/limitless/docs/"
                                        class="navbar-nav-link legitRipple" target="_blank"><i
                                class="icon-file-text2 mr-2"></i> Docs</a></li>
            </ul>
        </div>
    </div>
    <!-- /footer -->

</div>



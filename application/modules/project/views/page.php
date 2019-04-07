<?php
defined('BASEPATH') OR exit('No direct script access allowed');


?>


<div class="content-wrapper" id="ez-detail">

    <!-- Content area -->
    <div class="content pt-0" id="ez_content" surl="<?php echo current_url(); ?>">

        <div class="card mt-3">
            <div class="card-header header-elements-inline">
                <h5 class="card-title"> Manage </h5>

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

                    <li class="nav-item"><a href="#bottom-tab1" class="tab nav-link active legitRipple"
                                            data-toggle="tab"
                                            u="<?= site_url('project/summary/?project_id=' . $this->project) ?>">
                            <i class="icon-ipad mr-2"></i>View</a></li>
                    <?php

                    $dbx_id = uniqid('dbexp');

                    foreach ($tabs as $tab) {

                        $args = http_build_query($tab);
                        $url = (array_key_exists('link', $tab) ? $tab['link'] : 'api/obox/page_not_found');
                        $url .= '?' . $args . '&form_id=' . $dbx_id;
                        $url = site_url($url);
                        $icon = (empty($tab['icon']) ? 'icon-menu7' : $tab['icon']);
                        echo '<li class="nav-item"><a href="#' . $dbx_id . '" class="tab nav-link legitRipple" data-toggle="tab" u="' . $url . '" ><i class="' . $icon . ' mr-2"></i>' . $tab['title'] . '</a></li>';
                    }
                    ?>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="bottom-tab1">
                        <?php
                        //todo : load view automatically
                        ?>
                    </div>
                    <div class="tab-pane fade dbx_wrapper" id="<?php echo $dbx_id; ?>">
                        nothing now
                    </div>

                </div>
            </div>
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
                            © 2008 - 2018. <a href="#">AfyaData</a> by <a href="http://www.sacids.org" target="_blank">SACIDS.ORG</a>
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



<?php
defined('BASEPATH') OR exit('No direct script access allowed');




?>


<div class="content-wrapper" id="ez-detail">

    <!-- Content area -->
    <div class="content pt-0" id="ez_content" surl="<?php echo current_url(); ?>">

        <div class="card mt-3">
            <div class="card-header header-elements-inline">
                <h5 class="card-title"> Form Name </h5>

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

                    <li class="nav-item">
                        <a href="#bottom-tab1" class="nav-link active legitRipple" data-toggle="tab"><i class="icon-ipad mr-2"></i>View</a>
                    </li>
                    <li class="nav-item">
                        <a href="#bottom-tab1" class="nav-link legitRipple" data-toggle="tab"><i class="icon-stack2 mr-2"></i>Data</a>
                    </li>
                    <li class="nav-item">
                        <a href="#bottom-tab1" class="nav-link legitRipple" data-toggle="tab"><i class="icon-map mr-2"></i>Map</a>
                    </li>
                    <li class="nav-item">
                        <a href="#bottom-tab1" class="nav-link legitRipple" data-toggle="tab"><i class="icon-chart mr-2"></i>Charts</a>
                    </li>
                    <li class="nav-item">
                        <a href="#bottom-tab1" class="nav-link legitRipple" data-toggle="tab"><i class="icon-bubbles6 mr-2"></i>Discussion</a>
                    </li>
                    <li class="nav-item">
                        <a href="#bottom-tab1" class="nav-link legitRipple" data-toggle="tab"><i class="icon-link2 mr-2"></i>Mapping</a>
                    </li>
                    <li class="nav-item">
                        <a href="#bottom-tab1" class="nav-link legitRipple" data-toggle="tab"><i class="icon-filter4 mr-2"></i>Filter</a>
                    </li>
                    <li class="nav-item">
                        <a href="#bottom-tab1" class="nav-link legitRipple" data-toggle="tab"><i class="icon-user-lock mr-2"></i>Permissions</a>
                    </li>
                    <li class="nav-item">
                        <a href="#bottom-tab1" class="nav-link legitRipple" data-toggle="tab"><i class="icon-cog3 mr-2"></i>Config</a>
                    </li>


                    <?php
/*
                    $dbx_id = uniqid('dbexp');

                    foreach($tabs as $tab){

                        $args	= http_build_query($tab);
                        $url   = ( array_key_exists('link', $tab) ? $tab['link'] : 'api/obox/page_not_found');
                        $url    .= '?'.$args.'&form_id='.$dbx_id;
                        $url    = site_url($url);
                        $icon   = ( empty($tab['icon']) ? 'icon-menu7' : $tab['icon'] );

                        echo '<li class="nav-item"><a href="#'.$dbx_id.'" class="tab nav-link legitRipple" data-toggle="tab" u="'.$url.'" ><i class="'.$icon.' mr-2"></i>'.$tab['title'].'</a></li>';
                    }*/
                    ?>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="bottom-tab1">
                        <?php

                        //echo 'salama '.print_r($data);
                        /*
                                                foreach($data as $k => $v){

                                                    if ( (array_key_exists ( $k, $conf ) && $conf[$k] ['field_property'] == 'hidden') || substr($k,0,2) == "__" || !array_key_exists ( $k, $conf )) {
                                                        continue; // do not show
                                                    }

                                                    if ( (array_key_exists ( $k, $conf ) && $conf[$k] ['field_property'] == 'upload' )) {

                                                        $file   = FCPATH.'assets/uploads/'.$v;
                                                        $mime = mime_content_type($file);
                                                        if(strstr($mime, "video/")){
                                                            // this code for video
                                                        }else if(strstr($mime, "image/")){
                                                            // this code for image
                                                            $v  = '<a href="'.site_url("/assets/uploads/$v").'" data-popup="lightbox"><img class="img-preview rounded" src="'.site_url("/assets/uploads/$v").'"></a>';

                                                        }else{
                                                            echo '<a href="'.site_url("/assets/uploads/$v").' download></a>';
                                                        }



                                                    }

                                                    if ( (array_key_exists ( $k, $conf ) && substr($conf[$k] ['field_property'],0,3) == 'db_' )) {

                                                        $fv = explode(":",$conf[$k]['field_value']);
                                                        $this->model->set_table($fv[0]);
                                                        $ret = $this->model->as_array()->get_by($fv[1],$v);
                                                        $v  = strtoupper($ret[$fv[2]]);
                                                    }

                                                    echo '<div class="row p-1"><div class="col-1">'.str_replace("_"," ",str_replace("_id","",ucfirst($k))).'</div><div class="col-5">: '.$v.'</div></div>';

                                                }*/
                        ?>
                    </div>
                    <div class="tab-pane fade dbx_wrapper" id="">
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
            <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                <i class="icon-unfold mr-2"></i>
                Footer
            </button>
        </div>

        <div class="navbar-collapse collapse" id="navbar-footer">
                        <span class="navbar-text">
                            © 2015 - 2018. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
                        </span>

            <ul class="navbar-nav ml-lg-auto">
                <li class="nav-item"><a href="https://kopyov.ticksy.com/" class="navbar-nav-link legitRipple" target="_blank"><i class="icon-lifebuoy mr-2"></i> Support</a></li>
                <li class="nav-item"><a href="http://demo.interface.club/limitless/docs/" class="navbar-nav-link legitRipple" target="_blank"><i class="icon-file-text2 mr-2"></i> Docs</a></li>
                <li class="nav-item"><a href="https://themeforest.net/item/limitless-responsive-web-application-kit/13080328?ref=kopyov" class="navbar-nav-link font-weight-semibold legitRipple"><span class="text-pink-400"><i class="icon-cart2 mr-2"></i> Purchase</span></a></li>
            </ul>
        </div>
    </div>
    <!-- /footer -->

</div>



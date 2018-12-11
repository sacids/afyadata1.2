<?php
defined('BASEPATH') OR exit('No direct script access allowed');




?>


<div class="content-wrapper" id="ez-detail">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold"><?php  ?></span> - Manage</h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

            <div class="header-elements d-none text-center text-md-left mb-3 mb-md-0">
                <div class="btn-group">
                    <button type="button" class="btn bg-indigo-400 legitRipple"><i class="icon-stack2 mr-2"></i> Actions </button>
                    <button type="button" class="btn bg-indigo-400 dropdown-toggle legitRipple legitRipple-empty" data-toggle="dropdown"></button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">Export</div>
                        <a href="#" class="dropdown-item"><i class="icon-file-pdf"></i> Export to PDF</a>
                        <a href="#" class="dropdown-item"><i class="icon-file-excel"></i> Export to CSV</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content pt-0" id="ez_content" surl="<?php echo current_url(); ?>">

        <div class="alert alert-primary alert-styled-left alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>

            <?php

            //echo 'sema ';print_r($data);
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
                        // this code for imageech
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

                echo '<div>'.str_replace("_"," ",str_replace("_id","",ucfirst($k))).': '.$v.'</div>';

            }
            ?>

        </div>
        <!-- row start -->
        <div class="row">


        <?php

            $c = 0;

            $ch = curl_init();
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13");
            foreach($tabs as $tab){

               ?>
                <div class="card col m-1">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title"><?php echo $tab['title']; ?></h5>

                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="fullscreen"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div>
                        </div>
                    </div>


                        <?php
                        $url   = ( array_key_exists('link', $tab) ? $tab['link'] : 'api/obox/page_not_found');
                        $icon   = ( empty($tab['icon']) ? 'info' : $tab['icon'] );
                        $args	= http_build_query($tab);
                        $dbx_id = uniqid('dbexp');
                        $url    .= '?'.$args.'&form_id='.$dbx_id;

                        echo '<div id="'.$dbx_id.'" class="dbx_wrapper">';
                        //echo site_url($url);
                        curl_setopt($ch,CURLOPT_URL,site_url($url));
                        $data = curl_exec($ch);
                        //$str = file_get_contents(site_url($url),false,$context);
                        echo $data;
                        echo '</div>';

                        //echo '<iframe id="ez_card_'.$c.'" name="ez_card_'.$c.'" src="'.site_url($url).'" class="card_target"></iframe>';
                        $c++;
                        ?>

                </div>
                <?php

                echo ($c%1 != 0) ? '' : '<div class="w-100"></div>';

            }

            curl_close($ch);

        ?>
        <!-- /navbar classes -->

        </div>
        <!-- /row classes -->

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



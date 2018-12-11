<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


        <!-- Main sidebar -->
        <div class="sidebar sidebar-dark sidebar-main sidebar-fixed sidebar-expand-md">

            <!-- Sidebar mobile toggler -->
            <div class="sidebar-mobile-toggler text-center">
                <a href="#" class="sidebar-mobile-main-toggle">
                    <i class="icon-arrow-left8"></i>
                </a>
                Navigation
                <a href="#" class="sidebar-mobile-expand">
                    <i class="icon-screen-full"></i>
                    <i class="icon-screen-normal"></i>
                </a>
            </div>
            <!-- /sidebar mobile toggler -->


            <!-- Sidebar content -->
            <div class="sidebar-content">


                <!-- User menu -->
                <div class="sidebar-user-material">
                    <div class="sidebar-user-material-body">
                        <div class="card-body text-center">
                            <a href="#">
                                <img src="<?php echo base_url(); ?>vendors/limitless/global_assets/images/placeholders/placeholder.jpg" class="img-fluid rounded-circle shadow-1 mb-3" width="80" height="80" alt="">
                            </a>
                            <h6 class="mb-0 text-white text-shadow-dark"><?php echo $first_name.' '.$last_name; ?></h6>
                            <span class="font-size-sm text-white text-shadow-dark"><?php echo $company ?></span>
                        </div>

                        <div class="sidebar-user-material-footer">
                            <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse"><span>My account</span></a>
                        </div>

                    </div>

                    <div class="collapse" id="user-nav">
                        <ul class="nav nav-sidebar">
                            <li class="nav-item">
                                <a href="<?php echo base_url('ez/1/22/m/'.$this->session->userdata('user_id')); ?>" class="nav-link">
                                    <i class="icon-user-plus"></i>
                                    <span>My profile</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo base_url('auth/logout'); ?>" class="nav-link">
                                    <i class="icon-switch2"></i>
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
                <!-- /user menu -->
                <?php
//echo '<pre>';
//print_r($this->perm_tree);
//exit();
                foreach($this->perm_tree as $k1 => $e1){

                    if($e1['module']->active){
                        $aria_expanded = 'true';
                        $collapsed     = '';
                        $show          = 'show';
                    }else{
                        $aria_expanded = 'false';
                        $collapsed       = 'collapsed';
                        $show           = '';
                    }



                    echo '<div class="sidebar-user-material-footer"><a  href="#mod_'.$k1.'" 
                                class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle '.$collapsed.'" 
                                data-toggle="collapse" aria-expanded="'.$aria_expanded.'"><span>'.$e1['module']->title.'</span></a></div><div class="collapse '.$show.'" id="mod_'.$k1.'"><ul class="nav nav-sidebar">';

                    if(array_key_exists('tasks',$e1)) {

                        foreach ($e1['tasks'] as $k2 => $e2) {

                            $active = $e2->active ? 'active' : '';
                            $t1     = $e2->perm_type == 'table' ? 'l' : 'w';
                            echo '<li class="nav-item"><a href="' . base_url("ez/$k1/$k2/$t1/") . '" class="nav-link '.$active.'"><i class="'.$e2->icon_font.'"></i><span>' . $e2->title . '</span></a>';

                        }
                    }

                    echo '</ul></div>';
                }

                ?>



            </div>     
            <!-- /sidebar content-->
        </div>
        <!-- /sidebar -->



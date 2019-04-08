<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/*
 *
 SELECT c.id, `project_id`, `reference`, c.title, b.first_name, a.title , `status`, c.id FROM `ob_requests` as c,`ob_users` as b,`ob_request_type` as a WHERE a.id = request_type_id and b.id = beneficiary_id AND 1 = 1

$data = self::sql_exec( $db, $bindings,
    "SELECT `".implode("`, `", self::pluck($columns, 'db'))."`
			 FROM `$table`
			 $where
			 $limit"
);
*/

?>


<div class="content-wrapper" id="ez-detail">
    <!-- Page header -->
    <div class="page-header">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold"><?php echo $title; ?></span> - Manage</h4>
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

        <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
                <h6 class="card-title">Task manager</h6>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>
        <table class="table tasks-list table-lg">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Activity description</th>
                    <th>Amount</th>
                    <th>status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
        <?php

            $requests   = array('lpo','imp','clm');
            $count      = 0;
            foreach($requests as $val){

                $q  = "select a.id, a.amount, a.item, b.title, a.status,a.request_id, a.activity_id, b.amount_available from ob_request_$val as a, ob_projects_activities as b WHERE a.activity_id = b.id and b.manager_id = ".$this->user_id." and a.status not in ('approved','closed')";
                $res  = $this->db->query($q);
                //echo '<pre>'.$val; print_r($res->result_array());

                foreach($res->result_array() as $v) {

                    $req_url = base_url('ez/7/14/m/'.$v['request_id']);
                    //$tmp['opt']

                    switch($val){
                        case 'clm': $type = 'Claims'; break;
                        case 'lpo': $type = 'Local Purchase Order'; break;
                        case 'imp': $type = 'Imprest'; break;
                    }

                    switch(strtolower($v['status'])){
                        case 'approved': $status = 'bg-success'; break;
                        case 'hold': $status = 'bg-warning'; break;
                        case 'cancelled': $status = 'bg-danger'; break;
                        case 'staged': $status = 'bg-info'; break;
                        //default: $status = 'bg-secondary'; break;
                    }
                    echo '
                        <tr>
                            <td>'.$v['id'].'</td>
                            <td>'.$type.'</td>
                            <td>
                                <div class="font-weight-semibold">'.$v['item'].'</div>
                                <div class="text-muted">'.$v['title'].'</div>
</td>
                            <td><div>Budgeted: '.$v['amount'].'</div><div>Available: '.$v['amount_available'].'</div></td>
                            <td><div class="badge '.$status.'">'.$v['status'].'</div></td>
                            <td><div>
                            <a href="'.$req_url.'"><i class="icon-chrome"></i></a></div></td>
                        </tr>';

                }
            }

        ?>
            </tbody>
        </table>
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



<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$delperm = ($perm['del'] ? 'dp_y' : 'dp_n');

$th = '';
//$columns    = array(array('db'=>'id','dt'=> 0));
$columns    = array();
$q          = array();
$c          = 0;
$tbl        = 'b';
$f  = array($table_name.' as a'); $w = array(); $s = array();


foreach($field_data as $field){
    $class = '';
    if($c == 1) {
        $c = 2;
        $th .= '<th class="ez-th-act">Action</th>';
        //continue;
    }
    $n  = $field->name;
    if ( array_key_exists ( $n, $conf ) ){

        //echo $n.' - '.$conf[$n] ['field_property'] .'<br>';
        if( $conf[$n] ['field_property']             == 'hidden') continue;

        if( substr($conf[$n] ['field_property'],0,3) == 'db_' and $conf[$n] ['field_property'] <> 'db_multiselect') {

            $fv     = explode(":",$conf[$n]['field_value']);
            array_push($f,$fv[0].' as '.$tbl);
            array_push($s,'`'.$tbl.'`.`'.$fv[2].'` as '.$n);
            array_push($w, 'a.'.$n.' = '.$tbl.'.'.$fv[1]);
            $tbl++;

        }else{
            array_push($s,'`a`.`'.$n.'`');
        }

        if( $conf[$n] ['field_property']             == 'upload'){
            //echo $n.' - '.$c;
            //print_r($conf[$n]);
            $class = 'ez-upl';
        }
    }else{
        array_push($s,'a.'.$n);
    }

    $k  = strtoupper(str_replace("_"," ",str_replace("_id","",$n)));
    array_push($columns, array("db" => $n, 'dt' => $c++));

    $class .= $c == 1 ? ' ez-th-act' : '';
    $th .= '<th class="'.$class.'">'.$k.'</th>';



}

$q['f'] = implode(",", $f);
$q['s'] = implode(",", $s);
$q['w'] = empty($w) ? ' 1 ' : '('.implode(" and ", $w).')';

$q1 = 'SELECT `a`.`id` as id,  '.$q['s'].' FROM '.$q['f'].' WHERE '.$q['w'].' and ('.$cond.')';
//echo $q1;
$q1 = base64_encode($q1);

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

        <!-- Navbar classes -->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">List <?php echo $title; ?> contents</h5>

                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
            </div>

            <div class="table-responsive">
                <table id="ez_table" class="table table-bordered compact <?php echo $delperm; ?>"  >
                    <thead>
                    <tr class="">
                        <?php echo $th; ?>
                    </tr>
                    </thead>
                </table>
                <div id="ez_table_prop"
                    <?php
                        echo " column='".json_encode($columns)."'  cond='".$cond."' tn='".$table_name."' q1='".$q1."'";
                    ?>
                ></div>

                <a href="<?php echo substr(current_url(),0,-1).'a'; ?>" class="btn bg-blue ml-3 mb-3 legitRipple" role="button">Insert new <?php echo $title; ?> <i class="icon-paperplane ml-2"></i></a>
            </div>


        </div>
        <!-- /navbar classes -->


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



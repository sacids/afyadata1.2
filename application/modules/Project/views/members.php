<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

    <?php

        //echo '<pre>'; print_r($members); print_r($project); echo '</pre>';
    ?>



<ul class="media-list">
<?php
if(count($members)) {
    foreach ($members as $member) {

        ?>
        <li class="media">
            <div class="mr-3">
                <a href="#">
                    <img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="rounded-circle"
                         width="40" height="40" alt="">
                </a>
            </div>

            <div class="media-body">
                <div class="media-title font-weight-semibold"><?php echo $member['first_name'] . ' ' . $member['last_name']; ?></div>
                <span class="text-muted"><?php echo $member['username']; ?></span>
            </div>

            <div class="align-self-center ml-3">
                <div class="list-icons">
                    <div class="list-icons-item dropdown">
                        <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"
                           aria-expanded="false"><i class="icon-menu9"></i></a>

                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"
                             style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(22px, 16px, 0px);">
                            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#call"><i
                                        class="icon-phone2"></i> Change Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </li>

        <?php
    }
}else{
    echo 'No members';
}


?>
</ul>
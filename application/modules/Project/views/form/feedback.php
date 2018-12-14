

<script src="<?php echo base_url(); ?>vendors/ez/js/db_exp.js"></script>

<?php
/**
 * Created by PhpStorm.
 * User: Godluck Akyoo
 * Date: 12/12/2018
 * Time: 11:36
 */

echo $this->session->userdata('form_id');
return;

$this->model->set_table('feedback');
$tmp    = array('table_id' => $ele_id, 'table' => $table_name);

$data['data']   = array();
$tmp2   = $this->model->as_array()->get_many_by($tmp);

$this->model->set_table('users');

foreach($tmp2 as $val){

    $user                   = $this->model->as_object()->get($val['created_by']);
    $val['full_name']       = $user->legal_name;
    $val['profile_pic']     = $user->profile_pic;
    $val['time_elapsed']    = $this->time_elapsed_string($val['created_on']);

    array_push($data['data'],$val);
}

?>

<ul class="list-unstyled msg_list">
        <?php

            foreach($data as $comment){
                ?>
                <!-- <li>
                    <div class="block">
                        <h2 class="title">
                            <?php echo $comment['comment']; ?>
                        </h2>
                        <div class="tags">
                            <a href="" class="tag">
                                <span><?php echo $comment['full_name']; ?></span>
                            </a>
                        </div>
                        <div class="block_content">
                            <div class="byline">
                                <span><?php echo $comment['time_elapsed']; ?></span>
                            </div>
                        </div>
                    </div>
                </li> -->
                <li>
                    <a>
                            <span class="image">
                              <img src="<?php echo base_url('assets/obox/images/').($comment['profile_pic'] ? $comment['profile_pic']:'user.png') ?>" alt="img">
                            </span>
                        <span>
                              <span><?php echo $comment['full_name']; ?></span>
                              <span class="time"><?php echo $comment['time_elapsed']; ?></span>
                            </span>
                        <span class="message">
                              <?php echo $comment['comment']; ?>
                            </span>
                    </a>
                </li>
                <?php
            }
        ?>
</ul>


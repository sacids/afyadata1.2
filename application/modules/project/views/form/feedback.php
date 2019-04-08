

<?php
/**
 * Created by PhpStorm.
 * User: Godluck Akyoo
 * Date: 12/12/2018
 * Time: 11:36
 */

echo $this->session->userdata('form_id');
return;

$this->model->set_table('Feedbacks');
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

<ul id="obox_chat_list" class="media-list media-chat media-chat-scrollable mb-3">
    <?php

    foreach($data as $comment) {


        $pic = ($comment['profile_pic'] ? $comment['profile_pic'] : 'placeholder.jpg');

        if($user_id == $comment['created_by']){
            $class  = ' media-chat-item-reverse ';
            $pre_icon   = '<div class="ml-3">';
        }else{
            $class  = '';
            $pre_icon   = '<div class="mr-3">';

        }

        $pre_icon   .= '<a href="'.base_url("assets/uploads/") . $pic.'">
                            <img src="'.base_url("assets/uploads/") . $pic.'"
                                 class="rounded-circle" width="40" height="40" alt="">
                        </a>
                    </div>';

        ?>

        <li class="media <?php echo $class; ?>">

            <?php if($class == '') echo $pre_icon ?>
            <div class="media-body">
                <div class="media-chat-item"><?php echo $comment['comment']; ?></div>
                <div class="font-size-sm text-muted mt-2"><?php echo $comment['time_elapsed']. ' | '. $comment['full_name']; ?><a href="#"><i
                                class="icon-pin-alt ml-2 text-muted"></i></a></div>
            </div>
            <?php if($class != '') echo $pre_icon ?>
        </li>

        <?php
    }
    ?>



</ul>

<textarea id="ref_comment" name="enter-message" class="form-control mb-3" rows="3" cols="1" placeholder="Enter your message..."></textarea>

<div class="d-flex align-items-center">
    <button type="button" id="obox_comment" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-auto legitRipple" ref_data="<?php echo $ref_data; ?>"><b><i class="icon-paperplane"></i></b> Send</button>
</div>


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<?php

    if(count($xforms)) {

            ?>
            <div class="table-responsive">
                <table class="table table-inbox">
                    <tbody data-link="row" class="rowlink">
<?php
        foreach ($xforms as $form) {
            ?>
                    <tr class="unread">
                        <td class="table-inbox-name">
                            <a href="<?php echo base_url($project->title.'/form/'.$form['id']); ?>">
                                <div class="letter-icon-title text-default"><?php echo $form['title'] ?></div>
                                <span class="text-muted font-weight-normal">Created on <?php $form['created_at']; ?></span>
                        </td>
                        </a>
                        </td>
                        <td class="table-inbox-message">
                <span class="table-inbox-subject">
                    <span class="badge bg-indigo-400 mr-2">Order</span>
                    <span class="badge bg-indigo-400 mr-2">Order</span> &nbsp;-&nbsp;</span>
                            <span class="text-muted font-weight-normal"><?php echo $form['description']; ?></span>
                        </td>
                        <td class="table-inbox-time">
                            11:09 pm
                        </td>
                    </tr>
<?php

        }
?>
                    </tbody>
                </table>
            </div>
            <?php
    }else{
        echo 'No form to show';
    }
?>


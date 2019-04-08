<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<?php if (isset($xforms) && $xforms) { ?>
    <div class="table-responsive">
        <table class="table table-inbox">
            <tbody data-link="row" class="rowlink">
            <?php
            foreach ($xforms as $form) {
                ?>
                <tr class="unread">
                    <td width="30%" class="table-inbox-name">
                        <a href="<?php echo base_url($project->title . '/form/' . $form['id']); ?>">
                            <div class="letter-icon-title text-default"><?php echo $form['title'] ?></div>
                            <span class="text-muted font-weight-normal">Created on <?php echo date('jS F, Y', strtotime($form['created_at'])); ?></span>
                        </a>
                    </td>
                    <td width="40%" class="table-inbox-message">
                <span class="table-inbox-subject">
                            <span class="text-muted font-weight-normal"><?php echo $form['description']; ?></span>
                    </td>
                    <td width="10%" class="table-inbox-time">
                        <?php echo date('h.i A', strtotime($form['created_at'])); ?>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php
} else {
    echo 'No form to show';
}
?>


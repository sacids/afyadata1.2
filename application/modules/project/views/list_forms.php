<?php if (isset($xforms) && $xforms) { ?>
    <div class="table-responsive">
        <table class="table table-inbox">
            <tbody data-link="row" class="rowlink">
            <?php
            foreach ($xforms as $form) {
                ?>
                <tr class="unread">
                    <td width="70%" class="table-inbox-name">
                        <a href="<?php echo base_url(str_replace(" ", "_", strtolower($project->title)) . '/form/' . $form['id']); ?>">
                            <div class="letter-icon-title text-default"><?php echo $form['title'] ?></div>
                            <span class="text-muted font-weight-normal"><?php echo $form['description']; ?></span>
                        </a>
                    </td>
                    <td width="20%" class="table-inbox-time">
                        <?php echo date('jS F, Y h.i A', strtotime($form['created_at'])); ?>
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


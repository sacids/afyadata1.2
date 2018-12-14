<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>



<ul class="fab-menu fab-menu-fixed  fab-menu-bottom-right mr-3 mb-5" data-fab-toggle="hover">
    <li>
        <a class="fab-menu-btn btn bg-danger-400 btn-float rounded-round btn-icon">
            <i class="fab-icon-open icon-plus3"></i>
            <i class="fab-icon-close icon-cross2"></i>
        </a>

        <ul class="fab-menu-inner">
            <li>
                <div data-fab-label="Add Project">
                    <a href="<?php echo base_url('project/add'); ?>" class="btn btn-light rounded-round btn-icon btn-float">
                        <i class="icon-cabinet"></i>
                    </a>
                </div>
            </li>
<?php if($this->project != 0){ ?>
            <li>
                <div data-fab-label="Add Member">
                    <a href="#" class="btn btn-light rounded-round btn-icon btn-float">
                        <i class="icon-user-plus"></i>
                    </a>
                </div>
            </li>
            <li>
                <div data-fab-label="Add Group">
                    <a href="#" class="btn btn-light rounded-round btn-icon btn-float">
                        <i class="icon-make-group"></i>
                    </a>
                </div>
            </li>
            <li>
                <div data-fab-label="Add Form">
                    <a href="#" class="btn btn-light rounded-round btn-icon btn-float">
                        <i class="icon-stack-text"></i>
                    </a>
                </div>
            </li>
<?php } ?>
        </ul>
    </li>
</ul>
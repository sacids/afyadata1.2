<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="content">
    <div class="card">
    <div class="card-header bg-white header-elements-inline">
        <h6 class="card-title">Remote content source</h6>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <form class="wizard-form steps-async wizard clearfix" action="#" data-fouc="" role="application" id="steps-uid-1"><div class="steps clearfix"><ul role="tablist"><li role="tab" class="first current" aria-disabled="false" aria-selected="true"><a id="steps-uid-1-t-0" href="#steps-uid-1-h-0" aria-controls="steps-uid-1-p-0" class=""><span class="current-info audible">current step: </span><span class="number">1</span> Personal data</a></li><li role="tab" class="disabled" aria-disabled="true"><a id="steps-uid-1-t-1" href="#steps-uid-1-h-1" aria-controls="steps-uid-1-p-1" class="disabled"><span class="number">2</span> Your education</a></li><li role="tab" class="disabled" aria-disabled="true"><a id="steps-uid-1-t-2" href="#steps-uid-1-h-2" aria-controls="steps-uid-1-p-2" class="disabled"><span class="number">3</span> Your experience</a></li><li role="tab" class="disabled last" aria-disabled="true"><a id="steps-uid-1-t-3" href="#steps-uid-1-h-3" aria-controls="steps-uid-1-p-3" class="disabled"><span class="number">4</span> Additional info</a></li></ul></div><div class="content clearfix">
            <h6 id="steps-uid-1-h-0" tabindex="-1" class="title current">Personal data</h6>
            <fieldset data-mode="async" data-url="../../../../global_assets/demo_data/wizard/personal_data.html" id="steps-uid-1-p-0" role="tabpanel" aria-labelledby="steps-uid-1-h-0" class="body current" aria-hidden="false" aria-busy="true"><div class="card-body text-center"><i class="icon-spinner2 spinner mr-2"></i>  Loading ...</div></fieldset>

            <h6 id="steps-uid-1-h-1" tabindex="-1" class="title">Your education</h6>
            <fieldset data-mode="async" data-url="../../../../global_assets/demo_data/wizard/education.html" id="steps-uid-1-p-1" role="tabpanel" aria-labelledby="steps-uid-1-h-1" class="body" aria-hidden="true" style="display: none;"></fieldset>

            <h6 id="steps-uid-1-h-2" tabindex="-1" class="title">Your experience</h6>
            <fieldset data-mode="async" data-url="../../../../global_assets/demo_data/wizard/experience.html" id="steps-uid-1-p-2" role="tabpanel" aria-labelledby="steps-uid-1-h-2" class="body" aria-hidden="true" style="display: none;"></fieldset>

            <h6 id="steps-uid-1-h-3" tabindex="-1" class="title">Additional info</h6>
            <fieldset data-mode="async" data-url="../../../../global_assets/demo_data/wizard/additional.html" id="steps-uid-1-p-3" role="tabpanel" aria-labelledby="steps-uid-1-h-3" class="body" aria-hidden="true" style="display: none;"></fieldset>
        </div><div class="actions clearfix"><ul role="menu" aria-label="Pagination"><li class="disabled" aria-disabled="true"><a href="#previous" class="btn btn-light disabled legitRipple" role="menuitem"><i class="icon-arrow-left13 mr-2"></i> Previous</a></li><li aria-hidden="false" aria-disabled="false"><a href="#next" class="btn btn-primary legitRipple" role="menuitem">Next <i class="icon-arrow-right14 ml-2"></i></a></li><li aria-hidden="true" style="display: none;"><a href="#finish" class="btn btn-primary legitRipple" role="menuitem">Submit form <i class="icon-arrow-right14 ml-2"></i></a></li></ul></div></form>
</div>
</div>
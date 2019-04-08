<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

        <div class="content-wrapper" id="ez-detail">

            <!-- Page header -->
            <div class="page-header">
                <div class="page-header-content header-elements-md-inline">
                    <div class="page-title d-flex">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Single Navbar</span> - Top Fixed</h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>

                    <div class="header-elements d-none text-center text-md-left mb-3 mb-md-0">
                        <div class="btn-group">
                            <button type="button" class="btn bg-indigo-400 legitRipple"><i class="icon-stack2 mr-2"></i> New report</button>
                            <button type="button" class="btn bg-indigo-400 dropdown-toggle legitRipple legitRipple-empty" data-toggle="dropdown"></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header">Actions</div>
                                <a href="#" class="dropdown-item"><i class="icon-file-eye"></i> View reports</a>
                                <a href="#" class="dropdown-item"><i class="icon-file-plus"></i> Edit reports</a>
                                <a href="#" class="dropdown-item"><i class="icon-file-stats"></i> Statistics</a>
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
            <div class="content pt-0">

                <!-- Info alert -->
                <div class="alert alert-info bg-white alert-styled-left alert-arrow-left alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                    <h6 class="alert-heading font-weight-semibold mb-1">Fixed top navbar</h6>
                    Top <code>fixed</code> navbar is positioned relative to the screen's viewport and doesn't move when scrolled. To use, add <code>.fixed-top</code> class to the <code>.navbar</code> container and <code>.navbar-top</code> class to the <code>&lt;body&gt;</code> container.
                </div>
                <!-- /info alert -->


                <!-- Navbar component -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Navbar component</h5>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <p class="mb-3">Navbar is a navigation component, usually displayed on top of the page and includes brand logo, navigation, notifications, user menu, language switcher and other components. By default, navbar has <code>top static</code> position and is a direct child of <code>&lt;body&gt;</code> container. Navbar toggler appears next to the brand logo on small screens and can be easily adjusted with <code>display</code> utility classes. You can also control responsive collapsing breakpoint directly in the markup. Navbar component is responsive by default and requires <code>.navbar</code> and <code>.navbar-expand{-sm|-md|-lg|-xl}</code> classes.</p>

                        <div class="mb-4">
                            <h6 class="font-weight-semibold">Static navbars</h6>
                            <p class="mb-3">By default, top and bottom navbars have <code>static</code> position and scroll away along with content. This use case doesn't require any additional classes for <code>.navbar</code> and <code>&lt;body&gt;</code> containers, this means navbar appearance depends on its placement: in the template top static navbar is the first direct child of <code>&lt;body&gt;</code> and placed <strong>before</strong> <code>.page-content</code> container, bottom static navbar is placed <strong>after</strong> it.</p>

                            <div class="rounded" style="max-height: 275px; overflow: auto; box-shadow: 0 -1px 0 0 rgba(0,0,0,0.125), 1px 0 0 0 rgba(0,0,0,0.125) inset, -1px 0 0 0 rgba(0,0,0,0.125) inset, 0 1px 0 0 rgba(0,0,0,0.125);">
                                <div class="navbar navbar-dark navbar-expand-xl rounded-top">
                                    <div class="navbar-brand">
                                        <a href="index.html" class="d-inline-block">
                                            <img src="../../../../global_assets/images/logo_light.png" alt="">
                                        </a>
                                    </div>

                                    <div class="d-xl-none">
                                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-demo1-mobile">
                                            <i class="icon-grid3"></i>
                                        </button>
                                    </div>

                                    <div class="navbar-collapse collapse" id="navbar-demo1-mobile">
                                        <ul class="navbar-nav">
                                            <li class="nav-item"><a href="#" class="navbar-nav-link legitRipple">Link</a></li>
                                            <li class="nav-item dropdown">
                                                <a href="#" class="navbar-nav-link dropdown-toggle legitRipple" data-toggle="dropdown">Dropdown</a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item">Action</a>
                                                    <a href="#" class="dropdown-item">Another action</a>
                                                    <a href="#" class="dropdown-item">Something else here</a>
                                                    <a href="#" class="dropdown-item">One more line</a>
                                                </div>
                                            </li>
                                        </ul>

                                        <span class="navbar-text ml-xl-3">
											<span class="badge bg-success">Online</span>
										</span>

                                        <ul class="navbar-nav ml-xl-auto">
                                            <li class="nav-item">
                                                <a href="#" class="navbar-nav-link legitRipple">
                                                    <i class="icon-bell2"></i>
                                                    <span class="d-xl-none ml-2">Notifications</span>
                                                    <span class="badge badge-pill bg-warning-400 ml-auto ml-xl-0">2</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" class="navbar-nav-link legitRipple">
                                                    <i class="icon-bubbles4"></i>
                                                    <span class="d-xl-none ml-2">Messages</span>
                                                </a>
                                            </li>
                                            <li class="nav-item dropdown dropdown-user">
                                                <a href="#" class="navbar-nav-link dropdown-toggle legitRipple" data-toggle="dropdown">
                                                    <img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" alt="">
                                                    <span>Victoria</span>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item">Action</a>
                                                    <a href="#" class="dropdown-item">Another action</a>
                                                    <a href="#" class="dropdown-item">Something else here</a>
                                                    <a href="#" class="dropdown-item">One more line</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="px-3 pt-3 pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="alpha-slate p-1 mb-3"></div>
                                        </div>
                                        <div class="col-4">
                                            <div class="alpha-danger p-2 mb-3"></div>
                                        </div>
                                        <div class="col-8">
                                            <div class="alpha-teal p-2 mb-3"></div>
                                        </div>
                                        <div class="col-8">
                                            <div class="alpha-blue p-1 mb-3"></div>
                                        </div>
                                        <div class="col-4">
                                            <div class="alpha-brown p-1 mb-3"></div>
                                        </div>
                                        <div class="col-3">
                                            <div class="alpha-purple p-2 mb-3"></div>
                                        </div>
                                        <div class="col-6">
                                            <div class="alpha-pink p-2 mb-3"></div>
                                        </div>
                                        <div class="col-3">
                                            <div class="alpha-success p-2 mb-3"></div>
                                        </div>
                                        <div class="col-6">
                                            <div class="alpha-green p-1 mb-3"></div>
                                        </div>
                                        <div class="col-6">
                                            <div class="alpha-primary p-1 mb-3"></div>
                                        </div>
                                        <div class="col-4">
                                            <div class="alpha-info p-2 mb-3"></div>
                                        </div>
                                        <div class="col-8">
                                            <div class="alpha-orange p-2 mb-3"></div>
                                        </div>
                                        <div class="col-8">
                                            <div class="alpha-brown p-1 mb-3"></div>
                                        </div>
                                        <div class="col-4">
                                            <div class="alpha-primary p-1 mb-3"></div>
                                        </div>
                                        <div class="col-7">
                                            <div class="alpha-slate p-2 mb-3"></div>
                                        </div>
                                        <div class="col-3">
                                            <div class="alpha-warning p-2 mb-3"></div>
                                        </div>
                                        <div class="col-2">
                                            <div class="alpha-green p-2 mb-3"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="navbar navbar-expand-xl navbar-light bg-light rounded-bottom" style="border: 1px solid rgba(0,0,0,0.125); border-bottom: 0;">
                                    <div class="text-center d-xl-none w-100">
                                        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-demo2-mobile">
                                            <i class="icon-tree5 mr-2"></i>
                                            Bottom navbar
                                        </button>
                                    </div>

                                    <div class="navbar-collapse collapse" id="navbar-demo2-mobile">
										<span class="navbar-text">
											© 2015 - 2018. <a href="#">Limitless Web App Kit</a>
										</span>

                                        <ul class="navbar-nav ml-xl-auto">
                                            <li class="nav-item"><a href="#" class="navbar-nav-link legitRipple">Help center</a></li>
                                            <li class="nav-item"><a href="#" class="navbar-nav-link legitRipple">Policy</a></li>
                                            <li class="nav-item"><a href="#" class="navbar-nav-link font-weight-semibold legitRipple">Upgrade your account</a></li>
                                            <li class="nav-item dropup">
                                                <a href="#" class="navbar-nav-link dropdown-toggle caret-0 legitRipple" data-toggle="dropdown">
                                                    <i class="icon-share4 d-none d-xl-inline-block"></i>
                                                    <span class="d-xl-none">Share</span>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item"><i class="icon-dribbble3"></i> Dribbble</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-pinterest2"></i> Pinterest</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-github"></i> Github</a>
                                                    <a href="#" class="dropdown-item"><i class="icon-stackoverflow"></i> Stack Overflow</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="font-weight-semibold">Fixed navbars</h6>
                            <p class="mb-3">Fixed navbars use <code>position: fixed</code>, meaning they’re pulled from the normal flow of the DOM and may require custom CSS (e.g., <code>padding-top</code> on the <code>&lt;body&gt;</code>) to prevent overlap with other elements. Thanks to the power of SASS, padding classes are dynamically calculated based on brand and nav link heights. Table below lists all available body and navbar classes.</p>

                            <div class="navbar navbar-dark navbar-expand-xl navbar-static rounded-top">
                                <div class="navbar-brand">
                                    <a href="index.html" class="d-inline-block">
                                        <img src="../../../../global_assets/images/logo_light.png" alt="">
                                    </a>
                                </div>

                                <div class="d-xl-none">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-demo3-mobile">
                                        <i class="icon-grid3"></i>
                                    </button>
                                </div>

                                <div class="navbar-collapse collapse" id="navbar-demo3-mobile">
                                    <ul class="navbar-nav">
                                        <li class="nav-item"><a href="#" class="navbar-nav-link legitRipple">Link</a></li>
                                        <li class="nav-item dropdown">
                                            <a href="#" class="navbar-nav-link dropdown-toggle legitRipple" data-toggle="dropdown">Dropdown</a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item">Action</a>
                                                <a href="#" class="dropdown-item">Another action</a>
                                                <a href="#" class="dropdown-item">Something else here</a>
                                                <a href="#" class="dropdown-item">One more line</a>
                                            </div>
                                        </li>
                                    </ul>

                                    <span class="navbar-text ml-xl-3">
										<span class="badge bg-success">Online</span>
									</span>

                                    <ul class="navbar-nav ml-xl-auto">
                                        <li class="nav-item">
                                            <a href="#" class="navbar-nav-link legitRipple">
                                                <i class="icon-bell2"></i>
                                                <span class="d-xl-none ml-2">Notifications</span>
                                                <span class="badge badge-pill bg-warning-400 ml-auto ml-xl-0">2</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="navbar-nav-link legitRipple">
                                                <i class="icon-bubbles4"></i>
                                                <span class="d-xl-none ml-2">Messages</span>
                                            </a>
                                        </li>
                                        <li class="nav-item dropdown dropdown-user">
                                            <a href="#" class="navbar-nav-link dropdown-toggle legitRipple" data-toggle="dropdown">
                                                <img src="../../../../global_assets/images/placeholders/placeholder.jpg" class="rounded-circle" alt="">
                                                <span>Victoria</span>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item">Action</a>
                                                <a href="#" class="dropdown-item">Another action</a>
                                                <a href="#" class="dropdown-item">Something else here</a>
                                                <a href="#" class="dropdown-item">One more line</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div style="max-height: 230px; overflow: auto; box-shadow: 0 0 0 1px rgba(0,0,0,0.125) inset;">
                                <div class="px-3 pt-3 pb-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="alpha-slate p-1 mb-3"></div>
                                        </div>
                                        <div class="col-4">
                                            <div class="alpha-danger p-2 mb-3"></div>
                                        </div>
                                        <div class="col-8">
                                            <div class="alpha-teal p-2 mb-3"></div>
                                        </div>
                                        <div class="col-8">
                                            <div class="alpha-blue p-1 mb-3"></div>
                                        </div>
                                        <div class="col-4">
                                            <div class="alpha-brown p-1 mb-3"></div>
                                        </div>
                                        <div class="col-3">
                                            <div class="alpha-purple p-2 mb-3"></div>
                                        </div>
                                        <div class="col-6">
                                            <div class="alpha-pink p-2 mb-3"></div>
                                        </div>
                                        <div class="col-3">
                                            <div class="alpha-success p-2 mb-3"></div>
                                        </div>
                                        <div class="col-6">
                                            <div class="alpha-green p-1 mb-3"></div>
                                        </div>
                                        <div class="col-6">
                                            <div class="alpha-primary p-1 mb-3"></div>
                                        </div>
                                        <div class="col-4">
                                            <div class="alpha-info p-2 mb-3"></div>
                                        </div>
                                        <div class="col-8">
                                            <div class="alpha-orange p-2 mb-3"></div>
                                        </div>
                                        <div class="col-8">
                                            <div class="alpha-brown p-1 mb-3"></div>
                                        </div>
                                        <div class="col-4">
                                            <div class="alpha-primary p-1 mb-3"></div>
                                        </div>
                                        <div class="col-7">
                                            <div class="alpha-slate p-2 mb-3"></div>
                                        </div>
                                        <div class="col-3">
                                            <div class="alpha-warning p-2 mb-3"></div>
                                        </div>
                                        <div class="col-2">
                                            <div class="alpha-green p-2 mb-3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="navbar navbar-expand-xl navbar-light bg-light rounded-bottom" style="margin-left: 1px; margin-right: 1px;">
                                <div class="text-center d-xl-none w-100">
                                    <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-demo4-mobile">
                                        <i class="icon-tree5 mr-2"></i>
                                        Bottom navbar
                                    </button>
                                </div>

                                <div class="navbar-collapse collapse" id="navbar-demo4-mobile">
									<span class="navbar-text">
										© 2015 - 2018. <a href="#">Limitless Web App Kit</a>
									</span>

                                    <ul class="navbar-nav ml-xl-auto">
                                        <li class="nav-item"><a href="#" class="navbar-nav-link legitRipple">Help center</a></li>
                                        <li class="nav-item"><a href="#" class="navbar-nav-link legitRipple">Policy</a></li>
                                        <li class="nav-item"><a href="#" class="navbar-nav-link font-weight-semibold legitRipple">Upgrade your account</a></li>
                                        <li class="nav-item dropup">
                                            <a href="#" class="navbar-nav-link dropdown-toggle caret-0 legitRipple" data-toggle="dropdown">
                                                <i class="icon-share4 d-none d-xl-inline-block"></i>
                                                <span class="d-xl-none">Share</span>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item"><i class="icon-dribbble3"></i> Dribbble</a>
                                                <a href="#" class="dropdown-item"><i class="icon-pinterest2"></i> Pinterest</a>
                                                <a href="#" class="dropdown-item"><i class="icon-github"></i> Github</a>
                                                <a href="#" class="dropdown-item"><i class="icon-stackoverflow"></i> Stack Overflow</a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <h6 class="font-weight-semibold">Navbar markup</h6>
                        <p class="mb-3">Navbar markup consists of a set of containers with mandatory and optional classes: <code>.navbar</code> is a wrapper, this class is required for all types of navbars; <code>.navbar-[color]</code> - sets main background color and adjusts content color; <code>.navbar-expand-[breakpoint]</code> - responsible for collapsing navbar content behind the button on small screens; <code>.navbar-component</code> - displays navbar as a stand alone component with borders and rounded corners. See the table below for a full list of classes.</p>

                        <div class="row">
                            <div class="col-md-6">
                                <p class="font-weight-semibold">Static navbar markup:</p>
                                <pre class="mb-3 language-markup code-toolbar" data-line="2, 5"><code class=" language-markup"><span class="token comment">&lt;!-- Document body --&gt;</span>
<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>body</span><span class="token punctuation">&gt;</span></span>

	<span class="token comment">&lt;!-- Main navbar --&gt;</span>
	<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>navbar navbar-dark navbar-expand-md<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>

		<span class="token comment">&lt;!-- Header --&gt;</span>
		<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>navbar-header navbar-dark [...]<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
			<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>navbar-brand navbar-brand-md<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
				...
			<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>

			<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>navbar-brand navbar-brand-xs<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
				...
			<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
		<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
		<span class="token comment">&lt;!-- /header --&gt;</span>


		<span class="token comment">&lt;!-- Mobile toggler --&gt;</span>
		<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>d-md-none<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
			...
		<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
		<span class="token comment">&lt;!-- /mobile toggler --&gt;</span>


		<span class="token comment">&lt;!-- Navbar content --&gt;</span>
		<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>collapse navbar-collapse<span class="token punctuation">"</span></span> <span class="token attr-name">id</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>navbar<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
			...
		<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
		<span class="token comment">&lt;!-- /navbar content --&gt;</span>

	<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
	<span class="token comment">&lt;!-- /main navbar --&gt;</span>

<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>body</span><span class="token punctuation">&gt;</span></span>
<span class="token comment">&lt;!-- /document body --&gt;</span>
<div aria-hidden="true" class=" line-highlight" data-start="2" style="top: 18px;">
</div><div aria-hidden="true" class=" line-highlight" data-start="5" style="top: 72px;">
</div></code><div class="toolbar"><div class="toolbar-item"><span>Markup</span></div></div></pre>
                            </div>

                            <div class="col-md-6">
                                <p class="font-weight-semibold">Fixed navbar markup:</p>
                                <pre class="mb-3 language-markup code-toolbar" data-line="2, 5"><code class=" language-markup"><span class="token comment">&lt;!-- Document body --&gt;</span>
<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>body</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>navbar-top<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>

	<span class="token comment">&lt;!-- Main navbar --&gt;</span>
	<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>navbar navbar-dark navbar-expand-md fixed-top<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>

		<span class="token comment">&lt;!-- Header --&gt;</span>
		<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>navbar-header navbar-dark [...]<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
			<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>navbar-brand navbar-brand-md<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
				...
			<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>

			<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>navbar-brand navbar-brand-xs<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
				...
			<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
		<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
		<span class="token comment">&lt;!-- /header --&gt;</span>


		<span class="token comment">&lt;!-- Mobile toggler --&gt;</span>
		<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>d-md-none<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
			...
		<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
		<span class="token comment">&lt;!-- /mobile toggler --&gt;</span>


		<span class="token comment">&lt;!-- Navbar content --&gt;</span>
		<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>collapse navbar-collapse<span class="token punctuation">"</span></span> <span class="token attr-name">id</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>navbar<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
			...
		<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
		<span class="token comment">&lt;!-- /navbar content --&gt;</span>

	<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
	<span class="token comment">&lt;!-- /main navbar --&gt;</span>

<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>body</span><span class="token punctuation">&gt;</span></span>
<span class="token comment">&lt;!-- /document body --&gt;</span>
<div aria-hidden="true" class=" line-highlight" data-start="2" style="top: 18px;">
</div><div aria-hidden="true" class=" line-highlight" data-start="5" style="top: 72px;">
</div></code><div class="toolbar"><div class="toolbar-item"><span>Markup</span></div></div></pre>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /navbar component -->


                <!-- Navbar classes -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Navbar classes</h5>

                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        Navbar is a complex, but very flexible component. It supports different types of content, responsive utilities manage content appearance and spacing on various screen sizes, supports multiple sizing and color options etc. And everything can be changed on-the-fly directly in HTML markup. If you can't find an option you need, you can always extend default SCSS code. Table below demonstrates all available classes that can be used within the navbar:
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 20%;">Class</th>
                                <th style="width: 20%;">Type</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><code>.navbar</code></td>
                                <td><span class="text-muted">Required</span></td>
                                <td>Default navbar class, must be used with any navbar type and color. Responsible for basic navbar and navbar components styling as a parent container.</td>
                            </tr>
                            <tr>
                                <td><code>.navbar-light</code></td>
                                <td><span class="text-muted">Required</span></td>
                                <td>This class is used for <code>dark</code> background colors - default dark color is set in <code>$navbar-light-bg</code> variable, feel free to adjust the color according to your needs.</td>
                            </tr>
                            <tr>
                                <td><code>.navbar-light.alpha-*</code></td>
                                <td><span class="text-muted">Optional</span></td>
                                <td>Combination of these classes allows you to set custom <strong>light</strong> color to the <code>light</code> navbar. Note - <code>.navbar-light</code> is required, it's responsible for correct content styling.</td>
                            </tr>
                            <tr>
                                <td><code>.navbar-dark</code></td>
                                <td><span class="text-muted">Required</span></td>
                                <td>This class is used for <code>dark</code> background colors - default dark color is set in <code>$navbar-dark-bg</code> variable, feel free to adjust the color according to your needs.</td>
                            </tr>
                            <tr>
                                <td><code>.navbar-dark.bg-*</code></td>
                                <td><span class="text-muted">Optional</span></td>
                                <td>Combination of these classes allows you to set custom <strong>dark</strong> color to the <code>dark</code> navbar. Note - <code>.navbar-dark</code> is required, it's responsible for correct content styling.</td>
                            </tr>
                            <tr>
                                <td><code>.navbar-expand-[breakpoint]</code></td>
                                <td><span class="text-muted">Optional</span></td>
                                <td>For navbars that never collapse, add the <code>.navbar-expand</code> class on the navbar. For navbars that always collapse, don’t add any <code>.navbar-expand</code> class. Otherwise use this class to change when navbar content collapses behind a button.</td>
                            </tr>
                            <tr>
                                <td><code>.navbar-header</code></td>
                                <td><span class="text-muted">Optional</span></td>
                                <td>Navbar brand wrapper. This class is responsible for navbar logo section with custom background color. Must contain children <code>.navbar-brand</code> container(s).</td>
                            </tr>
                            <tr>
                                <td><code>.navbar-brand</code></td>
                                <td><span class="text-muted">Required</span></td>
                                <td>Class for logo container. It can be applied to most elements, but an anchor works best as some elements might require utility classes or custom styles</td>
                            </tr>
                            <tr>
                                <td><code>.navbar-brand-[md, xs]</code></td>
                                <td><span class="text-muted">Required</span></td>
                                <td>These classes toggle logos - <code>xs</code> is hidden by default and is visible if main sidebar is collapsed, <code>md</code> is visible by default and is hidden when main sidebar is expanded</td>
                            </tr>
                            <tr>
                            </tr><tr>
                                <td><code>.navbar-toggler</code></td>
                                <td><span class="text-muted">Required</span></td>
                                <td>This class needs to be added to the navbar toggle button that toggles navbar content on small screens. Always used with visibility utility classes.</td>
                            </tr>
                            <tr>
                                <td><code>.navbar-collapse</code></td>
                                <td><span class="text-muted">Required</span></td>
                                <td>Groups and hides navbar contents by a parent breakpoint. Requires an ID for targeting collapsible container when sidebar content is collapsed.</td>
                            </tr>
                            <tr>
                                <td><code>.navbar-nav</code></td>
                                <td><span class="text-muted">Required</span></td>
                                <td>Responsive navigation container class that adds default styling for navbar navigation.</td>
                            </tr>
                            <tr>
                                <td><code>.nav-item</code></td>
                                <td><span class="text-muted">Required</span></td>
                                <td>Wrapper class for immediate parents of all navigation links. Responsible for correct styling of nav items</td>
                            </tr>
                            <tr>
                                <td><code>.navbar-nav-link</code></td>
                                <td><span class="text-muted">Required</span></td>
                                <td>Custom class for links within <code>.navbar-nav</code> list, it sets proper styling for links in light and dark navbars.</td>
                            </tr>
                            <tr>
                                <td><code>.navbar-text</code></td>
                                <td><span class="text-muted">Required</span></td>
                                <td>This class adjusts vertical alignment and horizontal spacing for strings of text</td>
                            </tr>
                            <tr>
                                <td><code>.navbar-component</code></td>
                                <td><span class="text-muted">Optional</span></td>
                                <td>Display navbar as a stand alone component, with border and rounded corners.</td>
                            </tr>
                            <tr>
                                <td><code>.fixed-top</code></td>
                                <td><span class="text-muted">Optional</span></td>
                                <td>Makes navbar sticked to the <code>top</code> of the page. Requires proper class for <code>&lt;body&gt;</code> container, see the table below.</td>
                            </tr>
                            <tr>
                                <td><code>.fixed-bottom</code></td>
                                <td><span class="text-muted">Optional</span></td>
                                <td>Makes navbar sticked to the <code>bottom</code> of the page. Requires proper class for <code>&lt;body&gt;</code> container, see the table below.</td>
                            </tr>
                            <tr>
                                <td><code>.sticky-top</code></td>
                                <td><span class="text-muted">Optional</span></td>
                                <td>Adds <code>position: sticky;</code> to the navbar - it's treated as relatively positioned until its containing block crosses a specified threshold, at which point it is treated as fixed. Support is limited.</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /navbar classes -->


                <!-- Body classes -->
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title">Body classes</h5>
                        <div class="header-elements">
                            <div class="list-icons">
                                <a class="list-icons-item" data-action="collapse"></a>
                                <a class="list-icons-item" data-action="reload"></a>
                                <a class="list-icons-item" data-action="remove"></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        If you want to place navbar in non-static positions, you can choose from fixed to the top, fixed to the bottom, or stickied to the top (scrolls with the page until it reaches the top, then stays there). Fixed navbars use <code>position: fixed</code>, meaning they’re pulled from the normal flow of the DOM and require custom classes added to the <code>&lt;body&gt;</code> container to prevent overlap with other elements. The following table demonstrates the list of classes for <code>&lt;body&gt;</code> container if navbar has non-static position:
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 20%;">Class</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><code>.navbar-top</code></td>
                                <td>This class adds <code>top</code> padding to the <code>&lt;body&gt;</code> container. Works only with default navbar height. If another height is specified, apply another class (see the line below).</td>
                            </tr>
                            <tr>
                                <td><code>.navbar-bottom</code></td>
                                <td>This class adds <code>bottom</code> padding to the <code>&lt;body&gt;</code> container. Works only with default navbar height. If another height is specified, apply another class (see the line below).</td>
                            </tr>
                            <tr>
                                <td><code>.navbar-top-[size]</code></td>
                                <td>Controls <code>top</code> spacing of <code>&lt;body&gt;</code> container, if navbar has optional height. Available sizes: small (<code>*-sm</code>) and large (<code>*-lg</code>). Default navbar requires <code>.navbar-top</code> class only.</td>
                            </tr>
                            <tr>
                                <td><code>.navbar-bottom-[size]</code></td>
                                <td>Controls <code>bottom</code> spacing of <code>&lt;body&gt;</code> container, if navbar has optional height. Available sizes: small (<code>*-sm</code>) and large (<code>*-lg</code>). Default navbar requires <code>.navbar-bottom</code> class only.</td>
                            </tr>
                            <tr>
                                <td><code>.navbar-top-[size]-[size]</code></td>
                                <td>Use these classes if the layout has multiple <code>top</code> navbars, where first <code>[size]</code> is the size of the first navbar, second <code>[size]</code> - height of the second navbar. In this particular use case, <code>[size]</code> can be: <code>lg</code> if large height, <code>md</code> is default height <code>sm</code> is small height.
                                </td></tr>
                            <tr>
                                <td><code>.navbar-bottom-[size]-[size]</code></td>
                                <td>Use these classes if the layout has multiple <code>bottom</code> navbars, where first <code>[size]</code> is the size of the first navbar, second <code>[size]</code> - height of the second navbar. In this particular use case, <code>[size]</code> can be: <code>lg</code> if large height, <code>md</code> is default height <code>sm</code> is small height.
                                </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /body classes -->

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



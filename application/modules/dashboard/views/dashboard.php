<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<?php $this->load->view('header'); ?>

<head>
    <title><?php echo $title; ?></title>
</head>
    
<body class = "flat-back">

<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade in page-without-sidebar page-header-fixed">
    <!-- begin #header -->
    <div id="header" class="header navbar navbar-default navbar-fixed-top">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <!-- begin mobile sidebar expand / collapse button -->
            <div class="navbar-header">
                <a href="<?php echo current_url(); ?>" class="navbar-brand"><span class="navbar-logo"></span> EZ Online Pay</a>
                <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- end mobile sidebar expand / collapse button -->
            
            <!-- begin header navigation right -->
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <form class="navbar-form full-width">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter keyword" />
                                <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
                            <i class="fa fa-bell-o"></i>
                        </a>
                        <ul class="dropdown-menu media-list pull-right animated fadeInDown">
                            <li class="dropdown-header">Notifications</li>
                        </ul>
                    </li>
                    <li class="dropdown navbar-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="assets/img/user-13.jpg" alt="" /> 
                            <span class="hidden-xs"><?php echo $username; ?></span> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu animated fadeInLeft">
                            <li class="arrow"></li>
                            <li><a href="javascript:;">Edit Profile</a></li>
                            <li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li>
                            <li><a href="javascript:;">Calendar</a></li>
                            <li><a href="javascript:;">Setting</a></li>
                            <li class="divider"></li>
                            <li><a href="javascript:;">Log Out</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- end header navigation right -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end #header -->
    
    <!-- begin #sidebar -->
        <div id="sidebar" class="sidebar">
            <!-- begin sidebar scrollbar -->
            <div data-scrollbar="true" data-height="100%">
                <!-- begin sidebar user -->
                <ul class="nav">
                    <li class="nav-profile">
                        <div class="image">
                            <a href="javascript:;"><img src="assets/img/user-13.jpg" alt="" /></a>
                        </div>
                        <div class="info">
                            <?php echo $username; ?>
                            <small>Role goes here</small>
                        </div>
                    </li>
                </ul>
                <!-- end sidebar user -->
                <!-- begin sidebar nav -->
                <ul class="nav">
                    
                    <li class="nav-header">Navigation</li>
                    <li class="active">
                        <a href="javascript:;">
                            <i class="fa fa-laptop"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <li class="has-sub">
                        <a href="search">
                            <i class="fa fa-search"></i>
                            <span>Search</span>
                        </a>
                    </li>
                    
                    <li class="has-sub">
                        <a href="javascript:;">
                            <i class="fa fa-shopping-cart"></i>
                            <span>NPC</span>
                        </a>
                    </li>
                    
                    <li class="has-sub">
                        <a href="javascript:;">
                            <i class="fa fa-paypal"></i>
                            <span>Payment</span>
                        </a>
                    </li>                    

                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <i class="fa fa-file-o"></i>
                            <span>Payment Forms</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="virtualterminal">Virtual Terminal</a></li>
                            <li><a href="guestform">Guest Form</a></li>
                        </ul>
                    </li>
                    
                    <li class="has-sub">
                        <a href="robvincentform">
                            <i class="fa fa-gift"></i>
                            <span>Donate <span class="label label-theme m-l-5">NEW</span></span>
                        </a>
                    </li>

                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <i class="fa fa-cogs"></i>
                            <span>Settings</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="page_blank.html">Blank Page</a></li>
                            <li><a href="page_with_footer.html">Page with Footer</a></li>
                            <li><a href="page_without_sidebar.html">Page without Sidebar</a></li>
                            <li><a href="page_with_right_sidebar.html">Page with Right Sidebar</a></li>
                            <li><a href="page_with_minified_sidebar.html">Page with Minified Sidebar</a></li>
                            <li><a href="page_with_two_sidebar.html">Page with Two Sidebar</a></li>
                            <li><a href="page_with_line_icons.html">Page with Line Icons</a></li>
                            <li><a href="page_with_ionicons.html">Page with Ionicons</a></li>
                            <li><a href="page_full_height.html">Full Height Content</a></li>
                            <li><a href="page_with_wide_sidebar.html">Page with Wide Sidebar <i class="fa fa-paper-plane text-theme"></i></a></li>
                            <li><a href="page_with_light_sidebar.html">Page with Light Sidebar <i class="fa fa-paper-plane text-theme"></i></a></li>
                            <li><a href="page_with_mega_menu.html">Page with Mega Menu <i class="fa fa-paper-plane text-theme"></i></a></li>
                        </ul>
                    </li>   
                 
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <i class="fa fa-key"></i>
                            <span>Security</span> 
                        </a>
                        <ul class="sub-menu">
                            <li><a href="security/auth/cancel_account">Cancel Account</a></li>
                            <li><a href="security/auth/change_password">Change Password</a></li>
                            <li><a href="security/auth/forgot_password">Forgot Password</a></li>
                        </ul>
                    </li>
                    
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <i class="fa fa-cubes"></i>
                            <span>Back End</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="security/auth/custom_permissions">Custom Permissions</a></li>
                            <li><a href="security/auth/roles">Roles</a></li>
                            <li><a href="security/auth/unactivated_users">Unactivated Users</a></li>
                            <li><a href="security/auth/uri_permissions">URI Permissions</a></li>
                            <li><a href="security/auth/users">Users</a></li>
                        </ul>
                    </li>
                    
                    <li class="has-sub">
                        <a href="javascript:;">
                            <i class="fa fa-medkit"></i>
                            <span>Help</span>
                        </a>
                    </li>
                    
                    <li class="has-sub">
                        <a href="javascript:;">
                            <i class="fa fa-info-circle"></i>
                            <span>About</span>
                        </a>
                    </li>
                    
                    <li class="has-sub">
                        <a href="javascript:;">
                            <i class="fa fa-power-off"></i>
                            <span>Log Out</span>
                        </a>
                    </li>
                    
                    <!-- begin sidebar minify button -->
                    <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
                    <!-- end sidebar minify button -->
                </ul>
                <!-- end sidebar nav -->
            </div>
            <!-- end sidebar scrollbar -->
        </div>
        <div class="sidebar-bg"></div>
        <!-- end #sidebar -->
    
    <!-- begin #content -->
    <div id="content" class="content">
    
    
    <!-- end #content -->

    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->

</div>    
<!-- end page container -->

</body>

<?php $this->load->view('footer'); ?>

</html>
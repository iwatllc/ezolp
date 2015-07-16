<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<?php $this->load->view('header'); ?>


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<head>
    <title><?php echo 'EZOLP | URI Permissions'; ?></title>
</head>
    
<body class = "flat-back">

<?php echo form_open($this->uri->uri_string()); ?>
<?php echo $this->dx_auth->get_auth_error(); ?>

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
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end #header -->
    
    
    <!-- begin #content -->
    <div id="content" class="content">

        <!-- begin col-12 -->
        <div class="col-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" >
                <div class="panel-heading">
                    <h4 class="panel-title">MANAGE URI PERMISSIONS</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-9">
                        <div class="form-inline">
                            <?php
                                $show = array(
                                    'name' => 'show',
                                    'id' => 'show',
                                    'value' => 'Show URI Permissions',
                                    'class' => 'btn btn-sm btn-success'  
                                );
                                // Build drop down menu
                                foreach ($roles as $role)
                                {
                                    $options[$role->id] = $role->name;
                                }
                        
                                // Change allowed uri to string to be inserted in text area
                                if ( ! empty($allowed_uris))
                                {
                                    $allowed_uris = implode("\n", $allowed_uris);
                                }
                                
                                // Build form
                                echo form_open($this->uri->uri_string());
                                
                                echo form_label('Role', 'role_name_label');
                                echo form_dropdown('role', $options); 
                                echo form_submit($show); 
                                
                                echo form_label('', 'uri_label');
                                        
                                echo '<hr/>';
                                        
                                echo 'Allowed URI (One URI per line) :<br/><br/>';
                                
                                echo "Input '/' to allow role access all URI.<br/>";
                                echo "Input '/controller/' to allow role access controller and it's function.<br/>";
                                echo "Input '/controller/function/' to allow role access controller/function only.<br/><br/>";
                                echo 'These rules only have effect if you use check_uri_permissions() in your controller<br/><br/>.';
                                
                                echo form_textarea('allowed_uris', $allowed_uris); 
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9">
                            <?php
                                $save = array(
                                    'name' => 'save',
                                    'id' => 'save',
                                    'value' => 'Save URI Permissions',
                                    'class' => 'btn btn-sm btn-success'  
                                );
                           
                                echo '<br/>';
                                echo form_submit($save);
        
                                echo form_close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    <!-- end #content -->

    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->

</div>    
<!-- end page container -->

</body>

<?php $this->load->view('footer'); ?>

</html>
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
    <title><?php echo 'EZOLP | Custom Permissions'; ?></title>
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
                    <h4 class="panel-title">MANAGE ROLES</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-9">
                        <div class="form-inline">
                            <?php
                                $role_name = array(
                                    'name'  => 'role_name',
                                    'id' => 'role_name',
                                    'class' => 'form-control'
                                );
                                
                                $add = array(
                                    'name'  => 'add',
                                    'id'    => 'add',
                                    'value' => 'Add role',
                                    'class' => 'btn btn-sm btn-success'
                                );
                                
                                $delete = array(
                                    'name'  => 'delete',
                                    'id'    => 'delete',
                                    'value' => 'Delete selected role',
                                    'class' => 'btn btn-sm btn-success'
                                );
                                
                                // Show error
                                echo validation_errors();
                                
                                // Build drop down menu
                                $options[0] = 'None';
                                foreach ($roles as $role)
                                {
                                    $options[$role->id] = $role->name;
                                }
                            
                                // Build table
                                $this->table->set_heading('', 'ID', 'Name', 'Parent ID');
                                
                                foreach ($roles as $role)
                                {           
                                    $this->table->add_row(form_checkbox('checkbox_'.$role->id, $role->id), $role->id, $role->name, $role->parent_id);
                                }
                                
                                // Build form
                                echo form_open($this->uri->uri_string());
                                
                                echo form_label('Role parent', 'role_parent_label');
                                echo form_dropdown('role_parent', $options); 
                                        
                                echo form_label('Role name', 'role_name_label');
                                echo form_input($role_name); 
                                
                                echo form_submit($add); 
                                echo form_submit($delete);
                                        
                                echo '<hr/>';
                                
                                // Show table
                                echo $this->table->generate(); 
                                
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
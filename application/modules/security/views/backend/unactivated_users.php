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
    <title><?php echo 'EZOLP | Unactivated Users'; ?></title>
</head>
    
<body class = "flat-back">

<?php echo form_open($this->uri->uri_string()); ?>
<?php echo $this->dx_auth->get_auth_error(); ?>

<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

    <!-- begin #content -->
    <div id="content" class="content">

        <!-- begin col-12 -->
        <div class="col-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" >
                <div class="panel-heading">
                    <h4 class="panel-title">MANAGE UNACTIVATED USERS</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-9">
                        <div class="form-inline">
                            <?php               
                                // Show error
                                echo validation_errors();
                                
                                // Table view options
                                $tmpl = array ( 'table_open' => '<table border="1" cellpadding="2" cellspacing="1" style="width:100%; border-collapse: separate;"' );
                                $this->table->set_template($tmpl);
                                
                                $this->table->set_heading('', 'Username', 'Email', 'Register IP', 'Activation Key', 'Created');
                                
                                foreach ($users as $user) 
                                {
                                    $this->table->add_row(
                                        form_checkbox('checkbox_'.$user->id, $user->username).form_hidden('key_'.$user->id, $user->activation_key),
                                        $user->username, 
                                        $user->email, 
                                        $user->last_ip,                 
                                        $user->activation_key, 
                                        date('Y-m-d', strtotime($user->created)));
                                }
                                
                                echo form_open($this->uri->uri_string());
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9">
                            <?php
                                $activate = array(
                                    'name' => 'activate',
                                    'id' => 'activate',
                                    'value' => 'Activate User',
                                    'class' => 'btn btn-sm btn-success'  
                                );
                            
                                echo form_submit($activate);
                                
                                echo '<hr/>';
                                
                                echo $this->table->generate(); 
                                
                                echo form_close();
                                
                                echo $pagination;
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
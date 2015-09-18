<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'placeholder' => 'Username or Email',
	'class' => 'form-control',
	'maxlength'	=> 80,
	'size'	=> 30,
	'value' => set_value('login')
);

$reset = array(
    'name'  => 'reset',
    'id'    => 'reset',
    'value' => 'Reset Now',
    'class' => 'btn btn-sm btn-success'
);

?>

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
    <title><?php echo 'EZOLP | Forgot Password'; ?></title>
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
                    <h4 class="panel-title">FORGOT PASSWORD</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-9">
                        <div class="form-inline">
                            <div class="control-label"
                                <?php echo form_label('Enter your Username or Email Address', $login['id']);?>
                            </div>
                            <?php echo form_input($login); ?> 
                            <?php echo form_error($login['name']); ?>
                        </div>
                    </div>
                    
                    <br/>
                    
                    <div class="form-group">
                        <div class="col-md-9">
                            <?php echo form_submit($reset); ?>                                        
                            <?php echo form_close(); ?>
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
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<?php $this->load->view('navbar'); ?>

<head>
    <title><?php echo $title; ?></title>
</head>
    
<body class = "flat-back">
    <div id="content" class="content">
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-12">

                <!-- begin panel -->
                    <div class="panel panel-inverse" >
                        <div class="panel-heading">
                            <h4 class="panel-title">CHANGE STATUS</h4>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-9">
                                    <div class="form-inline">

                                        Status: <?php echo $status ?>
                                        <br><br>

                                        <?php if ($status == 'pending') { ?>
                                            <strong>'Auth Only' transactions that are awaiting capture.</strong>
                                        <?php } elseif ($status == 'pendingsettlement') { ?>
                                            <strong>This transaction is awaiting settlement.</strong>
                                            <br><br>
                                            <a href="<?php echo base_url(); ?>void/Void/index/<?php echo $paymentresponseid ?>" >
                                                <span>Click Here to void the transaction</span>
                                            </a>
                                        <?php } elseif ($status == 'failed') { ?>
                                            <strong>This transaction has failed.</strong>
                                        <?php } elseif ($status == 'canceled') { ?>
                                            <strong>This transaction has been voided.</strong>
                                        <?php } elseif ($status == 'complete') { ?>
                                            <strong>This transaction has settled.</strong>
                                            <br><br>
                                            <a href="<?php echo base_url(); ?>refund/Refund/index/<?php echo $paymentresponseid ?>" >
                                                <span>Click Here to process a refund for the transaction</span>
                                            </a>
                                        <?php } elseif ($status == 'unknown') { ?>
                                            <strong>An unknown error was encountered while processing this transaction.</strong>
                                        <?php } ?>

                                    </div>
                            </div>
                        </div>
                    </div>   
            </div>
        </div>
    </div>


<!-- end page container -->

</body>

<?php $this->load->view('footer'); ?>

</html>
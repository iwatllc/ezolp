<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8">
<![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

    <?php $this->load->view('header'); ?>

    <body class="flat-black receipt-print">


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
            <!-- begin page-header -->
            <h1 class="page-header"><?php echo $page_data['heading'];?></h1>
            <!-- end page-header -->
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-12">
                    <?php
                        $approved = $result_data['IsApproved'];
                        $responseHTML = $result_data['ResponseHTML'];
                        $responseCODE = $result_data['ReturnCode'];

                        if ($approved == 1)
                        {
                            $approved = TRUE;
                        } else {
                            $approved = FALSE;
                        }

                        if (isset($approved) && $approved === TRUE)
                        {
                            ?>
                            <div class='success'>
                            Payment Successfully Processed!
                            </div>
                            <br>
                            Payment Reciept
                            </br>
                            </br>
                            <b>Reciept #:</b> <?php echo $result_data['OrderNumber']; ?>
                            </br></br>
                            <b>Date:</b> <?php echo $result_data['UpdateDate']; ?>
                            </br></br>
                            <b>Amount:</b> <?php echo $submitted_data['amount']; ?>
                            </br></br>
                            <b>Card Ending: ************</b><?php echo $submitted_data['cclast4']; ?>
                            </br></br>
                            <b>Card Holder:</b> <?php echo $submitted_data['name']; ?>
                            </br></br>
                            <b>Address:</b></br>
                            <?php echo $submitted_data['streetaddress']; ?></br>
                            <?php echo $submitted_data['city']; ?>&nbsp;<?php echo $submitted_data['state']; ?>&nbsp;<?php echo $submitted_data['zip']; ?>
                            </br><br></br>
                            <b>Signature:</b>
                            </br></br></br></br>
                             __________________________________________________


                            <?php
                        }
                        else
                        {
                            ?>
                            <div style='color: #FF0000; font-weight: bold;' />
                            There was an error processing this transaction.
                            </div>
                            <br/>
                            <div style='font-weight: bold;'>
                            Here is the SkipJack response for further details as to possibly why there was a failure:
                            </div>
                            <br/>
                            <br/>
                            <?php echo $responseHTML; ?>
                            <br/>
                            <?php
                        }

                        echo "<div style='font-weight: bold;'>";
                        if (isset($response)){
                            // echo $respones;
                        };
                        echo "</div>";
                    ?>
                </div>
            </div>
        </div>
        <!-- end #content -->
    <?php
        echo anchor('guestform/', 'PROCESS ANOTHER CARD', array('class' => 'btn btn-primary btn-lg m-r-5 dontprint'));
    ?>

    <a href="javascript:window.print()" class="btn btn-primary btn-lg m-r-5 dontprint">PRINT RECEIPT</a>

    </div>
    <!-- end page container -->

    </body>
</html>
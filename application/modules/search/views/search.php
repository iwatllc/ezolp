<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style>
    table, th, td {
        border-collapse: separate;
        border-spacing:5em;
    }
    th, td {
        padding: 5px;
    }
</style>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<?php $this->load->view('header'); ?>

<!-- begin tablesorter -->
<script type="text/javascript" src="/path/to/jquery-latest.js"></script> 
<script type="text/javascript" src="/path/to/jquery.tablesorter.js"></script>
<script>
    $(document).ready(function() 
        { 
            $("#myTable").tablesorter(); 
        } 
    );
</script>
<!-- end tablesorter -->


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    $( document ).ready(function() {
        $( "#datepicker" ).datepicker({defaultDate: null});
        $( "#datepicker2" ).datepicker({defaultDate: null});
    });
</script>

<head>
    <title><?php echo $title; ?></title>
</head>
    
<body class = "flat-back">

<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->


    
    
    <!-- begin #content -->
    <div id="content" class="content">
    
    
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-12">
                <?php $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'searchform'); ?>
                <?php echo form_open('search/execute_search'); ?>
                <!-- begin panel -->
                    <div class="panel panel-inverse" >
                        <div class="panel-heading">
                            <h4 class="panel-title">SEARCH TRANSACTIONS</h4>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-9">
                                    <div class="form-inline">
                                        <table style="width:100%; border-collapse: separate; border-spacing:1em;">
                                            
                                            <tr>
                                                <td>
                                                        <label>Transaction ID</label>
                                                        <?php echo form_input(array('name'=>'PaymentTransactionId', 'placeholder'=>'ID', 'class'=>'form-control')); ?>
                                                </td>

                                                <td>
                                                        <label>Transaction Begin Date</label>
                                                        <?php echo form_input(array('name'=>'BegDate', 'placeholder'=>'Begin Date', 'class'=>'form-control', 'id'=>'datepicker')); ?>
                                                </td>
                                                
                                                <td>
                                                        <label>Transaction End Date</label>
                                                        <?php echo form_input(array('name'=>'EndDate', 'placeholder'=>'End Date', 'class'=>'form-control', 'id'=>'datepicker2')); ?>
                                                </td>

                                                <td>
                                                        <label>Payment Source</label>
                                                        <?php echo form_input(array('name'=>'PaymentSource', 'placeholder'=>'Payment Source', 'class'=>'form-control')); ?>
                                                </td>

                                                <td>
                                                        <label>Transaction Amount</label>
                                                        <?php echo form_input(array('name'=>'TransactionAmount', 'placeholder'=>'Transaction Amount', 'class'=>'form-control')); ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                        <label>Approval Code</label>
                                                        <?php echo form_input(array('name'=>'AuthCode', 'placeholder'=>'Approval Code', 'class'=>'form-control')); ?>
                                                </td>

                                                <td>
                                                        <label>Order Number</label>
                                                        <?php echo form_input(array('name'=>'OrderNumber', 'placeholder'=>'Order Number', 'class'=>'form-control')); ?>
                                                </td>
                                                
                                                <td>
                                                        <label>CVV2 Result</label>
                                                        <?php echo form_input(array('name'=>'CVV2ResponseMessage', 'placeholder'=>'CVV2 Result', 'class'=>'form-control')); ?>
                                                </td>

                                                <td>
                                                        <label>Batch Number</label>
                                                        <?php echo form_input(array('name'=>'SerialNumber', 'placeholder'=>'Batch Number', 'class'=>'form-control')); ?>
                                                </td>
                                            </tr>
                                            
                                        </table>
                                    </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <?php
                                        echo form_submit('search_submit', 'Submit', "class='btn btn-sm btn-success'", "id='submit'");
                                        echo form_close();
                                    ?> 
                                </div>
                            </div>
                        </div>
                    </div>   
    
                <div class="panel panel-inverse" >
                    <div class="panel-heading">
                        <h4 class="panel-title">TOTALS</h4>
                    </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <?php if (isset($num_results)) 
                                      {
                                           echo 'Records Returned: ' . $num_results;
                                      } ?>
                                <table border="1" width="50%" style="text-align: center;">
                              <?php if (isset($results))
                                    { 
                                        if ($results->num_rows() > 0)
                                        { ?>
                                            <thead align="center">
                                                <tr>
                                                    <th>Status</th>
                                                    <th>Number</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                                <?php
                                                echo "<tr>";
                                                    echo "<td>";
                                                        echo "Totals";
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo $num_results;
                                                    echo "</td>";
                                                    echo "<td>";
                                                        echo "$(" . $total_amount . ")";
                                                    echo "</td>";
                                                echo "<tr>";
                                                ?>
                                </table>
                                 <?php }
                                    } ?>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>


                <div class="panel panel-inverse" >
                    <div class="panel-heading">
                        <h4 class="panel-title">SEARCH RESULTS</h4>
                    </div>
                        <div class="panel-body">
                            
                                    <div class="table-responsive">
                                        <table id="myTable" class="table table-bordered tablesorter">
                                            <thead>
                                                <?php 
                                                if (isset($results))
                                                {
                                                    if ($results->num_rows() > 0)
                                                    { ?>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Transaction Date</th>
                                                            <th>Payment Source</th>
                                                            <th>Transaction Amount</th>
                                                            <th>Approval Code</th>
                                                            <th>Order Number</th>
                                                            <th>CVV2 Result</th>
                                                            <th>Batch Number</th>
                                                        </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($results->result() as $result)
                                                {
                                                    echo "<tr>";
                                                        echo "<td>";
                                                            echo $result->PaymentTransactionId;
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo $result->InsertDate;
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo $result->PaymentSource;
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo $result->TransactionAmount;
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo $result->AuthCode;
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo $result->OrderNumber;
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo $result->CVV2ResponseMessage;
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo $result->SerialNumber;
                                                        echo "</td>";
                                                    echo "<tr>";
                                                } ?>
                                            </tbody>
                                        </table>
                                </div>
                                            <?php
                                            } else
                                            {
                                                echo 'Search resulted with no records found';
                                            } ?>
                                        <?php 
                                        } else
                                        {
                                            echo 'Please input info to search.';
                                        } ?>
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
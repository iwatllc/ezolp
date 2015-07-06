<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
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

<html>
    
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
                <?php $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'searchform'); ?>
                <?php echo form_open('Search/execute_search'); ?>                    <!-- begin panel -->
                    <div class="panel panel-inverse" >
                        <div class="panel-heading">
                            <h4 class="panel-title">SEARCH CRITERIA</h4>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-9">
                                <p>
                                    <div class="form-inline">
                                        <label>ID </label>
                                        <?php echo form_input(array('name'=>'PaymentTransactionId', 'placeholder'=>'ID', 'class'=>'form-control')); ?>
                                    </div>
                                </p>
                                <p>
                                    <div class="form-inline">
                                        <label>Insert Date</label>
                                        <?php echo form_input(array('name'=>'InsertDate', 'placeholder'=>'Date Inserted', 'class'=>'form-control')); ?>
                                    </div>
                                </p>
                                <p>
                                    <div class="form-inline">
                                        <label>Payment Source</label>
                                        <?php echo form_input(array('name'=>'PaymentSource', 'placeholder'=>'Payment Source', 'class'=>'form-control')); ?>
                                    </div>
                                </p>
                                <p>
                                    <div class="form-inline">
                                        <label>Transaction Amount</label>
                                        <?php echo form_input(array('name'=>'TransactionAmount', 'placeholder'=>'CAmount', 'class'=>'form-control')); ?>
                                    </div>
                                </p>
                                <p>
                                    <div class="form-inline">
                                        <label>Approval Code</label>
                                        <?php echo form_input(array('name'=>'AuthCode', 'placeholder'=>'Code', 'class'=>'form-control')); ?>
                                    </div>
                                </p>
                                <p>
                                    <div class="form-inline">
                                        <label>Order Number</label>
                                        <?php echo form_input(array('name'=>'OrderNumber', 'placeholder'=>'Number', 'class'=>'form-control')); ?>
                                    </div>
                                </p>
                                <p>
                                    <div class="form-inline">
                                        <label>CVV2 Result</label>
                                        <?php echo form_input(array('name'=>'CVV2ResponseMessage', 'placeholder'=>'Result', 'class'=>'form-control')); ?>
                                    </div>
                                </p>
                                <p>
                                    <div class="form-inline">
                                        <label>Updated Date</label>
                                        <?php echo form_input(array('name'=>'UpdateDate', 'placeholder'=>'Date Updated', 'class'=>'form-control')); ?>
                                    </div>
                                </p>
                                <p>
                                    <div class="form-inline">
                                        <label>Batch Number</label>
                                        <?php echo form_input(array('name'=>'SerialNumber', 'placeholder'=>'Serial Number', 'class'=>'form-control')); ?>
                                    </div>
                                </p>
                                
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
                        <h4 class="panel-title">SEARCH RESULTS</h4>
                    </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <?php if (isset($results))
                                        { ?>    
                                            <?php
                                            if ($results->num_rows() > 0)
                                            { ?>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Date</th>
                                                    <th>Payment Source</th>
                                                    <th>Transaction Amount</th>
                                                    <th>Approval Code</th>
                                                    <th>Order Number</th>
                                                    <th>CVV2 Result</th>
                                                    <th>Updated Date</th>
                                                    <th>Batch Number</th>
                                                </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
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
                                                    echo $result->UpdateDate;
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $result->SerialNumber;
                                                echo "</td>";
                                            echo "<tr>";
                                        } ?>
                                    </tbody>
                                </table>
                                <?php
                                } else
                                {
                                    echo 'Search resulted with no records found';                    
                                }
                                ?>
                        <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
    
    </div>
    <!-- end #content -->

</div>    
<!-- end page container -->

</body>



</html>

<?php $this->load->view('footer'); ?>

</html>
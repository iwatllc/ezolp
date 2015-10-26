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

<?php $this->load->view('navbar'); ?>

<head>
    <title><?php echo $title; ?></title>
</head>
    
<body class = "flat-back">

    <div id="content" class="content">
    
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-12">
                <?php $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'searchform'); ?>
                <?php // echo form_open('search/execute_search'); ?>
                <!-- begin panel -->
                    <div class="panel panel-inverse" >
                        <div class="panel-heading">
                            <h4 class="panel-title">Filter by Date</h4>
                        </div>
                        <div class="panel-body">

                            <?php echo form_open('contributionreport/filter_date'); ?>

                                    <div class="form-inline">
                                        <div class="input-group input-daterange">
                                            <?php
                                            $BegDate = array(
                                                'name'          =>  'BegDate',
                                                'value'         =>  set_value('BegDate', $begin_date),
                                                'placeholder'   =>  date("m/d/Y", strtotime('-7 days')),
                                                'class'         =>  'form-control',
                                                'id'            =>  'datepicker',
                                            );

                                            echo form_input($BegDate)
                                            ?>

                                            <span class="input-group-addon">to</span>

                                            <?php
                                            $EndDate = array(
                                                'name'          =>  'EndDate',
                                                'value'         =>  set_value('EndDate', $end_date),
                                                'placeholder'   =>  date('m/d/Y'),
                                                'class'         =>  'form-control',
                                                'id'            =>  'datepicker2',
                                            );

                                            echo form_input($EndDate);
                                            ?>
                                        </div>

                                        <?php
                                        $submit = array(
                                            'name' => 'search_submit',
                                            'class' => "btn btn-sm btn-success",
                                            'id'    => 'submit',
                                            'value' => 'Apply',
                                        );

                                        echo form_submit($submit);
                                        echo form_close();
                                        ?>

                                    </div>

                        </div>
                    </div>


                <div class="panel panel-inverse" >
                    <div class="panel-heading">
                        <h4 class="panel-title">Contributions</h4>
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
                                                            <th></th>
                                                            <th>Name - Address</th>
                                                            <th>Amount Donated through <?php echo $page_data['company']; ?></th>
                                                            <th>Total Amount Donated Elsewhere</th>
                                                        </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 1;
                                                foreach ($results->result() as $result)
                                                {
                                                    echo "<tr>";
                                                        echo "<td>";
                                                            echo $count . '.';
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo $result->firstname . ' ' . $result->lastname . ' - ' . $result->streetaddress;
                                                        echo "</td>";
                                                        echo "<td align='right'>";
                                                            echo sprintf('$%01.2f', $result->total_company);
                                                        echo "</td>";
                                                        echo "<td align='right'>";
                                                            echo sprintf('$%01.2f', $result->total_other);
                                                        echo "</td>";
                                                    echo "<tr>";
                                                    $count++;
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
                                            echo 'There are no donation contributions to display.';
                                        } ?>
                        </div>
                    </div>
                </div>
    
    </div>
    <!-- end #content -->
    <input id="transactionid" type="hidden"/>
	<div id="dialog-confirm-void" title="Void Transaction?"></div>
    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->

</div>    
<!-- end page container -->

</body>

<?php $this->load->view('footer'); ?>

<script type="text/javascript">
    $( document ).ready(function() {
		//$("#myTable").tablesorter();

        $( "#datepicker" ).datepicker({defaultDate: null});
        $( "#datepicker2" ).datepicker({defaultDate: null});

    });

</script>


</html>
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
    <title><?php echo $page_data['title']; ?></title>
</head>
    
<body class = "flat-back">

    <div id="content" class="content">
    
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-12">
               
                <div class="panel panel-inverse" >
                        <div class="panel-heading">
                            <h4 class="panel-title">Generate Report</h4>
                        </div>
                        <div class="panel-body">
                            <?php echo form_open('contributionreport/submit'); ?>

                                <div class="form-inline">
                                    <div class="input-group input-daterange">
                                        <?php
                                        $startDate = array(
                                            'name'          =>  'startDate',
                                            'value'         =>  set_value('startDate', $start_date),
                                            'class'         =>  'form-control',
                                            'id'            =>  'datepicker',
                                        );

                                        echo form_input($startDate)
                                        ?>

                                        <span class="input-group-addon">to</span>

                                        <?php
                                        $endDate = array(
                                            'name'          =>  'endDate',
                                            'value'         =>  set_value('endDate', $end_date),
                                            'class'         =>  'form-control',
                                            'id'            =>  'datepicker2',
                                        );

                                        echo form_input($endDate);
                                        ?>
                                    </div>

                                    <?php
                                    $submit = array(
                                        'name' => 'search_submit',
                                        'class' => "btn btn-sm btn-success",
                                        'id'    => 'submit',
                                        'value' => 'Create',
                                    );

                                    echo form_submit($submit);
                                    echo form_close();
                                    ?>

                                </div>
                        </div>
                    </div>
                

                <div class="panel panel-inverse" >
                    <div class="panel-heading">
                        <h4 class="panel-title">Contribution Reports</h4>
                    </div>
                        <div class="panel-body">
                            
                                    <div class="table-responsive">
                                        <table id="myTable" class="table table-bordered tablesorter">
                                            <thead>
                                                <?php 
                                                if (isset($results))
                                                {
                                                    if (count($results) > 0)
                                                    { ?>
                                                        <tr>
                                                            <th width="120px">Report ID</th>
                                                            <th>Report Details</th>
                                                            <th>Status</th>
                                                            <th>Date</th>
                                                            <th>Actions</th>
                                                        </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($results as $row)
                                                {
                                                    echo "<tr>";
                                                        echo "<td>";
                                                            echo $row->id . '.';
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo '<div><small><strong>Start Date:</strong> ' . $row->input->startDate . "</small></div>";
                                                            echo '<div><small><strong>End Date:</strong> ' . $row->input->endDate . "</small></div>";
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo $row->status_name;
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo $row->creation_date;
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo '<a href="'.base_url().'/contributionreport/view/'.$row->id.'">View</a>';
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

</html>
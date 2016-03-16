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
                                <div class="col-md-12 form-group">
                                    <label>Match Fields</label>
                                    <div class="col-md-12 form-group">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="matchFirstName" value="1" checked="checked" disabled="disabled">
                                            First Name
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="matchLastName" value="1" checked="checked" disabled="disabled">
                                            Last Name
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="matchCity" value="1" checked="checked">
                                            City
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="matchState" value="1" checked="checked">
                                            State
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="matchZip" value="1" checked="checked">
                                            Zip
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="matchEmployer" value="1" checked="checked">
                                            Employer
                                        </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="matchOccupation" value="1" checked="checked">
                                            Occupation
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 form-group">
                                    <label>Date Range Filter</label>
                                    <div class="col-xs-12 input-group input-daterange">
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
                                </div>
                                <div class="col-md-6 col-lg-4 form-group">
                                    <label>First Name Filter</label>
                                    <?php
                                        echo form_input([
                                            'name'          =>  'firstName',
                                            'value'         =>  set_value('firstName', $firstName),
                                            'class'         =>  'form-control',
                                            'id'            =>  'firstName',
                                        ]);
                                    ?>
                                </div>
                                <div class="col-md-6 col-lg-4 form-group">
                                    <label>Last Name Filter</label>
                                    <?php
                                        echo form_input([
                                            'name'          =>  'lastName',
                                            'value'         =>  set_value('lastName', $lastName),
                                            'class'         =>  'form-control',
                                            'id'            =>  'lastName',
                                        ]);
                                    ?>
                                </div>
                                <div class="col-md-6 col-lg-4 form-group">
                                    <label>City Filter</label>
                                    <?php
                                        echo form_input([ 
                                            'name'          =>  'city',
                                            'value'         =>  set_value('city', $city),
                                            'class'         =>  'form-control',
                                            'id'            =>  'city',
                                        ]);
                                    ?>
                                </div>
                                <div class="col-md-6 col-lg-4 form-group">
                                    <label>State Filter</label>
                                    <?php
                                        echo form_input([ 
                                            'name'          =>  'state',
                                            'value'         =>  set_value('state', $state),
                                            'class'         =>  'form-control',
                                            'id'            =>  'state',
                                        ]);
                                    ?>
                                </div>
                                <div class="col-md-6 col-lg-4 form-group">
                                    <label>Zip Filter</label>
                                    <?php
                                        echo form_input([ 
                                            'name'          =>  'zip',
                                            'value'         =>  set_value('zip', $zip),
                                            'class'         =>  'form-control',
                                            'id'            =>  'zip',
                                        ]);
                                    ?>
                                </div>
                                <div class="col-md-6 col-lg-4 form-group">
                                    <label>Employer Filter</label>
                                    <?php
                                        echo form_input([ 
                                            'name'          =>  'employer',
                                            'value'         =>  set_value('employer', $employer),
                                            'class'         =>  'form-control',
                                            'id'            =>  'employer',
                                        ]);
                                    ?>
                                </div>
                                <div class="col-md-6 col-lg-4 form-group">
                                    <label>Occupation Filter</label>
                                    <?php
                                        echo form_input([ 
                                            'name'          =>  'occupation',
                                            'value'         =>  set_value('occupation', $occupation),
                                            'class'         =>  'form-control',
                                            'id'            =>  'occupation',
                                        ]);
                                    ?>
                                </div>                                    
                                <div class="col-md-6 col-lg-4 form-group">
                                </div>

                                <div class="col-xs-12 form-group">
                                    <?php
                                    $submit = array(
                                        'name' => 'search_submit',
                                        'class' => "btn btn-sm btn-success",
                                        'id'    => 'submit',
                                        'value' => 'Create',
                                    );

                                    echo form_submit($submit);
                                    ?>
                                </div>

                                <?php
                                echo form_close();
                                ?>
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
                                                        if(!empty($row->input->startDate)) {
                                                            echo '<div class="small"><strong>Start Date:</strong> ' . $row->input->startDate . "</div>";
                                                        }
                                                        if(!empty($row->input->endDate)) {
                                                            echo '<div class="small"><strong>End Date:</strong> ' . $row->input->endDate . "</div>";
                                                        }
                                                        if(!empty($row->input->firstName)) {
                                                            echo '<div class="small"><strong>First Name:</strong> ' . $row->input->firstName . "</div>";
                                                        }
                                                        if(!empty($row->input->lastName)) {
                                                            echo '<div class="small"><strong>Last Name:</strong> ' . $row->input->lastName . "</div>";
                                                        }
                                                        if(!empty($row->input->city)) {
                                                            echo '<div class="small"><strong>City:</strong> ' . $row->input->city . "</div>";
                                                        }
                                                        if(!empty($row->input->state)) {
                                                            echo '<div class="small"><strong>State:</strong> ' . $row->input->state . "</div>";
                                                        }
                                                        if(!empty($row->input->zip)) {
                                                            echo '<div class="small"><strong>Zip:</strong> ' . $row->input->zip . "</div>";
                                                        }
                                                        if(!empty($row->input->employer)) {
                                                            echo '<div class="small"><strong>Employer:</strong> ' . $row->input->employer . "</div>";
                                                        }
                                                        if(!empty($row->input->occupation)) {
                                                            echo '<div class="small"><strong>Occupation:</strong> ' . $row->input->occupation . "</div>";
                                                        }  
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo $row->status_name;
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo $row->creation_date;
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo '<a class="btn" href="'.base_url().'/contributionreport/view/'.$row->id.'"><i class="fa fa-eye fa-lg"></i> <span>View</span></a>';
                                                            echo '<a class="btn" href="'.base_url().'/contributionreport/download/'.$row->id.'"><i class="fa fa-download fa-lg"></i> <span>Download</span></a>';
                                                            echo '<a class="btn" href="'.base_url().'/contributionreport/delete/'.$row->id.'"><i class="fa fa-trash fa-lg"></i> <span>Delete</span></a>';
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
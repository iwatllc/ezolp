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
                <?php $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'searchform'); ?>
                
                <div class="panel panel-inverse" >
                    <div class="panel-heading">
                        <h4 class="panel-title">Contribution Report Configuration</h4>
                    </div>
                        <div class="panel-body">
                        <?php
                            if(!empty($results->input->startDate)) {
                                echo '<div><strong>Start Date:</strong> ' . $results->input->startDate . "</div>";
                            }
                            if(!empty($results->input->endDate)) {
                                echo '<div><strong>End Date:</strong> ' . $results->input->endDate . "</div>";
                            }
                            if(!empty($results->input->firstName)) {
                                echo '<div><strong>First Name:</strong> ' . $results->input->firstName . "</div>";
                            }
                            if(!empty($results->input->lastName)) {
                                echo '<div><strong>Last Name:</strong> ' . $results->input->lastName . "</div>";
                            }
                            if(!empty($results->input->city)) {
                                echo '<div><strong>City:</strong> ' . $results->input->city . "</div>";
                            }
                            if(!empty($results->input->state)) {
                                echo '<div><strong>State:</strong> ' . $results->input->state . "</div>";
                            }
                            if(!empty($results->input->zip)) {
                                echo '<div><strong>Zip:</strong> ' . $results->input->zip . "</div>";
                            }
                            if(!empty($results->input->employer)) {
                                echo '<div><strong>Employer:</strong> ' . $results->input->employer . "</div>";
                            }
                            if(!empty($results->input->occupation)) {
                                echo '<div><strong>Occupation:</strong> ' . $results->input->occupation . "</div>";
                            }                   
                        ?>
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
                                                if (isset($results) && isset($results->results))
                                                {
                                                    if (count($results->results) > 0)
                                                    { ?>
                                                        <tr>
                                                            <th></th>
                                                            <th width="200">Name - Address</th>
                                                            <th>Committee</th>
                                                            <th>Candidate</th>
                                                        </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 1;
                                                foreach ($results->results->data as $result)
                                                {
                                                    echo "<tr>";
                                                        echo "<td>";
                                                            echo $count . '.';
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo $result->firstname . ' ' . $result->lastname . ' <br> ';
                                                            echo $result->streetaddress . ' <br> ';
                                                            echo $result->city . ', ' . $result->state . ' ' . $result->zip . ' <br> ';
                                                            echo '$' . $result->transaction_amt . ' ' . $result->report_type;
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo $result->CMTE_NM. ' <br> ';
                                                            echo $result->CMTE_ST1 . ' ';
                                                            echo $result->CMTE_CITY . ', ' . $result->CMTE_ST . ' ' . $result->CMTE_ZIP . ' <br> ';
                                                            echo 'AFFILIATION: (' . $result->CMTE_PTY_AFFILIATION . ') ' . $result->CONNECTED_ORG_NM;
                                                        echo "</td>";
                                                        echo "<td>";
                                                            echo ($result->CAND_NAME != '' ? $result->CAND_NAME . ' <br> ' : 'UNKOWN' );
                                                            echo ($result->CAND_PTY_AFFILIATION != '' ? 'AFFILIATION: (' . $result->CAND_PTY_AFFILIATION . ') <br> ' : '' );
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

</html>
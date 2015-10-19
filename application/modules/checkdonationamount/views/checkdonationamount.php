<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

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
                    <h4 class="panel-title">YOUR DONATIONS</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-9">
                        <div class="form-inline">


                            <h3><?php echo $page_data['heading']?> Donations</h3><br>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered tablesorter">
                                    <?php if ($company_donations->num_rows() > 0){ ?>
                                        <thead>
                                            <tr>
                                                <th>Donation ID</th>
                                                <th>Name</th>
                                                <th>Street Address</th>
                                                <th>Street Address 2</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Zip</th>
                                                <th>Notes</th>
                                                <th>CC Last 4</th>
                                                <th>Amount</th>
                                                <th>Insert Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($company_donations->result() as $result)
                                            {
                                                echo "<tr>";
                                                echo "<td>";
                                                echo $result->id;
                                                echo "</td>";
                                                echo "<td>";
                                                echo $result->name;
                                                echo "</td>";
                                                echo "<td>";
                                                echo $result->streetaddress;
                                                echo "</td>";
                                                echo "<td>";
                                                echo $result->streetaddress2;
                                                echo "</td>";
                                                echo "<td>";
                                                echo $result->city;
                                                echo "</td>";
                                                echo "<td>";
                                                echo $result->state;
                                                echo "</td>";
                                                echo "<td>";
                                                echo $result->zip;
                                                echo "</td>";
                                                echo "<td>";
                                                echo $result->notes;
                                                echo "</td>";
                                                echo "<td>";
                                                echo $result->cclast4;
                                                echo "</td>";
                                                echo "<td>";
                                                echo $result->amount;
                                                echo "</td>";
                                                echo "<td>";
                                                echo $result->InsertDate;
                                                echo "</td>";
                                                echo "</tr>";
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } else { ?>
                                <strong>There are no donations to display.</strong>
                            <?php } ?><br><br>


                            <h3>Overall Donations</h3><br>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered tablesorter">
                                    <?php if ($all_donations->num_rows() > 0){ ?>
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Zip Code</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($all_donations->result() as $result)
                                    {
                                        echo "<tr>";
                                        echo "<td>";
                                        echo $result->name;
                                        echo "</td>";
                                        echo "<td>";
                                        echo $result->city;
                                        echo "</td>";
                                        echo "<td>";
                                        echo $result->state;
                                        echo "</td>";
                                        echo "<td>";
                                        echo $result->zip_code;
                                        echo "</td>";
                                        echo "<td>";
                                        echo $result->transaction_amt;
                                        echo "</td>";
                                        echo "</tr>";
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <strong>There are no donations to display.</strong>
                        <?php } ?>


                            <strong>Total Donations:</strong><br>
                            <strong>Total Amount Donated:</strong><br>
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
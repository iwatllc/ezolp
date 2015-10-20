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
                    <h4 class="panel-title"><?php echo $page_data['heading']?> Donations</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-inline">


                            <?php if ($company_donations->num_rows() > 0){ ?>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered tablesorter">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($company_donations->result() as $result)
                                            {
                                                echo "<tr>";
                                                echo "<td>";
                                                echo date_conversion_nowording($result->InsertDate);
                                                echo "</td>";
                                                echo "<td align='right'>";
                                                echo sprintf('$%01.2f', $result->amount);
                                                echo "</td>";
                                                echo "</tr>";
                                            } ?>
                                        </tbody>
                                </table>
                            </div>
                            <?php } else { ?>
                                <strong>There are no donations to display.</strong>
                            <?php } ?><br>


                        </div>
                    </div>



                    <div class="col-md-6">
                        <div class="form-inline">

                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered tablesorter">
                                    <thead>
                                    <tr>
                                        <th>Number of Donations</th>
                                        <th>Amount Donated</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <?php echo $num_company_donations; ?>
                                        </td>
                                        <td align="right">
                                            <?php echo sprintf('$%01.2f', $amount_company_donations); ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
    </div>
    <!-- end row -->



    <div class="row">
        <!-- begin col-12 -->
        <div class="col-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" >
                <div class="panel-heading">
                    <h4 class="panel-title">Federal Election Commission Individual Contributions</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-inline">


                            <?php if ($all_donations->num_rows() > 0){ ?>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered tablesorter">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($all_donations->result() as $result)
                                    {
                                        echo "<tr>";
                                        echo "<td>";
                                        echo date_conversion_nowording($result->transaction_date);
                                        echo "</td>";
                                        echo "<td align='right'>";
                                        echo sprintf('$%01.2f', $result->transaction_amt);
                                        echo "</td>";
                                        echo "</tr>";
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php } else { ?>
                                <strong>There are no donations to display.</strong>
                            <?php } ?><br>


                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-inline">

                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered tablesorter">
                                    <thead>
                                    <tr>
                                        <th>Number of Donations</th>
                                        <th>Amount Donated</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <?php echo $num_all_donations; ?>
                                        </td>
                                        <td align="right">
                                            <?php echo sprintf('$%01.2f', $amount_all_donations); ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
    </div>
    <!-- end row -->




    <div class="row">
        <!-- begin col-12 -->
        <div class="col-12">

            <!-- begin panel -->
            <div class="panel panel-inverse" >
                <div class="panel-heading">
                    <h4 class="panel-title">Total Donations</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="form-inline">


                                <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered tablesorter">
                                        <thead>
                                        <tr>
                                            <th>Total Number of Donations</th>
                                            <th>Total Amount Donated</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <?php echo $num_total_donations; ?>
                                                </td>
                                                <td>
                                                    <?php // echo $amount_total_donations; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                        </div>
                    </div>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
    </div>
    <!-- end row -->



</div>
<!-- end content -->

<!-- end page container -->

</body>

<?php $this->load->view('footer'); ?>

</html>
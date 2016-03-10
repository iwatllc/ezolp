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
<!--    <link rel="stylesheet" type="text/css" href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css">-->
<!--    <script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"></script>-->
<!---->
<!--    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>-->
<!--    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/css/bootstrap.min.css">-->
<!--    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>-->

</head>

<body class = "flat-back">

<div id="content" class="content">

    <div class="row">
        <!-- begin col-12 -->
        <div class="col-12">
            <?php $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'searchform'); ?>
            <?php echo form_open('da_search/execute_search', array('id' => 'myForm')); ?>

            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Search Display Ads</h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-4">
                                <label class="control-label">Contact Info</label>
                                <?php
                                    $data = array(
                                        'name' => 'contactinfo',
                                        'value'=> set_value('contactinfo'),
                                        'placeholder' => 'First/Last Name, City, Street, State, Zip, Email',
                                        'class' => 'form-control'
                                    );
                                    echo form_input($data);
                                ?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Page Size</label>
                                <?php
                                $data = array(
                                    'class' => 'form-control'
                                );
                                echo form_dropdown('pricing', $pricings, set_value('pricing', ''), $data);
                                ?>
                            </div>
                            <div class="col-md-4">
                                <label class="control-label">Promo Code Used</label>
                                <?php
                                $data = array(
                                    'class' => 'form-control'
                                );
                                echo form_dropdown('promocode', $promo_codes, set_value('promocode', ''), $data);
                                ?>
                            </div>
                        </div>
                        <br/><br/><br/><br/>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label class="control-label">Submission Begin/End Date</label>
                                <div class="col-md-12 input-group input-daterange">
                                    <?php
                                    $BegDate = array(
                                        'name'          =>  'begindate',
                                        'id'            =>  'begindate',
                                        'value'         =>  set_value('begindate'),
                                        'placeholder'   =>  date("m/d/Y"),
                                        'class'         =>  'form-control'
                                    );

                                    echo form_input($BegDate)
                                    ?>
                                    <span class="input-group-addon">to</span>
                                    <?php
                                    $EndDate = array(
                                        'name'          =>  'enddate',
                                        'id'            =>  'enddate',
                                        'value'         =>  set_value('enddate'),
                                        'placeholder'   =>  date("m/d/Y", strtotime('+7 days')),
                                        'class'         =>  'form-control'
                                    );

                                    echo form_input($EndDate);
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Issues</label>
                                <?php
                                    $data = array(
                                        'January'   => 'January',
                                        'February'  => 'February',
                                        'March'     => 'March',
                                        'April'     => 'April',
                                        'May'       => 'May',
                                        'June'      => 'June',
                                        'July'      => 'July',
                                        'August'    => 'August',
                                        'September' => 'September',
                                        'October'   => 'October',
                                        'November'  => 'November',
                                        'December'  => 'December'
                                    );
                                    $options = array(
                                        'class' => 'form-control',
                                        'style' => 'height:10%'
                                    );
                                    echo form_multiselect('issues[]', $data, $this->input->post('issues'), $options);
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-9">
                                <br/>
                                <input type="button" onclick="document.getElementById('myForm').reset();;" class="btn btn-sm btn-default" value="Reset" />
                                <button type="submit" class="btn btn-sm btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end panel -->

            <?php
            if ( isset($results) )
            {?>
            <div class="panel panel-inverse" >
                <div class="panel-heading">
                    <h4 class="panel-title">Showing <?php echo $results->num_rows(); ?> results</h4>
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered tablesorter">
                            <thead>
                            <?php
                            if ( isset($results) )
                            {
                            if ($results -> num_rows() > 0)
                            { ?>
                            <tr>
                                <th width="30%">Contact</th>
                                <th width="20%">Page Size</th>
                                <th width="15%">Promo Code</th>
                                <th width="20%">Issues</th>
                                <th width="10%">Submitted</th>
                                <th width="5%">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($results -> result() as $result)
                            {
                                echo "<tr>";
                                echo "<td>";
                                echo $result->firstname.' '.$result->lastname.'<br/>'.$result->streetaddress.'<br/>'.$result->city.', '.$result->state.'<br/>'.$result->zip;
                                echo "</td>";
                                echo "<td>";
                                echo $result->option;
                                echo "</td>";
                                echo "<td>";
                                echo $result->promocode;
                                echo "</td>";
                                echo "<td>";
                                echo $result->issues;
                                echo "</td>";
                                echo "<td>";
                                echo date_conversion_nowording($result->created);
                                echo "</td>";
                                echo "<td>&nbsp;</td>";
                                echo "<tr>";
                            }
                            ?>
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
                        // echo 'Please input info to search.';
                    } ?>
                </div>
            </div>
            <?php
            }
            ?>
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

<br/><br/><br/><br/><br/><br/><br/>

</body>

<?php $this->load->view('footer'); ?>
<script type="text/javascript">

    function resetForm($form) {
        $form.find('input:text, input:password, input:file, select, textarea').val('');
        $form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
    }

    $( document ).ready(function() {

        $( "#datepicker" ).datepicker({defaultDate: null});
        $( "#datepicker2" ).datepicker({defaultDate: null});

        $('.view-text').click( function(event) {
            event.preventDefault();

            $(this).next().slideToggle( "fast", function() {
                $(this).is(':visible') ? $(this).prev().html('<span class="glyphicon glyphicon-plus-sign"></span> view ') : $(this).prev().html('<span class="glyphicon glyphicon-minus-sign"></span> close ');
            });
            $(this).next().next().slideToggle( "fast", function() {});
        });

    });

</script>


</html>
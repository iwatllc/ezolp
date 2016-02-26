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
            <?php echo form_open('search/execute_search'); ?>
            <!-- begin panel -->
            <div class="panel panel-inverse" >
                <div class="panel-heading">
                    <h4 class="panel-title">Manage Classified Ad Promo Codes</h4>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-9">
                            <?php
                            $add = array(
                                'name' => 'add',
                                'id' => 'add',
                                'value' => 'true',
                                'type' => 'button',
                                'class' => 'btn btn-success',
                                'content' => 'Add Promo Code'
                            );

                            echo form_button($add);

                            echo form_submit('search_submit', 'Submit', "class='btn btn-sm btn-success'", "id='submit'");
                            echo form_close();
                            ?>

                        </div>
                    </div>
                </div>

                <?php
                // Show error
                echo validation_errors();

                // Table options
                $tbl = array (
                    'table_open'  => '<table class="table  table-stripped">',
                    'table_close' => '</table>'
                );
                $this -> table -> set_template($tbl);

                // Create table
                $this -> table -> set_heading('', 'Description', 'Code', 'Months', 'Percentage', 'Start', 'End');

                foreach ($ca_promos as $promo)
                {
                    $this -> table -> add_row(
                        form_checkbox('checkbox_'.$promo->id, $promo->id),
                        $promo -> description,
                        $promo -> code,
                        $promo -> months,
                        $promo -> percentage,
                        date('Y-m-d', strtotime($promo -> startdate)),
                        date('Y-m-d', strtotime($promo -> enddate))
                    );
                }

                echo $this -> table -> generate();
                ?>

                <div class="panel-body">
                    <div>
                        <ul class="pagination pagination-lg m-t-0 m-b-10">
                            <li class="disabled"><a href="javascript:;">«</a></li>
                            <li class="active"><a href="javascript:;">1</a></li>
                            <li><a href="javascript:;">2</a></li>
                            <li><a href="javascript:;">3</a></li>
                            <li><a href="javascript:;">4</a></li>
                            <li><a href="javascript:;">5</a></li>
                            <li><a href="javascript:;">»</a></li>
                        </ul>
                    </div>
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

    function resetForm($form) {
        $form.find('input:text, input:password, input:file, select, textarea').val('');
        $form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
    }

    $( document ).ready(function() {
        //$("#myTable").tablesorter();

        $( "#datepicker" ).datepicker({defaultDate: null});
        $( "#datepicker2" ).datepicker({defaultDate: null});

        $( "#content" ).on("click", ".btn-changestatus", function() {
            window.location = "<?php echo base_url(); ?>changestatus/Changestatus/index/"+$(this).attr("data-paymentTransactionFileName")+"/"+$(this).attr("data-paymentResponseId");
        });

        $( "#content" ).on("click", ".btn-checkdonationamount", function() {
            window.location = "<?php echo base_url(); ?>checkdonationamount/index/"+$(this).attr("data-paymentResponseId");
        });

        $( "#content" ).on("click", ".btn-refund", function() {
            window.location = "<?php echo base_url(); ?>refund/Refund/index/"+$(this).attr("data-paymentResponseId");
        });

        $( "#content" ).on("click", ".btn-void", function() {
            $("#transactionid").val($(this).attr("data-paymentResponseId"));
            $("#dialog-confirm-void").html("<strong>Transaction Id:</strong> " + $(this).attr("data-paymentResponseId") + "</br>"
                +  "<strong>Transaction Date:</strong> " + $(this).attr("data-transactionDate") + "</br>"
                +  "<strong>Transaction Amount:</strong> $" + $(this).attr("data-transactionAmount"));
            $("#dialog-confirm-void").dialog("option", "position", {at: "center top", of: this}).dialog("open");
        });

        $( "#dialog-confirm-void").dialog({
            modal: true,
            autoOpen: false,
            buttons: {
                "Void Transaction": function() {
                    window.location = "<?php echo base_url(); ?>void/Void/index/"+$("#transactionid").val();
                },
                Cancel: function() {
                    $(this).dialog("close");
                }
            }
        });
    });

</script>


</html>
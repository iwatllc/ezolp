<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

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
                    <button type="button" id ="delpromo-btn" class="btn btn-danger m-r-5 m-b-5"><i class="fa fa-trash-o"></i> Delete</button>
                    <button type="button" id="addpromo-btn" class="btn btn-info m-r-5 m-b-5"><i class="fa fa-plus"></i> Add</button>
                    <!--                    <span class="alert alert-success">-->
                    <!--                        <strong>Success!</strong> Promo Code Added-->
                    <!--                    </span>-->
                </div>

                <div id="overlay"></div>

                <!---------------- ADD PROMO CODE BEGINS ---------------------------->
                <div id="add-popup">
                    <div class="form-group" id="addcodefield">
                        <label class="col-md-2 control-label">Code:</label>
                        <div class="col-md-3">
                            <?php
                            $data = array(
                                'name'          => 'promocode',
                                'id'            => 'addcode',
                                'value'         => set_value('addcode'),
                                'class'         => 'form-control',
                                'type'          => 'text',
                                'placeholder'   => 'Promo Code Name',
                                'data-parsley-required' => 'true',
                            );
                            echo form_input($data);
                            echo '<span class="form-control-feedback" id="addcode-err"></span>';
                            ?>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="form-group" id="adddescriptionfield">
                        <label class="col-md-2 control-label">Description:</label>
                        <div class="col-md-9">
                            <?php
                            $data = array(
                                'name'          => 'description',
                                'id'            => 'adddescription',
                                'value'         => set_value('adddescription'),
                                'class'         => 'form-control',
                                'type'          => 'text',
                                'placeholder'   => 'Promo Code Description',
                                'data-parsley-required' => 'true',
                                'rows'          => '3',
                                'style'        => 'resize:horizontal;'
                            );
                            echo form_textarea($data);
                            echo '<span class="form-control-feedback" id="adddescription-err"></span>';
                            ?>
                        </div>
                    </div>
                    <br/><br/><br/><br/>
                    <div class="form-group" id="adddatesfield">
                        <label class="col-md-2 control-label">Dates Valid:</label>
                        <div class="col-md-7 input-group input-daterange">
                            <?php
                            $BegDate = array(
                                'name'          =>  'begindate',
                                'id'            =>  'addbegindate',
                                'value'         =>  set_value('addbegindate', $begin_date),
                                'placeholder'   =>  date("m/d/Y"),
                                'class'         =>  'form-control'
                            );

                            echo form_input($BegDate)
                            ?>
                            <span class="input-group-addon">to</span>
                            <?php
                            $EndDate = array(
                                'name'          =>  'enddate',
                                'id'            =>  'addenddate',
                                'value'         =>  set_value('addenddate', $end_date),
                                'placeholder'   =>  date("m/d/Y", strtotime('+7 days')),
                                'class'         =>  'form-control'
                            );

                            echo form_input($EndDate);
                            echo '<span class="form-control-feedback" id="adddates-err"></span>';
                            ?>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group" id="addmonthsfield">
                        <label class="col-md-2 control-label">Months:</label>
                        <div class="col-md-2">
                            <select id="addmonths" class="form-control">
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                            <span class="form-control-feedback" id="addmonths-err"></span>
                        </div>
                    </div>
                    <br/>
                    <br/>
                    <div class="form-group" id="addpercentagefield">
                        <label class="col-md-2 control-label">Percentage:</label>
                        <div class="col-md-2 input-group " style="padding-left:1em">
                            <?php
                            $data = array(
                                'name'          => 'percentage',
                                'id'            => 'addpercentage',
                                'value'         => set_value('addpercentage'),
                                'class'         => 'form-control',
                                'type'          => 'text',
                                'onkeypress'    => 'return event.charCode >= 48 && event.charCode <= 57',
                                'maxlength'     => '3',
                                'data-parsley-required' => 'true',
                            );
                            echo form_input($data);
                            echo '<span class="input-group-addon">%</span>';
                            echo '<span class="form-control-feedback" id="addpercentage-err"></span>';
                            ?>
                        </div>
                    </div>
                    <div class="panel-body">
                        <button type="button" id="addpromo-submit" class="btn btn-info m-r-5 m-b-5"><i class="fa fa-plus"></i> Add Promo Code</button>
                        <button type="button" id="cancelpromo-btn" class="btn btn-warning m-r-5 m-b-5"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                </div>
                <!---------------- ADD PROMO CODE ENDS ---------------------------->



                <div class="panel-body">

                    <table class="table table-bordered table-striped" id="promo-table">
                        <thead>
                        <tr>
                            <th width="5%"></th>
                            <th width="15%">Code</th>
                            <th width="30%">Description</th>
                            <th width="5%">Months</th>
                            <th width="5%">Percentage</th>
                            <th width="15%">Start Date</th>
                            <th width="15%">End Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($ca_promos as $promo)
                        {
                            echo '<tr id ="'.$promo->id.'">';
                            echo '<td>'.form_checkbox('promocodes[]', $promo->id).'</td>';
//                            echo '<td><button type="button" id="'.$promo->id.'" class="btn btn-success m-r-5 m-b-5 editpromo"><i class="fa fa-pencil"></i> Edit</button></td>';
                            echo '<td>'.$promo->code.'</td>';
                            echo '<td>'.$promo->description.'</td>';
                            echo '<td>'.$promo->months.'</td>';
                            echo '<td>'.$promo->percentage.'%</td>';
                            echo '<td>'.date('m-d-Y', strtotime($promo -> startdate)).'</td>';
                            echo '<td>'.date('m-d-Y', strtotime($promo -> enddate)).'</td>';
                            echo '</tr>';
                            ?>

                            <!---------------- EDIT PROMO CODE BEGINS ---------------------------->
                            <div id="edit-popup">
                                <div class="form-group" id="editcodefield">
                                    <label class="col-md-2 control-label">Edit Code:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $data = array(
                                            'name'          => 'promocode',
                                            'id'            => 'addcode',
                                            'value'         => set_value('promocode', $promo->code),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => 'Promo Code Name',
                                            'data-parsley-required' => 'true',
                                        );
                                        echo form_input($data);
                                        echo '<span class="form-control-feedback" id="addcode-err"></span>';
                                        ?>
                                    </div>
                                </div>
                                <br/><br/>
                                <div class="form-group" id="editdescriptionfield">
                                    <label class="col-md-2 control-label">Description:</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'description',
                                            'id'            => 'adddescription',
                                            'value'         => set_value('description', $promo->description),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => 'Promo Code Description',
                                            'data-parsley-required' => 'true',
                                            'rows'          => '3',
                                            'style'        => 'resize:horizontal;'
                                        );
                                        echo form_textarea($data);
                                        echo '<span class="form-control-feedback" id="adddescription-err"></span>';
                                        ?>
                                    </div>
                                </div>
                                <br/><br/><br/><br/>
                                <div class="form-group" id="editdatesfield">
                                    <label class="col-md-2 control-label">Dates Valid:</label>
                                    <div class="col-md-7 input-group input-daterange">
                                        <?php
                                        $BegDate = array(
                                            'name'          =>  'begindate',
                                            'id'            =>  'addbegindate',
                                            'value'         =>  set_value('begindate', date("m/d/Y", strtotime($promo->startdate)) ),
                                            'placeholder'   =>  date("m/d/Y"),
                                            'class'         =>  'form-control'
                                        );

                                        echo form_input($BegDate)
                                        ?>
                                        <span class="input-group-addon">to</span>
                                        <?php
                                        $EndDate = array(
                                            'name'          =>  'enddate',
                                            'id'            =>  'addenddate',
                                            'value'         =>  set_value('addenddate', date("m/d/Y", strtotime($promo->enddate)) ),
                                            'placeholder'   =>  date("m/d/Y", strtotime('+7 days')),
                                            'class'         =>  'form-control'
                                        );

                                        echo form_input($EndDate);
                                        echo '<span class="form-control-feedback" id="adddates-err"></span>';
                                        ?>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-group" id="editmonthsfield">
                                    <label class="col-md-2 control-label">Months:</label>
                                    <div class="col-md-2">
                                        <select id="addmonths" class="form-control">
                                            <option value="1" selected>1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                        <span class="form-control-feedback" id="addmonths-err"></span>
                                    </div>
                                </div>
                                <br/>
                                <br/>
                                <div class="form-group" id="editpercentagefield">
                                    <label class="col-md-2 control-label">Percentage:</label>
                                    <div class="col-md-2 input-group " style="padding-left:1em">
                                        <?php
                                        $data = array(
                                            'name'          => 'percentage',
                                            'id'            => 'addpercentage',
                                            'value'         => set_value('addpercentage'),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'onkeypress'    => 'return event.charCode >= 48 && event.charCode <= 57',
                                            'maxlength'     => '3',
                                            'data-parsley-required' => 'true',
                                        );
                                        echo form_input($data);
                                        echo '<span class="input-group-addon">%</span>';
                                        echo '<span class="form-control-feedback" id="addpercentage-err"></span>';
                                        ?>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <button type="button" id="editpromo-submit" class="btn btn-info m-r-5 m-b-5"><i class="fa fa-edit"></i> Update Promo Code</button>
                                    <button type="button" id="cancelpromo-btn" class="btn btn-warning m-r-5 m-b-5"><i class="fa fa-times"></i> Cancel</button>
                                </div>
                            </div>
                            <!---------------- EDIT PROMO CODE ENDS ---------------------------->

                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
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

    // On Add Promo button click, show Add Promo form
    $(document).on('click', '#addpromo-btn', function() {
        $('#overlay, #add-popup').css('display', 'block');
    });

    // Open Edit Charge form
    $('#promo-table').on('click', '.editpromo', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#overlay, #edit-popup').css('display', 'block');
    });

    // On Overlay or Cancel Promo button click, hide Add Promo form
    $(document).on('click', '#overlay, #cancelpromo-btn', function() {
        $('#overlay, #add-popup, #edit-popup').css('display', 'none', 'none');
    });

    // Add a Promo Code
    $(document).on('click', '#addpromo-submit', function(e) {
        e.preventDefault();

        var baseUrl = window.location .protocol + "//" + window.location.host + "/" + window.location.pathname.split('/')[1];

        // Replace button with animated loading gif
        $(this).attr('disabled', true).empty().prepend('<img src="'+baseUrl+'/assets/img/loading-gif.gif" />&nbsp; Adding Promo Code');

        // Set variables that will be posted
        var code = $("#addcode").val();
        var description = $("#adddescription").val();
//        var begindate = $("#addbegindate").datepicker('getDate');
//        var enddate = $("#addenddate").datepicker('getDate');
        var begindate = $( "#addbegindate" ).datepicker().val();
        var enddate = $( "#addenddate" ).datepicker().val();
        var months = $("#addmonths").val();
        var percentage = $("#addpercentage").val();

//        console.log(
//            'Code: ' + code + '\n' +
//            'Description: ' + description + '\n' +
//            'Begin Date: ' + begindate + '\n' +
//            'End Date: ' + enddate + '\n' +
//            'Months: ' + months + '\n' +
//            'Percentage: ' + percentage
//        );

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "ca_promo/Ca_promo/ajax_add_promocode",
            dataType: 'json',
            data: {code:code, description:description, begindate:begindate, enddate:enddate, months:months, percentage:percentage},
            success: function(res) {
                if (res) {

//                    console.log(
//                        'Code: ' + res.code + '\n' +
//                        'Description: ' + res.description + '\n' +
//                        'Begin Date: ' + res.begindate + '\n' +
//                        'End Date: ' + res.enddate + '\n' +
//                        'Months: ' + res.months + '\n' +
//                        'Percentage: ' + res.percentage
//                    );

                    // Replace button with original glyphicon
                    $('#addpromo-submit').removeAttr('disabled').empty().prepend('<i class="fa fa-plus"></i> Add Promo Code');

                    // remove previous error messages
                    $("#addcode-err").empty();
                    $("#adddescription-err").empty();
                    $("#addbegindate-err").empty();
                    $("#addenddate-err").empty();
                    $("#addmonths-err").empty();
                    $("#addpercentage-err").empty();

                    // check form validation first
                    if (res.code_error)
                    {
//                        $('#addcode-err').append(res.code_error); // display error message under Charge Category field
                        $('#addcodefield').addClass('has-error'); // make field red
                    } else
                    {
                        $('#addcodefield').removeClass('has-error'); // remove red field
                    }
                    if (res.description_error)
                    {
//                        $('#adddescription-err').append(res.description_error);
                        $('#adddescriptionfield').addClass('has-error');
                    } else
                    {
                        $('#adddescriptionfield').removeClass('has-error');
                    }
                    if (res.begindate_error || res.enddate_error)
                    {
//                        $('#adddates-err').append(res.enddate_error);
//                        $('#adddates-err').append(res.begindate_error);
                        $('#adddatesfield').addClass('has-error');
                    } else
                    {
                        $('#adddatesfield').removeClass('has-error');
                    }
                    if (res.months_error)
                    {
//                        $('#addmonths-err').append(res.months_error);
                        $('#addmonthsfield').addClass('has-error');
                    } else
                    {
                        $('#addmonthsfield').removeClass('has-error');
                    }
                    if (res.percentage_error)
                    {
//                        $('#addpercentage-err').append(res.percentage_error);
                        $('#addpercentagefield').addClass('has-error');
                    } else
                    {
                        $('#addpercentagefield').removeClass('has-error');
                    }

                    if (res.code_error || res.description_error || res.begindate_error || res.enddate_error || res.months_error || res.percentage_error)
                    {
                        return; // do not run any more javascript, there are errors on form
                    }

                    // Hide Add Promo form
                    $('#overlay, #add-popup').css('display', 'none');//

                    // reset all values on form after submission
                    $("#addcode").val('');
                    $("#adddescription").val('');
                    $("#addbegindate").datepicker().val('');
                    $("#addenddate").datepicker().val('');
                    $("#addmonths").val('1');
                    $("#addpercentage").val('');

                    var newtr =
                        '<td><input type="checkbox" name="promocodes[]" value="' + res.id + '"  /></td>' +
                        '<td>' + res.code + '</td>' +
                        '<td>' + res.description + '</td>' +
                        '<td>' + res.months + '</td>' +
                        '<td>' + res.percentage + '%</td>' +
                        '<td>' + res.begindate + '</td>' +
                        '<td>' + res.enddate + '</td>';

                    // Add row to table
                    row = $('<tr id="' + res.id + '" ></tr>');
                    row.append(newtr).prependTo('#promo-table');

                    // Highlight row that was just updated
                    setTimeout(function(){ $("tr#"+res.id).css('background-color','transparent').effect("highlight", {color:"#5C8116"}, 4000); })

//                    $('#num_jobnotes').html('<span class="badge">' + res.num_jobnotes + '</span>'); // update total number
                }
            }
        });

    });

    // Delete Promo Codes
    $(document).on('click','#delpromo-btn', function(e){
        e.preventDefault();

        var baseUrl = window.location .protocol + "//" + window.location.host + "/" + window.location.pathname.split('/')[1];

        var selectedPromoCodes = $("input[name='promocodes[]']");

        // If no items are checked, do not delete anything, just return
        if(!selectedPromoCodes.is(':checked'))
            return;

        // Disable button and replace with animated trashcan gif
        $(this).attr('disabled', true).empty().prepend('<img src="'+baseUrl+'/assets/img/trash-can.gif" /> Deleting');

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "ca_promo/Ca_promo/ajax_del_promocode",
            dataType: 'json',
            data: selectedPromoCodes.serialize(),
            success: function(res) {
                if (res) {

                    // Replace button with original glyphicon
                    $('#delpromo-btn').removeAttr('disabled').empty().prepend('<i class="fa fa-trash-o"></i> Delete');

                    // Remove rows from returned IDs in charge table
                    for (var i = 0; i < Object.keys(res).length - 1; i++)
                    {
                        $('table#promo-table tr#'+Number(res[i])).remove(); // remove row from table
                    }

//                    $('#num_jobnotes').html(res.num_jobnotes); // update total number of notes for job

//                    if (res.num_jobnotes > 0)
//                    {
//                        $('#num_jobnotes').html('<span class="badge">' + res.num_jobnotes + '</span>'); // update total number of notes
//                    } else
//                    {
//                        $('#num_jobnotes').html('<span class="badge"></span>'); // no notess, don't show number of reps
//                    }
                }
            }
        });
    });

    $( document ).ready(function() {
        //$("#myTable").tablesorter();

        $( "#addbegindate" ).datepicker("setDate", new Date());
        $( "#addenddate" ).datepicker("setDate", '7');

    });

</script>

<style>
    #overlay{
        display:none;
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
        z-index:1000;
        background-color:#333;
        opacity:.80;
    }

    #add-popup{
        color: #333;
        display: none;
        position: fixed;
        top: 10%;
        left: 18%;
        width:70%;
        min-width:70%;
        height: 70%;
        padding: 1em;
        border: 5px solid #333;
        background-color: white;
        text-align: left;
        z-index:1001;
        overflow: auto;
        font-size:16px;
    }

    #edit-popup{
        color: #333;
        display: none;
        position: fixed;
        top: 10%;
        left: 18%;
        width:70%;
        min-width:70%;
        height: 70%;
        padding: 1em;
        border: 5px solid #333;
        background-color: white;
        text-align: left;
        z-index:1001;
        overflow: auto;
        font-size:16px;
    }
</style>


</html>
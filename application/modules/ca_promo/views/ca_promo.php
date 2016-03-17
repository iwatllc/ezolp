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
                            <th width="15%"></th>
                            <th width="15%">Code</th>
                            <th width="40%">Description</th>
                            <th width="5%">Months</th>
                            <th width="5%">Percentage</th>
                            <th width="10%">Start Date</th>
                            <th width="10%">End Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($ca_promos as $promo)
                        {
                            echo '<tr id ="'.$promo->id.'">';
                            echo '<td>'.form_checkbox('promocodes[]', $promo->id).'&nbsp;&nbsp;<button type="button" id="'.$promo->id.'" class="btn btn-success m-r-5 m-b-5 editpromo"><i class="fa fa-pencil"></i> Edit</button></td>';
                            echo '<td>'.$promo->code.'</td>';
                            echo '<td>'.$promo->description.'</td>';
                            echo '<td>'.$promo->months.'</td>';
                            echo '<td>'.$promo->percentage.'%</td>';
                            echo '<td>'.date('m-d-Y', strtotime($promo -> startdate)).'</td>';
                            echo '<td>'.date('m-d-Y', strtotime($promo -> enddate)).'</td>';
                            echo '</tr>';
                            ?>

                            <!---------------- EDIT PROMO CODE BEGINS ---------------------------->
                            <div id="edit-popup<?php echo $promo->id?>">
                                <div class="form-group" id="editcodefield<?php echo $promo->id?>">
                                    <label class="col-md-2 control-label">Edit Code:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $data = array(
                                            'name'          => 'promocode',
                                            'id'            => 'editcode'.$promo->id,
                                            'value'         => set_value('promocode', $promo->code),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => 'Promo Code Name',
                                            'data-parsley-required' => 'true',
                                        );
                                        echo form_input($data);
                                        echo '<span class="form-control-feedback" id="editcode-err<?php echo $promo->id?>"></span>';
                                        ?>
                                    </div>
                                </div>
                                <br/><br/>
                                <div class="form-group" id="editdescriptionfield<?php echo $promo->id?>">
                                    <label class="col-md-2 control-label">Description:</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'description',
                                            'id'            => 'editdescription'.$promo->id,
                                            'value'         => set_value('description', $promo->description),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => 'Promo Code Description',
                                            'data-parsley-required' => 'true',
                                            'rows'          => '3',
                                            'style'        => 'resize:horizontal;'
                                        );
                                        echo form_textarea($data);
                                        echo '<span class="form-control-feedback" id="editdescription-err<?php echo $promo->id?>"></span>';
                                        ?>
                                    </div>
                                </div>
                                <br/><br/><br/><br/>
                                <div class="form-group" id="editdatesfield<?php echo $promo->id?>">
                                    <label class="col-md-2 control-label">Dates Valid:</label>
                                    <div class="col-md-7 input-group input-daterange">
                                        <?php
                                        $BegDate = array(
                                            'name'          =>  'begindate',
                                            'id'            =>  'editbegindate'.$promo->id,
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
                                            'id'            =>  'editenddate'.$promo->id,
                                            'value'         =>  set_value('addenddate', date("m/d/Y", strtotime($promo->enddate)) ),
                                            'placeholder'   =>  date("m/d/Y", strtotime('+7 days')),
                                            'class'         =>  'form-control'
                                        );

                                        echo form_input($EndDate);
                                        echo '<span class="form-control-feedback" id="editdates-err<?php echo $promo->id?>"></span>';
                                        ?>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-group" id="editmonthsfield<?php echo $promo->id?>">
                                    <label class="col-md-2 control-label">Months:</label>
                                    <div class="col-md-2">
                                        <select id="editmonths<?php echo $promo->id; ?>" class="form-control">
                                            <option value="1" <?php if($promo->months == '1'){ echo 'selected'; } ?>>1</option>
                                            <option value="2" <?php if($promo->months == '2'){ echo 'selected'; } ?>>2</option>
                                            <option value="3" <?php if($promo->months == '3'){ echo 'selected'; } ?>>3</option>
                                            <option value="4" <?php if($promo->months == '3'){ echo 'selected'; } ?>>4</option>
                                            <option value="5" <?php if($promo->months == '3'){ echo 'selected'; } ?>>5</option>
                                            <option value="6" <?php if($promo->months == '3'){ echo 'selected'; } ?>>6</option>
                                            <option value="7" <?php if($promo->months == '3'){ echo 'selected'; } ?>>7</option>
                                            <option value="8" <?php if($promo->months == '3'){ echo 'selected'; } ?>>8</option>
                                            <option value="9" <?php if($promo->months == '3'){ echo 'selected'; } ?>>9</option>
                                            <option value="10" <?php if($promo->months == '3'){ echo 'selected'; } ?>>10</option>
                                            <option value="11" <?php if($promo->months == '3'){ echo 'selected'; } ?>>11</option>
                                            <option value="12" <?php if($promo->months == '3'){ echo 'selected'; } ?>>12</option>
                                        </select>
                                        <span class="form-control-feedback" id="editmonths-err<?php echo $promo->id?>"></span>
                                    </div>
                                </div>
                                <br/>
                                <br/>
                                <div class="form-group" id="editpercentagefield<?php echo $promo->id?>">
                                    <label class="col-md-2 control-label">Percentage:</label>
                                    <div class="col-md-2 input-group " style="padding-left:1em">
                                        <?php
                                        $data = array(
                                            'name'          => 'percentage',
                                            'id'            => 'editpercentage'.$promo->id,
                                            'value'         => set_value('editpercentage', $promo->percentage),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'onkeypress'    => 'return event.charCode >= 48 && event.charCode <= 57',
                                            'maxlength'     => '3',
                                            'data-parsley-required' => 'true',
                                        );
                                        echo form_input($data);
                                        echo '<span class="input-group-addon">%</span>';
                                        echo '<span class="form-control-feedback" id="editpercentage-err<?php echo $promo->id?>"></span>';
                                        ?>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <button type="button" id="editpromo-submit" name="<?php echo $promo->id ?>" class="btn btn-info m-r-5 m-b-5 editpromo-submit"><i class="fa fa-edit"></i> Update Promo Code</button>
                                    <button type="button" id="cancelpromo-btn" name="<?php echo $promo->id ?>" class="btn btn-warning m-r-5 m-b-5"><i class="fa fa-times"></i> Cancel</button>
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
        $('#overlay, #edit-popup'+id).css('display', 'block');
    });

    // On Overlay or Cancel Promo button click, hide Add Promo form
    $(document).on('click', '#overlay, #cancelpromo-btn', function() {
        var id = $(this).attr("name");
        $('#overlay, #add-popup, [id^="edit-popup"]').css('display', 'none', 'none');
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

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "ca_promo/Ca_promo/ajax_add_promocode",
            dataType: 'json',
            data: {code:code, description:description, begindate:begindate, enddate:enddate, months:months, percentage:percentage},
            success: function(res) {
                if (res) {

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
                        '<td><input type="checkbox" name="promocodes[]" value="' + res.id + '"/>&nbsp;&nbsp;<button type="button" id="'+res.id+'" class="btn btn-success m-r-5 m-b-5 editpromo"><i class="fa fa-pencil"></i> Edit</button></td>' +
                        '<td>' + res.code + '</td>' +
                        '<td>' + res.description + '</td>' +
                        '<td>' + res.months + '</td>' +
                        '<td>' + res.percentage + '&#37;</td>' +
                        '<td>' + res.begindate + '</td>' +
                        '<td>' + res.enddate + '</td>';

                    // Add row to table
                    row = $('<tr id="' + res.id + '" ></tr>');
                    row.append(newtr).prependTo('#promo-table');

                    // Put all info just added in edit charge FORM
                    var editchargeform =
                        '<div id="edit-popup'+res.id+'">' +
                        '<div class="form-group" id="editcodefield'+res.id+'">' +
                        '<label class="col-md-2 control-label">Edit Code:</label>' +
                        '<div class="col-md-3">' +
                        '<input type="text" name="promocode" value="'+res.code+'" id="editcode'+res.id+'" class="form-control" placeholder="Promo Code Name" data-parsley-required="true"  />' +
                        '<span class="form-control-feedback" id="editcode-err'+res.id+'"></span>' +
                        '</div>' +
                        '</div>' +
                        '<br/><br/>' +
                        '<div class="form-group" id="editdescriptionfield'+res.id+'">' +
                        '<label class="col-md-2 control-label">Description:</label>' +
                        '<div class="col-md-9">' +
                        '<textarea name="description" cols="40" rows="3" id="editdescription'+res.id+'" class="form-control" type="text" placeholder="Promo Code Description" data-parsley-required="true" style="resize:horizontal;" >'+res.description+'</textarea>' +
                        '<span class="form-control-feedback" id="editdescription-err'+res.id+'"></span>' +
                        '</div>' +
                        '</div>' +
                        '<br/><br/><br/><br/>' +
                        '<div class="form-group" id="editdatesfield'+res.id+'">' +
                        '<label class="col-md-2 control-label">Dates Valid:</label>' +
                        '<div class="col-md-7 input-group input-daterange">' +
                        '<input type="text" name="begindate" value="'+res.begindate+'" id="editbegindate'+res.id+'" placeholder="'+res.begindate+'" class="form-control"  />' +
                        '<span class="input-group-addon">to</span>' +
                        '<input type="text" name="enddate" value="'+res.enddate+'" id="editenddate'+res.id+'" placeholder="'+res.enddate+'" class="form-control"  />' +
                        '<span class="form-control-feedback" id="editdates-err'+res.id+'"></span>                                    ' +
                        '</div>' +
                        '</div>' +
                        '<br/>' +
                        '<div class="form-group" id="editmonthsfield'+res.id+'">' +
                        '<label class="col-md-2 control-label">Months:</label>' +
                        '<div class="col-md-2">' +
                        '<select id="editmonths'+res.id+'" class="form-control">';
                    for(var x = 1; x < 13; x++)
                    {
                        var selected = res.months;
                        if (x == selected) { selected = 'selected'; } else { selected = ''; }
                        editchargeform += '<option value="'+x+'"'+selected+'>'+x+'</option>';
                    }
                    editchargeform +=   '</select>' +
                        '<span class="form-control-feedback" id="editmonths-err'+res.id+'"></span>' +
                        '</div>' +
                        '</div>' +
                        '<br/>' +
                        '<br/>' +
                        '<div class="form-group" id="editpercentagefield'+res.id+'">' +
                        '<label class="col-md-2 control-label">Percentage:</label>' +
                        '<div class="col-md-2 input-group " style="padding-left:1em">' +
                        '<input type="text" name="percentage" value="'+res.percentage+'" id="editpercentage'+res.id+'" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3" data-parsley-required="true"  />' +
                        '<span class="input-group-addon">%</span><span class="form-control-feedback" id="editpercentage-err'+res.id+'"></span>' +
                        '</div>' +
                        '</div>' +
                        '<div class="panel-body">' +
                        '<button type="button" id="editpromo-submit" name="'+res.id+'" class="btn btn-info m-r-5 m-b-5 editpromo-submit"><i class="fa fa-edit"></i> Update Promo Code</button>' +
                        '<button type="button" id="cancelpromo-btn" name="'+res.id+'" class="btn btn-warning m-r-5 m-b-5"><i class="fa fa-times"></i> Cancel</button>' +
                        '</div>' +
                        '</div>';

                    // Replace the Edit Charge form
                    $("div#edit-popup"+res.id).replaceWith(editchargeform);

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

    // Edit a Promo Code
    $(document).on('click', '#editpromo-submit', function(e) {
        e.preventDefault();

        var baseUrl = window.location .protocol + "//" + window.location.host + "/" + window.location.pathname.split('/')[1];

        // Replace button with animated loading gif
        $(this).attr('disabled', true).empty().prepend('<img src="'+baseUrl+'/assets/img/loading-gif.gif" />&nbsp; Updating Promo Code');

        var id = $(this).attr("name");

        // Set variables that will be posted
        var code = $("#editcode"+id).val();
        var description = $("#editdescription"+id).val();
        var begindate = $( "#editbegindate"+id).datepicker().val();
        var enddate = $( "#editenddate"+id).datepicker().val();
        var months = $("#editmonths"+id).val();
        var percentage = $("#editpercentage"+id).val();

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "ca_promo/Ca_promo/ajax_edit_promocode",
            dataType: 'json',
            data: {id:id, code:code, description:description, begindate:begindate, enddate:enddate, months:months, percentage:percentage},
            success: function(res) {
                if (res) {

                    // Replace button with original glyphicon
                    $('.editpromo-submit').removeAttr('disabled').empty().prepend('<i class="fa fa-plus"></i> Update Promo Code');

                    // remove previous error messages
                    $("#editcode-err"+res.id).empty();
                    $("#editdescription-err"+res.id).empty();
                    $("#editbegindate-err"+res.id).empty();
                    $("#editenddate-err"+res.id).empty();
                    $("#editmonths-err"+res.id).empty();
                    $("#editpercentage-err"+res.id).empty();

                    // check form validation first
                    if (res.code_error)
                    {
//                        $('#addcode-err').append(res.code_error); // display error message under Charge Category field
                        $('#editcodefield'+res.id).addClass('has-error'); // make field red
                    } else
                    {
                        $('#editcodefield'+res.id).removeClass('has-error'); // remove red field
                    }
                    if (res.description_error)
                    {
//                        $('#adddescription-err').append(res.description_error);
                        $('#editdescriptionfield'+res.id).addClass('has-error');
                    } else
                    {
                        $('#editdescriptionfield'+res.id).removeClass('has-error');
                    }
                    if (res.begindate_error || res.enddate_error)
                    {
//                        $('#adddates-err').append(res.enddate_error);
//                        $('#adddates-err').append(res.begindate_error);
                        $('#editdatesfield'+res.id).addClass('has-error');
                    } else
                    {
                        $('#editdatesfield'+res.id).removeClass('has-error');
                    }
                    if (res.months_error)
                    {
//                        $('#addmonths-err').append(res.months_error);
                        $('#editmonthsfield'+res.id).addClass('has-error');
                    } else
                    {
                        $('#editmonthsfield'+res.id).removeClass('has-error');
                    }
                    if (res.percentage_error)
                    {
//                        $('#addpercentage-err').append(res.percentage_error);
                        $('#editpercentagefield'+res.id).addClass('has-error');
                    } else
                    {
                        $('#editpercentagefield'+res.id).removeClass('has-error');
                    }

                    if (res.code_error || res.description_error || res.begindate_error || res.enddate_error || res.months_error || res.percentage_error)
                    {
                        return; // do not run any more javascript, there are errors on form
                    }

                    // Hide Add Promo form
                    $('#overlay, #edit-popup'+res.id).css('display', 'none');//

                    // reset all values on form after submission
                    $("#editcode"+res.id).val('');
                    $("#editdescription"+res.id).val('');
                    $("#editbegindate"+res.id).datepicker().val('');
                    $("#editenddate"+res.id).datepicker().val('');
                    $("#editmonths"+res.id).val('1');
                    $("#editpercentage"+res.id).val('');

                    // Update row in charge table
                    var newtr = '<tr id="' + res.id + '">' +
                        '<td>' +
                        '<input type="checkbox" name="promocodes[]" value="'+res.id+'"  /> &nbsp;&nbsp;<button type="button" id="'+res.id+'" class="btn btn-success m-r-5 m-b-5 editpromo"><i class="fa fa-pencil"></i> Edit</button>' +
                        '</td>' +
                        '<td>'+res.code+'</td>' +
                        '<td>'+res.description+'</td>' +
                        '<td>'+res.months+'</td>' +
                        '<td>'+res.percentage+'&#37;</td>' +
                        '<td>'+res.begindate+'</td>' +
                        '<td>'+res.enddate+'</td>' +
                        '</tr>';

                    $("tr#"+res.id).replaceWith(newtr);

                    // Put all info just added in edit charge FORM
                    var editchargeform =
                        '<div id="edit-popup'+res.id+'">' +
                            '<div class="form-group" id="editcodefield'+res.id+'">' +
                                '<label class="col-md-2 control-label">Edit Code:</label>' +
                                '<div class="col-md-3">' +
                                    '<input type="text" name="promocode" value="'+res.code+'" id="editcode'+res.id+'" class="form-control" placeholder="Promo Code Name" data-parsley-required="true"  />' +
                                    '<span class="form-control-feedback" id="editcode-err'+res.id+'"></span>' +
                                '</div>' +
                            '</div>' +
                            '<br/><br/>' +
                            '<div class="form-group" id="editdescriptionfield'+res.id+'">' +
                                '<label class="col-md-2 control-label">Description:</label>' +
                                '<div class="col-md-9">' +
                                    '<textarea name="description" cols="40" rows="3" id="editdescription'+res.id+'" class="form-control" type="text" placeholder="Promo Code Description" data-parsley-required="true" style="resize:horizontal;" >'+res.description+'</textarea>' +
                                    '<span class="form-control-feedback" id="editdescription-err'+res.id+'"></span>' +
                                '</div>' +
                            '</div>' +
                            '<br/><br/><br/><br/>' +
                        '<div class="form-group" id="editdatesfield'+res.id+'">' +
                            '<label class="col-md-2 control-label">Dates Valid:</label>' +
                            '<div class="col-md-7 input-group input-daterange">' +
                                '<input type="text" name="begindate" value="'+res.begindate+'" id="editbegindate'+res.id+'" placeholder="'+res.begindate+'" class="form-control"  />' +
                                '<span class="input-group-addon">to</span>' +
                                '<input type="text" name="enddate" value="'+res.enddate+'" id="editenddate'+res.id+'" placeholder="'+res.enddate+'" class="form-control"  />' +
                                '<span class="form-control-feedback" id="editdates-err'+res.id+'"></span>                                    ' +
                            '</div>' +
                        '</div>' +
                        '<br/>' +
                        '<div class="form-group" id="editmonthsfield'+res.id+'">' +
                        '<label class="col-md-2 control-label">Months:</label>' +
                    '<div class="col-md-2">' +
                        '<select id="editmonths'+res.id+'" class="form-control">';
                            for(var x = 1; x < 13; x++)
                            {
                                var selected = res.months;
                                if (x == selected) { selected = 'selected'; } else { selected = ''; }
                                editchargeform += '<option value="'+x+'"'+selected+'>'+x+'</option>';
                            }
    editchargeform +=   '</select>' +
                        '<span class="form-control-feedback" id="editmonths-err'+res.id+'"></span>' +
                        '</div>' +
                        '</div>' +
                        '<br/>' +
                        '<br/>' +
                        '<div class="form-group" id="editpercentagefield'+res.id+'">' +
                        '<label class="col-md-2 control-label">Percentage:</label>' +
                    '<div class="col-md-2 input-group " style="padding-left:1em">' +
                        '<input type="text" name="percentage" value="'+res.percentage+'" id="editpercentage'+res.id+'" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3" data-parsley-required="true"  />' +
                        '<span class="input-group-addon">%</span><span class="form-control-feedback" id="editpercentage-err'+res.id+'"></span>' +
                        '</div>' +
                        '</div>' +
                        '<div class="panel-body">' +
                        '<button type="button" id="editpromo-submit" name="'+res.id+'" class="btn btn-info m-r-5 m-b-5 editpromo-submit"><i class="fa fa-edit"></i> Update Promo Code</button>' +
                        '<button type="button" id="cancelpromo-btn" name="'+res.id+'" class="btn btn-warning m-r-5 m-b-5"><i class="fa fa-times"></i> Cancel</button>' +
                        '</div>' +
                    '</div>';

                    // Replace the Edit Charge form
                    $("div#edit-popup"+res.id).replaceWith(editchargeform);



                    // Highlight row that was just updated
                    setTimeout(function(){ $("tr#"+res.id).css('background-color','transparent').effect("highlight", {color:"#5C8116"}, 4000); });

//                    $('#num_jobnotes').html('<span class="badge">' + res.num_jobnotes + '</span>'); // update total number
                }
            }
        });

    });



    $( document ).ready(function() {
        $( "#addbegindate" ).datepicker("setDate", new Date());
        $( "#addenddate" ).datepicker("setDate", '7');

        $( '[id^=editbegindate]').datepicker();
        $( '[id^=editenddate]' ).datepicker();
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

    [id^="edit-popup"] {
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

    td {
        page-break-inside: avoid;
    }
</style>


</html>
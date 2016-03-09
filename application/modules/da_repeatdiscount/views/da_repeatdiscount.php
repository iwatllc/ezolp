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
                    <h4 class="panel-title">Manage Display Ad Repeat Discounts</h4>
                </div>
                <div class="panel-body">
                    <button type="button" id ="deldiscount-btn" class="btn btn-danger m-r-5 m-b-5"><i class="fa fa-trash-o"></i> Delete</button>
                    <button type="button" id="adddiscount-btn" class="btn btn-info m-r-5 m-b-5"><i class="fa fa-plus"></i> Add</button>
                </div>

                <div id="overlay"></div>

                <!---------------- ADD REPEAT DISCOUNT BEGINS ---------------------------->
                <div id="add-popup">
                    <br/>
                    <div class="form-group" id="addissuesfield">
                        <label class="col-md-3 control-label">Number of Issues:</label>
                        <div class="col-md-2 input-group">
                            <?php
                            $data = array(
                                'name'          => 'issues',
                                'id'            => 'addissues',
                                'value'         => set_value('addissues'),
                                'class'         => 'form-control',
                                'type'          => 'text',
                                'onkeypress'    => 'return event.charCode >= 48 && event.charCode <= 57',
                                'maxlength'     => '2',
                                'data-parsley-required' => 'true'
                            );
                            echo form_input($data);
                            echo '<span class="input-group-addon">ISSUES</span>';
                            echo '<span class="form-control-feedback" id="addissues-err"></span>';
                            ?>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="form-group" id="addpercentagefield">
                        <label class="col-md-3 control-label">Percentage Discount:</label>
                        <div class="col-md-2 input-group">
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
                    <br/><br/>
                    <div class="panel-body">
                        <button type="button" id="adddiscount-submit" class="btn btn-info m-r-5 m-b-5"><i class="fa fa-plus"></i> Add Repeat Discount</button>
                        <button type="button" id="canceldiscount-btn" class="btn btn-warning m-r-5 m-b-5"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                </div>
                <!---------------- ADD REPEAT DISCOUNT ENDS ---------------------------->

                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="discount-table">
                        <thead>
                        <tr>
                            <th width="15%"></th>
                            <th width="30%">Number of Issues</th>
                            <th width="25%">Discount</th>
                            <th width="15%">Created</th>
                            <th width="15%">Modified</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($da_discounts as $discount)
                        {
                            echo '<tr id ="'.$discount -> id.'">';
                            echo '<td>'.form_checkbox('discounts[]', $discount -> id).'&nbsp;&nbsp;<button type="button" id="'.$discount->id.'" class="btn btn-success m-r-5 m-b-5 editdiscount"><i class="fa fa-pencil"></i> Edit</button></td>';
                            echo '<td>'.$discount -> numissues.' issues</td>';
                            echo '<td>'.$discount -> percentagediscount.' &#37;</td>';
                            echo '<td>'.date('m-d-Y', strtotime($discount -> created)).'</td>';
                            echo '<td>'.(($discount->modified == '')? '' : date('m-d-Y', strtotime($discount -> modified))).'</td>';
                            echo '</tr>';
                            ?>

                            <!---------------- EDIT REPEAT DISCOUNTS BEGINS ---------------------------->
                            <div id="edit-popup<?php echo $discount->id; ?>">
                                <br/>
                                <div class="form-group" id="editissuesfield<?php echo $discount->id; ?>">
                                    <label class="col-md-3 control-label">Number of Issues:</label>
                                    <div class="col-md-2 input-group">
                                        <?php
                                        $data = array(
                                            'name'          => 'issues',
                                            'id'            => 'editissues'.$discount->id,
                                            'value'         => set_value('editissues', $discount->numissues),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'onkeypress'    => 'return event.charCode >= 48 && event.charCode <= 57',
                                            'maxlength'     => '2',
                                            'data-parsley-required' => 'true'
                                        );
                                        echo form_input($data);
                                        ?>
                                        <span class="input-group-addon">ISSUES</span>
                                        <span class="form-control-feedback" id="editissues-err<?php echo $discount->id; ?>"></span>
                                    </div>
                                </div>
                                <br/><br/>
                                <div class="form-group" id="editpercentagefield<?php echo $discount->id; ?>">
                                    <label class="col-md-3 control-label">Percentage Discount:</label>
                                    <div class="col-md-2 input-group">
                                        <?php
                                        $data = array(
                                            'name'          => 'percentage',
                                            'id'            => 'editpercentage'.$discount->id,
                                            'value'         => set_value('editpercentage', $discount->percentagediscount),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'onkeypress'    => 'return event.charCode >= 48 && event.charCode <= 57',
                                            'maxlength'     => '3',
                                            'data-parsley-required' => 'true',
                                        );
                                        echo form_input($data);
                                        ?>
                                        <span class="input-group-addon">%</span>
                                        <span class="form-control-feedback" id="editpercentage-err<?php echo $discount->id; ?>"></span>
                                    </div>
                                </div>
                                <br/><br/>
                                <div class="panel-body">
                                    <button type="button" id="editdiscount-submit" name="<?php echo $discount->id; ?>" class="btn btn-info m-r-5 m-b-5 editdiscount-submit"><i class="fa fa-edit"></i> Update Discount</button>
                                    <button type="button" id="canceldiscount-btn" name="<?php echo $discount->id; ?>" class="btn btn-warning m-r-5 m-b-5"><i class="fa fa-times"></i> Cancel</button>
                                </div>
                            </div>
                            <!---------------- EDIT REPEAT DISCOUNTS ENDS ---------------------------->

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

    // On Add Discount button click, show Add Discount form
    $(document).on('click', '#adddiscount-btn', function() {
        $('#overlay, #add-popup').css('display', 'block');
    });

    // Open Edit Charge form
    $('#discount-table').on('click', '.editdiscount', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#overlay, #edit-popup'+id).css('display', 'block');
    });

    // On Overlay or Cancel Promo button click, hide Add Promo form
    $(document).on('click', '#overlay, #canceldiscount-btn', function() {
        var id = $(this).attr("name");
        $('#overlay, #add-popup, [id^="edit-popup"]').css('display', 'none', 'none');
    });

    // Add a Repeat Discount
    $(document).on('click', '#adddiscount-submit', function(e) {
        e.preventDefault();

        var baseUrl = window.location .protocol + "//" + window.location.host + "/" + window.location.pathname.split('/')[1];

        // Replace button with animated loading gif
        $(this).attr('disabled', true).empty().prepend('<img src="'+baseUrl+'/assets/img/loading-gif.gif" />&nbsp; Adding Repeat Discount');

        // Set variables that will be posted
        var issues = $("#addissues").val();
        var percentage = $("#addpercentage").val();

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "da_repeatdiscount/Da_repeatdiscount/ajax_add_discount",
            dataType: 'json',
            data: { issues:issues, percentage:percentage },
            success: function(res) {
                if (res) {

                    // Replace button with original glyphicon
                    $('#adddiscount-submit').removeAttr('disabled').empty().prepend('<i class="fa fa-plus"></i> Add Repeat Discount');

                    // remove previous error messages
                    $("#addissues-err").empty();
                    $("#addpercentage-err").empty();

                    // check form validation first
                    if (res.issues_error)
                    {
//                        $('#addissues-err').append(res.issues_error); // display error message under Charge Category field
                        $('#addissuesfield').addClass('has-error'); // make field red
                    } else
                    {
                        $('#addissuesfield').removeClass('has-error'); // remove red field
                    }
                    if (res.percentage_error)
                    {
//                        $('#addbwdiscount-err').append(res.description_error);
                        $('#addpercentagefield').addClass('has-error');
                    } else
                    {
                        $('#addpercentagefield').removeClass('has-error');
                    }

                    if (res.issues_error || res.percentage_error)
                    {
                        return; // do not run any more javascript, there are errors on form
                    }

                    // Hide Add Discount form
                    $('#overlay, #add-popup').css('display', 'none');//

                    // reset all values on form after submission
                    $("#addissues").val('');
                    $("#addpercentage").val('');

                    var newtr =
                        '<td><input type="checkbox" name="discounts[]" value="'+res.id+'" /> &nbsp;&nbsp;<button type="button" id="'+res.id+'" class="btn btn-success m-r-5 m-b-5 editdiscount"><i class="fa fa-pencil"></i> Edit</button></td>' +
                        '<td>' + res.issues + ' issues</td>' +
                        '<td>' + res.percentage + ' &#37;</td>' +
                        '<td>' + res.created + '</td>' +
                        '<td></td>';

                    // Add row to table
                    row = $('<tr id="' + res.id + '" ></tr>');
                    row.append(newtr).prependTo('#discount-table');

                    // Put all info just added in edit charge FORM
                    var editchargeform =
                        '<div id="edit-popup'+res.id+'">' +
                            '<br/>' +
                            '<div class="form-group" id="editissuesfield'+res.id+'">' +
                                '<label class="col-md-3 control-label">Number of Issues:</label>' +
                                '<div class="col-md-2 input-group">' +
                                    '<input type="text" name="issues" value="'+res.issues+'" id="editissues'+res.id+'" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="2" data-parsley-required="true"  />' +
                                    '<span class="input-group-addon">ISSUES</span>' +
                                    '<span class="form-control-feedback" id="editissues-err'+res.id+'"></span>' +
                                '</div>' +
                            '</div>' +
                            '<br/><br/>' +
                            '<div class="form-group" id="editpercentagefield'+res.id+'">' +
                                '<label class="col-md-3 control-label">Percentage Discount:</label>' +
                                '<div class="col-md-2 input-group">' +
                                    '<input type="text" name="percentage" value="'+res.percentage+'" id="editpercentage'+res.id+'" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3" data-parsley-required="true"  />' +
                                    '<span class="input-group-addon">%</span>' +
                                    '<span class="form-control-feedback" id="editpercentage-err'+res.id+'"></span>' +
                                '</div>' +
                            '</div>' +
                            '<br/><br/>' +
                            '<div class="panel-body">' +
                                '<button type="button" id="editdiscount-submit" name="'+res.id+'" class="btn btn-info m-r-5 m-b-5 editdiscount-submit"><i class="fa fa-edit"></i> Update Discount</button>' +
                                '<button type="button" id="canceldiscount-btn" name="'+res.id+'" class="btn btn-warning m-r-5 m-b-5"><i class="fa fa-times"></i> Cancel</button>' +
                            '</div>' +
                        '</div>';

                    // Replace the Edit Charge form
                    $("div#edit-popup"+res.id).replaceWith(editchargeform);

                    // Highlight row that was just updated
                    setTimeout(function(){ $("tr#"+res.id).css('background-color','transparent').effect("highlight", {color:"#5C8116"}, 4000); });

//                    $('#num_discounts').html('<span class="badge">' + res.num_discounts + '</span>'); // update total number
                }
            }
        });

    });

    // Edit a Repeat Discount
    $(document).on('click', '#editdiscount-submit', function(e) {
        e.preventDefault();

        var baseUrl = window.location .protocol + "//" + window.location.host + "/" + window.location.pathname.split('/')[1];

        // Replace button with animated loading gif
        $(this).attr('disabled', true).empty().prepend('<img src="'+baseUrl+'/assets/img/loading-gif.gif" />&nbsp; Updating Repeat Discount');

        var id = $(this).attr("name");

        // Set variables that will be posted
        var issues = $("#editissues"+id).val();
        var percentage = $("#editpercentage"+id).val();

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "da_repeatdiscount/Da_repeatdiscount/ajax_edit_discount",
            dataType: 'json',
            data: { id:id, issues:issues, percentage:percentage },
            success: function(res) {
                if (res) {

                    // Replace button with original glyphicon
                    $('.editdiscount-submit').removeAttr('disabled').empty().prepend('<i class="fa fa-plus"></i> Update Repeat Discount');

                    // remove previous error messages
                    $("#editissues-err"+res.id).empty();
                    $("#editpercentage-err"+res.id).empty();

                    // check form validation first
                    if (res.issues_error)
                    {
//                        $('#addcode-err').append(res.code_error); // display error message under Charge Category field
                        $('#editissuesfield'+res.id).addClass('has-error'); // make field red
                    } else
                    {
                        $('#editissuesfield'+res.id).removeClass('has-error'); // remove red field
                    }
                    if (res.percentage_error)
                    {
//                        $('#adddescription-err').append(res.description_error);
                        $('#editpercentagefield'+res.id).addClass('has-error');
                    } else
                    {
                        $('#editpercentagefield'+res.id).removeClass('has-error');
                    }

                    if (res.issues_error || res.issues_error)
                    {
                        return; // do not run any more javascript, there are errors on form
                    }

                    // Hide Add Promo form
                    $('#overlay, #edit-popup'+res.id).css('display', 'none');//

                    // reset all values on form after submission
                    $("#editissues"+res.id).val('');
                    $("#editpercentage"+res.id).val('');

                    // Update row in charge table
                    var newtr = '<tr id="' + res.id + '">' +
                        '<td>' +
                        '<input type="checkbox" name="discounts[]" value="'+res.id+'"  /> &nbsp;&nbsp;<button type="button" id="'+res.id+'" class="btn btn-success m-r-5 m-b-5 editdiscount"><i class="fa fa-pencil"></i> Edit</button>' +
                        '</td>' +
                        '<td>'+res.issues+' issues</td>' +
                        '<td>'+res.percentage+' &#37;</td>' +
                        '<td>'+res.created+'</td>' +
                        '<td>'+res.modified+'</td>' +
                        '</tr>';

                    $("tr#"+res.id).replaceWith(newtr);
                    // Put all info just added in edit charge FORM

                    var editchargeform =
                        '<div id="edit-popup'+res.id+'">' +
                        '<br/>' +
                        '<div class="form-group" id="editissuesfield'+res.id+'">' +
                        '<label class="col-md-3 control-label">Number of Issues:</label>' +
                        '<div class="col-md-2 input-group">' +
                        '<input type="text" name="issues" value="'+res.issues+'" id="editissues'+res.id+'" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="2" data-parsley-required="true"  />' +
                        '<span class="input-group-addon">ISSUES</span>' +
                        '<span class="form-control-feedback" id="editissues-err'+res.id+'"></span>' +
                        '</div>' +
                        '</div>' +
                        '<br/><br/>' +
                        '<div class="form-group" id="editpercentagefield'+res.id+'">' +
                        '<label class="col-md-3 control-label">Percentage Discount:</label>' +
                        '<div class="col-md-2 input-group">' +
                        '<input type="text" name="percentage" value="'+res.percentage+'" id="editpercentage'+res.id+'" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3" data-parsley-required="true"  />' +
                        '<span class="input-group-addon">%</span>' +
                        '<span class="form-control-feedback" id="editpercentage-err'+res.id+'"></span>' +
                        '</div>' +
                        '</div>' +
                        '<br/><br/>' +
                        '<div class="panel-body">' +
                        '<button type="button" id="editdiscount-submit" name="'+res.id+'" class="btn btn-info m-r-5 m-b-5 editdiscount-submit"><i class="fa fa-edit"></i> Update Discount</button>' +
                        '<button type="button" id="canceldiscount-btn" name="'+res.id+'" class="btn btn-warning m-r-5 m-b-5"><i class="fa fa-times"></i> Cancel</button>' +
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


    // Delete Discounts
    $(document).on('click','#deldiscount-btn', function(e){
        e.preventDefault();

        var baseUrl = window.location .protocol + "//" + window.location.host + "/" + window.location.pathname.split('/')[1];

        var selectedDiscounts = $("input[name='discounts[]']");

        // If no items are checked, do not delete anything, just return
        if(!selectedDiscounts.is(':checked'))
            return;

        // Disable button and replace with animated trashcan gif
        $(this).attr('disabled', true).empty().prepend('<img src="'+baseUrl+'/assets/img/trash-can.gif" /> Deleting');

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "da_repeatdiscount/Da_repeatdiscount/ajax_del_discount",
            dataType: 'json',
            data: selectedDiscounts.serialize(),
            success: function(res) {
                if (res) {
                    // Replace button with original glyphicon
                    $('#deldiscount-btn').removeAttr('disabled').empty().prepend('<i class="fa fa-trash-o"></i> Delete');

                    // Remove rows from returned IDs in charge table
                    for (var i = 0; i < Object.keys(res).length - 1; i++)
                    {
                        $('table#discount-table tr#'+Number(res[i])).remove(); // remove row from table
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

    $("form input[name='bwdiscount']").maskMoney();
    $("form input[name='colordiscount']").maskMoney();


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
        height: 45%;
        padding: 1em;
        border: 5px solid #333;
        background-color: white;
        text-align: left;
        z-index:1001;
        overflow: auto;
        font-issues:16px;
    }

    [id^="edit-popup"] {
        color: #333;
        display: none;
        position: fixed;
        top: 10%;
        left: 18%;
        width:70%;
        min-width:70%;
        height: 45%;
        padding: 1em;
        border: 5px solid #333;
        background-color: white;
        text-align: left;
        z-index:1001;
        overflow: auto;
        font-issues:16px;
    }
</style>


</html>
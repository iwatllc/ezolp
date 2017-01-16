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
                    <h4 class="panel-title">Manage Classified Ad Monthly Pricings</h4>
                </div>
                <div class="panel-body">
                    <button type="button" id ="delpricing-btn" class="btn btn-danger m-r-5 m-b-5"><i class="fa fa-trash-o"></i> Delete</button>
                    <button type="button" id="addpricing-btn" class="btn btn-info m-r-5 m-b-5"><i class="fa fa-plus"></i> Add</button>
                </div>

                <div id="overlay"></div>

                <!---------------- ADD MONTHLY PRICING BEGINS ---------------------------->
                <div id="add-popup">
                    <div class="form-group" id="addnamefield">
                        <label class="col-md-2 control-label">Name:</label>
                        <div class="col-md-3">
                            <?php
                            $data = array(
                                'name'          => 'name',
                                'id'            => 'addname',
                                'value'         => set_value('addname'),
                                'class'         => 'form-control',
                                'type'          => 'text',
                                'placeholder'   => 'Name of Classified Pricing',
                                'data-parsley-required' => 'true',
                            );
                            echo form_input($data);
                            echo '<span class="form-control-feedback" id="addname-err"></span>';
                            ?>
                        </div>
                    </div>
                    <br/><br/><br/>
                    <div class="form-group" id="addfeefield">
                        <label class="col-md-2 control-label"> Fee:</label>
                        <div class="col-md-3 input-group"  style="padding-left:1em">
                            <?php
                            $data = array(
                                'name'          => 'fee',
                                'id'            => 'addfee',
                                'value'         => set_value('addfee'),
                                'class'         => 'form-control',
                                'type'          => 'text',
                                'data-parsley-required' => 'true',
                            );
                            echo '<span class="input-group-addon">$</span>';
                            echo form_input($data);
                            echo '<span class="form-control-feedback" id="addfee-err"></span>';
                            ?>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group" id="addfixedfield">
                        <label class="col-md-2 control-label"> Fixed Amount:</label>
                        <div class="col-md-1 input-group"  style="padding-left:1em">
                            <?php
                            $data = array(
                                'name'          => 'fixed',
                                'id'            => 'addfixed',
                                'value'         => set_value('addfixed', 1),
                                'class'         => 'form-control',
                                'data-parsley-required' => 'true',
                            );
                            echo form_checkbox($data);
                            echo '<span class="form-control-feedback" id="addfixed-err"></span>';
                            ?>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group" id="addcharsizefield">
                        <label class="col-md-2 control-label">Max Character Size:</label>
                        <div class="col-md-3 input-group"  style="padding-left:1em">
                            <?php
                            $data = array(
                                'name'          => 'charsize',
                                'id'            => 'addcharsize',
                                'value'         => set_value('addcharsize'),
                                'class'         => 'form-control',
                                'type'          => 'text',
                                'data-parsley-required' => 'true',
                            );
                            echo form_input($data);
                            echo '<span class="input-group-addon">characters</span>';
                            echo '<span class="form-control-feedback" id="addcharsize-err"></span>';
                            ?>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="panel-body">
                        <button type="button" id="addpricing-submit" class="btn btn-info m-r-5 m-b-5"><i class="fa fa-plus"></i> Add Monthly Pricing</button>
                        <button type="button" id="cancelpricing-btn" class="btn btn-warning m-r-5 m-b-5"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                </div>
                <!---------------- ADD MONTHLY PRICING ENDS ---------------------------->


                <div class="panel-body">

                    <table class="table table-bordered table-striped" id="pricing-table">
                        <thead>
                        <tr>
                            <th width="15%"></th>
                            <th width="25%">Name</th>
                            <th width="10%">Fee</th>
                            <th width="10%">Fixed</th>
                            <th width="20%">Max Character Size</th>
                            <th width="10%">Created</th>
                            <th width="10%">Modified</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($ca_pricings as $price)
                        {
                            echo '<tr id ="'.$price -> id.'">';
                            echo '<td>'.form_checkbox('pricings[]', $price -> id).'&nbsp;&nbsp;<button type="button" id="'.$price -> id.'" class="btn btn-success m-r-5 m-b-5 editpricing"><i class="fa fa-pencil"></i> Edit</button></td>';
                            echo '<td>'.$price -> name.'</td>';
                            echo '<td>&#36; '.$price -> fee.'</td>';
                            if ($price->fixed == 0)
                                echo '<td>No</td>';
                            else
                                echo '<td>Yes</td>';
                            echo '<td>'.$price -> maxcharsize.'</td>';
                            echo '<td>'.date('m-d-Y', strtotime($price -> created)).'</td>';
                            echo '<td>'.(($price->modified == '')? '' : date('m-d-Y', strtotime($price -> modified))).'</td>';
                            echo '</tr>';
                            ?>

                            <!---------------- EDIT MONTHLY PRICING BEGINS ---------------------------->
                            <div id="edit-popup<?php echo $price->id; ?>">
                                <div class="form-group" id="editnamefield<?php echo $price->id; ?>">
                                    <label class="col-md-2 control-label">Name:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $data = array(
                                            'name'          => 'name',
                                            'id'            => 'editname'.$price->id,
                                            'value'         => set_value('editname', $price->name),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => 'Name of Pricing',
                                            'data-parsley-required' => 'true',
                                        );
                                        echo form_input($data);
                                        ?>
                                        <span class="form-control-feedback" id="editsize-err<?php echo $price->id; ?>"></span>
                                    </div>
                                </div>
                                <br/><br/><br/>
                                <div class="form-group" id="editfeefield<?php echo $price->id; ?>">
                                    <label class="col-md-2 control-label">Fee:</label>
                                    <div class="col-md-3 input-group"  style="padding-left:1em">
                                        <?php
                                        $data = array(
                                            'name'          => 'fee',
                                            'id'            => 'editfee'.$price->id,
                                            'value'         => set_value('editfee', $price->fee),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'data-parsley-required' => 'true',
                                        );
                                        echo '<span class="input-group-addon">$</span>';
                                        echo form_input($data);
                                        ?>
                                        <span class="form-control-feedback" id="editfee-err<?php echo $price->id; ?>"></span>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-group" id="editfixedfield">
                                    <label class="col-md-2 control-label"> Fixed Amount:</label>
                                    <div class="col-md-1 input-group"  style="padding-left:1em">
                                        <?php
                                        $data = array(
                                            'name'          => 'fixed',
                                            'id'            => 'editfixed'.$price->id,
                                            'value'         => set_value('editfixed', $price->fixed),
                                            'class'         => 'form-control',
                                            'data-parsley-required' => 'true',
                                        );
                                        echo form_checkbox($data);
                                        echo '<span class="form-control-feedback" id="editfixed-err"></span>';
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group" id="editcharsizefield<?php echo $price->id; ?>">
                                    <label class="col-md-2 control-label">Max Character Size:</label>
                                    <div class="col-md-3 input-group"  style="padding-left:1em">
                                        <?php
                                        $data = array(
                                            'name'          => 'charsize',
                                            'id'            => 'editcharsize'.$price->id,
                                            'value'         => set_value('editcharsize', $price->maxcharsize),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'data-parsley-required' => 'true',
                                        );
                                        echo form_input($data);
                                        echo '<span class="input-group-addon">characters</span>';
                                        ?>
                                        <span class="form-control-feedback" id="editcharsize-err<?php echo $price->id; ?>"></span>
                                    </div>
                                </div>
                                <br/><br/>
                                <div class="panel-body">
                                    <button type="button" id="editpricing-submit" name="<?php echo $price->id; ?>" class="btn btn-info m-r-5 m-b-5 editpricing-submit"><i class="fa fa-edit"></i> Update Pricing</button>
                                    <button type="button" id="cancelpricing-btn" name="<?php echo $price->id; ?>" class="btn btn-warning m-r-5 m-b-5"><i class="fa fa-times"></i> Cancel</button>
                                </div>
                            </div>
                            <!---------------- EDIT MONTHLY PRICING ENDS ---------------------------->

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

    // On Add Pricing button click, show Add Pricing form
    $(document).on('click', '#addpricing-btn', function() {
        $('#overlay, #add-popup').css('display', 'block');
    });

    // Open Edit Charge form
    $('#pricing-table').on('click', '.editpricing', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#overlay, #edit-popup'+id).css('display', 'block');
    });

    // On Overlay or Cancel Promo button click, hide Add Promo form
    $(document).on('click', '#overlay, #cancelpricing-btn', function() {
        var id = $(this).attr("name");
        $('#overlay, #add-popup, [id^="edit-popup"]').css('display', 'none', 'none');
    });

    // Add a Monthly Pricing
    $(document).on('click', '#addpricing-submit', function(e) {
        e.preventDefault();

        var baseUrl = window.location .protocol + "//" + window.location.host + "/" + window.location.pathname.split('/')[1];

        // Replace button with animated loading gif
        $(this).attr('disabled', true).empty().prepend('<img src="'+baseUrl+'/assets/img/loading-gif.gif" />&nbsp; Adding Monthly Price');

        // Set variables that will be posted
        var name = $("#addname").val();
        var fee = $("#addfee").val();
        if ($("#addfixed").is(":checked"))
            var fixed = 1;
        else
            var fixed = 0;
        var charsize = $( "#addcharsize" ).val();

        fee = parseFloat(fee.replace(/,/g, ''));
        charsize = parseFloat(charsize.replace(/,/g, ''));

        if(isNaN(fee))
            fee = 0.00;

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "ca_monthlypricing/ca_monthlypricing/ajax_add_pricing",
            dataType: 'json',
            data: { name:name, fee:fee, fixed:fixed, charsize:charsize },
            success: function(res) {
                if (res) {

                    // Replace button with original glyphicon
                    $('#addpricing-submit').removeAttr('disabled').empty().prepend('<i class="fa fa-plus"></i> Add Monthly Pricing');

                    // remove previous error messages
                    $("#addname-err").empty();
                    $("#addfee-err").empty();
                    $("#addcharsize-err").empty();

                    // check form validation first
                    if (res.name_error)
                    {
//                        $('#addname-err').append(res.name_error); // display error message under Charge Category field
                        $('#addnamefield').addClass('has-error'); // make field red
                    } else
                    {
                        $('#addnamefield').removeClass('has-error'); // remove red field
                    }
                    if (res.fee_error)
                    {
//                        $('#addfee-err').append(res.fee_error);
                        $('#addfeefield').addClass('has-error');
                    } else
                    {
                        $('#addfeefield').removeClass('has-error');
                    }
                    if (res.charsize_error)
                    {
//                        $('#addcharsize-err').append(res.charsize_error);
                        $('#addcharsizefield').addClass('has-error');
                    } else
                    {
                        $('#addcharsizefield').removeClass('has-error');
                    }

                    if (res.name_error || res.fee_error || res.charsize_error)
                    {
                        return; // do not run any more javascript, there are errors on form
                    }

                    // Hide Add Pricing form
                    $('#overlay, #add-popup').css('display', 'none');//

                    // reset all values on form after submission
                    $("#addname").val('');
                    $("#addfee").val('');
                    $("#addcharsize").val('');

                    if (res.fixed == 0)
                        var fixed = "No";
                    else
                        var fixed = "Yes";

                    var newtr =
                        '<td><input type="checkbox" name="pricings[]" value="'+res.id+'" /> &nbsp;&nbsp;<button type="button" id="'+res.id+'" class="btn btn-success m-r-5 m-b-5 editpricing"><i class="fa fa-pencil"></i> Edit</button></td>' +
                        '<td>' + res.name + '</td>' +
                        '<td>&#36; ' + res.fee + '</td>' +
                        '<td>' + fixed + '</td>' +
                        '<td>' + res.charsize + '</td>' +
                        '<td>' + res.created + '</td>' +
                        '<td></td>';

                    // Add row to table
                    row = $('<tr id="' + res.id + '" ></tr>');
                    row.append(newtr).prependTo('#pricing-table');

                    // Put all info just added in edit charge FORM
                    var editchargeform =
                        '<div id="edit-popup'+res.id+'">' +
                            '<div class="form-group" id="editnamefield'+res.id+'">' +
                                '<label class="col-md-2 control-label">Name:</label>' +
                                '<div class="col-md-3">' +
                                    '<input type="text" name="name" value="'+res.name+'" id="editname'+res.id+'" class="form-control" placeholder="Name of Classified Pricing" data-parsley-required="true"  />' +
                                    '<span class="form-control-feedback" id="editname-err'+res.id+'"></span>' +
                                '</div>' +
                            '</div>' +
                            '<br/><br/><br/>' +
                            '<div class="form-group" id="editfeefield'+res.id+'">' +
                                '<label class="col-md-2 control-label">Fee:</label>' +
                                '<div class="col-md-3 input-group"  style="padding-left:1em">' +
                                    '<span class="input-group-addon">$</span><input type="text" name="fee" value="'+res.fee+'" id="editfee'+res.id+'" class="form-control" data-parsley-required="true"  />' +
                                    '<span class="form-control-feedback" id="editfee-err'+res.id+'"></span>' +
                                '</div>' +
                            '</div>' +
                            '<br/>' +
                            '<div class="form-group" id="editcharsizefield'+res.id+'">' +
                                '<label class="col-md-2 control-label">Max Character Size:</label>' +
                                '<div class="col-md-3 input-group"  style="padding-left:1em">' +
                                    '<input type="text" name="charsize" value="'+res.charsize+'" id="editcharsize'+res.id+'" class="form-control" data-parsley-required="true"  />' +
                                    '<span class="input-group-addon">characters</span>' +
                                    '<span class="form-control-feedback" id="editcharsize-err'+res.id+'"></span>' +
                                '</div>' +
                            '</div>' +
                            '<br/><br/>' +
                            '<div class="panel-body">' +
                                '<button type="button" id="editpricing-submit" name="'+res.id+'" class="btn btn-info m-r-5 m-b-5 editpricing-submit"><i class="fa fa-edit"></i> Update Pricing</button>' +
                                '<button type="button" id="cancelpricing-btn" name="'+res.id+'" class="btn btn-warning m-r-5 m-b-5"><i class="fa fa-times"></i> Cancel</button>' +
                            '</div>' +
                        '</div>';

                    // Replace the Edit Charge form
                    $("div#edit-popup"+res.id).replaceWith(editchargeform);

                    // Highlight row that was just updated
                    setTimeout(function(){ $("tr#"+res.id).css('background-color','transparent').effect("highlight", {color:"#5C8116"}, 4000); })

//                    $('#num_pricings').html('<span class="badge">' + res.num_pricings + '</span>'); // update total number
                }
            }
        });

    });

    // Edit a Monthly Pricing
    $(document).on('click', '#editpricing-submit', function(e) {
        e.preventDefault();

        var baseUrl = window.location .protocol + "//" + window.location.host + "/" + window.location.pathname.split('/')[1];

        // Replace button with animated loading gif
        $(this).attr('disabled', true).empty().prepend('<img src="'+baseUrl+'/assets/img/loading-gif.gif" />&nbsp; Updating Monthly Pricing');

        var id = $(this).attr("name");

        // Set variables that will be posted
        var name = $("#editname"+id).val();
        var fee = $("#editfee"+id).val();
        if ($("#addfixed"+id).is(":checked"))
            var fixed = 1;
        else
            var fixed = 0;
        var charsize = $("#editcharsize"+id).val();

        fee = parseFloat(fee.replace(/,/g, ''));
        charsize = parseFloat(charsize.replace(/,/g, ''));

        if(isNaN(fee))
            fee = 0.00;

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "ca_monthlypricing/ca_monthlypricing/ajax_edit_pricing",
            dataType: 'json',
            data: {id:id, name:name, fee:fee, fixed:fixed, charsize:charsize},
            success: function(res) {
                if (res) {

                    // Replace button with original glyphicon
                    $('.editpricing-submit').removeAttr('disabled').empty().prepend('<i class="fa fa-plus"></i> Update Monthly Pricing');

                    // remove previous error messages
                    $("#editname-err"+res.id).empty();
                    $("#editfee-err"+res.id).empty();
                    $("#editcharsize-err"+res.id).empty();

                    // check form validation first
                    if (res.name_error)
                    {
//                        $('#addcode-err').append(res.code_error); // display error message under Charge Category field
                        $('#editnamefield'+res.id).addClass('has-error'); // make field red
                    } else
                    {
                        $('#editnamefield'+res.id).removeClass('has-error'); // remove red field
                    }
                    if (res.fee_error)
                    {
//                        $('#adddescription-err').append(res.description_error);
                        $('#editfeefield'+res.id).addClass('has-error');
                    } else
                    {
                        $('#editfeefield'+res.id).removeClass('has-error');
                    }
                    if (res.charsize_error)
                    {
//                        $('#addmonths-err').append(res.months_error);
                        $('#editcharsizefield'+res.id).addClass('has-error');
                    } else
                    {
                        $('#editcharsizefield'+res.id).removeClass('has-error');
                    }

                    if (res.name_error || res.fee_error || res.charsize_error)
                    {
                        return; // do not run any more javascript, there are errors on form
                    }

                    // Hide Add Promo form
                    $('#overlay, #edit-popup'+res.id).css('display', 'none');//

                    // reset all values on form after submission
                    $("#editname"+res.id).val('');
                    $("#editfee"+res.id).val('');
                    $("#editcharsize"+res.id).val('');

                    if (res.fixed == 0)
                        var fixed = "No";
                    else
                        var fixed = "Yes";

                    // Update row in charge table
                    var newtr = '<tr id="' + res.id + '">' +
                        '<td>' +
                        '<input type="checkbox" name="pricings[]" value="'+res.id+'"  /> &nbsp;&nbsp;<button type="button" id="'+res.id+'" class="btn btn-success m-r-5 m-b-5 editpricing"><i class="fa fa-pencil"></i> Edit</button>' +
                        '</td>' +
                        '<td>'+res.name+'</td>' +
                        '<td>'+res.fee+'</td>' +
                        '<td>'+fixed+'</td>' +
                        '<td>'+res.charsize+'</td>' +
                        '<td>'+res.created+'</td>' +
                        '<td>'+res.modified+'</td>' +
                        '</tr>';

                    $("tr#"+res.id).replaceWith(newtr);
                    // Put all info just added in edit charge FORM

                    var editchargeform =
                        '<div id="edit-popup'+res.id+'">' +
                        '<div class="form-group" id="editnamefield'+res.id+'">' +
                        '<label class="col-md-2 control-label">Name:</label>' +
                        '<div class="col-md-3">' +
                        '<input type="text" name="name" value="'+res.name+'" id="editname'+res.id+'" class="form-control" placeholder="Name of Classified Pricing" data-parsley-required="true"  />' +
                        '<span class="form-control-feedback" id="editname-err'+res.id+'"></span>' +
                        '</div>' +
                        '</div>' +
                        '<br/><br/><br/>' +
                        '<div class="form-group" id="editfeefield'+res.id+'">' +
                        '<label class="col-md-2 control-label">Fee:</label>' +
                        '<div class="col-md-3 input-group"  style="padding-left:1em">' +
                        '<input type="text" name="fee" value="'+res.fee+'" id="editfee'+res.id+'" class="form-control" data-parsley-required="true"  />' +
                        '<span class="input-group-addon">characters</span>' +
                        '<span class="form-control-feedback" id="editfee-err'+res.id+'"></span>' +
                        '</div>' +
                        '</div>' +
                        '<br/>' +
                        '<div class="form-group" id="editcharsizefield'+res.id+'">' +
                        '<label class="col-md-2 control-label">Max Character Size:</label>' +
                        '<div class="col-md-3 input-group"  style="padding-left:1em">' +
                        '<span class="input-group-addon">$</span><input type="text" name="charsize" value="'+res.charsize+'" id="editcharsize'+res.id+'" class="form-control" data-parsley-required="true"  />' +
                        '<span class="form-control-feedback" id="editcharsize-err'+res.id+'"></span>' +
                        '</div>' +
                        '</div>' +
                        '<br/><br/>' +
                        '<div class="panel-body">' +
                        '<button type="button" id="editpricing-submit" name="'+res.id+'" class="btn btn-info m-r-5 m-b-5 editpricing-submit"><i class="fa fa-edit"></i> Update Pricing</button>' +
                        '<button type="button" id="cancelpricing-btn" name="'+res.id+'" class="btn btn-warning m-r-5 m-b-5"><i class="fa fa-times"></i> Cancel</button>' +
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

    // Delete Pricings
    $(document).on('click','#delpricing-btn', function(e){
        e.preventDefault();

        var baseUrl = window.location .protocol + "//" + window.location.host + "/" + window.location.pathname.split('/')[1];

        var selectedPricings = $("input[name='pricings[]']");

        // If no items are checked, do not delete anything, just return
        if(!selectedPricings.is(':checked'))
            return;

        // Disable button and replace with animated trashcan gif
        $(this).attr('disabled', true).empty().prepend('<img src="'+baseUrl+'/assets/img/trash-can.gif" /> Deleting');

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "ca_monthlypricing/ca_monthlypricing/ajax_del_pricing",
            dataType: 'json',
            data: selectedPricings.serialize(),
            success: function(res) {
                if (res) {
                    // Replace button with original glyphicon
                    $('#delpricing-btn').removeAttr('disabled').empty().prepend('<i class="fa fa-trash-o"></i> Delete');

                    // Remove rows from returned IDs in charge table
                    for (var i = 0; i < Object.keys(res).length - 1; i++)
                    {
                        $('table#pricing-table tr#'+Number(res[i])).remove(); // remove row from table
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

    $("form input[name='fee']").maskMoney({
        allowzero: true
    });
    $("form input[name='charsize']").maskMoney({
        precision: 0
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
</style>


</html>
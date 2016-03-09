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
                    <h4 class="panel-title">Manage Display Ad Monthly Pricings</h4>
                </div>
                <div class="panel-body">
                    <button type="button" id ="delpricing-btn" class="btn btn-danger m-r-5 m-b-5"><i class="fa fa-trash-o"></i> Delete</button>
                    <button type="button" id="addpricing-btn" class="btn btn-info m-r-5 m-b-5"><i class="fa fa-plus"></i> Add</button>
                </div>

                <div id="overlay"></div>

                <!---------------- ADD MONTHLY PRICING BEGINS ---------------------------->
                <div id="add-popup">
                    <div class="form-group" id="addsizefield">
                        <label class="col-md-2 control-label">Page Size:</label>
                        <div class="col-md-3">
                            <?php
                            $data = array(
                                'name'          => 'size',
                                'id'            => 'addsize',
                                'value'         => set_value('addsize'),
                                'class'         => 'form-control',
                                'type'          => 'text',
                                'placeholder'   => 'Name of Size',
                                'data-parsley-required' => 'true',
                            );
                            echo form_input($data);
                            echo '<span class="form-control-feedback" id="addsize-err"></span>';
                            ?>
                        </div>
                    </div>
                    <br/><br/><br/>
                    <div class="form-group" id="addbwpricefield">
                        <label class="col-md-2 control-label">B/W Price:</label>
                        <div class="col-md-3 input-group"  style="padding-left:1em">
                            <?php
                            $data = array(
                                'name'          => 'bwprice',
                                'id'            => 'addbwprice',
                                'value'         => set_value('addbwprice'),
                                'class'         => 'form-control',
                                'type'          => 'text',
                                'data-parsley-required' => 'true',
                            );
                            echo '<span class="input-group-addon">$</span>';
                            echo form_input($data);
                            echo '<span class="form-control-feedback" id="addbwprice-err"></span>';
                            ?>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group" id="addcolorpricefield">
                        <label class="col-md-2 control-label">Color Price:</label>
                        <div class="col-md-3 input-group"  style="padding-left:1em">
                            <?php
                            $data = array(
                                'name'          => 'colorprice',
                                'id'            => 'addcolorprice',
                                'value'         => set_value('addcolorprice'),
                                'class'         => 'form-control',
                                'type'          => 'text',
                                'data-parsley-required' => 'true',
                            );
                            echo '<span class="input-group-addon">$</span>';
                            echo form_input($data);
                            echo '<span class="form-control-feedback" id="addcolorprice-err"></span>';
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
                            <th width="25%">Page Size</th>
                            <th width="20%">B/W Price</th>
                            <th width="20%">Color Price</th>
                            <th width="10%">Created</th>
                            <th width="10%">Modified</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($da_pricings as $price)
                        {
                            echo '<tr id ="'.$price -> id.'">';
                            echo '<td>'.form_checkbox('pricings[]', $price -> id).'&nbsp;&nbsp;<button type="button" id="'.$price -> id.'" class="btn btn-success m-r-5 m-b-5 editpricing"><i class="fa fa-pencil"></i> Edit</button></td>';
                            echo '<td>'.$price -> pagesize.'</td>';
                            echo '<td>&#36; '.$price -> bwprice.'</td>';
                            echo '<td>&#36; '.$price -> colorprice.'</td>';
                            echo '<td>'.date('m-d-Y', strtotime($price -> created)).'</td>';
                            echo '<td>'.(($price->modified == '')? '' : date('m-d-Y', strtotime($price -> modified))).'</td>';
                            echo '</tr>';
                            ?>

                            <!---------------- EDIT MONTHLY PRICING BEGINS ---------------------------->
                            <div id="edit-popup<?php echo $price->id; ?>">
                                <div class="form-group" id="editsizefield<?php echo $price->id; ?>">
                                    <label class="col-md-2 control-label">Page Size:</label>
                                    <div class="col-md-3">
                                        <?php
                                        $data = array(
                                            'name'          => 'size',
                                            'id'            => 'editsize'.$price->id,
                                            'value'         => set_value('editsize', $price->pagesize),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => 'Name of Size',
                                            'data-parsley-required' => 'true',
                                        );
                                        echo form_input($data);
                                        ?>
                                        <span class="form-control-feedback" id="editsize-err<?php echo $price->id; ?>"></span>
                                    </div>
                                </div>
                                <br/><br/><br/>
                                <div class="form-group" id="editbwpricefield<?php echo $price->id; ?>">
                                    <label class="col-md-2 control-label">B/W Price:</label>
                                    <div class="col-md-3 input-group"  style="padding-left:1em">
                                        <?php
                                        $data = array(
                                            'name'          => 'bwprice',
                                            'id'            => 'editbwprice'.$price->id,
                                            'value'         => set_value('editbwprice', $price->bwprice),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'data-parsley-required' => 'true',
                                        );
                                        echo '<span class="input-group-addon">$</span>';
                                        echo form_input($data);
                                        ?>
                                        <span class="form-control-feedback" id="editbwprice-err<?php echo $price->id; ?>"></span>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-group" id="editcolorpricefield<?php echo $price->id; ?>">
                                    <label class="col-md-2 control-label">Color Price:</label>
                                    <div class="col-md-3 input-group"  style="padding-left:1em">
                                        <?php
                                        $data = array(
                                            'name'          => 'colorprice',
                                            'id'            => 'editcolorprice'.$price->id,
                                            'value'         => set_value('editcolorprice', $price->colorprice),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'data-parsley-required' => 'true',
                                        );
                                        echo '<span class="input-group-addon">$</span>';
                                        echo form_input($data);
                                        ?>
                                        <span class="form-control-feedback" id="editcolorprice-err<?php echo $price->id; ?>"></span>
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
        var size = $("#addsize").val();
        var bwprice = $("#addbwprice").val();
        var colorprice = $( "#addcolorprice" ).val();

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "da_monthlypricing/Da_monthlypricing/ajax_add_pricing",
            dataType: 'json',
            data: { size:size, bwprice:bwprice, colorprice:colorprice },
            success: function(res) {
                if (res) {

                    // Replace button with original glyphicon
                    $('#addpricing-submit').removeAttr('disabled').empty().prepend('<i class="fa fa-plus"></i> Add Monthly Pricing');

                    // remove previous error messages
                    $("#addsize-err").empty();
                    $("#addbwprice-err").empty();
                    $("#addcolorprice-err").empty();

                    // check form validation first
                    if (res.size_error)
                    {
//                        $('#addsize-err').append(res.size_error); // display error message under Charge Category field
                        $('#addsizefield').addClass('has-error'); // make field red
                    } else
                    {
                        $('#addsizefield').removeClass('has-error'); // remove red field
                    }
                    if (res.bwprice_error)
                    {
//                        $('#addbwprice-err').append(res.description_error);
                        $('#addbwpricefield').addClass('has-error');
                    } else
                    {
                        $('#addbwpricefield').removeClass('has-error');
                    }
                    if (res.colorprice_error)
                    {
//                        $('#addcolorprice-err').append(res.colorprice_error);
                        $('#addcolorpricefield').addClass('has-error');
                    } else
                    {
                        $('#addcolorpricefield').removeClass('has-error');
                    }

                    if (res.size_error || res.bwprice_error || res.colorprice_error)
                    {
                        return; // do not run any more javascript, there are errors on form
                    }

                    // Hide Add Pricing form
                    $('#overlay, #add-popup').css('display', 'none');//

                    // reset all values on form after submission
                    $("#addsize").val('');
                    $("#addbwprice").val('');
                    $("#addcolorprice").val('');

                    var newtr =
                        '<td><input type="checkbox" name="pricings[]" value="'+res.id+'" /> &nbsp;&nbsp;<button type="button" id="'+res.id+'" class="btn btn-success m-r-5 m-b-5 editpricing"><i class="fa fa-pencil"></i> Edit</button></td>' +
                        '<td>' + res.size + '</td>' +
                        '<td>&#36; ' + res.bwprice + '</td>' +
                        '<td>&#36; ' + res.colorprice + '</td>' +
                        '<td>' + res.created + '</td>' +
                        '<td></td>';

                    // Add row to table
                    row = $('<tr id="' + res.id + '" ></tr>');
                    row.append(newtr).prependTo('#pricing-table');

                    // Put all info just added in edit charge FORM
                    var editchargeform =
                        '<div id="edit-popup'+res.id+'">' +
                            '<div class="form-group" id="editsizefield'+res.id+'">' +
                                '<label class="col-md-2 control-label">Page Size:</label>' +
                                '<div class="col-md-3">' +
                                    '<input type="text" name="size" value="'+res.size+'" id="editsize'+res.id+'" class="form-control" placeholder="Name of Size" data-parsley-required="true"  />' +
                                    '<span class="form-control-feedback" id="editsize-err'+res.id+'"></span>' +
                                '</div>' +
                            '</div>' +
                            '<br/><br/><br/>' +
                            '<div class="form-group" id="editbwpricefield'+res.id+'">' +
                                '<label class="col-md-2 control-label">B/W Price:</label>' +
                                '<div class="col-md-3 input-group"  style="padding-left:1em">' +
                                    '<span class="input-group-addon">$</span><input type="text" name="bwprice" value="'+res.bwprice+'" id="editbwprice'+res.id+'" class="form-control" data-parsley-required="true"  />' +
                                    '<span class="form-control-feedback" id="editbwprice-err'+res.id+'"></span>' +
                                '</div>' +
                            '</div>' +
                            '<br/>' +
                            '<div class="form-group" id="editcolorpricefield'+res.id+'">' +
                                '<label class="col-md-2 control-label">Color Price:</label>' +
                                '<div class="col-md-3 input-group"  style="padding-left:1em">' +
                                    '<span class="input-group-addon">$</span><input type="text" name="colorprice" value="'+res.colorprice+'" id="editcolorprice'+res.id+'" class="form-control" data-parsley-required="true"  />' +
                                    '<span class="form-control-feedback" id="editcolorprice-err'+res.id+'"></span>' +
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
        var size = $("#editsize"+id).val();
        var bwprice = $("#editbwprice"+id).val();
        var colorprice = $("#editcolorprice"+id).val();

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "da_monthlypricing/Da_monthlypricing/ajax_edit_pricing",
            dataType: 'json',
            data: {id:id, size:size, bwprice:bwprice, colorprice:colorprice},
            success: function(res) {
                if (res) {

                    // Replace button with original glyphicon
                    $('.editpricing-submit').removeAttr('disabled').empty().prepend('<i class="fa fa-plus"></i> Update Monthly Pricing');

                    // remove previous error messages
                    $("#editsize-err"+res.id).empty();
                    $("#editbwprice-err"+res.id).empty();
                    $("#editcolorprice-err"+res.id).empty();

                    // check form validation first
                    if (res.size_error)
                    {
//                        $('#addcode-err').append(res.code_error); // display error message under Charge Category field
                        $('#editsizefield'+res.id).addClass('has-error'); // make field red
                    } else
                    {
                        $('#editsizefield'+res.id).removeClass('has-error'); // remove red field
                    }
                    if (res.bwprice_error)
                    {
//                        $('#adddescription-err').append(res.description_error);
                        $('#editbwpricefield'+res.id).addClass('has-error');
                    } else
                    {
                        $('#editbwpricefield'+res.id).removeClass('has-error');
                    }
                    if (res.colorprice_error)
                    {
//                        $('#addmonths-err').append(res.months_error);
                        $('#editcolorpricefield'+res.id).addClass('has-error');
                    } else
                    {
                        $('#editcolorpricefield'+res.id).removeClass('has-error');
                    }

                    if (res.size_error || res.bwprice_error || res.colorprice_error)
                    {
                        return; // do not run any more javascript, there are errors on form
                    }

                    // Hide Add Promo form
                    $('#overlay, #edit-popup'+res.id).css('display', 'none');//

                    // reset all values on form after submission
                    $("#editsize"+res.id).val('');
                    $("#editbwprice"+res.id).val('');
                    $("#editcolorprice"+res.id).val('');

                    // Update row in charge table
                    var newtr = '<tr id="' + res.id + '">' +
                        '<td>' +
                        '<input type="checkbox" name="pricings[]" value="'+res.id+'"  /> &nbsp;&nbsp;<button type="button" id="'+res.id+'" class="btn btn-success m-r-5 m-b-5 editpricing"><i class="fa fa-pencil"></i> Edit</button>' +
                        '</td>' +
                        '<td>'+res.size+'</td>' +
                        '<td>'+res.bwprice+'</td>' +
                        '<td>'+res.colorprice+'</td>' +
                        '<td>'+res.created+'</td>' +
                        '<td>'+res.modified+'</td>' +
                        '</tr>';

                    $("tr#"+res.id).replaceWith(newtr);
                    // Put all info just added in edit charge FORM

                    var editchargeform =
                        '<div id="edit-popup'+res.id+'">' +
                        '<div class="form-group" id="editsizefield'+res.id+'">' +
                        '<label class="col-md-2 control-label">Page Size:</label>' +
                        '<div class="col-md-3">' +
                        '<input type="text" name="size" value="'+res.size+'" id="editsize'+res.id+'" class="form-control" placeholder="Name of Size" data-parsley-required="true"  />' +
                        '<span class="form-control-feedback" id="editsize-err'+res.id+'"></span>' +
                        '</div>' +
                        '</div>' +
                        '<br/><br/><br/>' +
                        '<div class="form-group" id="editbwpricefield'+res.id+'">' +
                        '<label class="col-md-2 control-label">B/W Price:</label>' +
                        '<div class="col-md-3 input-group"  style="padding-left:1em">' +
                        '<span class="input-group-addon">$</span><input type="text" name="bwprice" value="'+res.bwprice+'" id="editbwprice'+res.id+'" class="form-control" data-parsley-required="true"  />' +
                        '<span class="form-control-feedback" id="editbwprice-err'+res.id+'"></span>' +
                        '</div>' +
                        '</div>' +
                        '<br/>' +
                        '<div class="form-group" id="editcolorpricefield'+res.id+'">' +
                        '<label class="col-md-2 control-label">Color Price:</label>' +
                        '<div class="col-md-3 input-group"  style="padding-left:1em">' +
                        '<span class="input-group-addon">$</span><input type="text" name="colorprice" value="'+res.colorprice+'" id="editcolorprice'+res.id+'" class="form-control" data-parsley-required="true"  />' +
                        '<span class="form-control-feedback" id="editcolorprice-err'+res.id+'"></span>' +
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
            url: "<?php echo base_url(); ?>" + "da_monthlypricing/Da_monthlypricing/ajax_del_pricing",
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

    $("form input[name='bwprice']").maskMoney();
    $("form input[name='colorprice']").maskMoney();


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
        height: 55%;
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
        height: 55%;
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
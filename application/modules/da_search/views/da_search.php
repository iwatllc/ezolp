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
    /*.autoResizeImage {*/
        /*max-width: 100%;*/
        /*height: auto;*/
        /*width: 100%;*/
    /*}*/
    /*img {*/
        /*max-width:64px;*/
        /*max-height:64px;*/
        /*width:auto;*/
        /*height:auto;*/
    /*}*/
    .dropbtn {
        background-color: white;
        color: white;
        padding: 1px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {background-color: #f1f1f1}

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropbtn {
        background-color: #3e8e41;
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/toggle-switch.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/switch.css">
    <script src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dropzone.css">

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
                    <div class="panel-heading-btn"></div>
                    <h4 class="panel-title">Search Display Ads</h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-4">
                                            <label class="control-label">Contact Info</label>
                                            <?php
                                            $data = array(
                                                'name' => 'contactinfo',
                                                'value'=> set_value('contactinfo'),
                                                'placeholder' => 'Name, Address, Email',
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
                                <div class="row">
                                    <div class="col-md-8">
                                        <br/><br/>
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
                                    <div class="col-md-2">
                                        <br/><br/>
                                        <label class="control-label">Approval Status</label>
                                        <label class="switch">
                                            <?php
                                            $data = array(
                                                'name'        => 'approval',
                                                'value'       => set_value('approval', 'approved'),
                                                'class'       => 'switch-input'
                                            );
                                            echo form_checkbox($data, set_value('approval', 'approved'), set_checkbox('approval', 'approved'));
                                            ?>
                                            <span class="switch-label" data-on="Approved" data-off="Not Apprvd"></span>
                                            <span class="switch-handle"></span>
                                        </label>
                                    </div>
                                    <div class="col-md-2">
                                        <br/><br/>
                                        <label class="control-label">Cancelled?</label>
                                        <label class="switch">
                                            <?php
                                            $data = array(
                                                'name'        => 'status',
                                                'value'       => set_value('status', 'cancelled'),
                                                'class'       => 'switch-input'
                                            );
                                            echo form_checkbox($data, set_value('status', 'cancelled'), set_checkbox('status', 'cancelled'));
                                            ?>
                                            <span class="switch-label" data-on="Cancelled" data-off="Open"></span>
                                            <span class="switch-handle"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <br/><br/><br/>
                                        <input type="button" onclick="$(':input').clearForm();" class="btn btn-sm btn-default" value="Reset" />
                                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
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
                                        'style' => 'height: 35%;'
                                    );
                                    echo form_multiselect('issues[]', $data, $this->input->post('issues'), $options);
                                    ?>
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
                        <table id="myTable" class="table table-bordered tablesorter" style="table-layout:fixed;">
                            <thead>
                            <?php
                            if ( isset($results) )
                            {
                            if ($results -> num_rows() > 0 && $results->result() != 'NULL')
                            { ?>
                            <tr>
                                <th width="15%">Contact</th>
                                <th width="8%">Promo Code</th>
                                <th width="8%">Page Size</th>
                                <th width="8%">Issues</th>
                                <th width="8%">Connector Coupons</th>
                                <th width="8%">Submitted</th>
                                <th width="15%">Image(s)</th>
                                <th width="15%">Approved Image(s)</th>
                                <th width="15%">Status</th>
                            </tr>
                            </thead>
                            <tbody style="font-size:80%;">
                            <?php
                            foreach ($results -> result() as $result)
                            {
                                echo '<tr id="'.$result->id.'" >';
                                    echo "<td>";
                                        echo $result->firstname.' '.$result->lastname.'<br/>'.$result->streetaddress.'<br/>'.$result->city.', '.$result->state.'<br/>'.$result->zip.'<br/>'.$result->email;
                                    echo "</td>";
                                    echo "<td>";
                                        echo $result->promocode;
                                    echo "</td>";
                                    echo "<td>";
                                        echo $result->option;
                                    echo "</td>";
                                    echo "<td>";
                                        echo $result->issues;
                                    echo "</td>";
                                    echo "<td>";
                                        if ($result -> coupons == 1)
                                            echo "Yes";
                                        else
                                            echo "No";
                                    echo "</td>";
                                    echo "<td>";
                                        echo date_conversion_nowording($result->created);
                                    echo "</td>";
                                    echo "<td>";

                                        if ($result -> images != '')
                                        {
                                            $images = explode(",", $result->images);
                                            foreach($images as $image)
                                            {
                                                $info = pathinfo($image);
                                                // Check image extension if PDF
                                                if ($info["extension"] == "pdf")
                                                {
                                                    ?>
                                                    <div class="dropdown">
                                                        <button class="dropbtn">
                                                            <a href="<?php echo base_url('/image/uploads/' . $image) ?>" target="_blank">
                                                                <embed width="100%" height="100%" name="plugin" src="<?php echo base_url('/image/uploads/'.$image) ?>" type="application/pdf">
                                                            </a>
                                                        </button>
                                                        <div class="dropdown-content">
                                                            <a href="<?php echo base_url('/image/uploads/' . $image) ?>" target="_blank">View</a>
                                                            <a href="<?php echo base_url('/image/uploads/' . $image) ?>" download="<?php echo $image ?>">Download</a>
                                                        </div>
                                                    </div>
                                                    <?php
                                                } else
                                                {
                                                    ?>
                                                    <div class="dropdown">
                                                        <button class="dropbtn">
                                                            <a href="<?php echo base_url('/image/uploads/' . $image) ?>" target="_blank">
                                                                <img class="autoResizeImage" src="<?php echo base_url('/image/uploads/' . $image) ?>" style="max-width: 100px;max-height: 100px;" >
                                                            </a>
                                                        </button>
                                                        <div class="dropdown-content">
                                                            <a href="<?php echo base_url('/image/uploads/' . $image) ?>" target="_blank">View</a>
                                                            <a href="<?php echo base_url('/image/uploads/' . $image) ?>" download="<?php echo $image ?>">Download</a>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }

                                                echo '<hr/>';
                                            }
                                        } else
                                        {
                                            echo 'No images';
                                        }

                                    echo "</td>";
                                    echo "<td>";

                                        if($result-> approvedfilenames != '')
                                        {
                                            $approvedimages = array_unique(explode(", ", $result->approvedfilenames));
                                            foreach($approvedimages as $image)
                                            {
                                                echo '<div id="'.$image.'">';
                                                $info = pathinfo($image);
                                                // Check image extension if PDF so that we can display it as embeded image
                                                if ($info["extension"] == "pdf")
                                                {
                                                    ?>
                                                    <div class="dropdown">
                                                        <button class="dropbtn">
                                                            <a href="<?php echo base_url('/image/approved_uploads/' . $image) ?>" target="_blank">
                                                                <embed width="100%" height="100%" name="plugin" src="<?php echo base_url('/image/approved_uploads/'.$image) ?>" type="application/pdf">
                                                            </a>
                                                        </button>
                                                        <div class="dropdown-content">
                                                            <a href="<?php echo base_url('/image/approved_uploads/' . $image) ?>" target="_blank">View</a>
                                                            <a href="<?php echo base_url('/image/approved_uploads/' . $image) ?>" download="<?php echo $image ?>">Download</a>
                                                            <a id="delete-image" name="<?php echo $image ?>" style="cursor:pointer;">Delete</a>
                                                        </div>
                                                    </div>
                                                    <?php
                                                } else
                                                {
                                                    ?>
                                                    <div class="dropdown">
                                                        <button class="dropbtn">
                                                            <a href="<?php echo base_url('/image/approved_uploads/' . $image) ?>" target="_blank">
                                                                <img class="autoResizeImage" src="<?php echo base_url('/image/approved_uploads/' . $image) ?>" style="max-width: 100px;max-height: 100px;" >
                                                            </a>
                                                        </button>
                                                        <div class="dropdown-content">
                                                            <a href="<?php echo base_url('/image/approved_uploads/' . $image) ?>" target="_blank">View</a>
                                                            <a href="<?php echo base_url('/image/approved_uploads/' . $image) ?>" download="<?php echo $image ?>">Download</a>
                                                            <a id="delete-image" name="<?php echo $image ?>" style="cursor:pointer;">Delete</a>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                echo '<hr/>';

                                                echo '</div>';
                                            }
                                        }

                                        echo '<br/>';

                                        $attributes = array('class' => 'dropzone', 'id' => 'my-dropzone', 'style' => 'height:50%');
                                        echo form_open_multipart('da_search/do_upload', $attributes);
                                        echo form_hidden('da_submissionid', $result->id);
                                        echo form_close();

                                    echo "</td>";
                                    echo '<td>';
                                        if ($result->approved == '0')
                                        {
                                            echo '<input num="'.$result->id.'" id="cmn-toggle-'.$result->id.'" class="cmn-toggle cmn-toggle-yes-no" type="checkbox" />';
                                        } else if ($result->approved == '1')
                                        {
                                            echo '<input num="'.$result->id.'" id="cmn-toggle-'.$result->id.'" class="cmn-toggle cmn-toggle-yes-no" type="checkbox" checked/>';
                                        }
                                        echo '<label for="cmn-toggle-'.$result->id.'" data-on="APPROVED" data-off="NOT APPROVED"></label>';

                                        echo '<div id="approvedby-'.$result->id.'">';
                                        if ($result->approved == '1')
                                        {
                                            echo '<u>Approved By</u><br/>' . $result->username;
                                            echo '<br/><u>Approved Date</u><br/> '.date_conversion_nowording($result->approveddate);
                                        }
                                        echo '</div>';

                                        echo '<br/>';
                                        echo '<hr/>';
                                        echo '<div id="cancel-status-'.$result->id.'">';
                                            if (!$result->cancelled)
                                            {
                                                echo '<button type="button" id ="cancelad-btn" adid="'.$result->id.'" class="btn btn-danger m-r-5 m-b-5"><i class="fa fa-times-circle"></i> Cancel Ad</button>';
                                            } else
                                            {
                                                echo '<div class="alert alert-danger fade in m-b-15"><center><strong><u>Cancelled</u></strong></center> This ad has been cancelled by <strong>'.$result->usercancelled.'</strong> on <strong>'.date_conversion_nowording($result->cancelled).'</strong><br/><br/><center><button type="button" class="label label-inverse" id="renewad-btn" raid="' . $result->id .'">Renew Ad</button></center></div>';
                                            }
                                        echo '</div>';
                                    echo '</td>';
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

    // Approved/disapprove a submission
    $(document).on('click', '.cmn-toggle-yes-no', function(e){

        var id = $(this).attr('num');
        var status;

        if ($(this).is(':checked'))
        {
            status = "Approved";
        }
        if (!$(this).is(':checked'))
        {
            status = "Not Approved";
        }

        console.log('ID: ' + id + '\n' + 'Status: ' + status);

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "da_search/Da_search/ajax_approve_submission",
            dataType: 'json',
            data: {id:id, status:status},
            success: function(res) {
                if (res) {

                    console.log('AJAX returned these\n' + 'ID: ' + res.id + '\n' + 'Status: ' + res.status);

                    // Highlight row that was just updated
                    if(res.status == 1)
                    {
                        setTimeout(function(){ $("tr#"+res.id).css('background-color','transparent').effect("highlight", {color:"#8ce196"}, 3000); })

                        // Add the user who approved and current date
                        $("div#approvedby-"+res.id).empty();
                        $("div#approvedby-"+res.id).html('<u>Approved By</u><br/>' + res.approvedby + '<br/><u>Approved Date</u><br/>' + res.approveddate);

                    }
                    if (res.status == 0)
                    {
                        // Remove approved by and approved date
                        $("div#approvedby-"+res.id).empty();

                        setTimeout(function(){ $("tr#"+res.id).css('background-color','transparent').effect("highlight", {color:"#ff1919"}, 3000); })
                    }
                }
            }
        });
    });

    $( document ).ready(function() {

        $( "#datepicker" ).datepicker({defaultDate: null});
        $( "#datepicker2" ).datepicker({defaultDate: null});

    });

    $.fn.clearForm = function() {
        return this.each(function() {
            var type = this.type, tag = this.tagName.toLowerCase();
            if (tag == 'form')
                return $(':input',this).clearForm();
            if (type == 'text' || type == 'password' || tag == 'textarea')
                this.value = '';
            else if (type == 'checkbox' || type == 'radio')
                $(':input', this).value == false;
            else if (tag == 'select')
                this.selectedIndex = -1;
        });
    };

    // Delete an Image
    $(document).on('click','#delete-image', function(e){
        e.preventDefault();

        var imgname =  $(this).attr("name");

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "da_search/Da_search/ajax_del_approved_image",
            dataType: 'json',
            data: {imgname:imgname},
            success: function(res) {
                if (res) {

                    // Remove image and dropdown
//                    var filename = res.filename;
//                    filename = filename.replace(/\.[^/.]+$/, "");
                    location.reload();
//                    filename = filename.replace(/\./g,'\\.');
//                    $('#'+filename).remove();
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus); alert("Error: " + errorThrown);
            }
        });
    });

    // Cancel an ad submission
    $(document).on('click','#cancelad-btn', function(e){
        e.preventDefault();

        var id =  $(this).attr("adid");

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "da_search/Da_search/ajax_cancel_ad",
            dataType: 'json',
            data: { id:id },
            success: function(res) {
                if (res) {

                    // Replace button with message
                    var cancelAlert = '<div class="alert alert-danger fade in m-b-15"><center><strong><u>Cancelled</u></strong></center> This ad has been cancelled by <strong>' + res.username + '</strong> on <strong>' + res.date + '</strong><br/><br/><center><button type="button" class="label label-inverse" id="renewad-btn" raid="' + res.id + '">Renew Ad</button></center></div>';

                    $("#cancel-status-"+res.id).html(cancelAlert);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus); alert("Error: " + errorThrown);
            }
        });
    });

    // Renew an ad submission
    $(document).on('click','#renewad-btn', function(e){
        e.preventDefault();

        var id =  $(this).attr("raid");

        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "da_search/Da_search/ajax_renew_ad",
            dataType: 'json',
            data: { id:id },
            success: function(res) {
                if (res) {

                    // Replace button with message
                    var cancelAlert = '<button type="button" id ="cancelad-btn" adid="' + res.id + '" class="btn btn-danger m-r-5 m-b-5"><i class="fa fa-times-circle"></i> Cancel Ad</button>';

                    $("#cancel-status-"+res.id).html(cancelAlert);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus); alert("Error: " + errorThrown);
            }
        });
    });

</script>

</html>
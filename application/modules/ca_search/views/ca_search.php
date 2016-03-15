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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/toggle-switch.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/switch.css">

</head>

<body class = "flat-back">

<div id="content" class="content">

    <div class="row">
        <!-- begin col-12 -->
        <div class="col-12">
            <?php $attributes = array('class' => 'form-horizontal form-bordered', 'id' => 'searchform'); ?>
            <?php echo form_open('ca_search/execute_search', array('id' => 'myForm')); ?>

            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn"></div>
                    <h4 class="panel-title">Search Classified Ads</h4>
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
                                            <label class="control-label">Ad Text</label>
                                            <?php
                                            $data = array(
                                                'name' => 'adtext',
                                                'value'=> set_value('adtext'),
                                                'placeholder' => 'Ad Text',
                                                'class' => 'form-control'
                                            );
                                            echo form_input($data);
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
                                    <div class="col-md-4">
                                        <br/><br/>
                                        <label class="control-label">Approval Status</label>
                                        <label class="switch">
                                            <?php
                                                $data = array(
                                                    'name'        => 'approval',
                                                    'value'       => set_value('approval', 'approved'),
//                                                    'checked'     => set_checkbox('approval'),
                                                    'class'       => 'switch-input'
                                                );

                                                echo form_checkbox($data, set_value('approval', 'approved'), set_checkbox('approval', 'approved'));

                                            ?>
                                            <span class="switch-label" data-on="Approved" data-off="Not Apprvd"></span>
                                            <span class="switch-handle"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <br/><br/><br/><br/>
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
                            if ($results -> num_rows() > 0)
                            { ?>
                            <tr>
                                <th width="15%">Contact</th>
                                <th width="10%">Promo Code</th>
                                <th width="10%">Issues</th>
                                <th width="10%">Submitted</th>
                                <th width="20%">Ad Text</th>
                                <th width="20%">Approved Text</th>
                                <th width="15%">Status</th>
                            </tr>
                            </thead>
                            <tbody style="font-size:80%;">
                            <?php
                            foreach ($results -> result() as $result)
                            {
                                echo '<tr id="'.$result->id.'" >';
                                    echo "<td>";
                                        echo '<span>';
                                            echo $result->firstname.' '.$result->lastname.'<br/>'.$result->streetaddress.'<br/>'.$result->city.', '.$result->state.'<br/>'.$result->zip;
                                        echo '</span>';
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
                                    echo "<td>";
                                    echo $result->adtext;
                                    echo "</td>";
                                    echo '<td id="'.$result->id.'" contenteditable="true" bgcolor="#FFFFE0">';
                                    echo $result->approvedtext;
                                    echo "</td>";
                                    echo "<td>";
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
                                    echo "</td>";
                                echo "</tr>";
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
            url: "<?php echo base_url(); ?>" + "ca_search/Ca_search/ajax_approve_submission",
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

    // Change approved text of submission
    $(function(){

        // acknowledgement message
        $("td[contenteditable=true]").blur(function(){
            var id = $(this).attr("id") ;
            var text = $(this).text();
            console.log('Before POST - ' + id + ': ' + text);

            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "ca_search/Ca_search/ajax_change_approved_text",
                dataType: 'json',
                data: { id:id, text:text },
                success: function(res) {
                    if (res) {

                        console.log('After POST - ' + res.id + ': ' + res.text);

                        // Highlight row that was just updated
                        setTimeout(function(){ $("tr#"+res.id).css('background-color','transparent').effect("highlight", {color:"#8ce196"}, 3000); })
                    }
                }
            });
        });
    });

    $( "#datepicker" ).datepicker({defaultDate: null});
    $( "#datepicker2" ).datepicker({defaultDate: null});


    $.fn.clearForm = function() {
        return this.each(function() {
            var type = this.type, tag = this.tagName.toLowerCase();
            if (tag == 'form')
                return $(':input',this).clearForm();
            if (type == 'text' || type == 'password' || tag == 'textarea')
                this.value = '';
            else if (type == 'checkbox' || type == 'radio')
                this.checked = false;
            else if (tag == 'select')
                this.selectedIndex = -1;
        });
    };



</script>


</html>
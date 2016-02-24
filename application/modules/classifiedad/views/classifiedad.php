<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php

if($Guestform_Clientform == "FALSE") {

?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<?php $this->load->view('header'); ?>

<style>
    #loading-div-background{
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        background: #fff;
        width: 100%;
        height: 100%;
    }

    #loading-div{
        width: 300px;
        height: 150px;
        background-color: #fff;
        border: 5px solid #f59c1a;
        text-align: center;
        color: #202020;
        position: absolute;
        left: 50%;
        top: 50%;
        margin-left: -150px;
        margin-top: -100px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        behavior: url("/css/pie/PIE.htc"); /* HANDLES IE */
    }
</style>

<body class="flat-black">

<div id="page-container" class="fade in page-without-sidebar">

    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin page-header -->

        <h1 class="page-header">
            <?php if($Guestform_Logo != 'FALSE'){ ?>
                <img src="<?php echo base_url(); ?>/client/<?php echo $Guestform_Logo ?>" alt="" height="120" width="120">
            <?php } ?>
            <?php echo $page_data['heading'];?>
        </h1>
        <!-- end page-header -->

        <div class="row">
            <!-- begin col-12 -->
            <div class="col-12">
                <?php $attributes = array('class' => 'form-horizontal', 'id' => 'guestform'); ?>
                <?php echo form_open('classifiedad/submit', $attributes);
                    $data = array(
                        'type'  => 'hidden',
                        'name'  => 'cardtype',
                        'id'    => 'cardtype',
                        'value' => '',
                        'class' => 'cardtype'
                    );
                    echo form_input($data) ;
                ?>
                    <!-- begin panel -->
                    <div class="panel panel-inverse" >
                        <div class="panel-heading">
                            <h4 class="panel-title">Place your Classified Ad in THE CONNECTOR (* = Required Field)</h4>
                        </div>
                        <div class="panel-body">
                            <legend><b>Pricing:</b> $<?php echo $price_per_line; ?>  per line per month.</legend>

                            <legend>Billing Information</legend>
                                <div class="form-group <?php echo(!empty(form_error('firstname')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">FIRST NAME*</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'firstname',
                                            'id'            => 'firstname',
                                            'value'         => set_value('firstname'),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => 'Required',
                                            'maxlength'     => '100',
                                            'data-parsley-required' => 'true'
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('firstname')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('firstname'); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo(!empty(form_error('lastname')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">LAST NAME*</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'lastname',
                                            'id'            => 'lastname',
                                            'value'         => set_value('lastname'),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => 'Required',
                                            'maxlength'     => '100',
                                            'data-parsley-required' => 'true'
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('lastname')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('lastname'); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo(!empty(form_error('streetaddress')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">STREET ADDRESS*</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'streetaddress',
                                            'id'            => 'streetaddress',
                                            'value'         => set_value('streetaddress'),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => 'Required',
                                            'maxlength'     => '100',
                                            'data-parsley-required' => 'true'
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('streetaddress')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('streetaddress'); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo(!empty(form_error('city')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">CITY*</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'city',
                                            'id'            => 'city',
                                            'value'         => set_value('city'),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => 'Required',
                                            'maxlength'     => '100',
                                            'data-parsley-required' => 'true'
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('city')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('city'); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo(!empty(form_error('state')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">STATE*</label>
                                    <div class="col-md-9">
                                        <?php
                                            $extra = array(
                                                'class' => 'form-control selectpicker',
                                                'data-live-search' => 'true',
                                                'data-style' => (!empty(form_error('state')) ? 'btn-danger' : ''),
                                            );

                                            $options = array(
                                                '0' => 'Select State',
                                                'AL' =>'Alabama',
                                                'AK' =>'Alaska',
                                                'AZ' =>'Arizona',
                                                'AR' =>'Arkansas',
                                                'CA' =>'California',
                                                'CO' =>'Colorado',
                                                'CT' =>'Connecticut',
                                                'DE' =>'Delaware',
                                                'DC' =>'District Of Columbia',
                                                'FL' =>'Florida',
                                                'GA' =>'Georgia',
                                                'HI' =>'Hawaii',
                                                'ID' =>'Idaho',
                                                'IL' =>'Illinois',
                                                'IN' =>'Indiana',
                                                'IA' =>'Iowa',
                                                'KS' =>'Kansas',
                                                'KY' =>'Kentucky',
                                                'LA' =>'Louisiana',
                                                'ME' =>'Maine',
                                                'MD' =>'Maryland',
                                                'MA' =>'Massachusetts',
                                                'MI' =>'Michigan',
                                                'MN' =>'Minnesota',
                                                'MS' =>'Mississippi',
                                                'MO' =>'Missouri',
                                                'MT' =>'Montana',
                                                'NE' =>'Nebraska',
                                                'NV' =>'Nevada',
                                                'NH' =>'New Hampshire',
                                                'NJ' =>'New Jersey',
                                                'NM' =>'New Mexico',
                                                'NY' =>'New York',
                                                'NC' =>'North Carolina',
                                                'ND' =>'North Dakota',
                                                'OH' =>'Ohio',
                                                'OK' =>'Oklahoma',
                                                'OR' =>'Oregon',
                                                'PA' =>'Pennsylvania',
                                                'RI' =>'Rhode Island',
                                                'SC' =>'South Carolina',
                                                'SD' =>'South Dakota',
                                                'TN' =>'Tennessee',
                                                'TX' =>'Texas',
                                                'UT' =>'Utah',
                                                'VT' =>'Vermont',
                                                'VA' =>'Virginia',
                                                'WA' =>'Washington',
                                                'WV' =>'West Virginia',
                                                'WI' =>'Wisconsin',
                                                'WY' =>'Wyoming',
                                            );

                                            echo form_dropdown('state', $options, set_value('state'), $extra);
                                        ?>
                                        <?php echo(!empty(form_error('state')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('state'); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo(!empty(form_error('zip')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">ZIP*</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'zip',
                                            'id'            => 'masked-input-zip',
                                            'value'         => set_value('zip'),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => '99999',
                                            'maxlength'     => '5',
                                            'data-parsley-required' => 'true'
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('zip')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('zip'); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo(!empty(form_error('phone')) ? 'has-error has-feedback' : ''); ?>">
                                <label class="col-md-3 control-label">PHONE*</label>
                                <div class="col-md-9">
                                    <?php
                                    $data = array(
                                        'name'          => 'phone',
                                        'id'            => 'masked-input-phone',
                                        'value'         => set_value('phone'),
                                        'class'         => 'form-control',
                                        'type'          => 'text',
                                        'placeholder'   => '999-999-9999',
                                        'maxlength'     => '5',
                                        'data-parsley-required' => 'true'
                                    );

                                    echo form_input($data);
                                    ?>
                                    <?php echo(!empty(form_error('phone')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                    <?php echo form_error('phone'); ?>
                                </div>
                            </div>
                                <div class="form-group <?php echo(!empty(form_error('email')) ? 'has-error has-feedback' : ''); ?>">

                                    <?php if($Guestform_Email == "TRUE") { ?>
                                        <label class="col-md-3 control-label">EMAIL<?php echo( $Guestform_Email_Required == 'TRUE' ? '*' : ' ') ?></label>
                                        <div class="col-md-9">
                                            <?php
                                            $data = array(
                                                'name'          => 'email',
                                                'id'            => 'email',
                                                'value'         => set_value('email'),
                                                'class'         => 'form-control',
                                                'type'          => 'email',
                                                'placeholder'   => 'email address',
                                                'maxlength'     => '100',
                                                'data-parsley-required' => $Guestform_Email_Required
                                            );

                                            echo form_input($data);
                                            ?>
                                            <?php echo(!empty(form_error('email')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                            <?php echo form_error('email'); ?>
                                        </div>
                                    <?php } ?>

                                </div>

                            <?php
                                for ($i = 0; $i < 12; $i++)
                                {
                                    $month_array[$i] = date('F', strtotime('+'.($i+1).' month'));
                                }
                            ?>

                            <legend>I would like my ad to be listed in the following issue(s):</legend>
                        <div id="allInputs">
                            <div class="form-group <?php echo(!empty(form_error('issue')) ? 'has-error has-feedback' : ''); ?>">
                                <div class="col-md-3 control-label">
                                    <table>
                                        <?php foreach ($month_array as $month)
                                              {?>
                                            <tr>
                                                <?php
                                                    $data = array(
                                                        'name'          => 'issues[]',
                                                        'id'            => $month,
                                                        'value'         => $month,
                                                        'class'         => 'form-control',
                                                        'data-parsley-required' => 'true'
                                                    );

                                                    echo '<td>'.form_checkbox($data).'</td>';
                                                ?>
                                                <td><label class="col-md-3 control-label"><?php echo $month; ?></label></td>
                                            </tr>
                                          <?php } ?>
                                    </table>
                                </div>
                                <?php echo(!empty(form_error('issue')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                <?php echo form_error('issue'); ?>
                            </div>

                            <legend>Your ad text:</legend>
                            <div class="form-group <?php echo(!empty(form_error('adtext')) ? 'has-error has-feedback' : ''); ?>">
                                <label class="col-md-3 control-label">Your ad text:</label>
                                <div class="col-md-9">
                                    <?php
                                    $data = array(
                                        'name'          => 'adtext',
                                        'id'            => 'adtext',
                                        'value'         => set_value('adtext'),
                                        'class'         => 'form-control',
                                        'type'          => 'text',
                                        'placeholder'   => 'Required',
                                        'rows'          => '4',
                                        'columns'       => '50',
                                        'data-parsley-required' => 'true'
                                    );

                                    echo form_textarea($data);
                                    ?>
                                    <?php echo(!empty(form_error('adtext')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                    <?php echo form_error('adtext'); ?>
                                </div>
                            </div>
                        </div>

                            <div class="form-group <?php echo(!empty(form_error('totallines')) ? 'has-error has-feedback' : ''); ?>">
                                <label class="col-md-3 control-label">Total Lines:</label>
                                <div class="col-md-9">
                                    <?php
                                    $data = array(
                                        'name'          => 'totallines',
                                        'id'            => 'totallines',
                                        'value'         => set_value('totallines'),
//                                        'class'         => 'form-control',
                                        'type'          => 'text',
                                        'size'          => '10',
                                        'data-parsley-required' => 'true',
                                        'readonly'      => 'true'
                                    );

                                    echo form_input($data);
                                    ?>
                                    <?php echo(!empty(form_error('totallines')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                    <?php echo form_error('totallines'); ?>
                                </div>
                            </div>

                            <div class="form-group <?php echo(!empty(form_error('grandtotal')) ? 'has-error has-feedback' : ''); ?>">
                                <label class="col-md-3 control-label"><b>TOTAL:</b></label>
                                <div class="col-md-9">
                                    <?php
                                    $data = array(
                                        'name'          => 'grandtotal',
                                        'id'            => 'grandtotal',
                                        'value'         => set_value('grandtotal'),
//                                        'class'         => 'form-control',
                                        'type'          => 'text',
                                        'size'          => '20',
                                        'data-parsley-required' => 'true',
                                        'readonly'      => 'true'
                                    );

                                    echo form_input($data);
                                    ?>
                                    <?php echo(!empty(form_error('totallines')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                    <?php echo form_error('totallines'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Submit</label>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-sm btn-success">Submit Button</button>
                                </div>
                            </div>
                        </div>
                        <!-- end panel body -->

                        <div class="donation-grp">
                            <div class="form-group">
                                <div class="col-md-12 end-form-donate">
                                    <div class="panel-body">
                                        <address>
                                            <strong><u>OSI offers a full range of printing services with experienced personnel to meet your printing needs from design to print to mailing services.</u></strong><br/><br/>
                                            <strong>Contact info:</strong>
                                            <br/>
                                            <u>Phone:</u> (717)263-9293 x 215
                                            <br/>
                                            <u>Email:</u> <a href="mailto:#">print@osinc.org</a>
                                            <br/>
                                            <u>Address:</u>  Occupational Services, Inc.
                                            <br/>
                                            <div style="margin-left:5em">17 Redwood Street</div>
                                            <div style="margin-left:5em">Chambersburg, PA  17201</div><br/>
                                        </address>
                                        <address>
                                            <strong>Partnering with:</strong><br />
                                            Internet and web design:  IWAT  (info)
                                        </address>
                                    </div>
                            </div>
                        </div>

                    </div>
                    <!-- end panel -->
                <?php echo form_close(); ?>
            </div>
            <!-- end col-12 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end #content -->

    <!-- #modal-message -->
    <div id="loading-div-background">
        <div id="loading-div" class="ui-corner-all">
            <img style="height:64px;width:62px;margin:30px;" src="<?php echo base_url(); ?>assets/img/wait_spinner.gif" alt="Loading.."/><br>PROCESSING. PLEASE WAIT...
        </div>
    </div>


    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->

</div>
<!-- end page container -->

<?php $this->load->view('footer'); ?>


<script src="<?php echo base_url(); ?>/assets/plugins/jquery-payment/lib/jquery.payment.min.js"></script>

<script type="text/javascript">

    $(document).ready(function() {
        var lines_per_char = "<?php echo $lines_per_char ?>";
        var price_per_line = "<?php echo $price_per_line ?>";

        (function()
        {
            function showLength(e)
            {
                e = e || window.event; // IE doesn't pass event to callback
                var target = e.target || e.srcElement; // IE == srcElement, good browsers: target
                var lines = Math.ceil( target.value.length / lines_per_char ); // set the total amount of lines by dividing it by the number of lines per character and then rounding up to the nearest whole number
                var price = (lines * price_per_line).toFixed(2); // set the total price by taking the number of lines times the price
                document.getElementById('totallines').value = lines; // set the text box for lines
                document.getElementById('grandtotal').value = price; // set the text box total price
            }
            //bind event listener to the div containing all elements you want to be 'handled'
            var mainDiv = document.getElementById('allInputs');
            if (!(mainDiv.addEventListener))
            {
                mainDiv.attachEvent('onfocusout',showLength); //IE doesn't have EventListeners, and doesn't support onchange this way, use onfocusout
            }
            else
            {
                mainDiv.addEventListener('keyup',showLength,false);
            }
        })();
    });

</script>


<script type="text/javascript">

    $(document).ready(function() {
        $("#loading-div-background").css({ opacity: 1.0 });

        $('#guestform').submit(function(){
            var cardType = $.payment.cardType($('.creditcard').val());
            $('.cardtype').val(cardType);
            $('#submit').attr({
                disabled: 'disabled',
                value: 'Processing, Please Wait...'
            });
            $("#loading-div-background").show();
        });

        $('.creditcard').payment('formatCardNumber');
        $('.cc-cvc').payment('formatCardCVC');
    });

</script>

<script type="text/javascript">
    /* Credit Card Swipe Logic */
    var readErrorReason = "Credit card read error. Please try again.";

    var creditCardParser = function (rawData) {

        var trackpattern = new RegExp("^(%[^%;\\?]+\\?)(;[0-9\\:<>\\=]+\\?)?(;[0-9\\:<>\\=]+\\?)?");

        var trackmatches = trackpattern.exec(rawData);
        if (!trackmatches) return null;

        var fieldpattern = new RegExp("^(\\%)([a-zA-Z])(\\d{1,19})(\\^)(.{2,26})(\\^)(\\d{0,4}|\\^)(\\d{0,3}|\\^)(.*)(\\?)");

        var fieldmatches = fieldpattern.exec(rawData);

        if (!fieldmatches) return null;

        // Extract the three lines
        var cardData = {
            track1: trackmatches[1],
            track2: trackmatches[2],
            track3: trackmatches[3],
            FC: fieldmatches[2],
            PAN: fieldmatches[3],
            NM: fieldmatches[5],
            ED: fieldmatches[7],
            SC: fieldmatches[8],
            DD: fieldmatches[9]
        };

        if (cardData.FC != "B")
        {
            readErrorReason = "Invalid Format Code. Only cards with Format Code 'B' may be processed.";
        }
        else if (cardData.PAN.length == 0)
        {
            readErrorReason = "Can not read Primary Account Number. Please try again.";
        }
        else if (cardData.ED.length == 0)
        {
            readErrorReason = "Can not read Expiration Date. Please try again.";
        }

        console.log(cardData);

        return cardData;
    };

    var goodScan = function (data) {
        $("#status").text("Success!");
        $("#track1").text(data.track1);
        $("#track2").text(data.track2);
        $("#track3").text(data.track3);

        // console.log(data.PAN);
        // console.log(data.ED.substring(2, 4));
        // console.log(data.ED.substring(0, 2));

        // Swap around the name
        var fullname  = data.NM.split("/");
        var firstname = fullname[1].trim();
        var lastname = fullname[0].trim();
        var formattedname = firstname.concat(" ", lastname).trim();

        $("[name='fullname']").val(formattedname);
        $("[name='creditcard']").val(data.PAN);

        // Set Value of Element then run the selectpicker refresh
        $("#expirationmonth").val(data.ED.substring(2, 4));
        $('.selectpicker').selectpicker('refresh');

        // var expirationyear = data.ED.substring(0, 2);
        // $("[name='expirationyear']").val(data.ED.substring(0, 2));
        var year_prefix = "20";
        var year_suffix = data.ED.substring(0, 2);
        var cardyear = year_prefix.concat(year_suffix);
        $("#expirationyear").val(cardyear);
        $('.selectpicker').selectpicker('refresh');


        $("[name='cvv2']").focus();
    }

    var badScan = function () {
        $("#status").text("Failed!");
        $(".line").text("");
        alert(readErrorReason);
    }

    // Initialize the plugin with default parser and callbacks.
    //
    // Set debug to true to watch the characters get captured and the state machine transitions
    // in the javascript console. This requires a browser that supports the console.log function.
    //
    // Set firstLineOnly to true to invoke the parser after scanning the first line. This will speed up the
    // time from the start of the scan to invoking your success callback.
    $.cardswipe({
        firstLineOnly: false,
        success: goodScan,
        parser: creditCardParser,
        error: badScan,
        debug: true
    });

</script>


</body>
</html>



<?php } else { ?>



<?php } ?>
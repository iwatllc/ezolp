<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php

if($Classifiedad_Clientform == "FALSE") {

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
            <?php if($Classifiedad_Logo != 'FALSE'){ ?>
                <img src="<?php echo base_url(); ?>/client/<?php echo $Classifiedad_Logo ?>" alt="" height="120" width="120">
            <?php } ?>
            <?php echo $page_data['heading'];?>
        </h1>
        <!-- end page-header -->

        <div class="row">
            <!-- begin col-12 -->
            <div class="col-12">
                <?php $attributes = array('class' => 'form-horizontal', 'id' => 'classifiedad'); ?>
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

                                    <?php if($Classifiedad_Email == "TRUE") { ?>
                                        <label class="col-md-3 control-label">EMAIL<?php echo( $Classifiedad_Email_Required == 'TRUE' ? '*' : ' ') ?></label>
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
                                                'data-parsley-required' => $Classifiedad_Email_Required
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
                        <div id="allIssues">
                            <div class="form-group <?php echo(!empty(form_error('issue')) ? 'has-error has-feedback' : ''); ?>">
                                <div class="col-md-8 control-label">
                                    <table align="center">
                                        <?php
                                            $i = 0;
                                            foreach ($month_array as $month)
                                            {
                                                $data = array(
                                                    'name'          => 'issues[]',
                                                    'id'            => $month,
                                                    'value'         => $month,
                                                    'class'         => 'form-control',
                                                    'data-parsley-required' => 'true'
                                                );
                                                if ($i % 2 != 0) // if it's divisible by 6
                                                {
                                                        echo '<td>' . form_checkbox($data) . '</td>';
                                                        echo '<td><label class="col-md-3 control-label">' . $month . '</label></td>';
                                                    echo '</tr>';
                                                } else
                                                {
                                                    echo '<tr>';
                                                        echo '<td>' . form_checkbox($data) . '</td>';
                                                        echo '<td><label class="col-md-3 control-label">' . $month . '</label></td>';
                                                        echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
                                                }

                                                $i++;
                                            }
                                        ?>
                                    </table>
                                </div>
                                <?php echo(!empty(form_error('issue')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                <?php echo form_error('issue'); ?>
                            </div>
                        </div>

                            <legend>Your ad text:</legend>
                        <div id="allInputs">
                            <div class="form-group <?php echo(!empty(form_error('adtext')) ? 'has-error has-feedback' : ''); ?>">
                                <label class="col-md-3 control-label">Your ad text:</label>
                                <div class="col-md-5">
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

                            <div class="form-group">
                                <label class="col-md-3 control-label">Total Lines:</label>
                                <div class="col-md-1">
                                    <?php
                                    $data = array(
                                        'name'          => 'totallines',
                                        'id'            => 'totallines',
                                        'value'         => set_value('totallines'),
//                                        'class'         => 'form-control',
                                        'type'          => 'text',
                                        'size'          => '4',
                                        'data-parsley-required' => 'true',
                                        'readonly'      => 'true',
                                        'style'         => '-webkit-appearance:none; -moz-appearance:none; appearance:none;'
                                    );

                                     echo form_input($data);
                                    ?>
                                    <span id="numlines"></span>
                                </div>
                            </div>

                            <div class="form-group <?php echo(!empty(form_error('promocode')) ? 'has-error has-feedback' : ''); ?>">
                                <label class="col-md-3 control-label">Promotional Code:</label>
                                <div class="col-md-5">
                                    <?php
                                    $data = array(
                                        'name'          => 'promocode',
                                        'id'            => 'promocode',
                                        'value'         => set_value('promocode'),
                                        'class'         => 'form-control',
                                        'type'          => 'text',
                                        'size'          => '30',
                                        'data-parsley-required' => 'true'
                                    );

                                    echo form_input($data);
                                    ?>
                                    <?php echo(!empty(form_error('promocode')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                    <?php echo form_error('promocode'); ?>
                                    <span id="promo-result"></span>
                                </div>
                            </div>

                            <div class="form-group" id="promo-info" style="display:none"></div>
                            <span id="percentage" style="display:none"></span>
                            <span id="numMonths" style="display:none"></span>

                            <div class="form-group <?php echo(!empty(form_error('grandtotal')) ? 'has-error has-feedback' : ''); ?>">
                                <label class="col-md-3 control-label"><b>TOTAL AMOUNT:</b></label>
                                <div class="col-md-1">
                                    <?php
                                    $data = array(
                                        'name'          => 'grandtotal',
                                        'id'            => 'grandtotal',
                                        'value'         => set_value('grandtotal'),
                                        'class'         => 'form-control',
                                        'type'          => 'text',
                                        'size'          => '20',
                                        'data-parsley-required' => 'true',
                                        'readonly'      => 'true'
//                                        'style'         => 'outline: none; border-color: green; box-shadow: 0 0 10px green;'
                                    );

                                    echo form_input($data);
                                    ?>
                                    <?php echo(!empty(form_error('grandtotal')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                    <?php echo form_error('grandtotal'); ?>
                                </div>
                            </div>

                        <legend>Credit Card Information</legend>
                            <div class="form-group <?php echo(!empty(form_error('creditcard')) ? 'has-error has-feedback' : ''); ?>">
                                <label class="col-md-3 control-label">CREDIT CARD *</label>
                                <div class="col-md-9">
                                    <?php
                                    $data = array(
                                        'name'          => 'creditcard',
                                        'id'            => 'creditcard',
                                        'value'         => set_value('creditcard'),
                                        'class'         => 'form-control creditcard',
                                        'type'          => 'text',
                                        'placeholder'   => '9999 9999 9999 9999',
                                    );

                                    echo form_input($data);
                                    ?>
                                    <?php echo(!empty(form_error('creditcard')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                    <?php echo form_error('creditcard'); ?>

                                </div>
                            </div>

                            <div class="form-group <?php echo(!empty(form_error('expirationmonth')) ? 'has-error has-feedback' : ''); ?>">
                                <label class="col-md-3 control-label">Expiration Month *</label>
                                <div class="col-md-9">
                                    <?php
                                    $extra = array(
                                        'class' => 'form-control selectpicker',
                                        'id' => 'expirationmonth',
                                        'name' => 'expirationmonth',
                                        'data-live-search' => 'true',
                                        'data-style' => (!empty(form_error('expirationmonth')) ? 'btn-danger' : ''),
                                    );

                                    $options = array(
                                        '0'  => 'Select Month',
                                        '01' => 'January (01)',
                                        '02' => 'February (02)',
                                        '03' => 'March (03)',
                                        '04' => 'April (04)',
                                        '05' => 'May (05)',
                                        '06' => 'June (06)',
                                        '07' => 'July (07)',
                                        '08' => 'August (08)',
                                        '09' => 'September (09)',
                                        '10' => 'October (10)',
                                        '11' => 'November (11)',
                                        '12' => 'December (12)',
                                    );

                                    echo form_dropdown('expirationmonth', $options, set_value('expirationmonth'), $extra);
                                    ?>
                                    <?php echo(!empty(form_error('expirationmonth')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                    <?php echo form_error('expirationmonth'); ?>
                                </div>
                            </div>
                            <div class="form-group <?php echo(!empty(form_error('expirationyear')) ? 'has-error has-feedback' : ''); ?>">
                                <label class="col-md-3 control-label">Expiration Year *</label>
                                <div class="col-md-9">
                                    <?php
                                    $extra = array(
                                        'class' => 'form-control selectpicker',
                                        'id' => 'expirationyear',
                                        'name' => 'expirationyear',
                                        'data-live-search' => 'true',
                                        'data-style' => (!empty(form_error('expirationyear')) ? 'btn-danger' : ''),
                                    );


                                    $options = array();
                                    for ($i = 0; $i <= 10; $i++ ){
                                        $a_year = date("Y") + $i;
                                        $options[$a_year] = $a_year;
                                    }

                                    echo form_dropdown('expirationyear', $options, set_value('expirationyear'), $extra);
                                    ?>
                                    <?php echo(!empty(form_error('expirationyear')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                    <?php echo form_error('expirationyear'); ?>
                                </div>
                            </div>

                            <div class="form-group <?php echo(!empty(form_error('cvv2')) ? 'has-error has-feedback' : ''); ?>">
                                <label class="col-md-3 control-label">CVV2 *</label>
                                <div class="col-md-9">
                                    <?php
                                    $data = array(
                                        'name'          => 'cvv2',
                                        'id'            => 'cvv2',
                                        'value'         => set_value('cvv2'),
                                        'class'         => 'form-control cvv2',
                                        'type'          => 'text',
                                        'placeholder'   => '000',
                                        'maxlength'     => '4',
                                        'data-parsley-required' => 'true'
                                    );

                                    echo form_input($data);
                                    ?>
                                    <?php echo(!empty(form_error('cvv2')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                    <?php echo form_error('cvv2'); ?>
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
                                            <u>Email:</u> <a href="mailto:print@osinc.org">print@osinc.org</a>
                                            <br/>
                                            <u>Address:</u>  Occupational Services, Inc.
                                            <br/>
                                            <div style="margin-left:5em">17 Redwood Street</div>
                                            <div style="margin-left:5em">Chambersburg, PA  17201</div><br/>
                                        </address>
                                        <address>
                                            <strong>Partnering with:</strong><br />
                                            Design & Built By iWAT
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
        var x_timer;



        // Change total on text area change
        function updateTotal() // add e as paramenter if we want IE
        {
//            e = e || window.event; // IE doesn't pass event to callback
//            var target = e.target || e.srcElement; // IE == srcElement, good browsers: target

            // Static database variables
            var numChars = document.getElementById('adtext').value.length;
            var pricePerLine = parseFloat(price_per_line);

            // Ad Text variables
            var numChecked = parseFloat($('input[name="issues[]"]:checked').length);
            var numLines = Math.ceil( numChars / lines_per_char );
            document.getElementById('totallines').value = numLines;

            // Promo code variables
            var percentage = $('#percentage').text();
            var numMonths = $('#numMonths').text();

//            console.log('Total before Promo Code: ' + total);

            // Apply percentage off depending on the number of boxes checked and the promo code percentage
            if (numMonths && numChecked >= numMonths)
            {
                var numMonthsWithoutPercentage = numChecked - numMonths;
                var numMonthsWithPercentage = numChecked - numMonthsWithoutPercentage;

                var withoutPercentage = numMonthsWithoutPercentage * (numLines * pricePerLine);

                if (percentage)
                {
                    // convert to true percentage
                    var decimalPercent = parseFloat(percentage) / 100.0;

                    var newTotal = numMonthsWithPercentage * (numLines * pricePerLine);

                    var discount = decimalPercent * newTotal;

                    var withPercentage = newTotal - discount;
                }

                var total = withPercentage + withoutPercentage;

//                console.log('Without Promo code applied to ' + numMonthsWithoutPercentage + 'months: ' + withoutPercentage);
//                console.log('With Promo code applied to ' + numMonthsWithPercentage + 'months: ' + withPercentage);
            } else if (numMonths && numChecked < numMonths)
            {
                // All months get the percentage off
                var allMonths = numChecked;
                if (percentage)
                {
                    // convert to true percentage
                    var decimalPercent = parseFloat(percentage) / 100.0;

                    var newTotal = allMonths * (numLines * pricePerLine);

                    var discount = decimalPercent * newTotal;

                    var total = newTotal - discount;
                }

            } else
            {
//                console.log('Promotion not applied!');
                var total = numChecked * (numLines * pricePerLine);
            }

//            console.log(
////                'Lines per character: '             + lines_per_char + '\n' +
////                'Price per line: '                  + price_per_line + '\n' +
//                'Number of lines in Text Area: '    + numLines + '\n' +
//                'Number of months checked: '        + numChecked + '\n' +
//                'Percentage off  for promo code: '  + percentage + '\n' +
//                'Number of months for promo code: ' + numMonths + '\n' +
//                'Grand Total: '                     + total
//            );

            if(total)
            {
                document.getElementById('grandtotal').value = total.toFixed(2);
            } else
            {
                total = 0;
                document.getElementById('grandtotal').value = total.toFixed(2);
            }

//                $('#numlines').text(lines); // set total lines span
            document.getElementById('totallines').value = numLines; // set hidden input
        }


        // bind event listener to the div containing all elements you want to be 'handled'
        var mainDiv = document.getElementById('allInputs');
        var issuesDiv = document.getElementById('allIssues');
        if (!(mainDiv.addEventListener) && !(issuesDiv.addEventListener))
        {
            mainDiv.attachEvent('onfocusout',updateTotal); //IE doesn't have EventListeners, and doesn't support onchange this way, use onfocusout
            issuesDiv.attachEvent("onclick", updateTotal);
        }
        else
        {
            mainDiv.addEventListener('keyup',updateTotal,false);
            issuesDiv.addEventListener('CheckboxStateChange',updateTotal,false);
        }


        // Check the promo code
        $("#promocode").keyup(function (e)
        {
            clearTimeout(x_timer);
            var promo_code = $(this).val();
            x_timer = setTimeout(function() { check_promocode_ajax(promo_code); }, 1000);
        });
        function check_promocode_ajax(promocode)
        {
            $("#promo-result").html('<img src="<?php echo base_url() ?>assets/img/ajax-loader.gif" />');

            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "classifiedad/Classifiedad/check_promocode",
                dataType: 'json',
                data: {promocode:promocode},
                success: function(res) {
                    if (res) {
                        $("#promo-result").html('<img src="<?php echo base_url() ?>assets/img/checkmark.ico" />');
                        $("#promo-info").show();

                        $("#promo-info").html(
                            '<label class="col-md-3 control-label">Promotional Code Information:</label>' +
                            '<div class="col-md-8">' +
                            '<div class="panel-body">' +
                            '<table class="table" border="1">' +
                            '<thead>' +
                            '<tr>' +
                            '<th>Code</th>' +
                            '<th>Description</th>' +
                            '<th>Percentage</th>' +
                            '<th>Months</th>' +
                            '<th>Start Date</th>' +
                            '<th>End Date</th>' +
                            '</tr>' +
                            '</thead>' +
                            '<tbody>' +
                            '<tr>' +
                            '<td>' + res.code + '</td>' +
                            '<td>' + res.description + '</td>' +
                            '<td>' + res.percentage + '</td>' +
                            '<td>' + res.months + '</td>' +
                            '<td>' + res.startdate + '</td>' +
                            '<td>' + res.enddate + '</td>' +
                            '</tr>' +
                            '</tbody>' +
                            '</table>' +
                            '</div>' +
                            '</div>'
                        );

                        // Set the percentage in a div
                        $("#percentage").html(parseInt(res.percentage));

                        // Set the number of months in a div
                        $("#numMonths").html(parseInt(res.months));

                        // Set the total value by applying the discount
//                        document.getElementById('grandtotal').value = (document.getElementById('grandtotal').value - ((parseInt(res.percentage) / 100) * document.getElementById('grandtotal').value)).toFixed(2); // set the text box total price

                        $("#promocode").prop("disabled", true);

                        updateTotal();

                    } else
                    {
                        $("#promo-result").html('<img src="<?php echo base_url() ?>assets/img/cross.png" />');
                        $("#promo-info").empty();
                        $("#promo-info").hide();

                    }
                }
            });
        }

        // Credit card information gets processed
        $("#loading-div-background").css({ opacity: 1.0 });

        $('#classifiedad').submit(function(){
            $("#promocode").prop("disabled", false);
            $("#promocode").prop("readonly", true);

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
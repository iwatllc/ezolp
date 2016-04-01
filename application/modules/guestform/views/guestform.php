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


<script src="<?php echo base_url(); ?>/assets/plugins/moment/moment.min.js" rel="stylesheet" ></script>
<script>
    moment().format();
</script>

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
                <img src="<?php echo base_url(); ?>/client/<?php echo $Guestform_Logo ?>" alt="" height="120" width="800">
            <?php } ?>
            <?php echo $page_data['heading'];?>
        </h1>
        <!-- end page-header -->


        <div class="row">
            <!-- begin col-12 -->
            <div class="col-12">
                <?php $attributes = array('class' => 'form-horizontal', 'id' => 'guestform'); ?>
                <?php echo form_open('guestform/submit', $attributes);
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
                            <h4 class="panel-title">PAYMENT INFORMATION (* = Required Field)</h4>
                        </div>
                        <div class="panel-body">

                            <legend>Donation Information</legend>

                            <div class="form-group <?php echo(!empty(form_error('paymentamount')) ? 'has-error has-feedback' : ''); ?>">
                                <label class="col-md-3 control-label">AMOUNT<span class="required">*</span></label>
                                <div class="col-md-9">
                                    <div class="btn-group pay-btns pay-btns-1" data-toggle="buttons">
                                        <label class="btn btn-primary radio-amount">
                                            <input type="radio" class="amt-rad" name="paymentamount" id="paymentamount1000" value="1000.00" <?php echo set_radio('paymentamount', '1000.00'); ?> /> <span>$1,000</span>
                                        </label>

                                        <label class="btn btn-primary radio-amount">
                                            <input type="radio" class="amt-rad" name="paymentamount" id="paymentamount500" value="500.00" <?php echo set_radio('paymentamount', '500.00'); ?> /><span>$500</span>
                                        </label>

                                        <label class="btn btn-primary radio-amount">
                                            <input type="radio" class="amt-rad" name="paymentamount" id="paymentamount250" value="250.00" <?php echo set_radio('paymentamount', '250.00'); ?> /><span>$250</span>
                                        </label>

                                        <label class="btn btn-primary radio-amount">
                                            <input type="radio" class="amt-rad" name="paymentamount" id="paymentamount100" value="100.00" <?php echo set_radio('paymentamount', '100.00'); ?> /><span>$100</span>
                                        </label>

                                        <label class="btn btn-primary radio-amount">
                                            <input type="radio" class="amt-rad" name="paymentamount" id="paymentamount50" value="50.00" <?php echo set_radio('paymentamount', '50.00'); ?> /><span>$50</span>
                                        </label>

                                        <label class="btn btn-primary radio-amount other-special">
                                            <input type="radio" class="amt-rad" name="paymentamount" id="paymentamountother" value="other" <?php echo set_radio('paymentamount', 'other'); ?> /><span>Other</span>
                                            $
                                        </label>
                                        <?php
                                        $data = array(
                                            'name'          => 'otheramount',
                                            'id'            => 'maskedMoney-input-paymentamount',
                                            'value'         => set_value('otheramount'),
                                            'class'         => 'form-control input-other-pay',
                                            'type'          => 'text',
                                            'placeholder'   => '0.00',
                                            'maxlength'     => '10'
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('paymentamount')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('paymentamount'); ?>
                                        <?php echo(!empty(form_error('otheramount')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('otheramount'); ?>
                                    </div><!-- ./ pay-btns -->
                                </div><!-- ./col-md-9 -->
                            </div>


                            <div class="form-group <?php echo(!empty(form_error('recurring')) ? 'has-error has-feedback' : ''); ?>">
                                <label class="col-md-3 control-label">MAKE RECURRING<span class="required"></span></label>
                                <div class="col-md-9">
                                    <div class="btn-group pay-btns pay-btns-1" data-toggle="buttons">
                                        <label class="btn btn-primary radio-recurring">One-Time Gift
                                            <?php
                                            $data_onetime = array(
                                                'name'          => 'recurring',
                                                'id'            => 'recurring',
                                                'value'         => 'One-Time',
                                                'class'         => 'form-control radio-recurring',
                                                'checked'       => set_radio('recurring', 'One-Time', true)
                                            );
                                            echo form_radio($data_onetime);
                                            ?>
                                        </label>
                                        <label class="btn btn-primary radio-recurring">Recurring Gift
                                            <?php
                                            $data_recurring = array(
                                                'name'          => 'recurring',
                                                'id'            => 'recurring',
                                                'value'         => 'Recurring',
                                                'class'         => 'form-control radio-recurring',
                                                'checked'       => set_radio('recurring', 'Recurring')
                                            );
                                            echo form_radio($data_recurring);
                                            ?>
                                        </label>
                                        <label class="btn btn-primary radio-recurring">Pledge
                                            <?php
                                            $data_pledge = array(
                                                'name'          => 'recurring',
                                                'id'            => 'recurring',
                                                'value'         => 'Pledge',
                                                'class'         => 'form-control radio-recurring',
                                                'checked'       => set_radio('recurring', 'Pledge')
                                            );
                                            echo form_radio($data_pledge);
                                            ?>
                                        </label>
                                    </div><!-- ./ pay-btns -->
                                </div><!-- ./col-md-9 -->
                            </div>

                            <div class="recurring_info" >
                                <div class="form-group <?php echo(!empty(form_error('frequency')) ? 'has-error has-feedback' : ''); ?>">

                                    <label class="col-md-3 control-label">FREQUENCY</label>
                                    <div class="col-md-9">
                                        <?php
                                        $extra = array(
                                            'class' => 'form-control frequencypicker',
                                            'data-live-search' => 'false',
                                            'data-style' => (!empty(form_error('frequency')) ? 'btn-danger' : ''),
                                        );

                                        $options = array(
                                            '1' =>'Day 1 of every month',
                                            '15' => 'Day 15 of every month',
                                        );

                                        echo form_dropdown('frequency', $options, set_value('frequency'), $extra);
                                        ?>
                                    </div>
                                    <label class="col-md-3 control-label">STARTING</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="datepicker" name="recurring-start-date" placeholder="Select Date" value="<?php echo date("n/j/Y"); ?>"/>
                                    </div>
                                    <label class="col-md-3 control-label">ENDING</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="datepicker2" name="recurring-end-date" placeholder="Select Date" value=""/>
                                    </div>
                                </div>
                            </div>



                            <div class="pledge_info" >
                                <div class="form-group <?php echo(!empty(form_error('installments')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">NUMBER OF INSTALLMENTS*</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'installments',
                                            'id'            => 'installments',
                                            'value'         => set_value('installments'),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => 'Required',
                                            'maxlength'     => '100',
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('amount_installments')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('amount_installments'); ?>
                                    </div>
                                    <label class="col-md-3 control-label">AMOUNT OF INSTALLMENTS</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'amount_installments',
                                            'id'            => 'amount_installments',
                                            'value'         => set_value('amount_installments'),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => 'Please enter a number of installments and select an amount',
                                            'maxlength'     => '100',
                                        );

                                        echo form_input($data);
                                        ?>
                                    </div>
                                    <label class="col-md-3 control-label">FREQUENCY</label>
                                    <div class="col-md-9">
                                        <?php
                                        $extra = array(
                                            'class' => 'form-control frequencypicker',
                                            'name'  => 'pledge_frequency',
                                            'id'    => 'pledge_frequency',
                                            'data-live-search' => 'false',
                                            'data-style' => (!empty(form_error('frequency')) ? 'btn-danger' : ''),
                                        );

                                        $options = array(
                                            '1' =>'Day 1 of every month',
                                            '15' => 'Day 15 of every month',
                                        );

                                        echo form_dropdown('frequency', $options, set_value('frequency'), $extra);
                                        ?>
                                    </div>
                                    <label class="col-md-3 control-label">STARTING</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="datepicker3" name="pledge-start-date" placeholder="Select Date" value="<?php echo date("n/j/Y"); ?>"/>
                                    </div>
                                    <label class="col-md-3 control-label">ENDING</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="end-date" name="pledge-end-date" placeholder="" value=""/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group <?php echo(!empty(form_error('designations')) ? 'has-error has-feedback' : ''); ?>">
                                <label class="col-md-3 control-label">DESIGNATIONS</label>
                                <div class="col-md-9">
                                    <?php
                                    $extra = array(
                                        'class' => 'form-control selectpicker',
                                        'data-live-search' => 'true',
                                        'data-style' => (!empty(form_error('designations')) ? 'btn-danger' : ''),
                                    );

                                    $options = array(
                                        '13' =>'Where the Need is Greatest',
                                        '26' => 'Citizens Baptist Medical Center',
                                        '30' =>'Princeton Baptist Medical Center',
                                        '24' =>'Shelby Baptist Medical Center',
                                        '25' =>'Walker Baptist Medical Center'
                                    );

                                    echo form_dropdown('designations', $options, set_value('designations'), $extra);
                                    ?>
                                    <?php echo(!empty(form_error('designations')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                    <?php echo form_error('designations'); ?>
                                </div>
                            </div>


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
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('firstname')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('firstname'); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo(!empty(form_error('middleinitial')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">MIDDLE INITIAL</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'middleinitial',
                                            'id'            => 'middleinitial',
                                            'value'         => set_value('middleinitial'),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => 'Middle Initial',
                                            'maxlength'     => '1'
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('middleinitial')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('middleinitial'); ?>
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
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('streetaddress')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('streetaddress'); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo(!empty(form_error('streetaddress2')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">STREET ADDRESS(2)</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'streetaddress2',
                                            'id'            => 'streetaddress2',
                                            'value'         => set_value('streetaddress2'),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => '',
                                            'maxlength'     => '100',
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('streetaddress2')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('streetaddress2'); ?>
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
                                                'WY' =>'Wyoming'
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
                                            'maxlength'     => '5'
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('zip')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('zip'); ?>
                                    </div>
                                </div>

                                <div class="form-group <?php echo(!empty(form_error('phone')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">PHONE</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'phone',
                                            'id'            => 'phone',
                                            'value'         => set_value('phone'),
                                            'class'         => 'form-control',
                                            'type'          => 'phone',
                                            'placeholder'   => 'Phone',
                                            'maxlength'     => '100'
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('phone')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('phone'); ?>
                                    </div>
                                </div>

                                <div class="form-group <?php echo(!empty(form_error('email')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">EMAIL*</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'email',
                                            'id'            => 'email',
                                            'value'         => set_value('email'),
                                            'class'         => 'form-control',
                                            'type'          => 'email',
                                            'placeholder'   => 'Email Address',
                                            'maxlength'     => '100'
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('zip')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('zip'); ?>
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
                                            'maxlength'     => '4'
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('cvv2')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('cvv2'); ?>
                                    </div>
                                </div>


                            <legend>Tribute Information</legend>


                            <div class="form-group <?php echo(!empty(form_error('tributeefirstname')) ? 'has-error has-feedback' : ''); ?>">
                                <label class="col-md-3 control-label">FIRST NAME</label>
                                <div class="col-md-9">
                                    <?php
                                    $data = array(
                                        'name'          => 'tributeefirstname',
                                        'id'            => 'tributeefirstname',
                                        'value'         => set_value('tributeefirstname'),
                                        'class'         => 'form-control',
                                        'type'          => 'text',
                                        'placeholder'   => '',
                                        'maxlength'     => '100',
                                    );

                                    echo form_input($data);
                                    ?>
                                    <?php echo(!empty(form_error('tributeefirstname')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                    <?php echo form_error('tributeefirstname'); ?>
                                </div>
                            </div>
                            <div class="form-group <?php echo(!empty(form_error('tributeelastname')) ? 'has-error has-feedback' : ''); ?>">
                                <label class="col-md-3 control-label tribute-lastname">LAST NAME</label>
                                <div class="col-md-9">
                                    <?php
                                    $data = array(
                                        'name'          => 'tributeelastname',
                                        'id'            => 'tributeelastname',
                                        'value'         => set_value('tributeelastname'),
                                        'class'         => 'form-control',
                                        'type'          => 'text',
                                        'placeholder'   => 'Required',
                                        'maxlength'     => '100',
                                    );

                                    echo form_input($data);
                                    ?>
                                    <?php echo(!empty(form_error('tributeelastname')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                    <?php echo form_error('tributeelastname'); ?>
                                </div>
                            </div>

                            <div class="form-group <?php echo(!empty(form_error('mailtribute')) ? 'has-error has-feedback' : ''); ?>">
                                <label class="col-md-3 control-label">MAIL TRIBUTE</label>
                                <div class="col-md-9">
                                    <?php
                                    $data = array(
                                        'name'          => 'mailtribute',
                                        'id'            => 'mailtribute',
                                        'value'         => 'mailtribute',
                                        'checked'       => set_checkbox('mailtribute', 'mailtribute', FALSE),
                                        'class'         => 'form-control'
                                    );

                                    echo form_checkbox($data);
                                    ?>
                                    <?php echo(!empty(form_error('mailtribute')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                    <?php echo form_error('mailtribute'); ?>
                                </div>
                            </div>


                            <div class="tributeto_info" >
                                <div class="form-group <?php echo(!empty(form_error('tributetofirstname')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">FIRST NAME</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'tributetofirstname',
                                            'id'            => 'tributetofirstname',
                                            'value'         => set_value('tributetofirstname'),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => '',
                                            'maxlength'     => '100',
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('tributetofirstname')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('tributetofirstname'); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo(!empty(form_error('tributetolastname')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">LAST NAME*</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'tributetolastname',
                                            'id'            => 'tributetolastname',
                                            'value'         => set_value('tributetolastname'),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => 'Required',
                                            'maxlength'     => '100'
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('tributetolastname')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('tributetolastname'); ?>
                                    </div>
                                </div>

                                <div class="form-group <?php echo(!empty(form_error('tributetostreetaddress')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">STREET ADDRESS*</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'tributetostreetaddress',
                                            'id'            => 'tributetostreetaddress',
                                            'value'         => set_value('tributetostreetaddress'),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => 'Required',
                                            'maxlength'     => '100',
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('tributetostreetaddress')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('tributetostreetaddress'); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo(!empty(form_error('tributetostreetaddress2')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">STREET ADDRESS(2)</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'tributetostreetaddress2',
                                            'id'            => 'tributetostreetaddress2',
                                            'value'         => set_value('tributetostreetaddress2'),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => '',
                                            'maxlength'     => '100',
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('tributetostreetaddress2')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('tributetostreetaddress2'); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo(!empty(form_error('tributetocity')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">CITY*</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'tributetocity',
                                            'id'            => 'tributetocity',
                                            'value'         => set_value('tributetocity'),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => 'Required',
                                            'maxlength'     => '100',
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('tributetocity')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('tributetocity'); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo(!empty(form_error('tributetostate')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">STATE*</label>
                                    <div class="col-md-9">
                                        <?php
                                        $extra = array(
                                            'class' => 'form-control selectpicker',
                                            'data-live-search' => 'true',
                                            'data-style' => (!empty(form_error('tributetostate')) ? 'btn-danger' : ''),
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

                                        echo form_dropdown('tributetostate', $options, set_value('tributetostate'), $extra);
                                        ?>
                                        <?php echo(!empty(form_error('tributetostate')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('tributetostate'); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo(!empty(form_error('tributetozip')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">ZIP*</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'tributetozip',
                                            'id'            => 'masked-input-zip',
                                            'value'         => set_value('tributetozip'),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => '99999',
                                            'maxlength'     => '5'
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('tributetozip')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('tributetozip'); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo(!empty(form_error('tributetophone')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">PHONE</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'tributetophone',
                                            'id'            => 'tributetophone',
                                            'value'         => set_value('tributetophone'),
                                            'class'         => 'form-control',
                                            'type'          => 'email',
                                            'placeholder'   => 'email address',
                                            'maxlength'     => '100'
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('tributetophone')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('tributetophone'); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo(!empty(form_error('tributetoemail')) ? 'has-error has-feedback' : ''); ?>">
                                        <label class="col-md-3 control-label">EMAIL</label>
                                        <div class="col-md-9">
                                            <?php
                                            $data = array(
                                                'name'          => 'tributetoemail',
                                                'id'            => 'tributetoemail',
                                                'value'         => set_value('tributetoemail'),
                                                'class'         => 'form-control',
                                                'type'          => 'email',
                                                'placeholder'   => 'email address',
                                                'maxlength'     => '100',
                                            );

                                            echo form_input($data);
                                            ?>
                                            <?php echo(!empty(form_error('tributetoemail')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                            <?php echo form_error('tributetoemail'); ?>
                                        </div>
                                </div>

                            </div>
                            <br><br><br><br><br>


                            <div class="form-group">
                                <label class="col-md-3 control-label">Submit</label>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-sm btn-success">Submit Button</button>
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
        $("#loading-div-background").css({ opacity: 1.0 });

        $( "#datepicker" ).datepicker({defaultDate: null});
        $( "#datepicker2" ).datepicker({defaultDate: null});
        $( "#datepicker3" ).datepicker({defaultDate: null});

        if( $('#mailtribute').is(":checked") ) {
            $(".tributeto_info").show();
        } else {
            $(".tributeto_info").hide();
        }

        if( $("input:radio[name=recurring]").is(":checked") ) {
            $('input:radio[name=recurring]:checked').parent('.radio-recurring').addClass('active');
            var recurring_type = $("input:radio[name=recurring]:checked" ).val();
            radio_recurring_toggle(recurring_type);
        }

        $('[name="pledge-end-date"]').attr("disabled", "disabled");
        $('[name="amount_installments"]').attr("disabled", "disabled");


        // Prepare some things on the page based on if the radio button was selected and
        // validation failed for some reason.
        if( $("input:radio[name=paymentamount]").is(":checked") ) {

            // When the page is submitted and validation fails we need to determine which
            // radio button was selected and then add the active class to the label so it
            // shows as highlighted.
            $('input:radio[name=paymentamount]:checked').parent('.radio-amount').addClass('active');

            var amount = $("input:radio[name=paymentamount]:checked" ).val();
            if( amount  === 'other' ) {
                $("#maskedMoney-input-paymentamount").show();
            } else {
                $("#maskedMoney-input-paymentamount").val('0.00');
                $("#maskedMoney-input-paymentamount").hide();
            }
        } else {
            $("#maskedMoney-input-paymentamount").val('0.00');
            $("#maskedMoney-input-paymentamount").hide();
        }

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

    $('#mailtribute').change(function(){
        if(this.checked){
            $(".tribute-lastname").text('LAST NAME*');
        } else {
            $(".tribute-lastname").text('LAST NAME');
        }
        $(".tributeto_info").toggle();
    });

    $('.amt-rad').change(function(){
        var amount = $("input:radio[name=paymentamount]:checked" ).val();
        if( amount  === 'other' ){
            $("#maskedMoney-input-paymentamount").show();
            $("#maskedMoney-input-paymentamount").val('0.00');
        } else {
            $("#maskedMoney-input-paymentamount").hide();
            $("#maskedMoney-input-paymentamount").val('0.00');
        }
        $( "#installments" ).keyup();
    });

    $('.radio-recurring').change(function(){
        var recurring_type = $("input:radio[name=recurring]:checked" ).val();
        radio_recurring_toggle(recurring_type);
    });


    function radio_recurring_toggle(param){
        switch (param){
            case "One-Time":
                // Do nothing.
                $(".recurring_info").hide();
                $(".pledge_info").hide();
                break;
            case "Recurring":
                $(".recurring_info").show();
                $(".pledge_info").hide();
                break;
            case "Pledge":
                $(".recurring_info").hide();
                $(".pledge_info").show();
                break;
        }
    }

    $('#installments').keyup(function(){
        var amount = $("input:radio[name=paymentamount]:checked" ).val();
        var installments = $('#installments').val();

        if ($('input:radio[name=paymentamount]:checked').length === 0 ){
            $('[name="pledge-end-date"]').val('Please select or enter an amount');
        } else if (installments === '') {
            $('[name="pledge-end-date"]').val('Please enter a number of installments');
            $('#amount_installments').val('0.00');
        } else {
            if (amount === 'other') {
                amount = $("#maskedMoney-input-paymentamount").val();
                amount = amount.replace(",", "");
            }
            var installment_amount = (amount / installments);
            // $('[name="pledge-end-date"]').val(installment_amount.toFixed(2));
            $('#amount_installments').val(installment_amount.toFixed(2));

            var startdate = $('[name="pledge-start-date"]').val();
            //var daysahead = installments * 30;
            //var endingdate = new Date(startdate);
            //endingdate.setDate(endingdate.getDate() + daysahead);
            //$('[name="pledge-end-date"]').val(endingdate.toLocaleDateString());
            $('[name="pledge-end-date"]').val(calculate_ending_date(startdate, installments));
        }

    });

    $('#maskedMoney-input-paymentamount').keyup(function(){
        $( "#installments" ).keyup();
    });


    $('[name="pledge-start-date"]').change(function(){
        var startdate = $('[name="pledge-start-date"]').val();
        var installments = $('#installments').val();
        $('[name="pledge-end-date"]').val(calculate_ending_date(startdate, installments));
    });

    // This function will calculate the ending date of the installments.
    function calculate_ending_date(startdate, installments){
        var pledge_frequency = $('#pledge_frequency').val();

        var selected_date = new Date(startdate);
        var m = moment(selected_date);

        if ( pledge_frequency === '1') {
            if (selected_date.getDate() === pledge_frequency){
                m.add(parseInt(installments), 'months');
                m.startOf('month');
            } else {
                m.add(parseInt(installments), 'months');
                m.startOf('month');
            }
        } else if ( pledge_frequency === '15') {
            if (selected_date.getDate() <= pledge_frequency){
                m.add(parseInt(installments)-1, 'months');
                m.startOf('month');
                m.add(14, 'days');
            } else {
                m.add(parseInt(installments), 'months');
                m.startOf('month');
                m.add(14, 'days');
            }

        }

        return m.format('L');
    }





</script>



</body>
</html>



<?php } else { ?>



<?php } ?>
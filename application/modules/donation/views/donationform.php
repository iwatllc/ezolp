<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<?php 
		$css = new Asset_css('donationform');
	    $css->add_asset($this->config->item('base_preprocess'));
		$css->add_asset($this->config->item('client'));
		$css->add_asset('./assets/scss/donation.scss');
	
		$data['asset'] = $css;
		$this->load->view('header', $data); 
?>
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

<body class="flat-black donation-form">

<!-- begin #page-container -->
<div id="page-container" class="fade in page-without-sidebar">
    <!-- begin #header -->
    <div id="header" class="header navbar navbar-default">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <!-- begin mobile sidebar expand / collapse button -->
            <div class="navbar-header">
                <a href="<?php echo current_url(); ?>">
                    <div class="logo-img">
                        <img src="<?php echo base_url(); ?>/client/client.png">
                    </div>
                    <h1 class="page-title"><?php echo $page_data['title'];?></h1>
                </a>
            </div>
            <!-- end mobile sidebar expand / collapse button -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end #header -->
    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header"><?php echo $page_data['slogan'];?></h1>
        <!-- end page-header -->
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-12">
                <?php $attributes = array('class' => 'form-horizontal', 'id' => 'donationform'); ?>
                <?php echo form_open('donation/Donation/submit', $attributes); ?>
                    <!-- begin panel -->
                    <div class="panel panel-inverse" >
                        <div class="panel-heading">
                            <h4 class="panel-title">DONATION INFORMATION ( <span class="required">*</span> = Required Field)</h4>
                        </div>
                        <div class="panel-body">
                        		<div class="donation-grp">
									<legend>My Donation</legend>
									<div class="form-group <?php echo(!empty(form_error('paymentamount')) ? 'has-error has-feedback' : ''); ?>">
										<div class="row">
											<label class="col-md-3 control-label">Amount <span class="required">*</span></label>
											<div class="col-md-9">
												<div class="btn-group pay-btns pay-btns-1" data-toggle="buttons">
													<label class="btn btn-primary">
														<input type="radio" class="amt-rad" name="paymentamount" id="paymentamount25" value="25.00" <?php echo set_radio('paymentamount', '25.00'); ?> /> <span>$25</span>
													</label>
												
													<label class="btn btn-primary">
														<input type="radio" class="amt-rad" name="paymentamount" id="paymentamount50" value="50.00" <?php echo set_radio('paymentamount', '50.00'); ?> /><span>$50</span>
													</label>
											
													<label class="btn btn-primary">
														<input type="radio" class="amt-rad" name="paymentamount" id="paymentamount75" value="75.00" <?php echo set_radio('paymentamount', '75.00'); ?> /><span>$75</span>
													</label>
												
													<label class="btn btn-primary">
														<input type="radio" class="amt-rad" name="paymentamount" id="paymentamount100" value="100.00" <?php echo set_radio('paymentamount', '100.00'); ?> /><span>$100</span>
													</label>
												
													<label class="btn btn-primary">
														<input type="radio" class="amt-rad" name="paymentamount" id="paymentamount200" value="200.00" <?php echo set_radio('paymentamount', '200.00'); ?> /><span>$200</span>
													</label>
													
													<label class="btn btn-primary other-special">
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
												'maxlength'     => '10',
												'data-parsley-required' => 'true'
											);
											
											echo form_input($data);
											?>
											
													
												</div><!-- ./ pay-btns -->
											</div><!-- ./col-md-9 -->
										</div><!-- ./row -->

										
										<div class="row other-pay-error">
											<div class="col-md-9 col-md-offset-3">
												<?php echo form_error('paymentamount'); ?>
												<?php echo form_error('otheramount'); ?>
											</div>
										</div>
									</div><!-- ./ form-grp -->	
								</div><!-- ./donation-grp -->
									
											<!--
											
											<div class="btn-group pay-btns" data-toggle="buttons">
												
											<div class="other-pay-grp">	
											
												
												<div id="other-amount">
													<span class="fa fa-usd"></span>

												
											</div>
											</div>
											
											<?php //echo(!empty(form_error('paymentamount')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
											
											<?php //echo(!empty(form_error('otheramount')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
											
										</div>
									</div>
								</div>
							</div>	
							</div>-->
				
				
				
							<div class="donation-grp">
                            <legend>My Information</legend>
                                <div class="form-group <?php echo(!empty(form_error('fullname')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">Full Name <span class="required">*</span></label>
                                    <div class="col-md-9">
                                        <?php
                                            $data = array(
                                                'name'          => 'fullname',
                                                'id'            => 'fullname',
                                                'value'         => set_value('fullname'),
                                                'class'         => 'form-control max-250',
                                                'type'          => 'text',
                                                'placeholder'   => 'Required',
                                                'maxlength'     => '100',
                                                'data-parsley-required' => 'true'
                                            );

                                            echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('fullname')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('fullname'); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo(!empty(form_error('streetaddress')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">Street Address <span class="required">*</span></label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'streetaddress',
                                            'id'            => 'streetaddress',
                                            'value'         => set_value('streetaddress'),
                                            'class'         => 'form-control max-350',
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
                                <div class="form-group <?php echo(!empty(form_error('streetaddress2')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">Street Address (2)</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'streetaddress2',
                                            'id'            => 'streetaddress2',
                                            'value'         => set_value('streetaddress2'),
                                            'class'         => 'form-control max-350',
                                            'type'          => 'text',
                                            'placeholder'   => '',
                                            'maxlength'     => '100',
                                            'data-parsley-required' => 'true'
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('streetaddress2')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('streetaddress2'); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo(!empty(form_error('city')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">City <span class="required">*</span></label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'city',
                                            'id'            => 'city',
                                            'value'         => set_value('city'),
                                            'class'         => 'form-control max-350',
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
                                    <label class="col-md-3 control-label">State <span class="required">*</span></label>
                                    <div class="col-md-9">
                                        <?php
                                            $extra = array(
                                                'class' => 'form-control selectpicker max-200',
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
                                    <label class="col-md-3 control-label">Zip Code <span class="required">*</span></label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'zip',
                                            'id'            => 'masked-input-zip',
                                            'value'         => set_value('zip'),
                                            'class'         => 'form-control max-100',
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
                                <div class="form-group <?php echo(!empty(form_error('email')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'email',
                                            'id'            => 'email',
                                            'value'         => set_value('email'),
                                            'class'         => 'form-control max-250',
                                            'type'          => 'email',
                                            'placeholder'   => 'email address',
                                            'maxlength'     => '100',
                                            'data-parsley-required' => 'false'
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('email')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('email'); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo(!empty(form_error('notes')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">Notes</label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'notes',
                                            'id'            => 'notes',
                                            'value'         => set_value('notes'),
                                            'class'         => 'form-control max-350',
                                            'type'          => 'text',
                                            'placeholder'   => 'Notes',
                                            'maxlength'     => '100',
                                            'data-parsley-required' => 'true'
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('notes')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('notes'); ?>
                                    </div>
                                </div>
							</div>	
							
							<div class="donation-grp">
                            <legend>My Payment Information</legend>
                                <div class="form-group <?php echo(!empty(form_error('creditcard')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">Credit Card <span class="required">*</span></label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'creditcard',
                                            'id'            => 'masked-input-cc',
                                            'value'         => set_value('creditcard'),
                                            'class'         => 'form-control max-200',
                                            'type'          => 'text',
                                            'placeholder'   => '9999-9999-9999-9999',
                                            'maxlength'     => '19',
                                            'data-parsley-required' => 'true'
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('creditcard')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('creditcard'); ?>

                                    </div>
                                </div>

                                <div class="form-group <?php echo(!empty(form_error('expirationmonth')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">Expiration Month <span class="required">*</span></label>
                                    <div class="col-md-9">
                                        <?php
                                        $extra = array(
                                            'class' => 'form-control selectpicker max-200',
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
                                    <label class="col-md-3 control-label">Expiration Year <span class="required">*</span></label>
                                    <div class="col-md-9">
                                        <?php
                                        $extra = array(
                                            'class' => 'form-control selectpicker max-200',
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
                                    <label class="col-md-3 control-label">CVV2 <span class="required">*</span></label>
                                    <div class="col-md-9">
                                        <?php
                                        $data = array(
                                            'name'          => 'cvv2',
                                            'id'            => 'masked-input-cvv2',
                                            'value'         => set_value('cvv2'),
                                            'class'         => 'form-control max-200',
                                            'type'          => 'text',
                                            'placeholder'   => '999',
                                            'maxlength'     => '3',
                                            'data-parsley-required' => 'true'
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('cvv2')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('cvv2'); ?>
                                    </div>
                                </div>
							</div>	

                            <div class="form-group">
                                <div class="col-md-12 end-form-donate">
                                    <button type="submit" class="btn btn-donate btn-primary">Donate Now</button>
                                </div>
                            </div>

                            <div class="donation-grp">
                                <div class="form-group">
                                    <div class="col-md-12 end-form-donate">
                                        By clicking Donate, I affirm that the following statements are true and accurate:
                                        <br><br>
                                        <ul>
                                            <li>
                                                I am a United States citizen or lawfully admitted permanent resident.
                                            </li>
                                            <li>
                                                I am making this contribution using my own personal funds, and not those of another.
                                            </li>
                                            <li>
                                                I am making this contribution using my personal credit or debit card, and not with the card of a corporation, business entity, or another person.
                                            </li>
                                            <li>
                                                I do not personally hold a federal government contract.
                                            </li>
                                            <li>
                                                I am at least 16 years old.
                                            </li>
                                        </ul>
                                        <br>
                                        Contributions to Jeb 2016, Inc. are not tax deductible for federal income tax purposes. Contributions to Jeb 2016, Inc. will be used in connection with federal elections and are subject to the limitations and prohibitions of federal law. The maximum an individual may contribute is $2,700 per election. Couples may contribute up to $5,400 per election; joint contributions require the signature of both spouses. Federal multicandidate PACs may contribute up to $5,000 per election. Contributions from corporations, foreign nationals, and federal government contractors are prohibited. Contributions must be made from personal funds and may not be reimbursed by any other person. Federal law requires us to use our best efforts to obtain and report the name, mailing address, occupation, and name of employer for each individual whose contributions aggregate in excess of $200 in an election cycle.
                                        <br><br>
                                        To contribute by mail, please send a personal check made payable to “Jeb 2016, Inc.” to:
                                        <br><br>
                                        Jeb 2016, Inc.
                                        PO Box 440644
                                        Miami, FL 33144
                                        <br><br>
                                        Please include your full name, address, phone number, email address, occupation, and name of employer in the envelope

                                    </div>
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



<script type="text/javascript">
    //$('#vtpaymentform').submit(function(){
    //    $('input[type=submit]', this).attr('disabled', 'disabled');
    //});
    $(document).ready(function() {
        $("#loading-div-background").css({ opacity: 1.0 });

        $('#donationform').submit(function(){
            $('#submit').attr({
                disabled: 'disabled',
                value: 'Processing, Please Wait...'
            });
            $("#loading-div-background").show();
        });
    });

</script>

<script type="text/javascript">
	
	$( document ).ready(function() {
		
		var amount = $('input.amt-rad:checked');
		if (amount.length > 0) {
			$(amount).parent().addClass('active');
		}
		//console.log();
	});
	
	
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
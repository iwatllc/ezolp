<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<?php $this->load->view('header'); ?>

<body class="flat-black">

<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade in page-without-sidebar page-header-fixed">
    <!-- begin #header -->
    <div id="header" class="header navbar navbar-default navbar-fixed-top">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <!-- begin mobile sidebar expand / collapse button -->
            <div class="navbar-header">
                <a href="<?php echo current_url(); ?>" class="navbar-brand"><span class="navbar-logo"></span> EZ Online Pay</a>
                <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- end mobile sidebar expand / collapse button -->


        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end #header -->


    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header"><?php echo $heading;?></h1>
        <!-- end page-header -->


        <div class="row">
            <!-- begin col-12 -->
            <div class="col-12">
                <?php $attributes = array('class' => 'form-horizontal form-bordered'); ?>
                <?php echo form_open('Guestform/submit', $attributes); ?>
                    <!-- begin panel -->
                    <div class="panel panel-inverse" >
                        <div class="panel-heading">
                            <h4 class="panel-title">PAYMENT INFORMATION</h4>
                        </div>
                        <div class="panel-body">
                            <legend>Billing Informaiton</legend>

                                <div class="form-group <?php echo(!empty(form_error('fullname')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">FULL NAME*</label>
                                    <div class="col-md-9">
                                        <?php
                                            $data = array(
                                                'name'          => 'fullname',
                                                'id'            => 'fullname',
                                                'value'         => set_value('fullname'),
                                                'class'         => 'form-control',
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
                                    <label class="col-md-3 control-label">STREET ADDRESS</label>
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
                                            'placeholder'   => 'Required',
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
                                    <label class="col-md-3 control-label">CITY</label>
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
                                    <label class="col-md-3 control-label">STATE</label>
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
                                    <label class="col-md-3 control-label">ZIP</label>
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
                            <legend>Credit Card Informaiton</legend>
                                <div class="form-group <?php echo(!empty(form_error('creditcard')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">CREDIT CARD *</label>
                                    <div class="col-md-8">
                                        <?php
                                        $data = array(
                                            'name'          => 'creditcard',
                                            'id'            => 'masked-input-cc',
                                            'value'         => set_value('creditcard'),
                                            'class'         => 'form-control',
                                            'type'          => 'text',
                                            'placeholder'   => '9999-9999-9999-9999',
                                            'maxlength'     => '5',
                                            'data-parsley-required' => 'true'
                                        );

                                        echo form_input($data);
                                        ?>
                                        <?php echo(!empty(form_error('creditcard')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('creditcard'); ?>

                                    </div>
                                </div>

                                <div class="form-group <?php echo(!empty(form_error('expirationmonth')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">Expiration Month</label>
                                    <div class="col-md-9">
                                        <?php
                                        $extra = array(
                                            'class' => 'form-control selectpicker',
                                            'data-live-search' => 'true',
                                            'data-style' => (!empty(form_error('expirationmonth')) ? 'btn-danger' : ''),
                                        );

                                        $options = array(
                                            '0'  => 'Select State',
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
                                    <label class="col-md-3 control-label">Expiration Year</label>
                                    <div class="col-md-9">
                                        <?php
                                        $extra = array(
                                            'class' => 'form-control selectpicker',
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
                                <div class="form-group">
                                    <label class="col-md-3 control-label">CVV2</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="STREET ADDRESS(2)" />
                                    </div>
                                </div>
                            <legend>Payment Amount</legend>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Amount *</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" id="maskedMoney-input-amount" placeholder="0.00" data-parsley-required="true" />
                                    </div>
                                </div>


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



    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->

</div>
<!-- end page container -->

<?php $this->load->view('footer'); ?>

</body>
</html>
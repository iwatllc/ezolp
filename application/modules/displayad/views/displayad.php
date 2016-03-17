<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php

if($Displayad_Clientform == "FALSE") {

?>

    <!DOCTYPE html>
    <!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
    <!--[if !IE]><!-->
    <html lang="en">
    <!--<![endif]-->

    <?php $this->load->view('header'); ?>

    <style>
        input[type="file"] {
            /*display: none;*/
            /*background:transparent; border:none; color:transparent;*/
        }

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
                <?php if($Displayad_Logo != 'FALSE'){ ?>
                    <img src="<?php echo base_url(); ?>client/<?php echo $Displayad_Logo ?>" alt="" height="120" width="120">
                <?php } ?>
                <?php echo $page_data['heading'];?>
            </h1>
            <!-- end page-header -->

            <div class="row">
                <!-- begin col-12 -->
                <div class="col-12">
                    <?php $attributes = array('class' => 'form-horizontal', 'id' => 'displayad', 'enctype' => 'multipart/form-data'); ?>
                    <?php echo form_open_multipart('displayad/submit', $attributes);
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
                            <h4 class="panel-title">* = Required Field</h4>
                        </div>
                        <div class="panel-body">
                            <legend>
                                <h1><font color="#b8860b">Place your Display Ad in <u>THE CONNECTOR</u></font></h1>
                                <br/>
                                <h3><b>Your ad will be distributed to a broad range of readers across Franklin County in both <span style="color:purple">Print</span> <i>and</i> <span style="color:purple">Online</span>.</b></h3>
                                <br/>
                                <h4>Whether you have an ad ready to upload or need to start from scratch, the professionals in our print shop are ready to help.<br/><br/>Call <a href="tel:7172649293,215">717-264-9293 ext.215</a> or email <a href="mailto:jlahr@osinc.org">jlahr@osinc.org</a>.</h4>
                            </legend>

                            <div class="table-responsive col-md-6">
                                <table class="table table-hover">
                                    <caption><center><h3><u><font face="Modern,Arial">Monthly Pricing</font></u></h3></center></caption>
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th><font size="4">B/W</font></th>
                                        <th><font size="4">Color</font></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($monthly_pricing->result() as $row)
                                        {
                                            echo "<tr>";
                                            echo "<td>";
                                            echo "<font size='4' color='black'>" . $row -> pagesize . "</font>";
                                            echo "</td>";
                                            echo "<td>";
                                            echo "<font size='4'>" . "&#36; " . $row -> bwprice . "</font>";
                                            echo "</td>";
                                            echo "<td>";
                                            echo "<font size='4'>" . "&#36; " . $row -> colorprice . "</font>";
                                            echo "</td>";
                                            echo "<tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-responsive col-md-6">
                                <table class="table table-hover">
                                    <caption><center><h3><u><font face="Modern,Arial">Repeat Advertising Discounts</font></u></h3></center></caption>
                                    <thead>
                                    <td><font size="4">&nbsp;</font></td>
                                    <td><font size="4">&nbsp;</font></td>
                                    <td><font size="4">&nbsp;</font></td>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach($repeat_advertising_discounts->result() as $row)
                                    {
                                        echo "<tr>";
                                        echo "<td align='right'>";
                                        echo "<b><font size='4' color='black'>" . $row -> numissues . " Issues" . "</font></b>";
                                        echo "</td>";
                                        echo "<td align='center'>";
                                        echo "<font size='4'>" . " - " . "</font>";
                                        echo "</td>";
                                        echo "<td>";
                                        echo "<b><font size='4' color='red'>" . "Save " . $row -> percentagediscount . "&#37;" . "</font></b>";
                                        echo "</td>";
                                        echo "<tr>";

                                        $rad_array [$row->numissues] = $row -> percentagediscount;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>

                            &nbsp;
                            <br/><br/><br/><br/><br/><br/>

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
                                        'maxlength'     => '14',
                                        'data-parsley-required' => 'true'
                                    );

                                    echo form_input($data);
                                    ?>
                                    <?php echo(!empty(form_error('phone')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                    <?php echo form_error('phone'); ?>
                                </div>
                            </div>
                            <div class="form-group <?php echo(!empty(form_error('email')) ? 'has-error has-feedback' : ''); ?>">

                                <?php if($Displayad_Email == "TRUE") { ?>
                                    <label class="col-md-3 control-label">EMAIL*<?php echo( $Displayad_Email_Required == 'TRUE' ? '*' : ' ') ?></label>
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
                                            'data-parsley-required' => $Displayad_Email_Required
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
                                $month_array[$i] = date('F', strtotime('first day of +'.($i+1).' month'));
                            }
                            print_r($month_array);
                            ?>

                            <legend>I would like my ad to be listed in the following issue(s):</legend>
                            <div id="allIssues">
                                <div class="form-group <?php echo(!empty(form_error('issues[]')) ? 'has-error has-feedback' : ''); ?>">
                                    <div class="col-md-8 control-label">
                                        <table align="center">
                                            <?php
                                            $i = 0;
                                            foreach ($month_array as $month)
                                            {
                                                if ($i % 2 != 0) // if it's divisible by 6
                                                {
                                                    echo '<td><input type="checkbox" name="issues[]" value="'.$month.'"' . set_checkbox('issues[]', $month) . '/></td>';
                                                    echo '<td><label class="col-md-3 control-label">' . $month . '</label></td>';
                                                    echo '</tr>';
                                                } else
                                                {
                                                    echo '<tr>';
                                                    echo '<td><input type="checkbox" name="issues[]" value="'.$month.'"' . set_checkbox('issues[]', $month) . '/></td>';
                                                    echo '<td><label class="col-md-3 control-label">' . $month . '</label></td>';
                                                    echo '<td><span style="padding-left:5em"></span></td>';
                                                }

                                                $i++;
                                            }
                                            ?>
                                        </table>
                                    </div>
                                    <?php echo(!empty(form_error('issues[]')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                    <?php echo form_error('issues[]'); ?>
                                </div>

                                <legend>Size and color options:</legend>
                                <div id="allIssues">
                                    <div class="form-group <?php echo(!empty(form_error('size[]')) ? 'has-error has-feedback' : ''); ?>">
                                        <div class="col-md-8 control-label">
                                            <table align="center">
                                                <?php
                                                    foreach($monthly_pricing->result() as $price)
                                                    {
                                                        echo '<tr align="left">';
                                                            echo '<td>';
                                                                echo '<input type="radio" name="size[]" price="'.$price->bwprice.'" value="'.$price->pagesize.' - B/W ('.$price->bwprice.')'.'"' . set_radio('size[]', $price->pagesize.' - B/W ('.$price->bwprice.')') . '>&nbsp;&nbsp;&nbsp;<label class="control-label">' . $price->pagesize . ' - B/W (' . $price->bwprice . ')</label>';
                                                            echo '</td>';
                                                        echo '<td><span style="padding-left:5em"></span></td>';
                                                        echo '<td>';
                                                                echo '<input type="radio" name="size[]" price="'.$price->colorprice.'" value="'.$price->pagesize.' - Color ('.$price->colorprice.')'.'"' . set_radio('size[]', $price->pagesize.' - Color ('.$price->colorprice.')') . '>&nbsp;&nbsp;&nbsp;<label class="control-label">' . $price->pagesize . ' - Color (' . $price->colorprice . ')</label>';
                                                            echo '</td>';
                                                        echo '</tr>';
                                                    }
                                                ?>
                                            </table>
                                        </div>
                                        <?php echo(!empty(form_error('size[]')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('size[]'); ?>
                                    </div>
                                </div>
                            </div>

                            <legend>Upload Files:</legend>
                            <span id="allInputs">
                                <div class="form-group <?php echo(!empty(form_error('userfile[]')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">File Upload:</label>
                                    <div class="row fileupload-buttonbar">
                                        <div class="col-md-7">
                                            <div class="panel-body">
                                                <blockquote class="f-s-14">
                                                    <p>Select the files you wish to upload.<br>You may choose a single file or multiple files.<br>Accepted image formats: PDF, JPG, PNG, GIF, BMP, SVG</p>
                                                </blockquote>
                                                <form id="fileupload" action="assets/global/plugins/jquery-file-upload/server/php/" method="POST" enctype="multipart/form-data">
                                                    <div class="row fileupload-buttonbar">
                                                        <div class="col-md-11">
                                                            <label class="btn btn-primary m-r-5 m-b-5">
                                                                <input type="file" name="userfile[]" id="files" multiple />
<!--                                                                <i class="fa fa-plus"></i> Add Files...--><span style="padding-left:5em"></span>
                                                            </label>


                                                            <span id="numFiles">
                                                                <span  class="alert alert-warning fade in m-b-10">
                                                                    No files chosen
                                                                </span>
                                                            </span>

                                                            <button type="reset" id="clear-uploads-btn" class="btn btn-danger m-r-5 m-b-5" style="display:none">
                                                                <i class="fa fa-ban"></i>
                                                                <span>Remove All</span>
                                                            </button>

                                                        </div>
                                                    </div>
                                                    <br/>
                                                    <!-- The table listing the files available for upload/download -->
                                                    <table id="image-preview" role="presentation" class="table table-striped">
                                                        <tbody class="files">

                                                        </tbody>
                                                    </table>
                                                </form>
    <!--                                            <div class="note note-info">-->
    <!--                                                <h4>Demo Notes</h4>-->
    <!--                                                <ul>-->
    <!--                                                    <li>The maximum file size for uploads in this demo is <strong>5 MB</strong> (default file size is unlimited).</li>-->
    <!--                                                    <li>Only image files (<strong>JPG, GIF, PNG</strong>) are allowed in this demo (by default there is no file type restriction).</li>-->
    <!--                                                    <li>Uploaded files will be deleted automatically after <strong>5 minutes</strong> (demo setting).</li>-->
    <!--                                                </ul>-->
    <!--                                            </div>-->
                                            </div>
                                        </div>
                                        <?php echo(!empty(form_error('userfile[]')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                        <?php echo form_error('userfile[]'); ?>
                                    </div>
                                </div>
                            </span>

                                <div class="form-group <?php echo(!empty(form_error('promocode')) ? 'has-error has-feedback' : ''); ?>">
                                    <label class="col-md-3 control-label">Promotional Code:</label>
                                    <div class="col-md-4">
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
                                    </div>
                                    <div class="col-md-2">
                                        <?php
                                        $data = array(
                                            'name'      => 'promocode-btn',
                                            'id'        => 'promocode-btn',
                                            'type'      => 'button',
                                            'content'   => 'Validate',
                                            'class'     => 'btn btn-primary m-r-5 m-b-5'
                                        );

                                        echo form_button($data);

                                        $data = array(
                                            'name'      => 'promocode-btn-cancel',
                                            'id'        => 'promocode-btn-cancel',
                                            'type'      => 'button',
                                            'content'   => 'Clear',
                                            'class'     => 'btn btn-danger m-r-5 m-b-5',
                                            'style'     => 'display:none'
                                        );

                                        echo form_button($data);

                                        ?>
                                    </div>
                                    <?php echo(!empty(form_error('promocode')) ? '<span class="fa fa-times form-control-feedback"></span>' : ''); ?>
                                    <?php echo form_error('promocode'); ?>
                                </div>
                                <div class="col-md-3"></div>
                                <span class="col-md-4" id="promo-result"></span>
                                <br/>

                            <span class="form-group" id="promo-info" style="display:none"></span>
                            <span id="amount" style="display:none"></span>
                            <span id="numMonths" style="display:none"></span>

                            <br/>

                            <div class="form-group <?php echo(!empty(form_error('grandtotal')) ? 'has-error has-feedback' : ''); ?>">
                                <label class="col-md-3 control-label"><b>TOTAL AMOUNT:</b></label>
                                <div class="col-md-2">
                                    <?php
                                    $data = array(
                                        'name'          => 'grandtotal',
                                        'id'            => 'grandtotal',
                                        'value'         => set_value('grandtotal'),
                                        'class'         => 'form-control',
                                        'type'          => 'text',
                                        'size'          => '20',
                                        'data-parsley-required' => 'true',
                                        'readonly'      => 'true',
                                        'style'         => 'outline: none; border-color: green; box-shadow: 0 0 10px green; background-color:white; color: #000000;'
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
                                    <button type="submit" name="submit" class="btn btn-sm btn-success">Submit Button</button>
                                </div>
                            </div>
                            <br/>
                        </div>
                    <!-- end panel body -->

                    <div class="donation-grp">
                        <div class="form-group">
                            <div class="col-md-12 end-form-donate">
                                <div class="panel-body">
                                    <address>
                                        <legend>
                                            <center><h4><strong>OSI offers a full range of printing services with experienced personnel to meet your printing needs from design to print to mailing services.</strong></h4></center>
                                        </legend>
                                        <table>
                                            <caption><strong>Contact info:</strong></caption>
                                            <tbody>
                                            <tr>
                                                <td><u>Phone:</u></td>
                                                <td>&nbsp;(717)263-9293 x 215</td>
                                            </tr>
                                            <tr>
                                                <td><u>Email:</u></td>
                                                <td>&nbsp;<a href="mailto:print@osinc.org">print@osinc.org</a></td>
                                            </tr>
                                            <tr>
                                                <td><u>Address:</u></td>
                                                <td>&nbsp;Occupational Services, Inc.</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>&nbsp;17 Redwood Street</td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>&nbsp;Chambersburg, PA  17201</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </address>
                                    <address>
                                        <table>
                                            <caption><strong>Partnering with:</strong></caption>
                                            <tbody>
                                            <tr>
                                                <td>Design & Built By <a href="http://www.iwatllc.com" target="_blank">iWAT</a></td>
                                            </tr>
                                            </tbody>
                                        </table>
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


    <script src="<?php echo base_url(); ?>assets/plugins/jquery-payment/lib/jquery.payment.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function() {

            /*  On page load, check if promo code exists (in case form validation fails) */
            if ($('#promocode').val() != '')
            {
                $(function() {
                    $('#promocode-btn').click();
                });
            }

            <?php
                foreach ($rad_array as $i => $number)
                {
                    $rad_array[$i] = number_format($number/100, 2, '.', null);
                }

                $rad_array[0] = 0.00;
                $rad_array[1] = 0.00;
                for ($i = 2; $i < 12; $i++)
                {
                    if (!array_key_exists($i, $rad_array))
                    {
                        // if the element behind it is not 0, set it as same as current
                        if ($rad_array[$i-1] != 0.00)
                        {
                            $rad_array[$i] = $rad_array[$i-1];
                        }else
                        {
                            $rad_array[$i] = number_format(0, 2, '.', null);
                        }
                    }
                }


            ?>

            var js_array = <?php echo str_replace('"', '', json_encode($rad_array)); ?>;

            console.log(js_array);

            for (var key in js_array)
            {
                console.log(key + '-> ' + js_array[key]);
            }

            /* Event handler when files are selected */
            $(document).on('change', '#files', function() {
                var inp = document.getElementById('files');

                if (inp.files && inp.files[0])
                {
                    $("#image-preview tr").remove(); /* clear table first */

                    $(inp.files).each(function (index, element)
                    {
                        var name = element.name;
                        var size = bytesToSize(element.size);

                        var reader = new FileReader();
                        reader.readAsDataURL(this);
                        reader.onload = function (e)
                        {
                            var tableRow =  "<tr>" +
                                                "<td><img width='60' height='60' src='" + e.target.result + "'></td>" +
                                                "<td>" + name + "</td>" +
                                                "<td>" + size + "</td>" +
                                              /* "<td>" + "Cancel Button" + "</td>" + */
                                            "</tr>";

                            $('#image-preview tbody').append(tableRow);
                        }
                    });

                    $('#numFiles').html('<span  class="alert alert-success fade in m-b-10">' + inp.files.length + ' files chosen</span>');

                    $('#clear-uploads-btn').show();
                }
            });

            /* Clear the entire image-preview table */
            $(document).on('click', '#clear-uploads-btn', function() {
                $('#numFiles').html('<span  class="alert alert-warning fade in m-b-10">No files chosen</span>');
                $("#image-preview tr").remove();
                $('#clear-uploads-btn').hide();
            });

            function bytesToSize(bytes) {
                var sizes = ['Bytes', 'KB', 'MB'];
                if (bytes == 0) return 'n/a';
                var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
                return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[[i]];
            };

            /*  Change total on text area change */
            function updateTotal()
            {
                /*  e = e || window.event; // IE doesn't pass event to callback */
                /*  var target = e.target || e.srcElement; // IE == srcElement, good browsers: target */

                /* Price variables */
                var numChecked = parseFloat($('input[name="issues[]"]:checked').length);
                var price = $('input[name="size[]"]:checked').attr("price")

                /* Promo code variables */
                var amount = $('#amount').text();
                var numMonths = $('#numMonths').text();

                /*  Apply percentage off depending on the number of boxes checked and the promo code amount */
                if (numMonths && numChecked >= numMonths)
                {
                    var numMonthsWithoutPercentage = numChecked - numMonths;
                    var numMonthsWithPercentage = numChecked - numMonthsWithoutPercentage;

                    var withoutPercentage = numMonthsWithoutPercentage * price;

                    if (amount)
                    {
                        var newTotal = numMonthsWithPercentage * price;
                        var discount = amount;
                        var withPercentage = newTotal - discount;
                    }

                    var total = withPercentage + withoutPercentage;

                } else if (numMonths && numChecked < numMonths)
                {
                    var allMonths = numChecked;
                    if (amount)
                    {
                        var newTotal = allMonths * price;
                        var discount = amount;
                        var total = newTotal - discount;
                    }

                } else
                {
                    var total = numChecked * price;
                }

//                console.log(
//                    'Price checked: '                       + price + '\n' +
//                    'Number of months checked: '            + numChecked + '\n' +
//                    'Amount off with promo code: '          + amount + '\n' +
//                    'Number of months with promo code: '    + numMonths + '\n' +
//                    'Grand Total: '                         + total
//                );

                if (total && total > 0)
                {
                    var dis;

                    if (numChecked > 0)
                    {
                        dis = (total * js_array[numChecked]);
                        total = total - dis;
                        console.log('Number of checked: ' + numChecked + '\nValue applied: ' + js_array[numChecked])
                    }

                    document.getElementById('grandtotal').value = total.toFixed(2);
                } else
                {
                    total = 0;
                    document.getElementById('grandtotal').value = total.toFixed(2);
                }

//                console.log('New Total with discount: ' + total);

            }

            /* Update the total price when a checkbox or radio button changes */
            $("#allIssues").change(function() {
                updateTotal();
            });

            /* Check the promo code */
            $(document).on('click', '#promocode-btn', function() {
                var promo_code = $('#promocode').val();
                check_promocode_ajax(promo_code);
            });

            /* Cancel the promo code */
            $(document).on('click', '#promocode-btn-cancel', function() {
                $('#promo-info').hide(); /* hide info table */
                $('#promo-info').empty(); /* clear info table */
                $("#amount").empty(); /* reset the amount */
                $("#numMonths").empty(); /* reset the number of months */
                $("#promocode").val(''); /* clear promo code text */
                $("#promocode").prop("disabled", false); /* make promo code text editable */
                $('#promo-result').empty(); /* remove promo code notification (valid/invalid) */
                $("button[id=promocode-btn-cancel]").hide();
                $("button[id=promocode-btn]").show();


                updateTotal();  /* update total amount with the promo code removed */
            });

            function check_promocode_ajax(promocode)
            {
                $('#promocode-btn').attr('disabled', true).empty().prepend('<img src="<?php echo base_url() ?>assets/img/loading-gif.gif" />&nbsp; Validating...');

                $("#promo-result").empty();

                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>" + "displayad/Displayad/check_promocode",
                    dataType: 'json',
                    timeout: 8000,
                    data: {promocode:promocode},
                    error: function(xhr, error){
                        console.debug(xhr); console.debug(error);
                        $('#promocode-btn').removeAttr('disabled').empty().prepend('Validate');
                        $("#promo-result").html('<img src="<?php echo base_url() ?>assets/img/cross.png" /> <span style="color:red;">Validation is not responding. Try again with a different browser. </span>');
                        $("#promo-info").empty();
                        $("#promo-info").hide();
                    },
                    success: function(res) {
                        if (res) {
                            $("#promo-result").html('<img src="<?php echo base_url() ?>assets/img/checkmark.ico" /> <span style="color:green;">Promo Code is Valid</span>');
                            $("#promo-info").show();
                            $("button[id=promocode-btn-cancel]").show();
                            $("button[id=promocode-btn]").attr('disabled', false).empty().hide().prepend('Validate');

                            $("#promo-info").html(
                                '<label class="col-md-3 control-label">Promotional Code Information:</label>' +
                                '<div class="col-md-8">' +
                                '<div class="panel-body">' +
                                '<table class="table" border="1">' +
                                '<thead>' +
                                '<tr>' +
                                '<th>Code</th>' +
                                '<th>Description</th>' +
                                '<th>Months</th>' +
                                '<th>Amount</th>' +
                                '<th>Start Date</th>' +
                                '<th>End Date</th>' +
                                '</tr>' +
                                '</thead>' +
                                '<tbody>' +
                                '<tr>' +
                                '<td>' + res.code + '</td>' +
                                '<td>' + res.description + '</td>' +
                                '<td>' + res.months + '</td>' +
                                '<td>&#36; ' + res.amount + '</td>' +
                                '<td>' + res.startdate + '</td>' +
                                '<td>' + res.enddate + '</td>' +
                                '</tr>' +
                                '</tbody>' +
                                '</table>' +
                                '</div>' +
                                '</div>'
                            );

                            $("#amount").html(res.amount);

                            $("#numMonths").html(parseInt(res.months));

                            $("#promocode").prop("disabled", true);

                            updateTotal();

                        } else
                        {
                            $('#promocode-btn').removeAttr('disabled').empty().prepend('Validate');
                            $("#promo-result").html('<img src="<?php echo base_url() ?>assets/img/cross.png" /> <span style="color:red;">Promo Code is Not Valid</span>');
                            $("#promo-info").empty();
                            $("#promo-info").hide();

                        }
                    }
                });
            }

            /* Credit card information gets processed */
            $("#loading-div-background").css({ opacity: 1.0 });

            $('#displayad').submit(function(){
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

            /* Extract the three lines */
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

            /* console.log(data.PAN); */
            /* console.log(data.ED.substring(2, 4)); */
            /* console.log(data.ED.substring(0, 2)); */

            /* Swap around the name */
            var fullname  = data.NM.split("/");
            var firstname = fullname[1].trim();
            var lastname = fullname[0].trim();
            var formattedname = firstname.concat(" ", lastname).trim();

            $("[name='fullname']").val(formattedname);
            $("[name='creditcard']").val(data.PAN);

            /* Set Value of Element then run the selectpicker refresh  */
            $("#expirationmonth").val(data.ED.substring(2, 4));
            $('.selectpicker').selectpicker('refresh');

            /* var expirationyear = data.ED.substring(0, 2);  */
            /* $("[name='expirationyear']").val(data.ED.substring(0, 2));  */
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
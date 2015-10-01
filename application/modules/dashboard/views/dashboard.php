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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

    <script src="<?php echo base_url(); ?>/assets/highcharts/js/highcharts.js"></script>
    <script src="<?php echo base_url(); ?>/assets/highcharts/js/modules/exporting.js"></script>
</head>
    
<body class = "flat-back">

<!-- begin #content -->
<div id="content" class="content">

    <!-- begin page-header -->
    <h1 class="page-header"><?php echo $page_data['heading']; ?> <small> <?php echo $current_date; ?></small></h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-3 -->
        <div class="col-md-6 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fa fa-users"></i></div>
                <div class="stats-info">
                    <h4>TOTAL CUSTOMERS</h4>
                    <p><?php echo $total_customers; ?></p>
                </div>
                <div class="stats-link">
                    <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-6 col-sm-6">
            <div class="widget widget-stats bg-blue">
                <div class="stats-icon"><i class="fa fa-database"></i></div>
                <div class="stats-info">
                    <h4>TOTAL VOLUME</h4>
                    <p><?php echo '$' . $total_volume; ?></p>
                </div>
                <div class="stats-link">
                    <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
    </div>
    <!-- end row -->








    <!-- begin row -->
    <div class="row">
        <!-- begin col-8 -->
        <div class="col-md-12">
            <div class="panel panel-inverse" data-sortable-id="index-1">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Gross Volume of Sales (by Day)</h4>
                </div>
                <div class="panel-body">

                    <div id="container"></div>


                </div>
            </div>
        </div>
        <!-- end col-8 -->
    </div>
    <!-- end row -->



</div>
<!-- end #content -->


</body>

<!-- begin #footer -->
<!-- ================== BEGIN BASE JS ================== -->
<script src="<?php echo base_url(); ?>/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="<?php echo base_url(); ?>/assets/crossbrowserjs/html5shiv.js"></script>
<script src="<?php echo base_url(); ?>/assets/crossbrowserjs/respond.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="<?php echo base_url(); ?>/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="<?php echo base_url(); ?>/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/masked-input/masked-input.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/password-indicator/js/password-indicator.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/parsley/dist/parsley.js"></script>
<!-- <script src="assets/js/form-plugins.demo.min.js"></script> -->
<script src="<?php echo base_url(); ?>/assets/js/form-plugins.demo.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/apps.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/maskMoney/jquery.maskMoney.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/plugins/cardswipe/jquery.cardswipe.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script type="text/javascript">

    var val = "<?php echo $page_data['company']; ?>";

    // whenever the document is ready to execute,
    // execute these series of functions inside of this anonymous function()
    $(document).ready(function() {
        App.init();
        FormPlugins.init();

        var chart1 = new Highcharts.Chart({

            credits: {
                enabled: false
            },

            title: {
                text: 'Gross Volume of Sales',
                x: -20 //center
            },

            subtitle: {
                text: 'By Day',
                x: -20
            },

            chart: {
                renderTo: 'container',
                type: 'line'
            },

            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Dollars ($)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: 'blue'
                }]
            },

            tooltip: {
                valueSuffix: '$'
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },

            series: [{
                name: val,
                data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6],
                color:'blue'
            }]
        });
    });

</script>
<!-- end #footer -->

</html>
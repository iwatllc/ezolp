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

<!-- begin #content -->
<div id="content" class="content">

    <!-- begin page-header -->
    <h1 class="page-header">Dashboard <small>Welcome to EZ Online Pay</small></h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-3 -->
        <div class="col-md-6 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fa fa-users"></i></div>
                <div class="stats-info">
                    <h4>TOTAL CUSTOMERS</h4>
                    <p>922</p>
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
                    <p>20.44%</p>
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
                    <div id="interactive-chart" class="height-sm" style="padding: 0px; postion: relative;"></div>
                    <canvas class="flot-base" width="416" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 416px; height: 300px;"></canvas>
                    <div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);">
                        <div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;">
                            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 41px; top: 284px; left: 46px; text-align: center;">May&nbsp;15</div>
                            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 41px; top: 284px; left: 104px; text-align: center;">May&nbsp;19</div>
                            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 41px; top: 284px; left: 163px; text-align: center;">May&nbsp;22</div>
                            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 41px; top: 284px; left: 222px; text-align: center;">May&nbsp;25</div>
                            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 41px; top: 284px; left: 281px; text-align: center;">May&nbsp;28</div>
                            <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 41px; top: 284px; left: 339px; text-align: center;">May&nbsp;31</div>
                        </div>
                        <div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;">
                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 272px; left: 14px; text-align: right;">0</div>
                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 244px; left: 7px; text-align: right;">20</div>
                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 217px; left: 7px; text-align: right;">40</div>
                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 190px; left: 7px; text-align: right;">60</div>
                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 163px; left: 7px; text-align: right;">80</div>
                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 136px; left: 1px; text-align: right;">100</div>
                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 109px; left: 1px; text-align: right;">120</div>
                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 82px; left: 1px; text-align: right;">140</div>
                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 55px; left: 1px; text-align: right;">160</div>
                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 28px; left: 1px; text-align: right;">180</div>
                            <div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 1px; text-align: right;">200</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col-8 -->
    </div>
    <!-- end row -->












</div>
<!-- end #content -->


</body>

<?php $this->load->view('footer'); ?>

</html>
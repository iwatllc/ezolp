<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php

if($Guestform_Clientform == "FALSE") {

?>


<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8">
<![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

    <?php $this->load->view('header'); ?>

    <link href="<?php echo base_url(); ?>/client/clientcss2.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>/client/clientcss.css" rel="stylesheet" />

<body class="flat-black receipt-print" id="BodyId">
    <div id="page-container" class="fade in page-without-sidebar">
        <div id="content" class="content">
            <div id="internal" class="container">
                <div id="wrapHeader">
                    <div id="header" class="clearfix">
                        <div class="bodyGutter clearfix">
                            <div id="headerLogo"><p><a href="http://www.baptisthealthfoundation.com/default.cfm?id=1"><img alt="Baptist Health Foundation" height="86" src="https://7686.thankyou4caring.org/view.image?Id=653" title="Baptist Health Foundation" width="459" /></a></p>
                            </div>
                        </div>
                    </div>
                    <div id="wrapNav">
                        <div class="bodyGutter clearfix">
                            <!--START MENU-->
                            <ul class="mainNav"><li class=" menuItem1 first"><a href="http://www.baptisthealthfoundation.net/Home.aspx">Home</a></li><li class=" menuItem2"><a href="http://www.baptisthealthfoundation.net/HowYouCanHelp.aspx">How You Can Help</a></li><li class=" menuItem3"><a href="http://www.baptisthealthfoundation.net/NewsEvents.aspx">News & Events</a></li><li class=" menuItem4"><a href="http://7686.thankyou4caring.org/">Online Community</a></li><li class="menuItem5 last"><a href="http://www.baptisthealthfoundation.net/AboutUs.aspx">About Us</a></li></ul>
                            <!--END MENU--><p><a class="facebook" href="http://www.facebook.com/BaptistHealthFoundation" target="_blank"><img alt="Friend Us" border="0" id="Facebook-icon_1_1719" src="https://7686.thankyou4caring.org/view.image?Id=652" /></a> <a class="youtube" href="http://www.youtube.com/baptisthealthsystem" target="_blank"><img alt="You Tube" border="0" id="youTubeLogo_1_1733" src="https://7686.thankyou4caring.org/view.image?Id=658" /></a></p>
                        </div>
                    </div>
                </div>
                <div id="wrapContentOuter" class="clearfix">
                    <div id="wrapContentInner" class="clearfix">
                        <div id="contentPrimary" class="bodyGutter clearfix">
                            <div class="gutter clearfix">
                                <div class="singleCol"><p style="padding: 0; margin: 0; text-align: right;"><a class="addthis_button" href="https://www.addthis.com/bookmark.php?v=250&amp;username=xa-4c7d709b2ab4abde"><img alt="Bookmark and Share" height="16" src="https://s7.addthis.com/static/btn/v2/lg-share-en.gif" style="border: 0;" width="125" /></a>
                                        <script src="https://s7.addthis.com/js/250/addthis_widget.js#username=xa-4c7d709b2ab4abde" type="text/javascript"></script>
                                    </p>
                                    <h1>Generosity Begins with you!</h1>
                                    <p style="text-align: left;">With the help of supporters like you, Baptist Health Foundation can provide charitable resources to support the continued improvement of health, provide social assistance and promote education for communities served by Brookwood Baptist Health in a way that furthers the healing ministry of Jesus Christ.</p>
                                    <p style="text-align: left;">Baptist Health Foundation is a 501(c)(3) nonprofit organization. Contributions are tax-deductible to the extent allowed by law.</p>
                                    <p>&#160;</p>
                                    <div id="PC1184_UpdatePanel">

                                        <div class="row">
                                            <!-- begin col-12 -->
                                            <div class="col-12">
                                                <?php
                                                $approved = $result_data['IsApproved'];
                                                $responseHTML = $result_data['ResponseHTML'];
                                                $responseCODE = $result_data['ReturnCode'];

                                                if ($approved == 1)
                                                {
                                                    $approved = TRUE;
                                                } else {
                                                    $approved = FALSE;
                                                }

                                                if (isset($approved) && $approved === TRUE)
                                                {
                                                    ?>
                                                    <div class='success'>
                                                        Donation Successfully Processed!
                                                    </div>
                                                    <br>
                                                    Donation Reciept
                                                    </br>
                                                    </br>
                                                    <b>Reciept #:</b> <?php echo $result_data['OrderNumber']; ?>
                                                    </br></br>
                                                    <b>Date:</b> <?php echo $result_data['UpdateDate']; ?>
                                                    </br></br>
                                                    <b>Amount:</b> <?php echo $submitted_data['amount']; ?>
                                                    </br></br>
                                                    <b>Card Ending: ************</b><?php echo $submitted_data['cclast4']; ?>
                                                    </br></br>
                                                    <b>Card Holder:</b> <?php echo $submitted_data['firstname']. ' ' . $submitted_data['lastname']; ?>
                                                    </br></br>
                                                    <b>Address:</b></br>
                                                    <?php echo $submitted_data['streetaddress']; ?></br>
                                                    <?php echo $submitted_data['city']; ?>&nbsp;<?php echo $submitted_data['state']; ?>&nbsp;<?php echo $submitted_data['zip']; ?>
                                                    </br></br></br>

                                                    <?php if($Guestform_Signature == "TRUE"){ ?>
                                                    <div class="center-text">
                                                        I AGREE TO PAY ABOVE
                                                        TOTAL AMOUNT ACCORDING
                                                        TO THE CARD ISSUER
                                                        AGREEMENT
                                                    </div>
                                                    <br/>
                                                    <b>Signature:</b>
                                                    </br></br></br></br>
                                                    X__________________________________________________
                                                    <br/><?php echo $submitted_data['firstname']. ' ' . $submitted_data['lastname']; ?>
                                                    <br/>
                                                <?php } ?>

                                                    <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <div style='color: #FF0000; font-weight: bold;' />
                                                There was an error processing this transaction.
                                            </div>
                                            <br/>
                                            <div style='font-weight: bold;'>
                                                Here is the response for further details as to possibly why there was a failure:
                                            </div>
                                            <br/>
                                            <?php echo $responseHTML; ?>
                                            <br/><br/>
                                            <?php
                                            }

                                            echo "<div style='font-weight: bold;'>";
                                            if (isset($response)){
                                                // echo $respones;
                                            };
                                            echo "</div>";
                                            ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="contentSecondary" class="bodyGutter clearfix">
                        <!--START MENU-->
                        <ul class="menu"><li class=" menuItem1 first"><a href="http://7686.thankyou4caring.org/page.aspx?pid=291">Login</a></li><li class=" menuItem4"><a href="http://7686.thankyou4caring.org/page.aspx?pid=293">My Email Preferences</a></li><li class=" menuItem5 selected"><a class="selected" href="http://7686.thankyou4caring.org/page.aspx?pid=298">Make a Donation</a></li><li class=" menuItem7"><a href="http://7686.thankyou4caring.org/page.aspx?pid=299">Event Calendar</a></li><li class="menuItem10 last"><a href="http://7686.thankyou4caring.org/page.aspx?pid=294">Privacy Policy</a></li></ul>

                        <!--END MENU-->
                        <div class="gutter clearfix"><p style="text-align: left;"><span style="font-size: 14pt;">Your gifts support...</span></p>
                            <p style="text-align: center;"><img height="237" src="https://7686.thankyou4caring.org/view.image?Id=699" style="border: 1px solid black;" width="150" /><br /><em><span style="font-size: 12pt;">Care for the smallest patients<br /></span></em></p>
                            <p style="text-align: center;"><img height="114" src="https://7686.thankyou4caring.org/view.image?Id=698" style="display: block; margin-left: auto; margin-right: auto; border: 1px solid black;" width="171" /><em><span style="font-size: 12pt;">Disaster relief<br /></span></em></p>
                            <p style="text-align: center;"><img height="224" src="https://7686.thankyou4caring.org/view.image?Id=689" style="display: block; margin-left: auto; margin-right: auto; border: 1px solid black;" width="150" /><em><span style="font-size: 12pt;">The most advanced medical technology<br /></span></em></p>
                            <p style="text-align: center;"><img height="91" src="https://7686.thankyou4caring.org/view.image?Id=703" style="border: 1px solid black;" width="171" /><br /><span style="font-size: 12pt;"><em>Community-based wellness programs</em></span></p>
                            <p style="text-align: center;">&#160;<br /><br /><span style="color: #004f85;"><strong><span style="font-size: 12pt;">Tribute Gifts<br /></span></strong></span></p>
                            <p style="text-align: justify;"><span style="color: #004f85; font-size: 12pt;">You can give a gift to honor a caregiver, to celebrate a milestone or to remember a loved one who is no longer with you. Please enter the person's name you want to recognize under Tribute Information. </span></p>
                        </div>
                    </div>
                </div>
                <div id="wrapFooter">
                    <div id="wrapFooterMenu">
                        <div class="bodyGutter clearfix">
                            <div class="footerMenuWrap"></div>
                            <div class="footerContactWrap"></div>
                        </div>
                    </div>
                    <div id="wrapFooterCopy">
                        <div class="bodyGutter"><p class="footerCopy">BAPTIST HEALTH FOUNDATION &#160;|&#160;&#160;1130 22nd STREET&#160;SOUTH, SUITE 1000&#160;&#160;|&#160; BIRMINGHAM, ALABAMA &#160;|&#160; 35205&#160;&#160;|&#160; 1-877-474-4243 &#160;|&#160;&#160;<a class="address" href="mailto:Foundation@bhsala.com" target="_blank">Email Us</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php } else { ?>


<? } ?>

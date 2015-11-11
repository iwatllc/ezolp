<?php

/**
 * Created by PhpStorm.
 * User: robertfulcher
 * Date: 11/9/15
 * Time: 3:59 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('email');

    }


    public function send_email($to, $message){

    }


}
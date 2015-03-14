<?php
/**
 * Created by PhpStorm.
 * User: robertfulcher
 * Date: 2/9/15
 * Time: 7:07 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Guestform extends CI_Controller {

    public $data = array(
        'title' => 'EZ Online Pay | Guest Payment Form',
        'heading' => 'Guest Payment Form',
        'description' => 'EZ Online Pay Guest Payment Form',
        'author' => 'EZ Online Pay 2015'
    );

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        //$this->dx_auth->check_uri_permissions();

    }


    public function index()
    {

        $this->load->view('guestform', $this->data);
    }


    public function submit()
    {
        $this->form_validation->set_rules('fullname', 'Full Name', 'required|max_length[100]');
        $this->form_validation->set_rules('streetaddress', 'Street Address', 'required|max_length[100]');
        $this->form_validation->set_rules('city', 'City', 'required|max_length[100]');
        $this->form_validation->set_rules('state', 'State', 'required|callback_check_default');
        $this->form_validation->set_rules('zip', 'Zip Code', 'required|min_length[5]|max_length[5]');
        $this->form_validation->set_rules('creditcard', 'Credit Card', 'required|callback_check_creditcard');
        $this->form_validation->set_rules('expirationmonth', 'Expiration Month', 'required|callback_check_default');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('guestform', $this->data);
        }
        else
        {
            echo "form submitted";
            //$this->load->view('formsuccess');
        }



    }


    function check_default($post_string)
    {
        $this->form_validation->set_message('check_default', 'You need to select a state');
        return $post_string == '0' ? FALSE : TRUE;
    }

    function check_creditcard($post_string)
    {
        $result = TRUE;
        $creditcard = $post_string;
        $creditcard = str_replace('-', '', $creditcard);
        $cc_length = strlen($creditcard);

        if ($cc_length < '16') {
            $this->form_validation->set_message('check_creditcard', 'Credit Card Number is not correct');
            $result = FALSE;
        } else if ($cc_length > '16') {
            $this->form_validation->set_message('check_creditcard', 'Credit Card Number is not correct');
            $result = FALSE;
        }

        return $result;
    }

}
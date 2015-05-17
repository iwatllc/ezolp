<?php
/**
 * Created by PhpStorm.
 * User: robertfulcher
 * Date: 2/9/15
 * Time: 7:07 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Guestform extends MX_Controller {



    public function __construct()
    {
        parent::__construct();

        // Loaded in here to make the validation work correctly.
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

        $this->load->module('configsys');

        // Your own constructor code
        //$this->dx_auth->check_uri_permissions();

    }


    public function index()
    {

        $clientname = $this->configsys->get_config_value('clientname');
        $view_vars = array(
            'title' => $clientname . ' | Guest Payment Form',
            'heading' => 'Guest Payment Form',
            'description' => $clientname. ' Guest Payment Form',
            'author' => 'EZ Online Pay ' . date("Y")
        );
        $data['page_data'] = $view_vars;
        $this->load->view('guestform', $data);
    }


    public function submit()
    {
        $this->form_validation->set_rules('fullname', 'Full Name', 'required|max_length[100]');
        $this->form_validation->set_rules('streetaddress', 'Street Address', 'required|max_length[100]');
        $this->form_validation->set_rules('city', 'City', 'required|max_length[100]');
        $this->form_validation->set_rules('state', 'State', 'required|callback_check_default');
        $this->form_validation->set_rules('zip', 'Zip Code', 'required|min_length[5]|max_length[5]');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('creditcard', 'Credit Card', 'required|callback_check_creditcard');
        $this->form_validation->set_rules('expirationmonth', 'Expiration Month', 'required|callback_check_default');
        $this->form_validation->set_rules('expirationyear', 'Expiration Year', 'required');
        $this->form_validation->set_rules('cvv2', 'CVV2 Code', 'required|min_length[3]|max_length[3]');
        $this->form_validation->set_rules('paymentamount', 'Payment Amount', 'required');


        if ($this->form_validation->run() == FALSE)
        {
            $data['page_data'] = $this->data;
            $this->load->view('guestform', $data);
        }
        else
        {

            // SAVE SUBMITTED FORM DATA
            $this->load->model('Guestform_model', 'Guestform');

            $submitted_data = array(
                'name' => $this->input->post('fullname'),
                'streetaddress' => $this->input->post('streetaddress'),
                'streetaddress2' => $this->input->post('streetaddress2'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'zip' => $this->input->post('zip'),
                'notes' => $this->input->post('notes'),
                'cclast4' => substr($this->input->post('creditcard'), -4),
                'amount' => str_replace( ',', '', $this->input->post('paymentamount') ),
                'InsertDate' => date('Y-n-j H:i:s')
            );


            // Get insertd record id to use as transaction id.
            $transaction_id = $this->Guestform->save($submitted_data);

            // Add transaction id to submitted data and pass to payment method.
            $submitted_data['transaction_id'] = $transaction_id;
            $submitted_data['creditcard'] = $this->input->post('creditcard');
            $submitted_data['expirationmonth'] = $this->input->post('expirationmonth');
            $submitted_data['expirationyear'] = $this->input->post('expirationyear');
            $submitted_data['cvv2'] = $this->input->post('cvv2');
            $submitted_data['PaymentSource'] = 'GF';


            // PROCESS CREDIT CARD DATA
            $this->load->module('payment');
            $result_data = $this->payment->process_payment($submitted_data);


            // Gather all the info for the view
            $view_vars = array(
                'title' => 'EZ Online Pay | Guest Payment Form Submission Results',
                'heading' => 'Payment Form Result',
                'description' => 'EZ Online Pay Guest Payment Form',
                'author' => 'EZ Online Pay 2015'
            );
            $data['page_data'] = $view_vars;
            $data['result_data'] = $result_data;
            $data['submitted_data'] = $submitted_data;

            $this->load->view('guestformresult', $data);
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
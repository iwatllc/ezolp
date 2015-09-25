<?php
/**
 * Created by Aptana.
 * User: gregarnold
 * Date: 8/27/15
 * Time: 7:07 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Donation extends MX_Controller {



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
            //'title' => $this->config->item('Client_Title'),
            'title' => '',
            'heading' => $this->config->item('Client_Heading'),
            'description' => $this->config->item('Client_Description'),
            'company' => $this->config->item('Client_Name'),
            'logo' => $this->config->item('Client_Logo'),
            'slogan' => '',
            'author' => $this->config->item('Client_Author')
        );
        $data['page_data'] = $view_vars;

        $this->load->view('donationform', $data);
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
        $this->form_validation->set_rules('expirationmonth', 'Expiration Month', 'required');
        $this->form_validation->set_rules('expirationyear', 'Expiration Year', 'required');
        $this->form_validation->set_rules('cvv2', 'CVV2 Code', 'required|min_length[3]|max_length[3]');
        $this->form_validation->set_rules('paymentamount', 'Payment Amount', 'required');
		$this->form_validation->set_rules('otheramount', 'Other Amount', 'callback_check_otheramount');


        if ($this->form_validation->run($this) == FALSE)
        {
        	$this->index();
        }
        else
        {

            // SAVE SUBMITTED FORM DATA
            $this->load->model('Donation_model', 'Donation');
			
			if(strcasecmp($this->input->post('paymentamount'), 'other') == 0) {
				$pamount = str_replace( ',', '', $this->input->post('otheramount') );
			}
			else {
				$pamount = str_replace( ',', '', $this->input->post('paymentamount') );
			}
            $submitted_data = array(
                'name' => $this->input->post('fullname'),
                'streetaddress' => $this->input->post('streetaddress'),
                'streetaddress2' => $this->input->post('streetaddress2'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'zip' => $this->input->post('zip'),
                'notes' => $this->input->post('notes'),
                'cclast4' => substr($this->input->post('creditcard'), -4),
                'amount' => $pamount,
                'InsertDate' => date('Y-n-j H:i:s')
            );


            // Get insertd record id to use as transaction id.
            $transaction_id = $this->Donation->save($submitted_data);

            // Add transaction id to submitted data and pass to payment method.
            $submitted_data['transaction_id'] = $transaction_id;
            $submitted_data['creditcard'] = $this->input->post('creditcard');
            $submitted_data['expirationmonth'] = $this->input->post('expirationmonth');
            $submitted_data['expirationyear'] = $this->input->post('expirationyear');
            $submitted_data['cvv2'] = $this->input->post('cvv2');
            $submitted_data['PaymentSource'] = 'DN';


            // PROCESS CREDIT CARD DATA
            $this->load->module('payment');
            $result_data = $this->payment->process_payment($submitted_data);


            // Gather all the info for the view
            $view_vars = array(
                //'title' => $this->config->item('Client_Title'),
                'title' => '',
                'heading' => $this->config->item('Client_Heading'),
                'description' => $this->config->item('Client_Description'),
                'company' => $this->config->item('Client_Name'),
                'logo' => $this->config->item('Client_Logo'),
                'slogan' => '',
                'author' => $this->config->item('Client_Author')
            );
            $data['page_data'] = $view_vars;
            $data['result_data'] = $result_data;
            $data['submitted_data'] = $submitted_data;

            $this->load->view('donationformresult', $data);
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

	function check_otheramount($post_string)
    {
    	$paymentamount = $this->input->post('paymentamount');
		
		log_message('debug', 'Payment amount = '.$paymentamount);
		
		if(strcasecmp($paymentamount, 'other') == 0) {
			if(strlen($post_string) == 0) {
				log_message('debug', 'check_otheramount FAILED length check = '.$post_string);
				$this->form_validation->set_message('check_otheramount', 'Enter a donation amount');
				return FALSE;
			}
			else if(is_numeric($post_string) == FALSE) {
				log_message('debug', 'check_otheramount FAILED is_numeric check = '.$post_string);
				$this->form_validation->set_message('check_otheramount', 'Amount must be numeric');
				return FALSE;
			}
			else if($post_string <= 0) {
				log_message('debug', 'check_otheramount FAILED > 0 check = '.$post_string);
				$this->form_validation->set_message('check_otheramount', 'Amount must greater than 0');
				return FALSE;
			}
		}
        return TRUE;
    }
}
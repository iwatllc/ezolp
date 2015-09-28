<?php
/**
 * Created by PhpStorm.
 * User: robertfulcher
 * Date: 2/9/15
 * Time: 7:07 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Void extends MX_Controller {



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
		$paymentResponseId = $this->uri->segment(4);
		$this->load->model('payment/Payment_model', 'Payment');
		$data = array('PaymentResponseId' => $paymentResponseId);
		
		$this->load->module('payment');
		$payment = $this->Payment->get($data);
		$result_data = $this->payment->process_void($payment);
		
        $view_vars = array(
                'title' => 'EZ Online Pay | Void Submission Results',
                'heading' => 'Void Result',
                'description' => 'EZ Online Pay Void',
                'author' => 'EZ Online Pay 2015'
            );
        $data['page_data'] = $view_vars;
        $data['result_data'] = $result_data;
		$data['payment'] = $payment;
		
        $this->load->view('voidresults', $data);
    }
}
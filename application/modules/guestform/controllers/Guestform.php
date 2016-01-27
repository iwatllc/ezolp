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
        $this->load->module('nation_builder');
    }

    public function index()
    {
        // Gather all the info for the view
        $clientname = $this->configsys->get_config_value('Client_Name');
        $clientaddress = $this->configsys->get_config_value('Client_Address');
        $clientcity = $this->configsys->get_config_value('Client_City');
        $clientstate = $this->configsys->get_config_value('Client_State');
        $clientzip = $this->configsys->get_config_value('Client_Zip');
        $clientphone = $this->configsys->get_config_value('Client_Phone');
        $clientwebsite = $this->configsys->get_config_value('Client_Website');

        $client_data = array(
            'clientname' => $clientname,
            'clientaddress' => $clientaddress,
            'clientcity' => $clientcity,
            'clientstate' => $clientstate,
            'clientzip' => $clientzip,
            'clientphone' => $clientphone,
            'clientwebsite' => $clientwebsite
        );

        $data['client_data'] = $client_data;

        $data['Guestform_Notes'] = $this->configsys->get_config_value('Guestform_Notes');
        $data['Guestform_Email'] = $this->configsys->get_config_value('Guestform_Email');
        $data['Guestform_Clientform'] = $this->configsys->get_config_value('Guestform_Clientform');
        $data['Guestform_Notes_Label'] = $this->configsys->get_config_value('Guestform_Notes_Label');
        $data['Guestform_Notes_Required'] = $this->configsys->get_config_value('Guestform_Notes_Required');
        $data['Guestform_Email_Required'] = $this->configsys->get_config_value('Guestform_Email_Required');
        $data['Guestform_Logo'] = $this->configsys->get_config_value('Guestform_Logo');


        $view_vars = array(
            'title' => $this->configsys->get_config_value('Client_Title'),
            'heading' => $this->configsys->get_config_value('Client_Title'),
            'description' => $this->configsys->get_config_value('Client_Description'),
            'company' => $this->configsys->get_config_value('Client_Name'),
            'logo' => $this->configsys->get_config_value('Client_Logo'),
            'author' => $this->configsys->get_config_value('Client_Author')
        );
        $data['page_data'] = $view_vars;

        $this->load->view('guestform', $data);
    }


    public function submit()
    {
        $this->form_validation->set_rules('firstname', 'First Name', 'required|max_length[100]');
        $this->form_validation->set_rules('middleinitial', 'Middle Initial', 'max_length[1]');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required|max_length[100]');
        $this->form_validation->set_rules('streetaddress', 'Street Address', 'required|max_length[100]');
        $this->form_validation->set_rules('city', 'City', 'required|max_length[100]');
        $this->form_validation->set_rules('state', 'State', 'required|callback_check_default');
        $this->form_validation->set_rules('zip', 'Zip Code', 'required|min_length[5]|max_length[5]');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('creditcard', 'Credit Card', 'required|callback_check_creditcard');
        $this->form_validation->set_rules('expirationmonth', 'Expiration Month', 'required|callback_check_default');
        $this->form_validation->set_rules('expirationyear', 'Expiration Year', 'required');
        $this->form_validation->set_rules('cvv2', 'CVV2 Code', 'required|min_length[3]|max_length[4]');
        $this->form_validation->set_rules('paymentamount', 'Payment Amount', 'required');

        $Guestform_Notes_Required = $this->configsys->get_config_value('Guestform_Notes_Required');
        if ($Guestform_Notes_Required == 'TRUE'){
            $this->form_validation->set_rules('notes', 'Notes', 'required');
        }

        $Guestform_Email_Required = $this->configsys->get_config_value('Guestform_Email_Required');
        if ($Guestform_Email_Required == 'TRUE'){
            $this->form_validation->set_rules('email', 'Email', 'required');
        }




        if ($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {

            // SAVE SUBMITTED FORM DATA
            $this->load->model('Guestform_model', 'Guestform');

            $submitted_data = array(
                'firstname' => $this->input->post('firstname'),
                'middleinitial' => $this->input->post('middleinitial'),
                'lastname' => $this->input->post('lastname'),
                'streetaddress' => $this->input->post('streetaddress'),
                'streetaddress2' => $this->input->post('streetaddress2'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'zip' => $this->input->post('zip'),
                'email' => $this->input->post('email'),
                'notes' => $this->input->post('notes'),
                'cardtype' => $this->input->post('cardtype'),
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
            // $result_data = $this->payment->process_payment($submitted_data);
            $result_data = [
                'IsApproved' => '1',
            ];
            // CHECK TO SEE IF TRANSACTION WENT THROUGH
            if($result_data['IsApproved'] == '1') {
                // SEND EMAIL RECIEPT TO PAYER
                $guestform_sendreceipt = $this->configsys->get_config_value('Guestform_Sendreceipt');
                $guestform_emailsubject = $this->configsys->get_config_value('Guesform_Email_Subject');
                $to_email = $this->input->post('email');
                if ($guestform_sendreceipt == 'TRUE') {
                    if(strlen(trim($to_email)) > 0){
                        $this->load->module('email_sys');

                        $message = '<!DOCTYPE html><html><body>';
                        $message .= '<p>';
                        $message .= 'Than you for your payment';
                        $message .= '<br>';
                        $message .= 'Please keep this receipt for your records';
                        $message .= '<br>';
                        $message .= '<hr>';
                        $message .= $this->input->post('firstname'). ' ' . $this->input->post('lastname');
                        $message .= '<br>';
                        $message .= $this->input->post('cardtype'). ' Ending in ' . substr($this->input->post('creditcard'), -4);
                        $message .= '<br>';
                        $message .= 'Amount Paid: ' . str_replace( ',', '', $this->input->post('paymentamount') );
                        $message .= '<br>';
                        $message .= 'Date: ' . date('Y-n-j H:i:s') ;
                        $message .= '<hr>';
                        $message .= '<br>';
                        $message .= '</p>';
                        $message .= '</body></html>';

                        $result_info = $this->email_sys->send_email($to_email, $guestform_emailsubject, $message);
                    }
                }

                // Execute NationBuilder Donation Hook
                $this->nation_builder->process_donation($submitted_data);
            }

            // Gather all the info for the view
            $clientname = $this->configsys->get_config_value('Client_Name');
            $clientaddress = $this->configsys->get_config_value('Client_Address');
            $clientcity = $this->configsys->get_config_value('Client_City');
            $clientstate = $this->configsys->get_config_value('Client_State');
            $clientzip = $this->configsys->get_config_value('Client_Zip');
            $clientphone = $this->configsys->get_config_value('Client_Phone');
            $clientwebsite = $this->configsys->get_config_value('Client_Website');

            $client_data = array(
                'clientname' => $clientname,
                'clientaddress' => $clientaddress,
                'clientcity' => $clientcity,
                'clientstate' => $clientstate,
                'clientzip' => $clientzip,
                'clientphone' => $clientphone,
                'clientwebsite' => $clientwebsite
            );

            $data['client_data'] = $client_data;

            $data['Guestform_Notes'] = $this->configsys->get_config_value('Guestform_Notes');
            $data['Guestform_Email'] = $this->configsys->get_config_value('Guestform_Email');
            $data['Guestform_Clientform'] = $this->configsys->get_config_value('Guestform_Clientform');
            $data['Guestform_Notes_Label'] = $this->configsys->get_config_value('Guestform_Notes_Label');
            $data['Guestform_Notes_Required'] = $this->configsys->get_config_value('Guestform_Notes_Required');
            $data['Guestform_Email_Required'] = $this->configsys->get_config_value('Guestform_Email_Required');
            $data['Guestform_Signature'] = $this->configsys->get_config_value('Guestform_Signature');

            // Gather all the info for the view
            $view_vars = array(
                'title' => $this->configsys->get_config_value('Client_Title'),
                'heading' => $this->configsys->get_config_value('Client_Title'),
                'description' => $this->configsys->get_config_value('Client_Description'),
                'company' => $this->configsys->get_config_value('Client_Name'),
                'logo' => $this->configsys->get_config_value('Client_Logo'),
                'author' => $this->configsys->get_config_value('Client_Author')
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
        $creditcard = str_replace(' ', '', $creditcard);
        $cc_length = strlen($creditcard);

        if ($cc_length < '15') {
            $this->form_validation->set_message('check_creditcard', 'Credit Card Number is not correct');
            $result = FALSE;
        } else if ($cc_length > '16') {
            $this->form_validation->set_message('check_creditcard', 'Credit Card Number is not correct');
            $result = FALSE;
        }

        return $result;
    }

}
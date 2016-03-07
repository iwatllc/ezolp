<?php
/**
 * Created by PhpStorm.
 * User: afrazer
 * Date: 2/23/15
 * Time: 3:17 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Classifiedad extends MX_Controller {

    public function __construct()
    {
        parent::__construct();

        // Loaded in here to make the validation work correctly.
        $this -> load -> library('form_validation');
        $this -> form_validation -> CI =& $this;

        // Load Required Modules
        $this -> load -> module('payment');
        $this -> load -> module('configsys');
        $this -> load -> module('nation_builder');
        $this -> load -> module('email_sys');

        // Load Required Models
        $this -> load -> model('Classifiedad_model');
        $this -> load -> model('Configsys_model');
    }

    public function index()
    {
        // Display the classifiedad index
        $this -> load -> view('classifiedad', $this -> get_view_data());
    }

    public function submit()
    {
        log_message('debug', 'ClassifiedAd submitted...');

        // Call helper function to setup form validation
        $this -> setup_form_validation();

        if ($this -> form_validation -> run() == false)
        {
            $this -> index();
        } else
        {
            // Construct array of submitted data
            $submitted_data = array(
                'firstname'     => $this -> input -> post('firstname'),
                'lastname'      => $this -> input -> post('lastname'),
                'streetaddress' => $this -> input -> post('streetaddress'),
                'city'          => $this -> input -> post('city'),
                'state'         => $this -> input -> post('state'),
                'zip'           => $this -> input -> post('zip'),
                'phone'         => $this -> input -> post('phone'),
                'email'         => $this -> input -> post('email'),
                'issues'        => implode(', ', $this -> input -> post('issues')), // comma separate months
                'adtext'        => $this -> input -> post('adtext'),
                'totallines'    => $this -> input -> post('totallines'),
                'promocode'     => $this -> input -> post('promocode'),
                'cardtype'      => $this -> input -> post('cardtype'),
                'cclast4'       => substr($this -> input -> post('creditcard'), -4),
                'amount'        => str_replace( ',', '', $this -> input -> post('grandtotal') ),
                'created'       => date('Y-n-j H:i:s')
            );

            // Get insertd record id to use as transaction id.
            $transaction_id = $this -> Classifiedad_model -> add_classifiedad_submission($submitted_data);

            // Add transaction id to submitted data and pass to payment method.
            $submitted_data['transaction_id'] = $transaction_id;
            $submitted_data['creditcard'] = $this -> input -> post('creditcard');
            $submitted_data['expirationmonth'] = $this -> input -> post('expirationmonth');
            $submitted_data['expirationyear'] = $this -> input -> post('expirationyear');
            $submitted_data['cvv2'] = $this -> input -> post('cvv2');
            $submitted_data['PaymentSource'] = 'CA';

            // Process Credit Card
            $result_data = $this -> payment -> process_payment($submitted_data);

            // Was the credit card processed successfully?
            if($result_data['IsApproved'] == '1')
            {
                // Handle Classifiedad Receipt
                if(strcasecmp($this -> configsys -> get_config_value('Classifiedad_Sendreceipt'), 'false'))
                {
                    // Send Receipt
                    $this -> email_sys -> send_email($submitted_data['email'],
                        $this -> configsys -> get_config_value('Classifiedad_Email_Subject', "Payment Receipt"),
                        $this -> get_email_body());
                }
            }

            // Load the classifiedad result view
            $this -> load -> view('classifiedadresult', $this -> get_view_data($submitted_data, $result_data));
        }
    }

    /*
     * Collects all required configuration data for the classifiedad views
     */
    private function get_view_data($submitted_data = array(), $result_data = array())
    {
        log_message('debug', 'Getting Classifiedad view data...');

        $data = array();

        // Gather all the info for the view
        $data['client_data'] = array(
            'clientname' => $this->configsys->get_config_value('Client_Name'),
            'clientaddress' => $this->configsys->get_config_value('Client_Address'),
            'clientcity' => $this->configsys->get_config_value('Client_City'),
            'clientstate' => $this->configsys->get_config_value('Client_State'),
            'clientzip' => $this->configsys->get_config_value('Client_Zip'),
            'clientphone' => $this->configsys->get_config_value('Client_Phone'),
            'clientwebsite' => $this->configsys->get_config_value('Client_Website'),
        );

        $data['Classifiedad_Notes'] = $this->configsys->get_config_value('Classifiedad_Notes');
        $data['Classifiedad_Email'] = $this->configsys->get_config_value('Classifiedad_Email');
        $data['Classifiedad_Clientform'] = $this->configsys->get_config_value('Classifiedad_Clientform');
        $data['Classifiedad_Notes_Label'] = $this->configsys->get_config_value('Classifiedad_Notes_Label');
        $data['Classifiedad_Notes_Required'] = $this->configsys->get_config_value('Classifiedad_Notes_Required');
        $data['Classifiedad_Email_Required'] = $this->configsys->get_config_value('Classifiedad_Email_Required');
        $data['Classifiedad_Signature'] = $this->configsys->get_config_value('Classifiedad_Signature');
        $data['Classifiedad_Logo'] = $this->configsys->get_config_value('Classifiedad_Logo');

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

        // Retrieve the amount of lines that constitutes for a character
        $data['lines_per_char'] = $this -> configsys_model -> get_value('Classifiedad_charperline');
        $data['price_per_line'] = $this -> configsys_model -> get_value('Classifiedad_priceperline');

        return $data;
    }

    /*
     * Configures form validation for the classifiedad
     */
    private function setup_form_validation()
    {
        log_message('debug', 'Setting up ClassifiedAd form validation...');

        $this -> form_validation -> set_rules('firstname', 'First Name', 'required|max_length[100]');
        $this -> form_validation -> set_rules('lastname', 'Last Name', 'required|max_length[100]');
        $this -> form_validation -> set_rules('streetaddress', 'Street Address', 'required|max_length[300]');
        $this -> form_validation -> set_rules('city', 'City', 'required|max_length[100]');
        $this -> form_validation -> set_rules('state', 'State', 'required|callback_check_default');
        $this -> form_validation -> set_rules('zip', 'Zip Code', 'required|min_length[5]|max_length[5]');
        $this -> form_validation -> set_rules('phone', 'Phone Number', 'required|min_length[14]|max_length[14]');
        $this -> form_validation -> set_rules('email', 'Email', 'required|valid_email');
        $this -> form_validation -> set_rules('issues[]', 'Issues', 'required');
        $this -> form_validation -> set_rules('adtext', 'Ad Text', 'required');
        $this -> form_validation -> set_rules('grandtotal', 'Total', 'required');

        $this->form_validation->set_rules('creditcard', 'Credit Card', 'required|callback_check_creditcard');
        $this->form_validation->set_rules('expirationmonth', 'Expiration Month', 'required|callback_check_default');
        $this->form_validation->set_rules('expirationyear', 'Expiration Year', 'required');
        $this->form_validation->set_rules('cvv2', 'CVV2 Code', 'required|min_length[3]|max_length[4]');
    }

    /*
     * Returns the body for an email receipt
     */
    private function get_email_body()
    {
        $message = '<!DOCTYPE html><html><body>';
        $message .= '<p>';
        $message .= 'Than you for your payment';
        $message .= '<br>';
        $message .= 'Please keep this receipt for your records';
        $message .= '<br>';
        $message .= '<hr>';
        $message .= $this -> input -> post('firstname'). ' ' . $this -> input -> post('lastname');
        $message .= '<br>';
        $message .= $this -> input -> post('cardtype'). ' Ending in ' . substr($this -> input -> post('creditcard'), -4);
        $message .= '<br>';
        $message .= 'Amount Paid: ' . str_replace( ',', '', $this -> input -> post('grandtotal') );
        $message .= '<br>';
        $message .= 'Date: ' . date('Y-n-j H:i:s') ;
        $message .= '<hr>';
        $message .= '<br>';
        $message .= '</p>';
        $message .= '</body></html>';

        return $message;
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

    function check_promocode()
    {
        if(isset($_POST["promocode"]))
        {
            $this -> load -> model('Classifiedad_model');
            $row = $this -> Classifiedad_model -> check_promo_code($_POST["promocode"]);
        }

        if ($row)
        {
            $data = array(
                'id'          => $row -> id,
                'code'        => $row -> code,
                'description' => $row -> description,
                'months'      => $row -> months,
                'percentage'  => $row -> percentage,
                'startdate'   => date('m-d-Y h:i A', strtotime($row -> startdate)),
                'enddate'     => date('m-d-Y h:i A', strtotime($row -> enddate))
            );
        } else
        {
            $data = '';
        }

        echo json_encode($data);
    }
}
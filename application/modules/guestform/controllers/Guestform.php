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

        // Load Required Modules
        $this->load->module('payment');
        $this->load->module('configsys');
        $this->load->module('nation_builder');
        $this->load->module('email_sys');

        // Load Required Models
        $this->load->model('Guestform_model', 'Guestform');
    }

    /*
     * Handles the default view
     */
    public function index()
    {
        // Display the guestform index
        $this->load->view('guestform', $this->get_view_data());
    }

    /*
     * Handles submission of the guest form
     */
    public function submit()
    {
        log_message('debug', 'GuestForm submitted...');

        // Call helper function to setup form validation
        $this->setup_form_validation();
        
        // Determine if it is recurreing and what type of recurring it is.
        $recurring = $this->input->post('recurring');
        $frequency = '';
        $start_date = '';
        $end_date = '';
        $installments = '0';
        $amount_installments = '';
        if ($recurring == "One-Time"){
            log_message('debug', 'One-Time Gift');
        }elseif($recurring == "Recurring"){
            log_message('debug', 'Recurring Gift');
            $frequency = $this->input->post('frequency');
            $start_date = $this->input->post('recurring-start-date');
            $end_date = $this->input->post('recurring-end-date');
            $installments = $this->numberofinstallments($frequency, $start_date, $end_date);
        }elseif($recurring == "Pledge"){
            log_message('debug', 'Pledge');
            $installments = $this->input->post('installments');
            $amount_installments = $this->input->post('amount_installments');
            $frequency = $this->input->post('pledge_frequency');
            $start_date = $this->input->post('pledge-start-date');
            $end_date = $this->input->post('pledge-end-date');
        }

        // Payment Amount submitted
        $amount = str_replace( ',', '', ( $this->input->post('paymentamount') === 'other' ? $this->input->post('otheramount') : $this->input->post('paymentamount')) );

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            // Construct array of submitted data
            $submitted_data = array(
                'amount' => $amount,
                'recurring' => $this->input->post('recurring'),
                'frequency' => $frequency,
                'start_date' => date('Y-n-j', strtotime($start_date)),
                'end_date' => date('Y-n-j', strtotime($end_date)),
                'installments' => $installments,
                'amount_installments' => $amount_installments,
                'designation' => $this->input->post('designations'),
                'firstname' => $this->input->post('firstname'),
                'middleinitial' => $this->input->post('middleinitial'),
                'lastname' => $this->input->post('lastname'),
                'streetaddress' => $this->input->post('streetaddress'),
                'streetaddress2' => $this->input->post('streetaddress2'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'zip' => $this->input->post('zip'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'cardtype' => $this->input->post('cardtype'),
                'cclast4' => substr($this->input->post('creditcard'), -4),
                'tributetype' => $this->input->post('tributetype'),
                'tributeefirstname' => $this->input->post('tributeefirstname'),
                'mailtribute' => $this->input->post('mailtribute'),
                'tributeelastname' => $this->input->post('tributeelastname'),
                'tributetofirstname' => $this->input->post('tributetofirstname'),
                'tributetolastname' => $this->input->post('tributetolastname'),
                'tributetoaddress' => $this->input->post('tributetostreetaddress'),
                'tributetoaddress2' => $this->input->post('tributetostreetaddress2'),
                'tributetocity' => $this->input->post('tributetocity'),
                'tributetostate' => $this->input->post('tributetostate'),
                'tributetozip' => $this->input->post('tributetozip'),
                'tributetophone' => $this->input->post('tributetophone'),
                'tributetoemail' => $this->input->post('tributetoemail'),
                'InsertDate' => date('Y-n-j H:i:s'),
            );

            // Get insertd record id to use as transaction id.
            $transaction_id = $this->Guestform->save($submitted_data);


            if ($recurring == "Pledge"){
                // Handle Guestform Receipt
                if(strcasecmp($this->configsys->get_config_value('Guestform_Sendreceipt'), 'false')) {
                    // Send Receipt
                    $this->email_sys->send_email($submitted_data['email'],
                        $this->configsys->get_config_value('Guesform_Email_Subject', "Payment Receipt"),
                        $this->get_email_body());
                }

                $result_data = array(
                    'IsApproved' => '1',
                    'ResponseHTML' => 'NONE',
                    'ReturnCode' => 'NONE',
                    'OrderNumber' => 'N/A For Pledge',
                    'UpdateDate' => date('Y-n-j H:i:s'),
                );
            } else {
                // Add transaction id to submitted data and pass to payment method.
                $submitted_data['transaction_id'] = $transaction_id;
                $submitted_data['creditcard'] = $this->input->post('creditcard');
                $submitted_data['expirationmonth'] = $this->input->post('expirationmonth');
                $submitted_data['expirationyear'] = $this->input->post('expirationyear');
                $submitted_data['cvv2'] = $this->input->post('cvv2');
                $submitted_data['PaymentSource'] = 'GF';

                // Process Credit Card
                $result_data = $this->payment->process_payment($submitted_data);

                // Was the credit card processed successfully?
                if($result_data['IsApproved'] == '1') {
                    // Handle Guestform Receipt
                    if(strcasecmp($this->configsys->get_config_value('Guestform_Sendreceipt'), 'false')) {
                        // Send Receipt
                        $this->email_sys->send_email($submitted_data['email'],
                            $this->configsys->get_config_value('Guesform_Email_Subject', "Payment Receipt"),
                            $this->get_email_body());
                    }
                }

                // Handle Recurring Dontation
                if($recurring == "Recurring") {
                    $recurring_data['recurring'] ='add_subscription';
                    $recurring_data['plan_payments'] = $installments;
                    $recurring_data['plan_amount'] = $amount;
                    $recurring_data['month_frequency'] = '1';
                    $recurring_data['day_of_month'] = $frequency;
                    $recurring_data['creditcard'] = $this->input->post('creditcard');
                    $recurring_data['expirationmonth'] = $this->input->post('expirationmonth');
                    $recurring_data['expirationyear'] = $this->input->post('expirationyear');
                    $recurring_data['cardtype'] = $this->input->post('cardtype');
                    $recurring_data['first_name'] = $this->input->post('firstname');
                    $recurring_data['last_name'] = $this->input->post('lastname');
                    $recurring_data['address1'] = $this->input->post('streetaddress');
                    $recurring_data['city'] = $this->input->post('city');
                    $recurring_data['state'] = $this->input->post('state');
                    $recurring_data['zip'] = $this->input->post('zip');
                    $recurring_data['email'] = $this->input->post('email');

                    $this->load->module('recurring');
                    $result_data_recurring = $this->recurring->addrecurring($recurring_data);

                    $data['result_data_recurring'] = $result_data_recurring;
                }

            }

            // Load the guestform result view
            $this->load->view('guestformresult', $this->get_view_data($submitted_data, $result_data));
        }
    }

    /*
     * Collects all required configuration data for the guestform views
     */
    private function get_view_data($submitted_data = array(), $result_data = array()) {
        log_message('debug', 'Getting GuestForm view data...');

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

        $data['Guestform_Notes'] = $this->configsys->get_config_value('Guestform_Notes');
        $data['Guestform_Email'] = $this->configsys->get_config_value('Guestform_Email');
        $data['Guestform_Clientform'] = $this->configsys->get_config_value('Guestform_Clientform');
        $data['Guestform_Notes_Label'] = $this->configsys->get_config_value('Guestform_Notes_Label');
        $data['Guestform_Notes_Required'] = $this->configsys->get_config_value('Guestform_Notes_Required');
        $data['Guestform_Email_Required'] = $this->configsys->get_config_value('Guestform_Email_Required');
        $data['Guestform_Signature'] = $this->configsys->get_config_value('Guestform_Signature');
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
        $data['result_data'] = $result_data;
        $data['submitted_data'] = $submitted_data;

        return $data;
    }

    /*
     * Configures form validation for the guestform
     */
    private function setup_form_validation() {
        log_message('debug', 'Setting up GuestForm form validation...');

        $this->form_validation->set_rules('cardtype', 'Card Type','trim');
        $this->form_validation->set_rules('paymentamount', 'Payment Amount', 'required');
        $this->form_validation->set_rules('otheramount', 'Other Amount', 'trim|callback_check_otheramount');
        $this->form_validation->set_rules('recurring', 'Recurring', 'required');
        $recurring = $this->input->post('recurring');
        if ($recurring == "One-Time"){
            log_message('debug', 'One-Time Gift');
            // Don't Need to Validate anything.
        }elseif($recurring == "Recurring"){
            log_message('debug', 'Recurring Gift');
            $this->form_validation->set_rules('frequency', 'Recurring Frequency','required');
            $this->form_validation->set_rules('recurring-start-date', 'Recurring Start Date','required');
            $this->form_validation->set_rules('recurring-end-date', 'Recurring End Date','required');
        }elseif($recurring == "Pledge"){
            log_message('debug', 'Pledge');
            $this->form_validation->set_rules('installments', 'Installments','required');
            $this->form_validation->set_rules('amount_installments', 'Amount of Installments','required');
            $this->form_validation->set_rules('pledge_frequency', 'Pledge Frequency','required');
            $this->form_validation->set_rules('pledge-start-date', 'Pledge Start Date','required');
            $this->form_validation->set_rules('pledge-end-date', 'Pledge End Date','required');
        }
        $this->form_validation->set_rules('designations', 'Designations','required');

        $this->form_validation->set_rules('firstname', 'First Name', 'required|max_length[100]');
        $this->form_validation->set_rules('middleinitial', 'Middle Initial', 'max_length[1]');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required|max_length[100]');
        $this->form_validation->set_rules('streetaddress', 'Street Address', 'required|max_length[100]');
        $this->form_validation->set_rules('streetaddress2', 'Street Addresse', 'trim');
        $this->form_validation->set_rules('city', 'City', 'required|max_length[100]');
        $this->form_validation->set_rules('state', 'State', 'required|callback_check_default');
        $this->form_validation->set_rules('zip', 'Zip Code', 'required|min_length[5]|max_length[5]');
        $this->form_validation->set_rules('phone', 'Phone', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        
        $this->form_validation->set_rules('creditcard', 'Credit Card', 'required|callback_check_creditcard');
        $this->form_validation->set_rules('expirationmonth', 'Expiration Month', 'required|callback_check_default');
        $this->form_validation->set_rules('expirationyear', 'Expiration Year', 'required');
        $this->form_validation->set_rules('cvv2', 'CVV2 Code', 'required|min_length[3]|max_length[4]');

        // Tribute Information
        $this->form_validation->set_rules('tributetype', 'Tribute Type', 'trim');
        $this->form_validation->set_rules('tributeefirstname', 'Tribute First Name', 'trim');
        $this->form_validation->set_rules('mailtribute', 'Mail Tribute', 'trim');

        // Check to see if the mailtribute option was set and then if it was
        // setup the form validation for the fields.
        $mailtribute = $this->input->post('mailtribute');
        if ($mailtribute == 'mailtribute') {
            $this->form_validation->set_rules('tributeelastname', 'Last Name', 'required|max_length[100]');
            $this->form_validation->set_rules('tributetofirstname', 'Tribute First Name', 'trim');
            $this->form_validation->set_rules('tributetolastname', 'Last Name', 'required|max_length[100]');
            $this->form_validation->set_rules('tributetostreetaddress', 'Street Address', 'required|max_length[100]');
            $this->form_validation->set_rules('tributetostreetaddress2', 'Street Address2', 'trim');
            $this->form_validation->set_rules('tributetocity', 'City', 'required|max_length[100]');
            $this->form_validation->set_rules('tributetostate', 'State', 'required|callback_check_default');
            $this->form_validation->set_rules('tributetozip', 'Zip Code', 'required|min_length[5]|max_length[5]');
            $this->form_validation->set_rules('tributetophone', 'Phone', 'trim');
            $this->form_validation->set_rules('tributetoemail', 'Email', 'trim');
        }




    }

    /*
     * Returns the body for an email receipt
     */
    private function get_email_body() {

        $Guestform_Notes_Required = $this->configsys->get_config_value('Guestform_Notes_Required');
        $amount = ( $this->input->post('paymentamount') === 'other' ? $this->input->post('otheramount') : $this->input->post('paymentamount') );


        $message = '<!DOCTYPE html><html><body>';
        $message .= '<p>';
        $message .= 'Thank you for your donation';
        $message .= '<br>';
        $message .= 'Please keep this receipt for your records';
        $message .= '<br>';
        $message .= '<hr>';
        $message .= $this->input->post('firstname'). ' ' . $this->input->post('lastname');
        if ($Guestform_Notes_Required == 'TRUE') {
            $message .= '<br>';
            $message .= $this->input->post('notes');
        }
        $message .= '<br>';
        $message .= $this->input->post('cardtype'). ' Ending in ' . substr($this->input->post('creditcard'), -4);
        $message .= '<br>';
        $message .= 'Amount Paid: ' . str_replace( ',', '', $amount );
        $message .= '<br>';
        $message .= 'Date: ' . date('Y-n-j H:i:s') ;
        $message .= '<hr>';
        $message .= '<br>';
        $message .= 'Tribute Information';
        $message .= ''.$this->input->post('tributetype');
        $message .= '<br>';
        $message .= 'First Name: '.$this->input->post('tributeefirstname');
        $message .= '<br>';
        $message .= 'Last Name: '.$this->input->post('tributeelastname');
        $message .= '<br>';
        $message .= 'Mail Tribute To';
        $message .= '<br>';
        $message .= 'First Name: '.$this->input->post('tributetofirstname');
        $message .= '<br>';
        $message .= 'Last Name: '.$this->input->post('tributetolastname');
        $message .= '<br>';
        $message .= 'Address: '.$this->input->post('tributetostreetaddress');
        $message .= '<br>';
        $message .= 'Address 2: '.$this->input->post('tributetostreetaddress2');
        $message .= '<br>';
        $message .= 'City: '.$this->input->post('tributetocity');
        $message .= '<br>';
        $message .= 'State: '.$this->input->post('tributetostate');
        $message .= '<br>';
        $message .= 'Zip: '.$this->input->post('tributetozip');
        $message .= '<br>';
        $message .= 'Phone: '.$this->input->post('tributetophone');
        $message .= '<br>';
        $message .= 'Email: '.$this->input->post('tributetoemail');
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
            // Relax this condition since we are formatting the number with decimals places.
            /*else if(is_numeric($post_string) == FALSE) {
                log_message('debug', 'check_otheramount FAILED is_numeric check = '.$post_string);
                $this->form_validation->set_message('check_otheramount', 'Amount must be numeric');
                return FALSE;
            }*/
            else if($post_string <= 0) {
                log_message('debug', 'check_otheramount FAILED > 0 check = '.$post_string);
                $this->form_validation->set_message('check_otheramount', 'Amount must greater than 0');
                return FALSE;
            }
        }
        return TRUE;
    }

    // Calculate the number of payments that will be done between two dates.
    function numberofinstallments($paymentday, $start, $end)
    {

        $start = new DateTime($start);
        $end = new DateTime($end);

        $count = 0;
        $interval = new \DateInterval('P1D');
        $period = new \DatePeriod($start, $interval, $end);

        if (strlen($paymentday) == 1){
            $paymentday = '0'.$paymentday;
        }

        foreach($period as $day){
            if($day->format('d') === $paymentday){
                $count ++;
            }
        }
        return $count;

    }


}
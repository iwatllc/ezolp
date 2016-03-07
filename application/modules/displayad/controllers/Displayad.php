<?php
/**
 * Created by PhpStorm.
 * User: afrazer
 * Date: 2/29/2016
 * Time: 9:27 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Displayad extends MX_Controller {

    public function __construct()
    {
        parent::__construct();

        // Loaded in here to make the validation work correctly.
        $this -> load -> library('form_validation');
        $this -> form_validation -> CI =& $this;

        // Load Required Modules
        $this -> load -> module('payment');
        $this -> load -> module('configsys');
        $this -> load -> module('email_sys');

        // Load Required Models
        $this -> load -> model('Displayad_model');
        $this -> load -> model('Configsys_model');
    }

    public function index()
    {
        $this -> load -> view('displayad', $this -> get_view_data());
    }

    public function submit()
    {
        // Call helper function to setup form validation
        $this -> setup_form_validation();

        if ($this -> form_validation -> run() == false)
        {
            $this -> index();
        } else
        {
            // Load upload library and configure the upload settings
            $this->load->library('upload', $this -> image_upload_settings());

            // Retrieve the next AUTO_INCREMENT value in the 'displayad_submissions' table
            $da_submissionid = $this -> Displayad_model -> get_auto_increment_value();

            $name_array = array();
            $count = count($_FILES['userfile']['size']);
            foreach($_FILES as $key => $value)
            {
                for($s = 0; $s <= $count - 1; $s++)
                {
                    $_FILES['userfile']['name']     =$value['name'][$s];
                    $_FILES['userfile']['type']     = $value['type'][$s];
                    $_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
                    $_FILES['userfile']['error']    = $value['error'][$s];
                    $_FILES['userfile']['size']     = $value['size'][$s];


                    if ($this -> upload -> do_upload())
                    {
                        $data = $this -> upload -> data();
                        $name_array[] = $data['file_name'];

                        // Make query to database to upload the file
                        $file_id = $this -> Displayad_model -> upload_file($da_submissionid, $data);
                    }
                    else
                    {
                        $error = $this -> upload -> display_errors();

                        // Need to set an error for 'userfile[]' here
                        $this -> form_validation -> set_rules('userfile[]', 'File(s)', 'callback_file_check');
                        $this -> index(); // load screen and display errors
                    }

                }
            }

            $names = implode(',', $name_array); // get all the names of the files into a comma separated string

            $option = $this -> input -> post ('size')[0];

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
                'promocode'     => $this -> input -> post('promocode'),
                'option'        => $option,
                'images'        => $names,
                'cardtype'      => $this -> input -> post('cardtype'),
                'cclast4'       => substr($this -> input -> post('creditcard'), -4),
                'amount'        => str_replace( ',', '', $this -> input -> post('grandtotal') ),
                'created'       => date('Y-n-j H:i:s')
            );

            // Get inserted record id to use as transaction id.
            $transaction_id = $this -> Displayad_model -> add_displayad_submission($submitted_data);

            // Add transaction id to submitted data and pass to payment method.
            $submitted_data['transaction_id'] = $transaction_id;
            $submitted_data['creditcard'] = $this -> input -> post('creditcard');
            $submitted_data['expirationmonth'] = $this -> input -> post('expirationmonth');
            $submitted_data['expirationyear'] = $this -> input -> post('expirationyear');
            $submitted_data['cvv2'] = $this -> input -> post('cvv2');
            $submitted_data['PaymentSource'] = 'DA';

            // Process Credit Card
            $result_data = $this -> payment -> process_payment($submitted_data);

            // Was the credit card processed successfully?
            if($result_data['IsApproved'] == '1')
            {
                // Handle Displayad Receipt
                if(strcasecmp($this -> configsys -> get_config_value('Displayad_Sendreceipt'), 'false'))
                {
                    // Send Receipt
                    $this -> email_sys -> send_email($submitted_data['email'],
                        $this -> configsys -> get_config_value('Displayad_Email_Subject', "Payment Receipt"),
                        $this -> get_email_body());
                }
            }

            // Load the classifiedad result view
            $this -> load -> view('displayadresult', $this -> get_view_data($submitted_data, $result_data));
        }
    }

    private function get_view_data($submitted_data = array(), $result_data = array())
    {
        log_message('debug', 'Getting Displayad view data...');

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

        $data['Displayad_Notes'] = $this->configsys->get_config_value('Displayad_Notes');
        $data['Displayad_Email'] = $this->configsys->get_config_value('Displayad_Email');
        $data['Displayad_Clientform'] = $this->configsys->get_config_value('Displayad_Clientform');
        $data['Displayad_Notes_Label'] = $this->configsys->get_config_value('Displayad_Notes_Label');
        $data['Displayad_Notes_Required'] = $this->configsys->get_config_value('Displayad_Notes_Required');
        $data['Displayad_Email_Required'] = $this->configsys->get_config_value('Displayad_Email_Required');
        $data['Displayad_Signature'] = $this->configsys->get_config_value('Displayad_Signature');
        $data['Displayad_Logo'] = $this->configsys->get_config_value('Displayad_Logo');

        $view_vars = array(
            'title' => $this->configsys->get_config_value('Client_Title'),
            'heading' => $this->configsys->get_config_value('Client_Title'),
            'description' => $this->configsys->get_config_value('Client_Description'),
            'company' => $this->configsys->get_config_value('Client_Name'),
            'logo' => $this->configsys->get_config_value('Client_Logo'),
            'author' => $this->configsys->get_config_value('Client_Author')
        );

        $data['monthly_pricing'] = $this -> Displayad_model -> get_monthlypricing_listing();
        $data['repeat_advertising_discounts'] = $this -> Displayad_model -> get_discounts_listing();

        $data['page_data'] = $view_vars;
        $data['result_data'] = $result_data;
        $data['submitted_data'] = $submitted_data;

        return $data;
    }

    private function setup_form_validation()
    {
        $this -> form_validation -> set_rules('firstname', 'First Name', 'required|max_length[100]');
        $this -> form_validation -> set_rules('lastname', 'Last Name', 'required|max_length[100]');
        $this -> form_validation -> set_rules('streetaddress', 'Street Address', 'required|max_length[300]');
        $this -> form_validation -> set_rules('city', 'City', 'required|max_length[100]');
        $this -> form_validation -> set_rules('state', 'State', 'required|callback_check_default');
        $this -> form_validation -> set_rules('zip', 'Zip Code', 'required|min_length[5]|max_length[5]');
        $this -> form_validation -> set_rules('phone', 'Phone Number', 'required|min_length[14]|max_length[14]');
        $this -> form_validation -> set_rules('email', 'Email', 'valid_email');
        $this -> form_validation -> set_rules('issues[]', 'Issues', 'required');
        $this -> form_validation -> set_rules('size[]', 'Size and Color', 'required');

        // set form validation for file upload
        if ($_FILES['userfile']['name'][0] == '')
        {
            $this -> form_validation -> set_rules('userfile[]', 'File(s)', 'required');
        }

        $this -> form_validation -> set_rules('grandtotal', 'Total', 'required');

        $this->form_validation->set_rules('creditcard', 'Credit Card', 'required|callback_check_creditcard');
        $this->form_validation->set_rules('expirationmonth', 'Expiration Month', 'required|callback_check_default');
        $this->form_validation->set_rules('expirationyear', 'Expiration Year', 'required');
        $this->form_validation->set_rules('cvv2', 'CVV2 Code', 'required|min_length[3]|max_length[4]');
    }

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
            $this -> load -> model('Displayad_model');
            $row = $this -> Displayad_model -> check_promo_code($_POST["promocode"]);
        }

        if ($row)
        {
            $data = array(
                'id'          => $row -> id,
                'code'        => $row -> code,
                'description' => $row -> description,
                'months'      => $row -> months,
                'amount'  => $row -> amount,
                'startdate'   => date('m-d-Y h:i A', strtotime($row -> startdate)),
                'enddate'     => date('m-d-Y h:i A', strtotime($row -> enddate))
            );
        } else
        {
            $data = '';
        }

        echo json_encode($data);
    }

    private function image_upload_settings()
    {
        $config['upload_path'] = './image/uploads';
        $config['allowed_types'] = 'gif|jpg|png|svg|ico|bmp';
        $config['max_size']    = '';
        $config['max_width']  = '';
        $config['max_height']  = '';

        return $config;
    }

    public function file_check()
    {
        $this -> form_validation -> set_message('userfile[]', 'There was an error');

        return false;
    }
}
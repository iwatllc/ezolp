<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ca_promo extends MX_Controller {

    public function __construct()
    {
        if (!$this->dx_auth->is_logged_in())
        {
            // redirect to login page
            redirect('security/auth', 'refresh');
        }

        parent::__construct();

        $this -> load -> library('table');
        $this -> load -> helper('form');
        $this -> load -> helper('url');
        $this -> load -> load -> library('session');
    }

    public function index()
    {
        $this -> load -> model('Ca_promo_model');

        $view_vars = array(
            'title' => $this->config->item('Company_Title'),
            'heading' => $this->config->item('Company_Title'),
            'description' => $this->config->item('Company_Description'),
            'company' => $this->config->item('Company_Name'),
            'logo' => $this->config->item('Company_Logo'),
            'author' => $this->config->item('Company_Author')
        );
        $data['page_data'] = $view_vars;

        // Get offset and limit for page viewing
        $offset = (int) $this->uri->segment(3);
        // Number of record showing per page
        $row_count = 10;

        // Get all users
        $data['ca_promos'] = $this -> Ca_promo_model -> list_all_promos($offset, $row_count)->result();

        // Pagination config
        $p_config['base_url'] = 'ca_promo';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this -> Ca_promo_model -> list_all_promos() -> num_rows();
        $p_config['per_page'] = $row_count;

        $this -> load -> view('ca_promo', $data);
    }

    public function execute_search()
    {
        $search_array['PaymentTransactionId'] = $this->input->post('PaymentTransactionId');
        $search_array['BegDate'] = date( "Y-m-d", strtotime( $this->input->post('BegDate') ) );
        $search_array['EndDate'] = date( "Y-m-d", strtotime( $this->input->post('EndDate') ) );
        $search_array['PaymentSource'] = $this->input->post('PaymentSource');
        $search_array['TransactionAmount'] = $this->input->post('TransactionAmount');
        $search_array['AuthCode'] = $this->input->post('AuthCode');
        $search_array['OrderNumber'] = $this->input->post('OrderNumber');
        $search_array['CVV2ResponseCode'] = $this->input->post('CVV2ResponseCode');
        $search_array['SerialNumber'] = $this->input->post('SerialNumber');
        $search_array['TransactionStatusId'] = $this->input->post('TransactionStatusId');

        $this->load->model('Search_model', 'Search');

        $data['results'] = $this->Search->get_search_results($search_array);

        $data['num_results'] = $this->Search->get_num_results($data['results']);
        $total_amount = $this->Search->get_total_amount($data['results']);
        $data['total_amount'] = floor($total_amount * 100) / 100; // round down nearest 2 decimal places

        $data['search_array'] = $search_array;

        $view_vars = array(
            'title' => $this->config->item('Company_Title'),
            'heading' => $this->config->item('Company_Title'),
            'description' => $this->config->item('Company_Description'),
            'company' => $this->config->item('Company_Name'),
            'logo' => $this->config->item('Company_Logo'),
            'author' => $this->config->item('Company_Author')
        );
        $data['transaction_statuses'] = $this->Search->get_transaction_statuses();
        $data['payment_sources'] = $this->Search->get_form_lists();
        $data['page_data'] = $view_vars;

        $this->load->view('search', $data);
    }
}
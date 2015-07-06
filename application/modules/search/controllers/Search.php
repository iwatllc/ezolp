<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MX_Controller {
        
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->load->library('session');
        
        $this->load->model('Search_model', 'Search');
        
        $view_vars = array(
            'title' => 'EZ Online Pay | Virtual Terminal Payment Form',
            'heading' => 'Search for Transactions',
            'description' => 'Enter criteria to search for a payment.',
            'author' => 'EZ Online Pay 2015 ' . date("Y")
        );
        $data['page_data'] = $view_vars;

        $this->load->view('search', $data);
    }
    
    public function execute_search()
    {
        $search_array['PaymentTransactionId'] = $this->input->post('PaymentTransactionId');
        $search_array['InsertDate'] = $this->input->post('InsertDate');
        $search_array['PaymentSource'] = $this->input->post('PaymentSource');
        $search_array['TransactionAmount'] = $this->input->post('TransactionAmount');
        $search_array['AuthCode'] = $this->input->post('AuthCode');
        $search_array['OrderNumber'] = $this->input->post('OrderNumber');
        $search_array['CVV2ResponseMessage'] = $this->input->post('CVV2ResponseMessage');
        $search_array['UpdateDate'] = $this->input->post('UpdateDate');
        $search_array['SerialNumber'] = $this->input->post('SerialNumber');

        
        $this->load->model('Search_model', 'Search');
        
        $data['results'] = $this->Search->get_search_results($search_array);
        
        $data['search_array'] = $search_array;
        
        $view_vars = array(
            'title' => 'EZ Online Pay | Virtual Terminal Payment Form',
            'heading' => 'Search Transactions',
            'description' => 'Enter criteria to search for a payment.',
            'author' => 'EZ Online Pay 2015 ' . date("Y")
        );
        $data['page_data'] = $view_vars;
        
        $this->load->view('search', $data);
    }
}
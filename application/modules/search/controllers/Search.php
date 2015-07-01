<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MX_Controller {
        
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->load->model('Search_model', 'Search');
        
        $data['transactions'] = $this->Search->return_ten();
        
        $view_vars = array(
            'title' => 'EZ Online Pay | Virtual Terminal Payment Form',
            'heading' => 'Search for a Payment',
            'description' => 'Enter criteria to search for a payment.',
            'author' => 'EZ Online Pay 2015 ' . date("Y")
        );
        $data['page_data'] = $view_vars;

        $this->load->view('search', $data);
    }
}
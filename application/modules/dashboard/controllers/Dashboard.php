<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {
        
    public function __construct()
    {
        if (!$this->dx_auth->is_logged_in())
        {
            // redirect to login page
            redirect('security/Auth', 'refresh');
        }
        
        parent::__construct();
    }
    
    public function index()
    {
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->load->library('session');
        
        $data['username'] = $this->session->userdata('DX_username');
        
        $this->load->model('Dashboard_model', 'Dashboard');

        $view_vars = array(
            'title' => 'EZ Online Pay | Virtual Terminal Payment Form',
            'heading' => 'Welcome',
            'description' => '',
            'author' => 'EZ Online Pay 2015 ' . date("Y")
        );
        $data['page_data'] = $view_vars;

        $this->load->view('dashboard', $data);
    }
}
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

        $data['total_amount'] = $this->Dashboard->get_total_amount_vt();
        $data['total_customers'] = $this->Dashboard->get_total_customers_vt();

        $view_vars = array(
            'title' => $this->config->item('Company_Title'),
            'heading' => $this->config->item('Company_Title'),
            'description' => $this->config->item('Company_Description'),
            'company' => $this->config->item('Company_Name'),
            'logo' => $this->config->item('Company_Logo'),
            'author' => $this->config->item('Company_Author')
        );
        $data['page_data'] = $view_vars;

        $this->load->view('dashboard', $data);
    }
}
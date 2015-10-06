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

        $data['todays_date'] = date('l, F j, Y');

        $view_vars = array(
            'title' => $this->config->item('Company_Title'),
            'heading' => $this->config->item('Company_Title'),
            'description' => $this->config->item('Company_Description'),
            'company' => $this->config->item('Company_Name'),
            'logo' => $this->config->item('Company_Logo'),
            'author' => $this->config->item('Company_Author')
        );
        $data['page_data'] = $view_vars;

        $data['begin_date'] = '';
        $data['end_date'] = '';

        $this->load->model('Dashboard_model', 'Dashboard');

        $data['total_volume'] = round($this->Dashboard->get_total_volume(), 2); // round to nearest tenth cent
        $data['total_customers'] = $this->Dashboard->get_total_customers();

        $data['total'] = $this->Dashboard->get_past_seven_days_total();

        $days_array = array();

        $time = time();

        // Get the past 7 days of the week and store it in $days_array
        for ($x = 0; $x < 7; $x++)
        {
            $days_array[$x] = date("M d", mktime(0,0,0,date("n", $time),date("j",$time) - $x ,date("Y", $time)));
        }

        $data['days_array'] = $days_array;

        $this->load->view('dashboard', $data);
    }

    public function filter_date()
    {
        $data['begin_date'] = date( "Y-m-d", strtotime( $this->input->post('BegDate') ) );
        $data['end_date'] = date( "Y-m-d", strtotime( $this->input->post('EndDate') ) );

        $this->load->model('Dashboard_model', 'Dashboard');

        $data['todays_date'] = date('l, F j, Y');

//        $data['total_volume'] = round($this->Dashboard->get_total_volume(), 2); // round to nearest tenth cent
        $data['total_customers'] = $this->Dashboard->get_total_customers();

        $data['total_volume'] = round($this->Dashboard->get_total_amount_by_date($data['begin_date'], $data['end_date']), 2);
        $data['total_customers'] = $this->Dashboard->get_total_customers_by_date($data['begin_date'], $data['end_date']);

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
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Checkdonationamount extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->module('configsys');
    }

    public function index()
    {
        $donationid = $this->uri->segment(3);

        $this->load->model('Checkdonationamount_model', 'Checkdonationamount');

        $data['company_donations'] = $this->Checkdonationamount->get_company_donations($donationid);
        $data['all_donations'] = $this->Checkdonationamount->get_all_donations($data['company_donations']);

        $view_vars = array(
            'title' => $this->config->item('Company_Title') . ' | Check Donation Amount ',
            'heading' => $this->config->item('Company_Title'),
            'description' => $this->config->item('Company_Title'). ' Check Donation Amount ',
            'logo' => $this->config->item('Company_Logo'),
            'author' => $this->config->item('Company_Author')
        );
        $data['page_data'] = $view_vars;

        $this->load->view('checkdonationamount', $data);
    }



}
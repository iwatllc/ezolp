<?php
/**
 * Created by PhpStorm.
 * User: afrazer
 * Date: 3/9/2016
 * Time: 10:51 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Ca_search extends MX_Controller
{
    public function __construct()
    {
        if (!$this->dx_auth->is_logged_in())
        {
            redirect('security/auth', 'refresh');
        }

        parent::__construct();
    }

    public function index()
    {
        $this -> load -> model('ca_search_model');

        $view_vars = array(
            'title' => $this->config->item('Company_Title'),
            'heading' => $this->config->item('Company_Title'),
            'description' => $this->config->item('Company_Description'),
            'company' => $this->config->item('Company_Name'),
            'logo' => $this->config->item('Company_Logo'),
            'author' => $this->config->item('Company_Author')
        );
        $data['page_data'] = $view_vars;

        $data['promo_codes'] = $this -> ca_search_model -> get_promocode_dropdown_list();

        $this -> load -> view('ca_search', $data);
    }

    public function execute_search()
    {
        $search_array['contactinfo']    = $this -> input -> post('contactinfo');
        $search_array['adtext']         = $this -> input -> post('adtext');
        $search_array['promocode']      = $this -> input -> post('promocode');
        $search_array['issues']      = $this -> input -> post('issues[]');
        $search_array['begindate']      = date( "Y-m-d", strtotime( $this -> input -> post('begindate') ) );
        $search_array['enddate']        = date( "Y-m-d", strtotime( $this -> input -> post('enddate') ) );

        if ($search_array['begindate'] == '1969-12-31')
        {
            $search_array['begindate'] = NULL;
        }
        if ($search_array['enddate'] == '1969-12-31')
        {
            $search_array['enddate'] = NULL;
        }

        $this -> load -> model('ca_search_model');

        $data['results'] = $this -> ca_search_model -> get_search_results($search_array);

        $data['search_array'] = $search_array;

        $data['promo_codes'] = $this -> ca_search_model -> get_promocode_dropdown_list();

        $view_vars = array(
            'title' => $this->config->item('Company_Title'),
            'heading' => $this->config->item('Company_Title'),
            'description' => $this->config->item('Company_Description'),
            'company' => $this->config->item('Company_Name'),
            'logo' => $this->config->item('Company_Logo'),
            'author' => $this->config->item('Company_Author')
        );
        $data['page_data'] = $view_vars;

        $this -> load -> view('ca_search', $data);
    }

    public function ajax_approve_submission()
    {
        $this -> load -> model('ca_search_model');

        $id     = $this -> input -> post('id');
        $status = $this -> input -> post('status');

        if ($status === 'Not Approved')
        {
            $statusid = 0;

            $this -> ca_search_model -> disapprove_submission($id, $statusid);

        } else if ($status == 'Approved')
        {
            $this -> load -> helper('date');
            $datestring = "%Y-%m-%d %H:%i:%s";
            $time = time();
            $approvaldate = mdate($datestring, $time);

            $statusid = 1;

            $approvedby = $this -> dx_auth -> get_user_id();

            $this -> ca_search_model -> approve_submission($id, $statusid, $approvedby, $approvaldate);
        }

        // query the table for the row that was just inserted
        $row = $this -> ca_search_model -> get_submission($id);

        $data = array(
            'id'                => $row -> id,
            'status'            => $row -> approved
        );

        // go back to ajax to print data
        echo json_encode($data);
    }
}
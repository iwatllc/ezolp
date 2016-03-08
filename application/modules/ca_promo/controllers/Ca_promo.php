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

        $data['begin_date'] = '';
        $data['end_date'] = '';

        // Pagination config
        $p_config['base_url'] = 'ca_promo';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this -> Ca_promo_model -> list_all_promos() -> num_rows();
        $p_config['per_page'] = $row_count;

        $this -> load -> view('ca_promo', $data);
    }

    function ajax_add_promocode()
    {
        $this -> load -> model('ca_promo_model', '', TRUE);

        // run form validation
        $this -> form_validation -> set_rules('code', 'Code', 'required');
        $this -> form_validation -> set_rules('description', 'Description', 'required');
        $this -> form_validation -> set_rules('begindate', 'Start Date', 'required');
        $this -> form_validation -> set_rules('enddate', 'End Date', 'required');
        $this -> form_validation -> set_rules('months', 'Months', 'required');
        $this -> form_validation -> set_rules('percentage', 'Percentage', 'required');

        if ($this -> form_validation -> run() == FALSE)
        {
            $errors = array();
            if ($this -> form_validation -> run('code') == FALSE)
                $errors['code_error'] = form_error('code');
            if ($this -> form_validation -> run('description') == FALSE)
                $errors['description_error'] = form_error('description');
            if ($this -> form_validation -> run('begindate') == FALSE)
                $errors['begindate_error'] = form_error('begindate');
            if ($this -> form_validation -> run('enddate') == FALSE)
                $errors['enddate_error'] = form_error('enddate');
            if ($this -> form_validation -> run('months') == FALSE)
                $errors['months_error'] = form_error('months');
            if ($this -> form_validation -> run('percentage') == FALSE)
                $errors['percentage_error'] = form_error('percentage');

            echo json_encode($errors);

            return; // if form validation fails, exit to ajax success message
        }

        $code           = $this -> input -> post('code');
        $description    = $this -> input -> post('description');
        $begindate      = $this -> input -> post('begindate');
        $enddate        = $this -> input -> post('enddate');
        $months         = $this -> input -> post('months');
        $percentage     = $this -> input -> post('percentage');

        $begindate = new DateTime($begindate);
        $begindate =  $begindate -> format('Y-m-d');

        $enddate = new DateTime($enddate);
        $enddate =  $enddate -> format('Y-m-d');

        $this -> load -> helper('date');
        $datestring = "%Y-%m-%d %H:%i:%s";
        $time = time();
        $createddate = mdate($datestring, $time);

        // insert data to database, return the id of the row that was inserted
        $id = $this -> ca_promo_model -> add_promo($code, $description, $begindate, $enddate, $months, $percentage, $createddate);

        // query the table for the row that was just inserted
        $row = $this -> ca_promo_model -> get_promo($id);

        $dt = new DateTime($row -> startdate);
        $startdate = $dt -> format('m-d-Y');
        $dt = new DateTime($row -> enddate);
        $enddate = $dt -> format('m-d-Y');


        $data = array(
            'id'                => $row -> id,
            'code'              => $row -> code,
            'description'       => $row -> description,
            'begindate'         => $startdate,
            'enddate'           => $enddate,
            'months'            => $row -> months,
            'percentage'        => $row -> percentage,
            'num_promos'      => $this-> ca_promo_model -> get_num_promos()
        );

        // go back to ajax to print data
        echo json_encode($data);
    }

    function ajax_edit_promocode()
    {
        $this -> load -> model('ca_promo_model', '', TRUE);

        // run form validation
        $this -> form_validation -> set_rules('code', 'Code', 'required');
        $this -> form_validation -> set_rules('description', 'Description', 'required');
        $this -> form_validation -> set_rules('begindate', 'Start Date', 'required');
        $this -> form_validation -> set_rules('enddate', 'End Date', 'required');
        $this -> form_validation -> set_rules('months', 'Months', 'required');
        $this -> form_validation -> set_rules('percentage', 'Percentage', 'required');

        if ($this -> form_validation -> run() == FALSE)
        {
            $errors = array();
            if ($this -> form_validation -> run('code') == FALSE)
                $errors['code_error'] = form_error('code');
            if ($this -> form_validation -> run('description') == FALSE)
                $errors['description_error'] = form_error('description');
            if ($this -> form_validation -> run('begindate') == FALSE)
                $errors['begindate_error'] = form_error('begindate');
            if ($this -> form_validation -> run('enddate') == FALSE)
                $errors['enddate_error'] = form_error('enddate');
            if ($this -> form_validation -> run('months') == FALSE)
                $errors['months_error'] = form_error('months');
            if ($this -> form_validation -> run('percentage') == FALSE)
                $errors['percentage_error'] = form_error('percentage');

            echo json_encode($errors);

            return; // if form validation fails, exit to ajax success message
        }

        $id             = $this -> input -> post('id');
        $code           = $this -> input -> post('code');
        $description    = $this -> input -> post('description');
        $begindate      = $this -> input -> post('begindate');
        $enddate        = $this -> input -> post('enddate');
        $months         = $this -> input -> post('months');
        $percentage     = $this -> input -> post('percentage');

        $begindate = new DateTime($begindate);
        $begindate =  $begindate -> format('Y-m-d');

        $enddate = new DateTime($enddate);
        $enddate =  $enddate -> format('Y-m-d');

        $this -> load -> helper('date');
        $datestring = "%Y-%m-%d %H:%i:%s";
        $time = time();
        $modifieddate = mdate($datestring, $time);

        // insert data to database, return the id of the row that was inserted
        $id = $this -> ca_promo_model -> update_promo($id, $code, $description, $begindate, $enddate, $months, $percentage, $modifieddate);

        // query the table for the row that was just inserted
        $row = $this -> ca_promo_model -> get_promo($id);

        $dt = new DateTime($row -> startdate);
        $startdate = $dt -> format('m-d-Y');
        $dt = new DateTime($row -> enddate);
        $enddate = $dt -> format('m-d-Y');


        $data = array(
            'id'                => $row -> id,
            'code'              => $row -> code,
            'description'       => $row -> description,
            'begindate'         => $startdate,
            'enddate'           => $enddate,
            'months'            => $row -> months,
            'percentage'        => $row -> percentage
//            'num_promos'      => $this-> ca_promo_model -> get_num_promos()
        );

        // go back to ajax to print data
        echo json_encode($data);
    }

    public function ajax_del_promocode()
    {
        $this -> load -> model('ca_promo_model', '', TRUE);

        $data = array();

        if( isset( $_POST['promocodes'] ) )
        {
            foreach ( $_POST['promocodes'] as $id )
            {
                // delete sales rep
                $this -> ca_promo_model -> del_promocode($id);

//                // query the table for the row that was just deleted
//                $row = $this -> jobnote_model -> get_jobnote($id);

                array_push($data, $id);
            }
        }

        $data['num_promocodes'] = $this-> ca_promo_model -> get_num_promos();

        // go back to ajax to print data
        echo json_encode($data);
    }
}
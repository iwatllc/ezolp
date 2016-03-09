<?php
/**
 * Created by PhpStorm.
 * User: afrazer
 * Date: 3/7/2016
 * Time: 8:43 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Da_repeatdiscount extends MX_Controller {

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
        $this -> load -> model('Da_repeatdiscount_model');

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
        $offset = (int) $this -> uri -> segment(3);
        // Number of record showing per page
        $row_count = 10;

        // Get repeat discount listing for display ads
        $data['da_discounts'] = $this -> Da_repeatdiscount_model -> list_all_discounts($offset, $row_count)->result();

        $data['begin_date'] = '';
        $data['end_date'] = '';

        // Pagination config
        $p_config['base_url'] = 'da_repeatdiscount';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this -> Da_repeatdiscount_model -> list_all_discounts() -> num_rows();
        $p_config['per_page'] = $row_count;

        $this -> load -> view('da_repeatdiscount', $data);
    }

    function ajax_add_discount()
    {
        $this -> load -> model('da_repeatdiscount_model', '', TRUE);

        // run form validation
        $this -> form_validation -> set_rules('issues', 'Number of Issues', 'required');
        $this -> form_validation -> set_rules('percentage', 'Discount Percentage', 'required');

        if ($this -> form_validation -> run() == FALSE)
        {
            $errors = array();
            if ($this -> form_validation -> run('issues') == FALSE)
                $errors['issues_error'] = form_error('issues');
            if ($this -> form_validation -> run('percentage') == FALSE)
                $errors['percentage_error'] = form_error('percentage');

            echo json_encode($errors);

            return; // if form validation fails, exit to ajax success message
        }

        $issues     = $this -> input -> post('issues');
        $percentage = $this -> input -> post('percentage');

        $this -> load -> helper('date');
        $datestring = "%Y-%m-%d %H:%i:%s";
        $time = time();
        $createddate = mdate($datestring, $time);

        // insert data to database, return the id of the row that was inserted
        $id = $this -> da_repeatdiscount_model -> add_discount($issues, $percentage, $createddate);

        // query the table for the row that was just inserted
        $row = $this -> da_repeatdiscount_model -> get_discount($id);

        $dt = new DateTime($row -> created);
        $created = $dt -> format('m-d-Y');

        $data = array(
            'id'            => $row -> id,
            'issues'          => $row -> numissues,
            'percentage'       => $row -> percentagediscount,
            'created'       => $created
//            'num_discounts'  => $this-> da_repeatdiscount_model -> get_num_discounts()
        );

        // go back to ajax to print data
        echo json_encode($data);
    }

    function ajax_edit_discount()
    {
        $this -> load -> model('da_repeatdiscount_model', '', TRUE);

        // run form validation
        $this -> form_validation -> set_rules('issues', 'Number of Issues', 'required');
        $this -> form_validation -> set_rules('percentage', 'Discount Percentage', 'required');

        if ($this -> form_validation -> run() == FALSE)
        {
            $errors = array();
            if ($this -> form_validation -> run('issues') == FALSE)
                $errors['issues_error'] = form_error('issues');
            if ($this -> form_validation -> run('percentage') == FALSE)
                $errors['percentage_error'] = form_error('percentage');

            echo json_encode($errors);

            return; // if form validation fails, exit to ajax success message
        }

        $id         = $this -> input -> post('id');
        $issues     = $this -> input -> post('issues');
        $percentage = $this -> input -> post('percentage');

        $this -> load -> helper('date');
        $datestring = "%Y-%m-%d %H:%i:%s";
        $time = time();
        $modifieddate = mdate($datestring, $time);

        // insert data to database, return the id of the row that was inserted
        $id = $this -> da_repeatdiscount_model -> update_discount($id, $issues, $percentage, $modifieddate);

        // query the table for the row that was just inserted
        $row = $this -> da_repeatdiscount_model -> get_discount($id);

        $dt = new DateTime($row -> created);
        $createddate = $dt -> format('m-d-Y');
        $dt = new DateTime($row -> modified);
        $modifieddate = $dt -> format('m-d-Y');

        $data = array(
            'id'                => $row -> id,
            'issues'              => $row -> numissues,
            'percentage'           => $row -> percentagediscount,
            'created'           => $createddate,
            'modified'          => $modifieddate
//            'num_pricings'      => $this-> da_repeatdiscount_model -> get_num_pricings()
        );

        // go back to ajax to print data
        echo json_encode($data);
    }

    function ajax_del_discount()
    {
        $this -> load -> model('da_repeatdiscount_model', '', TRUE);

        $data = array();

        if( isset( $_POST['discounts'] ) )
        {
            foreach ( $_POST['discounts'] as $id )
            {
                $this -> da_repeatdiscount_model -> del_discount($id);

//                // query the table for the row that was just deleted
//                $row = $this -> jobnote_model -> get_jobnote($id);

                array_push($data, $id);
            }
        }

        $data['num_discounts'] = $this-> da_repeatdiscount_model -> get_num_discounts();

        // go back to ajax to print data
        echo json_encode($data);
    }
}
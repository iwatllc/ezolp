<?php
/**
 * Created by PhpStorm.
 * User: afrazer
 * Date: 3/7/2016
 * Time: 8:43 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Da_monthlypricing extends MX_Controller {

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
        $this -> load -> model('Da_monthlypricing_model');

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

        // Get monthly pricing listing for display ads
        $data['da_pricings'] = $this -> Da_monthlypricing_model -> list_all_pricings($offset, $row_count)->result();

        $data['begin_date'] = '';
        $data['end_date'] = '';

        // Pagination config
        $p_config['base_url'] = 'da_monthlypricing';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this -> Da_monthlypricing_model -> list_all_pricings() -> num_rows();
        $p_config['per_page'] = $row_count;

        $this -> load -> view('da_monthlypricing', $data);
    }

    function ajax_add_pricing()
    {
        $this -> load -> model('da_monthlypricing_model', '', TRUE);

        // run form validation
        $this -> form_validation -> set_rules('size', 'Page Size', 'required');
        $this -> form_validation -> set_rules('bwprice', 'B/W Price', 'required');
        $this -> form_validation -> set_rules('colorprice', 'Color Price', 'required');

        if ($this -> form_validation -> run() == FALSE)
        {
            $errors = array();
            if ($this -> form_validation -> run('size') == FALSE)
                $errors['size_error'] = form_error('size');
            if ($this -> form_validation -> run('bwprice') == FALSE)
                $errors['bwprice_error'] = form_error('bwprice');
            if ($this -> form_validation -> run('colorprice') == FALSE)
                $errors['colorprice_error'] = form_error('colorprice');

            echo json_encode($errors);

            return; // if form validation fails, exit to ajax success message
        }

        $size       = $this -> input -> post('size');
        $bwprice    = $this -> input -> post('bwprice');
        $colorprice = $this -> input -> post('colorprice');

        $this -> load -> helper('date');
        $datestring = "%Y-%m-%d %H:%i:%s";
        $time = time();
        $createddate = mdate($datestring, $time);

        // insert data to database, return the id of the row that was inserted
        $id = $this -> da_monthlypricing_model -> add_pricing($size, $bwprice, $colorprice, $createddate);

        // query the table for the row that was just inserted
        $row = $this -> da_monthlypricing_model -> get_pricing($id);

        $dt = new DateTime($row -> created);
        $created = $dt -> format('m-d-Y');

        $data = array(
            'id'            => $row -> id,
            'size'          => $row -> pagesize,
            'bwprice'       => $row -> bwprice,
            'colorprice'    => $row -> colorprice,
            'created'       => $created
//            'num_pricings'  => $this-> da_monthlypricing_model -> get_num_pricings()
        );

        // go back to ajax to print data
        echo json_encode($data);
    }    
    
    function ajax_edit_pricing()
{
    $this -> load -> model('da_monthlypricing_model', '', TRUE);

    // run form validation
    $this -> form_validation -> set_rules('size', 'Page Size', 'required');
    $this -> form_validation -> set_rules('bwprice', 'B/W Price', 'required');
    $this -> form_validation -> set_rules('colorprice', 'Color Price', 'required');

    if ($this -> form_validation -> run() == FALSE)
    {
        $errors = array();
        if ($this -> form_validation -> run('size') == FALSE)
            $errors['size_error'] = form_error('size');
        if ($this -> form_validation -> run('bwprice') == FALSE)
            $errors['bwprice_error'] = form_error('bwprice');
        if ($this -> form_validation -> run('colorprice') == FALSE)
            $errors['colorprice_error'] = form_error('colorprice');

        echo json_encode($errors);

        return; // if form validation fails, exit to ajax success message
    }

    $id         = $this -> input -> post('id');
    $size       = $this -> input -> post('size');
    $bwprice    = $this -> input -> post('bwprice');
    $colorprice = $this -> input -> post('colorprice');

    $this -> load -> helper('date');
    $datestring = "%Y-%m-%d %H:%i:%s";
    $time = time();
    $modifieddate = mdate($datestring, $time);

    // insert data to database, return the id of the row that was inserted
    $id = $this -> da_monthlypricing_model -> update_pricing($id, $size, $bwprice, $colorprice, $modifieddate);

    // query the table for the row that was just inserted
    $row = $this -> da_monthlypricing_model -> get_pricing($id);

    $dt = new DateTime($row -> created);
    $createddate = $dt -> format('m-d-Y');
    $dt = new DateTime($row -> modified);
    $modifieddate = $dt -> format('m-d-Y');
    
    $data = array(
        'id'                => $row -> id,
        'size'              => $row -> size,
        'bwprice'           => $row -> bwprice,
        'colorprice'        => $row -> colorprice,
        'created'           => $createddate,
        'modified'          => $modifieddate
//            'num_pricings'      => $this-> da_monthlypricing_model -> get_num_pricings()
    );

    // go back to ajax to print data
    echo json_encode($data);
}

    public function ajax_del_pricing()
    {
        $this -> load -> model('da_monthlypricing_model', '', TRUE);

        $data = array();

        if( isset( $_POST['pricings'] ) )
        {
            foreach ( $_POST['pricings'] as $id )
            {
                $this -> da_monthlypricing_model -> del_pricing($id);

//                // query the table for the row that was just deleted
//                $row = $this -> jobnote_model -> get_jobnote($id);

                array_push($data, $id);
            }
        }

        $data['num_pricings'] = $this-> da_monthlypricing_model -> get_num_pricings();

        // go back to ajax to print data
        echo json_encode($data);
    }
}
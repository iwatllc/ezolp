<?php
/**
 * Created by PhpStorm.
 * User: afrazer
 * Date: 3/9/2016
 * Time: 10:51 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Da_search extends MX_Controller
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
        $this -> load -> model('da_search_model');

        $view_vars = array(
            'title' => $this->config->item('Company_Title'),
            'heading' => $this->config->item('Company_Title'),
            'description' => $this->config->item('Company_Description'),
            'company' => $this->config->item('Company_Name'),
            'logo' => $this->config->item('Company_Logo'),
            'author' => $this->config->item('Company_Author')
        );
        $data['page_data'] = $view_vars;

        $data['promo_codes'] = $this -> da_search_model -> get_promocode_dropdown_list();
        $data['pricings'] = $this -> da_search_model -> get_pricing_list();

        $this -> load -> view('da_search', $data);
    }

    public function execute_search()
    {
        $search_array['contactinfo']    = $this -> input -> post('contactinfo');
        $search_array['pricing']        = $this -> input -> post('pricing');
        $search_array['promocode']      = $this -> input -> post('promocode');
        $search_array['issues']         = $this -> input -> post('issues[]');
        $search_array['begindate']      = date( "Y-m-d", strtotime( $this -> input -> post('begindate') ) );
        $search_array['enddate']        = date( "Y-m-d", strtotime( $this -> input -> post('enddate') ) );
        $search_array['approval']       = $this -> input -> post('approval');


        if ($search_array['begindate'] == '1969-12-31')
        {
            $search_array['begindate'] = NULL;
        }
        if ($search_array['enddate'] == '1969-12-31')
        {
            $search_array['enddate'] = NULL;
        }

//        echo '<br/><br/><br/>';
//        echo '<div style="padding-left:20em">';
//            echo '<br/>Contact Info: '  . $this -> input -> post('contactinfo');
//            echo '<br/> Ad Text: '      . $this -> input -> post('adtext');
//            echo '<br/>Issues: ';
//            print_r($search_array['issues']);
//            echo '<br/>Begin Date: '    . date( "Y-m-d", strtotime( $this -> input -> post('begindate') ) );
//            echo '<br/>End Date: '      . date( "Y-m-d", strtotime( $this -> input -> post('enddate') ) );
//
//        echo '<br/><br/>Final Search Array: '; print_r($search_array);
//        echo '</div>';


        $this -> load -> model('da_search_model');

        $data['results'] = $this -> da_search_model -> get_search_results($search_array);

        $data['search_array'] = $search_array;

        $data['promo_codes'] = $this -> da_search_model -> get_promocode_dropdown_list();
        $data['pricings'] = $this -> da_search_model -> get_pricing_list();


        $view_vars = array(
            'title' => $this->config->item('Company_Title'),
            'heading' => $this->config->item('Company_Title'),
            'description' => $this->config->item('Company_Description'),
            'company' => $this->config->item('Company_Name'),
            'logo' => $this->config->item('Company_Logo'),
            'author' => $this->config->item('Company_Author')
        );
        $data['page_data'] = $view_vars;

        $this -> load -> view('da_search', $data);
    }

    public function ajax_approve_submission()
    {
        $this -> load -> model('da_search_model');

        $id     = $this -> input -> post('id');
        $status = $this -> input -> post('status');

        if ($status === 'Not Approved')
        {
            $statusid = 0;

            $this -> da_search_model -> disapprove_submission($id, $statusid);

        } else if ($status == 'Approved')
        {
            $this -> load -> helper('date');
            $datestring = "%Y-%m-%d %H:%i:%s";
            $time = time();
            $approvaldate = mdate($datestring, $time);

            $statusid = 1;

            $approvedby = $this -> dx_auth -> get_user_id();

            $this -> da_search_model -> approve_submission($id, $statusid, $approvedby, $approvaldate);
        }

        // query the table for the row that was just inserted
        $row = $this -> da_search_model -> get_submission($id);

        $approveddate = date_conversion_nowording($row -> approveddate);
        $username = $this -> dx_auth -> get_username();

        $data = array(
            'id'                => $row -> id,
            'status'            => $row -> approved,
            'approvedby'        => $username,
            'approveddate'      => $approveddate
        );

        // go back to ajax to print data
        echo json_encode($data);
    }

    public function do_upload()
    {
        $this -> load -> model('da_search_model');

        // Load upload library and configure the upload settings
        $this -> load -> library('upload', $this -> image_upload_settings());

        $da_submissionid = $this -> input -> post('da_submissionid');

        if ($this -> upload -> do_upload('file'))
        {
            echo 'Files were uploaded successfully.';

            $uploaded = $this -> upload -> data(); // get files metadata in an array

            // Make db query to upload the file's metadata
            $this -> da_search_model -> upload_approved_image($da_submissionid, $uploaded);

        } else
        {
            echo 'ERROR: Files were not uploaded.';
        }

    }

    private function image_upload_settings()
    {
        $config['upload_path'] = './image/approved_uploads';
        $config['allowed_types'] = 'gif|jpg|png|svg|ico|bmp';
        $config['max_size']    = '';
        $config['max_width']  = '';
        $config['max_height']  = '';
        $config['multi']        = 'all';

        return $config;
    }

    public function ajax_del_approved_image()
    {
        $this -> load -> model('da_search_model', '', TRUE);

        $imgname = $this -> input -> post('imgname');

        // Delete metadata from database table
        $filename = $this -> da_search_model -> del_approved_image($imgname);

        // Delete file from directory
        $base_dir = realpath(FCPATH);
        $uploads_dir = '\image\approved_uploads';
        $file_path = $base_dir . $uploads_dir . "\\" . $imgname;

        unlink($file_path);

        $data = array(
            'filename'   => $filename,
            'dir'       => $file_path
        );

        // go back to ajax to print data
        echo json_encode($data);
    }

}
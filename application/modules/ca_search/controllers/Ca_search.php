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


        $this -> load -> model('ca_search_model');

        $data['results'] = $this -> ca_search_model -> get_search_results($search_array);

        $data['num_results']    = $this -> ca_search_model -> get_num_results($data['results']);

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
}
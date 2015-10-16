<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lookup extends MX_Controller
{

    public function __construct()
    {
        if (!$this->dx_auth->is_logged_in())
        {
            // redirect to login page
            redirect('security/auth', 'refresh');
        }

        parent::__construct();
    }

    public function index()
    {
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->load->library('session');

        $this->load->model('Lookup_model', 'Lookup');

        $view_vars = array(
            'title' => $this->config->item('Company_Title'),
            'heading' => $this->config->item('Company_Title'),
            'description' => $this->config->item('Company_Description'),
            'company' => $this->config->item('Company_Name'),
            'logo' => $this->config->item('Company_Logo'),
            'author' => $this->config->item('Company_Author')
        );

        $data['page_data'] = $view_vars;

        $this->load->view('lookup', $data);
    }

    public function execute_lookup()
    {
        $unique_id = $this->input->post('unique_id');

        $this->load->model('Lookup_model', 'Lookup');

        // third segment in the url is going to be the unique identifier
        // we will add a button to the page later, but for now that is how we will search for information
        $id = $this->uri->segment(3);

        $data['results'] = $this->Lookup->search($id);

        $this->load->view('lookup', $data);
    }
}
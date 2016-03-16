<?php
/**
 * Created by PhpStorm.
 * User: robertfulcher
 * Date: 11/17/15
 * Time: 6:50 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Prospect extends MX_Controller {

    public function __construct()
    {
        // redirect if this is not a cli request and the user is not logged in
        if (!$this->input->is_cli_request() && !$this->dx_auth->is_logged_in())
        {
            // redirect to login page
            redirect('security/auth', 'refresh');
        }

        // Load required models
        $this->load->model('Prospect_model', 'Prospect');

        $this->view_vars = array(
            'title' => $this->config->item('Company_Title'),
            'heading' => $this->config->item('Company_Title'),
            'description' => $this->config->item('Company_Description'),
            'company' => $this->config->item('Company_Name'),
            'logo' => $this->config->item('Company_Logo'),
            'author' => $this->config->item('Company_Author')
        );

        parent::__construct();
    }

    public function index() {
        $data['page_data'] = $this->view_vars;
        $data['start_date'] = date("m/d/Y", strtotime('-6 months'));
        $data['end_date'] = date("m/d/Y");
        $data['firstName'] = null;
        $data['lastName'] = null;
        $data['city'] = null;
        $data['state'] = null;
        $data['zip'] = null;
        $data['employer'] = null;
        $data['occupation'] = null;
        $data['results'] = $this->Prospect->get_all_reports();
        
        $this->load->view('index', $data);
    }

    public function submit() {
        $this->lib_gearman->gearman_client();

        $input = array(
            'startDate' => $this->input->post('startDate'),
            'endDate' => $this->input->post('endDate'),
            'firstName' => $this->input->post('firstName'),
            'lastName' => $this->input->post('lastName'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'zip' => $this->input->post('zip'),
            'employer' => $this->input->post('employer'),
            'occupation' => $this->input->post('occupation'),
            );
        
        $id = $this->Prospect->create_new_report($input);
        $this->lib_gearman->do_job_background('processProspectReport', serialize([
            'input' => $input,
            'id'    => $id,
            ]));

        // Redirect to report view
        redirect('/prospect/view/'.$id);
    }

    public function create() {
        $data['page_data'] = $this->view_vars;
        $this->load->view('prospect/create', $data);
    }

    public function delete() {
        // TODO: Provide feedback via a flash message
        $this->Prospect->delete_report($this->uri->segment(3));
        $data['page_data'] = $this->view_vars;
        redirect('/prospect');
    }

    public function view() {
        $data['page_data'] = $this->view_vars;

        // Grab report id from URI
        $report_id = $this->uri->segment(3);

        if(!$report_id) {
            // TODO: better error handling (display error)
            redirect('/prospect');
        }

        // Attempt to retreive report
        $report = $this->Prospect->get_report($report_id);
        $data['results'] = $report;

        if($report->status_code < Prospect_model::STATUS_COMPLETED) {
            $this->output->set_header('refresh:5; url='.current_url());
            $this->load->view('prospect/processing', $data);
        }

        if(empty($report)) {
            // TODO: better error handling (display error)
            redirect('/prospect');
        }

        $this->load->view('prospect/view', $data);
    }

    function prospect_report_worker($job) {
        $data = unserialize($job->workload());

        $this->Prospect->set_report_in_progress($data['id']);

        $query = $this->Prospect->get_matching_list($data['input']);
        $result = array();

        if ($query->num_rows() > 0)
        {
           foreach ($query->result() as $row)
           {
                $result['data'][] = $row;
           }
        }

        $this->Prospect->set_report_result($data['id'], $result);

        // set status to completed
    }

    public function worker() {
        $worker = $this->lib_gearman->gearman_worker();

        // Register functions to worker
        $this->lib_gearman->add_worker_function('processProspectReport', array($this, 'prospect_report_worker'));

        while ($this->lib_gearman->work()) {
            if (!$worker->returnCode()) {
                log_message('debug', get_class($this) . " worker done successfully.");
            }
            if ($worker->returnCode() != GEARMAN_SUCCESS) {
                log_message('error', get_class($this) . " worker: " . $this->lib_gearman->current('worker')->returnCode());
                break;
            }
        }
    }




}
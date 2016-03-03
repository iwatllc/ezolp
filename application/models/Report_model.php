<?php

class Report_model extends CI_Model {

    const STATUS_WAITING = 0;
    const STATUS_IN_PROGRESS = 1;
    const STATUS_COMPLETED = 2;
    const STATUS_ERROR = 9;
    
    public function __construct()
    {
        $this->tableName = 'reports';
        parent::__construct();
    }

    /*
     * Persists the request for a new report in the database
     */
    public function create_new_report($input) {
        $this->db->insert($this->tableName, [
            'input' => json_encode(['data' => $input]),
            'creation_date' => date("Y-m-d H:i:s"),
            'status_code' => Report_model::STATUS_WAITING,
            ]);

        return $this->db->insert_id();
    }

    /*
     * Sets a report's status to STATUS_IN_PROGRESS
     */
    public function set_report_in_progress($id) {
        $this->db->where('id', $id);
        $this->db->update($this->tableName, [
                'status_code' => Report_model::STATUS_IN_PROGRESS,
            ]);
    }

    /*
     * Stores the result for a report and sets status to STATUS_COMPLETED
     */
    public function set_report_result($id, $result) {
        $this->db->where('id', $id);
        $this->db->update($this->tableName, [
                'results' => json_encode($result),
                'status_code' => Report_model::STATUS_COMPLETED,
            ]);
    }

    /*
     * Retrieves a report
     */
    public function get_report($id) {
        $this->db->from($this->tableName);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $row = $query->row();

        // Decode json
        if(isset($row->input)) {
            $row->input = json_decode($row->input)->data;
        }
        if(isset($row->results)) {
            $row->results = json_decode($row->results);
        }

        return $row;
    }

    /*
     * Retrieves all reports
     */
    public function get_all_reports() {
        $this->db->select('id, input, creation_date, status_code');
        $this->db->from($this->tableName);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();

        $result = array();

        foreach ($query->result() as $row)
        {
            // Decode json
            if(isset($row->input)) {
                $row->input = json_decode($row->input)->data;
            }
            // Status Names
            switch ($row->status_code) {
                case Report_model::STATUS_WAITING:
                    $row->status_name = "Queued";
                    break;
                case Report_model::STATUS_IN_PROGRESS:
                    $row->status_name = "In Progress";
                    break;
                case Report_model::STATUS_COMPLETED:
                    $row->status_name = "Completed";
                    break;
                case Report_model::STATUS_ERROR:
                    $row->status_name = "Error";
                    break;
                default:
                    $row->status_name = "Unknown";
            }

            $result[] = $row;
        }

        return $result;
    }


}
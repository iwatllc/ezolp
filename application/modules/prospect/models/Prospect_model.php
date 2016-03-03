<?php

/**
 * Created by PhpStorm.
 * User: robertfulcher
 * Date: 11/18/15
 * Time: 4:54 PM
 */
class Prospect_model extends Report_model {

    public function __construct()
    {
        parent::__construct();

        // Configure the table name used for storing reports
        $this->tableName = 'prospect_reports';
    }

    public function get_matching_list($filters) {

        $this->db->query('SET SQL_BIG_SELECTS=1');
        $this->db->select('contributors.*, prospect.* ');
        $this->db->from('contributors');
        $this->db->join('prospect', 'contributors.lastname = prospect.lastname AND contributors.firstname = prospect.firstname');

        // Append where conditions when needed
        if(!empty($filters['startDate'])) {
            $startDate = DateTime::createFromFormat('m/d/Y', $filters['startDate'])->format("Y-m-d");
            $this->db->where('contributors.transaction_date >=', $startDate);
        }
        if(!empty($filters['endDate'])) {
            $endDate = DateTime::createFromFormat('m/d/Y', $filters['endDate'])->format("Y-m-d");
            $this->db->where('contributors.transaction_date <=', $endDate);
        }
        if(!empty($filters['zip'])) {
            $this->db->where('contributors.zip_code', $filters['zip']);
        }
        if(!empty($filters['firstName'])) {
            $this->db->like('contributors.firstname', $filters['firstName']);
        }
        if(!empty($filters['lastName'])) {
            $this->db->like('contributors.lastname', $filters['lastName']);
        }
        if(!empty($filters['city'])) {
            $this->db->like('contributors.city', $filters['city']);
        }
        if(!empty($filters['state'])) {
            $this->db->like('contributors.state', $filters['state']);
        }
        if(!empty($filters['occupation'])) {
            $this->db->like('contributors.occupation', $filters['occupation']);
        }
        if(!empty($filters['employer'])) {
            $this->db->like('contributors.employer', $filters['employer']);
        }

        $query = $this->db->get();

        print_r($this->db->last_query());

        return $query;

    }

}
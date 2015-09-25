<?php

class Dashboard_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Return the entire amount thus far from virtualterminal_submissions table.
     */
    public function get_total_amount_vt()
    {
        $this->db->select_sum('amount');
        $this->db->from('virtualterminal_submissions');

        $query = $this->db->get();

        return $query->row()->amount;
    }

    /**
     * Return the number of unique names in virtualterminal_submissions table.
     */
    public function get_total_customers_vt()
    {
        $this->db->distinct();
        $this->db->select('name');
        $this->db->from('virtualterminal_submissions');

        $query = $this->db->get();

        return $query->num_rows();
    }
}
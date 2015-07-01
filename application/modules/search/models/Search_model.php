<?php

class Search_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Return 10 rows of transactions from the db
     */
     public function return_ten()
     {
         $this->db->limit(10);
         $this->db->select('*');
         $this->db->from('virtualterminal_submissions');
         
         return $this->db->get();
     }
}

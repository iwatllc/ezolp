<?php

class Classifiedad_model extends CI_Model {

    public function __construct()
    {
            parent::__construct();
    }

    public function add_classifiedad_submission($data)
    {
        $this -> db -> insert('classifiedad_submissions', $data);

        return $this -> db -> insert_id();
    }

    function check_promo_code($code)
    {
        $current_date = date('Y-n-j H:i:s');

        $this -> db -> where('code', $code);
        $this -> db -> where('startdate <=', $current_date);
        $this -> db -> where('enddate >=', $current_date);
        $query = $this -> db -> get('ca_promo');
        if ($query -> num_rows() > 0)
        {
            return $query -> row();
        }
        else
        {
            return '';
        }
    }
    
    public function get_monthlypricing_listing()
    {
        $this -> db -> select('*') -> from('classifiedad_pricing') -> order_by('classifiedad_pricing.fee', 'ASC');

        return $this -> db -> get();

    }

}
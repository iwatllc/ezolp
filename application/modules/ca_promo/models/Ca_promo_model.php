<?php

class Ca_promo_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function list_all_promos($offset = 0, $row_count = 0)
    {
        if ($offset >= 0 AND $row_count > 0)
        {
            $query = $this -> db -> get('ca_promo', $row_count, $offset);
        }
        else
        {
            $query = $this->db->get('ca_promo');
        }

        return $query;
    }

    function add_promo($code, $description, $begindate, $enddate, $months, $percentage, $createddate)
    {
        $data = array(
            'code'          => $code,
            'description'   => $description,
            'startdate'     => $begindate,
            'enddate'       => $enddate,
            'percentage'    => $percentage,
            'months'        => $months,
            'created'       => $createddate
        );

        $this -> db -> insert ('ca_promo', $data);

        $id = $this -> db -> insert_id(); // get row that was just inserted

        return $id;
    }

    function update_promo($id, $code, $description, $begindate, $enddate, $months, $percentage, $modifieddate)
    {
        $data = array(
            'code'          => $code,
            'description'   => $description,
            'startdate'     => $begindate,
            'enddate'       => $enddate,
            'percentage'    => $percentage,
            'months'        => $months,
            'modified'      => $modifieddate
        );

        $this -> db -> where('id', $id) -> update('ca_promo', $data);

//        $id = $this -> db -> insert_id(); // get row that was just inserted

        return $id;
    }

    function get_promo($id)
    {
        $row = $this -> db -> select('*') -> where('id', $id) -> get('ca_promo') -> row();

        return $row;
    }

    function get_num_promos()
    {
        $num_rows = $this -> db -> select('*') -> get('ca_promo') -> num_rows();

        return $num_rows;
    }

    function del_promocode($id)
    {
        $this -> db -> query("DELETE FROM ca_promo where id = ". $id);
    }

}
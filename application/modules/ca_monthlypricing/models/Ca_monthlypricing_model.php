<?php
/**
 * Created by PhpStorm.
 * User: afrazer
 * Date: 3/7/2016
 * Time: 8:43 PM
 */
class Ca_monthlypricing_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function list_all_pricings($offset = 0, $row_count = 0)
    {
        if ($offset >= 0 AND $row_count > 0)
        {
            $query = $this -> db -> get('classifiedad_pricing', $row_count, $offset);
        }
        else
        {
            $query = $this -> db -> get('classifiedad_pricing');
        }

        return $query;
    }

    function add_pricing($name, $fee, $fixed, $charsize, $createddate)
    {
        $data = array(
            'name'          => $name,
            'fee'           => $fee,
            'fixed'         => $fixed,
            'maxcharsize'   => $charsize,
            'created'       => $createddate
        );

        $this -> db -> insert ('classifiedad_pricing', $data);

        $id = $this -> db -> insert_id(); // get row that was just inserted

        return $id;
    }

    function update_pricing($id, $name, $fixed, $fee, $charsize, $modifieddate)
    {
        $data = array(
            'name'          => $name,
            'fixed'           => $fixed,
            'fee'           => $fee,
            'maxcharsize'   => $charsize,
            'modified'      => $modifieddate
        );

        $this -> db -> where('id', $id) -> update('classifiedad_pricing', $data);

//        $id = $this -> db -> insert_id(); // get row that was just inserted

        return $id;
    }

    function get_pricing($id)
    {
        $row = $this -> db -> select('*') -> where('id', $id) -> get('classifiedad_pricing') -> row();

        return $row;
    }

    function get_num_pricings()
    {
        $num_rows = $this -> db -> select('*') -> get('classifiedad_pricing') -> num_rows();

        return $num_rows;
    }

    function del_pricing($id)
    {
        $this -> db -> query("DELETE FROM classifiedad_pricing where id = ". $id);
    }

}
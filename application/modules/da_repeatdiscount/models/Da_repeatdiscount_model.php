<?php
/**
 * Created by PhpStorm.
 * User: afrazer
 * Date: 3/7/2016
 * Time: 8:43 PM
 */
class Da_repeatdiscount_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function list_all_discounts($offset = 0, $row_count = 0)
    {
        if ($offset >= 0 AND $row_count > 0)
        {
            $query = $this -> db -> order_by("numissues", "asc") -> get('displayad_discount', $row_count, $offset);
        }
        else
        {
            $query = $this -> db -> order_by("numissues", "asc") ->  get('displayad_discount');
        }

        return $query;
    }

    function add_discount($issues, $percentage, $createddate)
    {
        $data = array(
            'numissues'             => $issues,
            'percentagediscount'    => $percentage,
            'created'               => $createddate
        );

        $this -> db -> insert ('displayad_discount', $data);

        $id = $this -> db -> insert_id(); // get row that was just inserted

        return $id;
    }

    function get_discount($id)
    {
        $row = $this -> db -> select('*') -> where('id', $id) -> get('displayad_discount') -> row();

        return $row;
    }

    function get_num_discounts()
    {
        $num_rows = $this -> db -> select('*') -> get('displayad_discount') -> num_rows();

        return $num_rows;
    }

    function del_discount($id)
    {
        $this -> db -> query("DELETE FROM displayad_discount WHERE id = ". $id);
    }

}
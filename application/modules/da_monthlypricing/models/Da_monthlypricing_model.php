<?php
/**
 * Created by PhpStorm.
 * User: afrazer
 * Date: 3/7/2016
 * Time: 8:43 PM
 */
class Da_monthlypricing_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function list_all_pricings($offset = 0, $row_count = 0)
    {
        if ($offset >= 0 AND $row_count > 0)
        {
            $query = $this -> db -> get('displayad_pricing', $row_count, $offset);
        }
        else
        {
            $query = $this->db->get('displayad_pricing');
        }

        return $query;
    }

    function add_pricing($size, $bwprice, $colorprice, $createddate)
    {
        $data = array(
            'pagesize'      => $size,
            'bwprice'       => $bwprice,
            'colorprice'    => $colorprice,
            'created'       => $createddate
        );

        $this -> db -> insert ('displayad_pricing', $data);

        $id = $this -> db -> insert_id(); // get row that was just inserted

        return $id;
    }

    function get_pricing($id)
    {
        $row = $this -> db -> select('*') -> where('id', $id) -> get('displayad_pricing') -> row();

        return $row;
    }

    function get_num_pricings()
    {
        $num_rows = $this -> db -> select('*') -> get('displayad_pricing') -> num_rows();

        return $num_rows;
    }

    function del_pricing($id)
    {
        $this -> db -> query("DELETE FROM displayad_pricing where id = ". $id);
    }

}
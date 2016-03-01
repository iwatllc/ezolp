<?php
/**
 * Created by PhpStorm.
 * User: afrazer
 * Date: 2/29/2016
 * Time: 9:27 PM
 */

class Displayad_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function add_displayad_submission($data)
    {
        $this -> db -> insert('displayad_submissions', $data);

        return $this -> db -> insert_id();
    }

    function check_promo_code($code)
    {
        $this -> db -> where('code',$code);
        $query = $this -> db -> get('da_promo');
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
        $this -> db -> select('*') -> from('displayad_pricing') -> order_by('displayad_pricing.bwprice', 'DESC');

        return $this -> db -> get();

    }

    public function get_discounts_listing()
    {
        $this -> db -> select('*') -> from('displayad_discount') -> order_by('displayad_discount.numissues', 'DESC');

        return $this -> db -> get();
    }

}
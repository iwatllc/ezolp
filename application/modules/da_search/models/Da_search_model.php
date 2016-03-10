<?php
/**
 * Created by PhpStorm.
 * User: afrazer
 * Date: 3/9/2016
 * Time: 10:52 AM
 */

class Da_search_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_promocode_dropdown_list()
    {
        $this -> db -> from('da_promo');
        $this -> db -> order_by('code');
        $result = $this -> db -> get();

        $return = array();

        if ($result -> num_rows() > 0)
        {
            $return[''] = '';
            foreach ($result->result_array() as $row)
            {
                $return[$row['code']] = $row['code'];
            }
        }

        return $return;
    }

    public function get_pricing_list()
    {
        $this -> db -> from('displayad_pricing');
        $this -> db -> order_by('bwprice');
        $result = $this -> db -> get();

        $return = array();

        if ($result -> num_rows() > 0)
        {
            $return[''] = '';
            foreach ($result -> result_array() as $row)
            {
                $return[$row['pagesize']] = $row['pagesize'];
            }
        }

        return $return;
    }

    public function get_search_results($search_array)
    {
        // only search if search_array has something in it
        if (!empty($search_array))
        {
            $this -> db -> select('*');
            $this -> db -> from('displayad_submissions');

            if ($search_array['contactinfo'] != NULL)
            {
                // split up strings by spaces
                if ( preg_match('/\s/',$search_array['contactinfo']) ) // if there are spaces in the string
                {
                    $pieces = explode(" ", $search_array['contactinfo']);

                    foreach($pieces as $piece)
                    {
                        $this -> db -> where(
                            '(firstname LIKE'           . $this->db->escape($piece)
                            .' OR lastname LIKE'        . $this->db->escape($piece)
                            .' OR streetaddress LIKE'   . $this->db->escape('%'.$piece.'%')
                            .' OR city LIKE'            . $this->db->escape($piece)
                            .' OR state LIKE'           . $this->db->escape($piece)
                            .' OR zip LIKE'             . $this->db->escape($piece)
                            .' OR email LIKE'           . $this->db->escape('%'.$piece.'%') . ')'
                        );
                    }
                } else
                {
                    $this -> db -> where('firstname', $search_array['contactinfo']);
                    $this -> db -> or_where('lastname', $search_array['contactinfo']);
                    $this -> db -> or_where('streetaddress LIKE '.$this->db->escape('%'.$search_array['contactinfo'].'%'));
                    $this -> db -> or_where('city', $search_array['contactinfo']);
                    $this -> db -> or_where('state', $search_array['contactinfo']);
                    $this -> db -> or_where('zip', $search_array['contactinfo']);
                    $this -> db -> or_where('email LIKE '.$this->db->escape('%'.$search_array['contactinfo'].'%'));
                }

            }

            if ($search_array['pricing'] != NULL)
            {
                $this -> db -> where('option LIKE '.$this->db->escape('%'.$search_array['pricing'].'%'));
            }

            if ($search_array['promocode'] != NULL)
            {
                $this -> db -> where('promocode', $search_array['promocode']);
            }

            if ($search_array['issues'] != NULL)
            {
                foreach ($search_array['issues'] as $issue)
                {
                    $this -> db -> where('issues LIKE '.$this->db->escape('%'.$issue.'%'));
                }
            }

            if ($search_array['begindate'] != NULL && $search_array['enddate'] != NULL)
            {
                $this -> db -> where('DATE(created) >=', $search_array['begindate']) -> where('DATE(created) <=', $search_array['enddate']);
            } else if ($search_array['begindate'] != NULL)
            {
                $this -> db -> where('DATE(created) >=', $search_array['begindate']);
            } else if ($search_array['enddate'] != NULL)
            {
                $this -> db -> where('DATE(created) <=', $search_array['enddate']);
            }

            $this -> db -> order_by('created', 'DESC');

            // uncomment this to get the db query
//            echo $this->db->get_compiled_select();

            return $this -> db -> get();

        } else
        {
            return NULL; // search array is empty
        }

    }

}